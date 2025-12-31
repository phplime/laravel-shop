<?php

namespace App\Http\Controllers;

use App\Events\AdminMail;
use App\Listeners\SendAdminMail;
use App\Repositories\BaseRepository;
use App\Services\AuthService;
use App\Services\SubscriptionService;
use HasinHayder\TyroLogin\Http\Controllers\RegisterController as baseRegisterController;
use HasinHayder\TyroLogin\Http\Controllers\VerificationController;
use HasinHayder\TyroLogin\Mail\WelcomeMail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class RegisterController extends baseRegisterController
{
    protected $subscriptionService;
    protected $baseRepo;

    public function __construct(SubscriptionService $subscriptionService, BaseRepository $baseRepo)
    {
        $this->subscriptionService = $subscriptionService;
        $this->baseRepo = $baseRepo;
    }

    public function index(Request $request)
    {
        return parent::showRegistrationForm($request);
    }



    public function registration_mail()
    {

        $packageInfo = $this->subscriptionService->getPackageInfo(1);

        $subscription = $this->subscriptionService->upgrade(2, $packageInfo->slug);
        dd($subscription);
        $data = [
            'start_date' =>  now()->format('Y-m-d H:i:s'),
            'expire_date' => now()->addDays(5)->format('Y-m-d H:i:s'),
        ];
        dd($data);





        // $data = [
        //     'name' => 'phplime',
        //     'subject' => 'Welcome to MyApp!',
        //     'site_name' => 'Shop',
        //     'username' => 'phplime',
        //     'password' => '123456',
        //     'email' => 'phplime.envato@gmail.com',
        //     'package_name' => 'Basic',
        //     'verify_link' => url('/verify'),
        // ];

        // $send = event(new AdminMail($data, 'email_verification_mail'));
        // if (isset($send[0]['error'])) {
        //     dd($send[0]['error']);
        // } else {
        //     echo "sent successfully";
        // }
    }




    public function register(Request $request): RedirectResponse
    {
        if (!config('tyro-login.registration.enabled', true)) {
            abort(403, 'Registration is disabled.');
        }

        // 1. Get base rules from parent
        $rules = $this->getValidationRules();

        // 2. Add custom rules
        $rules['username'] = 'required|string|max:255|unique:users';

        // Add captcha validation if enabled (logic copied from parent)
        if (config('tyro-login.captcha.enabled_register', false)) {
            $rules['captcha_answer'] = ['required', 'numeric'];
        }

        // 3. Validate
        $validated = $request->validate($rules);

        // 4. Validate Captcha (logic copied from parent)
        if (config('tyro-login.captcha.enabled_register', false)) {
            if (!$this->validateCaptcha($request, $validated['captcha_answer'])) {
                $this->generateCaptcha($request);
                throw ValidationException::withMessages([
                    'captcha_answer' => config('tyro-login.captcha.error_message', 'Incorrect answer. Please try again.'),
                ]);
            }
            unset($validated['captcha_answer']);
        }

        // 5. Validate Password User Info (logic copied from parent)
        if (config('tyro-login.password.disallow_user_info', false)) {
            $this->validatePasswordNotContainingUserInfo($request, $validated);
        }

        // 6. Create User (Modified to include username and role)
        $userModel = config('tyro-login.user_model', 'App\\Models\\User');

        $packageInfo = $this->subscriptionService->getPackageInfo($validated['package']);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'username' => $validated['username'],
            'role' => 'user',
            'package_id' => $packageInfo->id
        ];

        $user = $userModel::CreateOrUpdate(['username' => $validated['username']], $data);





        event(new SendAdminMail($user, 'email_verification_mail'));

        // 7. Assign Tyro Role (logic copied from parent)
        $this->assignTyroRole($user);

        // 8. Email Verification (logic copied from parent)
        if (config('tyro-login.registration.require_email_verification', false)) {
            VerificationController::generateVerificationUrl($user);
            $request->session()->put('tyro-login.verification.email', $user->email);
            return redirect()->route('tyro-login.verification.notice');
        }

        // 9. Welcome Email (logic copied from parent)
        if (config('tyro-login.emails.welcome.enabled', true)) {
            Mail::to($user->email)->send(new WelcomeMail(
                userName: $user->name ?? 'User',
                loginUrl: url(config('tyro-login.routes.prefix', '') . '/login')
            ));
        }

        // 10. Auto Login (logic copied from parent)
        if (config('tyro-login.registration.auto_login', true)) {
            if (config('tyro-login.two_factor.enabled', false)) {
                $request->session()->put('login.id', $user->id);
                $request->session()->put('login.remember', true);
                return redirect()->route('tyro-login.two-factor.setup');
            }
            Auth::login($user);
        }

        return redirect(config('tyro-login.redirects.after_register', '/'));
    }
}
