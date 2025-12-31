<?php

namespace App\Services;

use App\Models\Package;
use App\Models\User;
use App\Models\Subscription;
use App\Repositories\UserRepository;
use App\Exceptions\SubscriptionException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use App\Models\Vendor;
use Exception;

class SubscriptionService
{
    const PAYMENT_METHOD_SELF = 'self';
    const PAYMENT_STATUS_COMPLETE = 'complete';
    const PACKAGE_TYPE_FREE = 'free';

    public function __construct(
        protected UserRepository $userRepo
    ) {}

    public function getPackageInfo(string|int|null $packageIdentifier = null)
    {
        $query = Package::query();

        if (empty($packageIdentifier)) {
            $package = $query->where('is_default', true)->first();
        } elseif (is_numeric($packageIdentifier)) {
            $package = $query->find($packageIdentifier);
        } else {
            $package = $query->where('slug', $packageIdentifier)->first();
        }

        if ($package) {
            $package->module_list = $this->getModuleInfo(
                json_decode($package->module_ids, true) ?? []
            );
        }

        return $package;
    }


    public function getModuleInfo(array $moduleIds = []): Collection
    {
        if (empty($moduleIds)) {
            return collect([]);
        }

        return DB::table('module_list')->whereIn('id', $moduleIds)->get();
    }


    public function upgrade($userIdentifier, $packageIdentifier, $registrationFrom = 'subscription')
    {
        $redirectUrl = url('/subscription');

        try {
            $user = $this->findUser($userIdentifier);
            $package = $this->findPackage($packageIdentifier);

            if (!$user || !$package) {
                return ['error' => __('invalid_request')];
            }



            return DB::transaction(function () use ($user, $package, $registrationFrom, $redirectUrl) {
                $existingSubscription = Subscription::where('user_id', $user->id)
                    ->where('is_payment', false)
                    ->where('is_expired', false)
                    ->latest('start_date')
                    ->first();

                $subscriptionData = $this->prepareSubscriptionData($user, $package);

                $subscriptionId = $existingSubscription
                    ? $this->updateSubscription($subscriptionData, $existingSubscription->id, $user->id)
                    : $this->createSubscription($subscriptionData, $user->id);

                if (isset($subscriptionId['error'])) {
                    return $subscriptionId['error'];
                }


                // Handle free packages
                if ($this->isFreePackage($package)) {
                    $paymentData = $this->processFreePackagePayment($package, $user, $subscriptionId);

                    return [
                        'redirect' => url("payment/success/{$user->username}")
                            . "?txn_id={$paymentData['txn_id']}"
                            . "&method={$paymentData['method']}"
                            . "&amount={$paymentData['amount']}"
                    ];
                }

                // Redirect to payment method selection
                return [
                    'redirect' => url("payment-method/{$user->username}/{$package->slug}")
                ];
            });
        } catch (SubscriptionException $e) {
            DB::rollBack();
            return [
                'redirect' => $redirectUrl,
                'error' => $e->getMessage()
            ];
        } catch (Exception $e) {
            DB::rollBack();
            report($e); // Log to monitoring system
            return [
                'redirect' => $redirectUrl,
                'error' => __('error_processing_subscription')
            ];
        }
    }


    protected function processFreePackagePayment(Package $package, User $user, int $subscriptionId)
    {
        $paymentData = [
            'user_id' => $user->id,
            'package_id' => $package->id,
            'amount' => 0,
            'currency' => config('settings.currency', 'USD'),
            'status' => self::PAYMENT_STATUS_COMPLETE,
            'method' => self::PAYMENT_METHOD_SELF,
            'payment_by' => self::PAYMENT_METHOD_SELF,
            'is_payment' => true,
            'is_expired' => false,
            'active_date' => now()->format('Y-m-d H:i:s'),
            'payment_date' => now()->format('Y-m-d H:i:s'),
            'txn_id' => Str::random(14),
            'all_info' => json_encode([]),
        ];


        // Expire all existing subscriptions
        Subscription::where('user_id', $user->id)
            ->update(['is_expired' => true]);

        // Update current subscription
        Subscription::where('id', $subscriptionId)
            ->update($paymentData);

        // Update user's subscription
        $user->update([
            'subscription_id' => $subscriptionId,
            'package_id' => $package->id
        ]);

        return $paymentData;
    }

    protected function createSubscription(array $data, int $userId)
    {
        try {
            $subscription = Subscription::create($data);

            // FIXED: Use ->id instead of model object
            User::where('id', $userId)->update([
                'subscription_id' => $subscription->id,
                'package_id' => $data['package_id']
            ]);

            // FIXED: Return ID instead of model object
            return $subscription->id;
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }


    protected function updateSubscription(array $data, int $subscriptionId, int $userId)
    {
        try {
            Subscription::where('id', $subscriptionId)
                ->where('user_id', $userId)
                ->update($data);

            return $subscriptionId;
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }



    public function findUser(string|int $identifier): ?User
    {
        $user = is_numeric($identifier)
            ? User::find($identifier)
            : User::where('username', $identifier)->first();

        if ($user) {
            $user->user_id = $user->id;
            $user->makeHidden([
                'two_factor_secret',
                'two_factor_recovery_codes',
                'two_factor_confirmed_at',
                'email_verified_at',
                'remember_token',
                'login_time',
                'created_at',
                'updated_at',
                'password',
            ]);
        }
        return $user;
    }


    public function findPackage(string|int $identifier): ?Package
    {
        $package = is_numeric($identifier)
            ? Package::find($identifier)
            : Package::where('slug', $identifier)->first();

        if ($package) {
            $package->package_id = $package->id;
            $package->makeHidden([
                'created_at',
                'updated_at',
            ]);
        }
        return $package;
    }


    protected function prepareSubscriptionData(User $user, Package $package): array
    {
        return [
            'user_id' => $user->id,
            'package_id' => $package->id,
            'package_price' => $package->price ?? 0,
            'start_date' => now()->format('Y-m-d H:i:s'),
            'expire_date' => $this->calculateExpireDate($package),
            'is_payment' => 0,
        ];
    }


    protected function calculateExpireDate($package)
    {
        return addDays($package->package_type, $package->duration);
    }


    protected function isFreePackage(Package $package)
    {
        return $package->price == 0 || $package->package_type === self::PACKAGE_TYPE_FREE;
    }




    public function verify_profile($user_id = null, $vendor_id = 0)
    {
        if (!empty($vendor_id)) {
            $vendor = Vendor::find($vendor_id);
            if ($vendor) {
                $vendor->update([
                    'is_verified' => 1
                ]);
            }
        }
    }

    public function insertFeatures(int $user_id): bool
    {
        return DB::transaction(function () use ($user_id) {

            $now = dateTime();

            $packageId = User::whereKey($user_id)->value('package_id');

            $packageFeatureIds = $packageId
                ? DB::table('active_package_features')
                ->where('package_id', $packageId)
                ->where('status', 1)
                ->pluck('feature_id')
                ->toArray()
                : [];

            $existingFeatures = DB::table('subscribe_features')
                ->where('user_id', $user_id)
                ->get(['id', 'feature_id', 'is_package'])
                ->keyBy('feature_id');

            $insertData = [];

            foreach (DB::table('feature_list')->pluck('id') as $featureId) {
                $isPackage = in_array($featureId, $packageFeatureIds) ? 1 : 0;

                if (!isset($existingFeatures[$featureId])) {
                    $insertData[] = [
                        'user_id'    => $user_id,
                        'feature_id' => $featureId,
                        'status'     => $isPackage, // Only check if it's in the package
                        'is_package' => $isPackage,
                        'created_at' => $now,
                    ];
                } elseif ($existingFeatures[$featureId]->is_package != $isPackage) {
                    DB::table('subscribe_features')
                        ->where('id', $existingFeatures[$featureId]->id)
                        ->update([
                            'status'     => $isPackage, // Sync status with package
                            'is_package' => $isPackage,
                        ]);
                }
            }

            if ($insertData) {
                DB::table('subscribe_features')->insert($insertData);
            }

            return true;
        });
    }

    public function insertOrderTypesIfNotExists(
        int $moduleId,
        int $vendorId,
        int $userId
    ): bool {
        return DB::transaction(function () use ($moduleId, $vendorId, $userId) {

            // Module order types (package)
            $module = DB::table('module_list')
                ->where('id', $moduleId)
                ->select('order_type_ids')
                ->first();

            $packageOrderTypes = [];
            if ($module && $module->order_type_ids && isJson($module->order_type_ids)) {
                $packageOrderTypes = json_decode($module->order_type_ids, true);
            }

            // Fast lookup map
            $packageMap = array_flip($packageOrderTypes);

            // All order types
            $allOrderTypes = DB::table('order_type_list')
                ->select('id')
                ->get();

            // Existing subscribed order types
            $existing = DB::table('subscribed_order_types')
                ->where('user_id', $userId)
                ->where('vendor_id', $vendorId)
                ->get(['id', 'order_type_id', 'is_package'])
                ->keyBy('order_type_id');

            $now = dateTime();
            $insertData = [];

            foreach ($allOrderTypes as $orderType) {
                $isPackage = isset($packageMap[$orderType->id]) ? 1 : 0;

                if (!$existing->has($orderType->id)) {
                    // Insert missing
                    $insertData[] = [
                        'user_id'         => $userId,
                        'vendor_id'       => $vendorId,
                        'order_type_id'   => $orderType->id,
                        'is_payment'      => 0,
                        'is_required'     => 0,
                        'is_admin_enable' => $isPackage, // Only enable if it's in the package
                        'is_package'      => $isPackage,
                    ];
                } elseif ($existing[$orderType->id]->is_package != $isPackage) {
                    // Update only if changed
                    DB::table('subscribed_order_types')
                        ->where('id', $existing[$orderType->id]->id)
                        ->update([
                            'is_admin_enable' => $isPackage, // Sync status with package
                            'is_package'      => $isPackage,
                            'updated_at'      => $now,
                        ]);
                }
            }

            // Bulk insert
            if (!empty($insertData)) {
                DB::table('subscribed_order_types')->insert($insertData);
            }

            return true;
        });
    }



    public function checkPaymentMethod(int $user_id): void
    {
        $activeGateways = DB::table('payment_gateway_list')
            ->where('status', 1)
            ->get();

        $existingSlugs = DB::table('vendor_payment_list')
            ->where('user_id', $user_id)
            ->pluck('slug')
            ->toArray();

        foreach ($activeGateways as $gateway) {
            if (!in_array($gateway->slug, $existingSlugs)) {
                DB::table('vendor_payment_list')->insert([
                    'user_id'          => $user_id,
                    'title'            => $gateway->title,
                    'slug'             => $gateway->slug,
                    'status'           => 1,
                    'is_admin_enabled' => 1,
                ]);
            }
        }
    }

    /**
     * Orchestrate all access-related data synchronization for a user.
     * This ensures features, order types, and payment methods are up-to-date.
     */
    public function syncUserAccessData(int $userId): void
    {
        // 1. Sync Features
        $this->insertFeatures($userId);

        // 2. Sync Order Types (if vendor exists)
        $vendor = DB::table('vendor_list')->where('user_id', $userId)->first();
        if ($vendor && $vendor->module_id) {
            $this->insertOrderTypesIfNotExists(
                (int)$vendor->module_id,
                (int)$vendor->id,
                $userId
            );
        }

        // 3. Sync Payment Methods
        $this->checkPaymentMethod($userId);
    }
}
