<?php

namespace App\Services;

use App\Models\Coupon;
use App\Models\OrderSession;
use App\Models\OrderTypeConfig;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderService
{
    public function getIdentifier(): array
    {
        if (Auth::guard('customer')->check()) {
            return ['customer_id' => Auth::guard('customer')->id()];
        }

        return ['session_id' => Session::getId()];
    }

    public function getOrCreate(int $vendorId): OrderSession
    {
        return OrderSession::firstOrCreate(
            array_merge($this->getIdentifier(), ['vendor_id' => $vendorId]),
            [
                'order_type' => 'dine_in',
                'owner_id'   => __activeOwnerId($vendorId)
            ]
        );
    }

    public function setOrderType(int $vendorId, string $orderType): void
    {
        $config = OrderTypeConfig::where('order_type', $orderType)
            ->where('status', true)
            ->firstOrFail();

        $orderSession = $this->getOrCreate($vendorId);

        $orderSession->update([
            'order_type'          => $orderType,
            'service_charge_type' => $config->service_charge_type,
            'service_charge_rate' => $config->service_charge_rate,
            'tax_rate'            => $config->tax_rate,
            'tip_amount'          => $config->tips_enabled ? $orderSession->tip_amount : 0,
            'tip_rate'            => $config->tips_enabled ? $orderSession->tip_rate : 0,
            'tip_type'            => $config->tips_enabled ? $orderSession->tip_type : null,
        ]);
    }

    public function setTip(int $vendorId, string $type, float $value): void
    {
        $orderSession = $this->getOrCreate($vendorId);

        $orderSession->update(
            $type === 'percentage'
                ? ['tip_type' => 'percentage', 'tip_rate' => $value, 'tip_amount' => 0]
                : ['tip_type' => 'flat', 'tip_amount' => $value, 'tip_rate' => 0]
        );
    }

    public function applyCoupon(int $vendorId, string $code, float $orderTotal): array
    {
        $coupon = Coupon::where('code', strtoupper($code))
            ->where('vendor_id', $vendorId)
            ->first();

        if (!$coupon || !$coupon->isValid($orderTotal)) {
            return [
                'success' => false,
                'message' => !$coupon
                    ? 'Coupon not found.'
                    : ($orderTotal < $coupon->min_order_amount
                        ? "Minimum order ৳{$coupon->min_order_amount} required."
                        : 'Coupon is invalid or expired.'),
            ];
        }

        $this->getOrCreate($vendorId)->update([
            'discount_code'   => $coupon->code,
            'discount_type'   => $coupon->type,
            'discount_rate'   => $coupon->type === 'percentage' ? $coupon->value : 0,
            'discount_amount' => $coupon->type === 'flat' ? $coupon->value : 0,
        ]);

        return ['success' => true, 'message' => 'Coupon applied successfully!'];
    }

    public function removeCoupon(int $vendorId): void
    {
        $this->getOrCreate($vendorId)->update([
            'discount_code'   => null,
            'discount_type'   => null,
            'discount_rate'   => 0,
            'discount_amount' => 0,
        ]);
    }

    public function recalculate(int $vendorId, $items): OrderSession
    {
        $orderSession = $this->getOrCreate($vendorId);

        // 1. Subtotal
        $subtotal = 0;
        foreach($items as $item) {
            $subtotal += (float)$item->price * (int)$item->quantity;
        }

        // 2. Service charge
        $serviceChargeAmount = 0;
        if ($orderSession->service_charge_rate > 0) {
            if ($orderSession->service_charge_type === 'item_based') {
                foreach($items as $i) {
                    $serviceChargeAmount += ((float)$i->price * (int)$i->quantity) * ((float)$orderSession->service_charge_rate / 100);
                }
            } else {
                $serviceChargeAmount = $subtotal * ((float)$orderSession->service_charge_rate / 100);
            }
        }

        // 3. Tax (on subtotal + service charge)
        $taxAmount = ($subtotal + $serviceChargeAmount) * ((float)$orderSession->tax_rate / 100);

        // 4. Discount
        $discountAmount = match ($orderSession->discount_type) {
            'percentage' => $subtotal * ((float)$orderSession->discount_rate / 100),
            'flat'        => min((float) $orderSession->discount_amount, $subtotal),
            default      => 0,
        };

        // 5. Tip
        $tipAmount = $orderSession->tip_type === 'percentage'
            ? $subtotal * ((float)$orderSession->tip_rate / 100)
            : (float) ($orderSession->tip_amount ?? 0);

        // 6. Grand total
        $grandTotal = max(
            $subtotal + $serviceChargeAmount + $taxAmount + $tipAmount - $discountAmount,
            0
        );

        $orderSession->update([
            'subtotal'              => round($subtotal, 2),
            'service_charge_amount' => round($serviceChargeAmount, 2),
            'tax_amount'            => round($taxAmount, 2),
            'tip_amount'            => round($tipAmount, 2),
            'discount_amount'       => round($discountAmount, 2),
            'grand_total'           => round($grandTotal, 2),
        ]);

        return $orderSession->fresh();
    }

    public function fullSummary(CartService $cart): array
    {
        $vendors = $cart->itemsByVendor();
        $vendorSummaries = [];
        $grandTotal = 0;
        $totalSubtotal = 0;
        $totalTax = 0;
        $totalServiceCharge = 0;
        $totalTip = 0;
        $totalDiscount = 0;

        foreach ($vendors as $vendorId => $items) {
            $sum = $this->summary((int)$vendorId, $items);
            $vendorSummaries[$vendorId] = $sum;
            $grandTotal += $sum['grand_total'];
            $totalSubtotal += $sum['subtotal'];
            $totalTax += $sum['tax_amount'];
            $totalServiceCharge += $sum['service_charge_amount'];
            $totalTip += $sum['tip_amount'];
            $totalDiscount += $sum['discount_amount'];
        }

        $summary = [
            'vendor_summaries'     => $vendorSummaries,
            'grand_total'          => round($grandTotal, 2),
            'total_subtotal'       => round($totalSubtotal, 2),
            'total_tax'            => round($totalTax, 2),
            'total_service_charge' => round($totalServiceCharge, 2),
            'total_tip'            => round($totalTip, 2),
            'total_discount'       => round($totalDiscount, 2),
            'total_count'          => $cart->count(),
            'items_by_vendor'      => $vendors,
        ];

        $summary['details'] = $this->get_total_details($summary, true);
        return $summary;
    }

    /**
     * Generate structured rows for order totals
     * @param array $summary The summary data (can be global or per-vendor)
     * @param bool $isGlobal Whether this is the global cart summary (affects prefix)
     */
    public function get_total_details(array $summary, bool $isGlobal = false): array
    {
        $p = $isGlobal ? 'total_' : '';
        // Map keys if not prefixed (for single vendor summary)
        $subtotal = $summary[$p . 'subtotal'] ?? 0;
        $tax      = $summary[$p . 'tax'] ?? ($summary['tax_amount'] ?? 0);
        $svc      = $summary[$p . 'service_charge'] ?? ($summary['service_charge_amount'] ?? 0);
        $tip      = $summary[$p . 'tip'] ?? ($summary['tip_amount'] ?? 0);
        $discount = $summary[$p . 'discount'] ?? ($summary['discount_amount'] ?? 0);
        $total    = $summary[$isGlobal ? 'grand_total' : 'grand_total'] ?? ($summary['grand_total'] ?? 0);

        $details = [];
        $details[] = [
            'label'    => !empty(lang('subtotal')) ? lang('subtotal') : 'Subtotal',
            'value'    => $subtotal,
            'type'     => 'subtotal',
            'is_total' => false
        ];

        if ($tax > 0) {
            $details[] = [
                'label'    => !empty(lang('tax')) ? lang('tax') : 'Tax',
                'value'    => $tax,
                'type'     => 'tax',
                'is_total' => false
            ];
        }

        if ($svc > 0) {
            $details[] = [
                'label'    => !empty(lang('service_charge')) ? lang('service_charge') : 'Service Charge',
                'value'    => $svc,
                'type'     => 'service_charge',
                'is_total' => false
            ];
        }

        if ($tip > 0) {
            $details[] = [
                'label'    => !empty(lang('tip')) ? lang('tip') : 'Tip',
                'value'    => $tip,
                'type'     => 'tip',
                'is_total' => false
            ];
        }

        if ($discount > 0) {
            $details[] = [
                'label'    => !empty(lang('discount')) ? lang('discount') : 'Discount',
                'value'    => - ($discount),
                'type'     => 'discount',
                'is_total' => false
            ];
        }

        $details[] = [
            'label'    => !empty(lang('total')) ? lang('total') : 'Total',
            'value'    => $total,
            'type'     => 'total',
            'is_total' => true
        ];

        return $details;
    }

    public function summary(int $vendorId, $items): array
    {
        $orderSession = $this->recalculate($vendorId, $items);

        $res = [
            'vendor_id'             => $vendorId,
            'order_type'            => $orderSession->order_type,
            'subtotal'              => (float) $orderSession->subtotal,
            'service_charge_type'   => $orderSession->service_charge_type,
            'service_charge_rate'   => (float) $orderSession->service_charge_rate,
            'service_charge_amount' => (float) $orderSession->service_charge_amount,
            'tax_rate'              => (float) $orderSession->tax_rate,
            'tax_amount'            => (float) $orderSession->tax_amount,
            'tip_type'              => $orderSession->tip_type,
            'tip_rate'              => (float) $orderSession->tip_rate,
            'tip_amount'            => (float) $orderSession->tip_amount,
            'discount_code'         => $orderSession->discount_code,
            'discount_type'         => $orderSession->discount_type,
            'discount_amount'       => (float) $orderSession->discount_amount,
            'grand_total'           => (float) $orderSession->grand_total,
            'tips_enabled'          => $this->tipsEnabledForCurrentOrderType($orderSession->order_type),
        ];

        $res['details'] = $this->get_total_details($res, false);
        return $res;
    }

    protected function tipsEnabledForCurrentOrderType(string $orderType): bool
    {
        return (bool) OrderTypeConfig::where('order_type', $orderType)->value('tips_enabled');
    }

    public function mergeGuestSession(int $id, string $type = 'user'): void
    {
        $sessionId    = Session::getId();
        $guestSession = OrderSession::where('session_id', $sessionId)->first();

        if (!$guestSession) return;

        $idKey = $type === 'customer' ? 'customer_id' : 'user_id';
        $userSession = OrderSession::where($idKey, $id)->first();

        if ($userSession) {
            $userSession->update($guestSession->only([
                'order_type',
                'service_charge_type',
                'service_charge_rate',
                'tax_rate',
                'tip_type',
                'tip_rate',
                'tip_amount',
                'discount_code',
                'discount_type',
                'discount_rate',
                'discount_amount',
            ]));
            $guestSession->delete();
        } else {
            $guestSession->update([$idKey => $id, 'session_id' => null]);
        }
    }

    public function clear(int $vendorId): void
    {
        OrderSession::where(array_merge($this->getIdentifier(), ['vendor_id' => $vendorId]))->delete();
    }
}
