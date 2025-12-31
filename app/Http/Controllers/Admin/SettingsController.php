<?php

namespace App\Http\Controllers\Admin;

use App\Data\EmailTemplates;
use App\Events\AdminMail;
use App\Http\Controllers\Controller;
use App\Models\Settings;
use App\Repositories\BaseRepository;
use App\Services\SettingsService;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    protected $baseRepo;
    public function __construct(BaseRepository $baseRepo)
    {
        $this->baseRepo = $baseRepo;
    }

    public function index()
    {
        $data = [];
        $data['page_title'] = 'General Settings';
        $data['page'] = 'Settings';
        $data['language_list'] = $this->baseRepo->all('language_list');
        $data['country_list'] = $this->baseRepo->all('country_list');
        return __mainContent("backend.admin.settings.general_settings", $data);
    }
    public function preferences()
    {
        $data = [];
        $data['page_title'] = 'Preferences';
        $data['page'] = 'Settings';
        return __mainContent("backend.admin.settings.preferences", $data);
    }

    public function email_settings()
    {
        $data = [];
        $data['page_title'] = 'Email Settings';
        $data['page'] = 'Settings';
        return __mainContent("backend.admin.settings.email_settings", $data);
    }
    public function payment_settings()
    {
        $data = [];
        $data['page_title'] = 'Payment Settings';
        $data['page'] = 'Settings';
        $data['payment_list'] = $this->baseRepo->all('payment_gateway_list');
        return __mainContent("backend.admin.settings.payment_settings", $data);
    }


    public function add_settings(Request $request)
    {
        try {
            $request->validate([
                'language' => 'required',
                'country_id' => 'required',
                'currency' => 'required',
                'dial_code' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return __request(0, $errors, '');
        }



        $data = [
            'language' => $request->language ?? 'en',
            'country_id' => $request->country_id,
            'currency' => $request->currency ?? 'USD',
            'dial_code' => $request->dial_code ?? '+1',
            'timezone' => $request->timezone ?? 'UTC',
            'site_name' => $request->site_name,
            'app_name' => $request->app_name,
            'logo' => $request->logo,
            'favicon' => $request->favicon,
            'description' => $request->description,
            'currency_position' => $request->currency_position ?? 'left',
            'number_format' => $request->number_format ?? 0,
            'tax_percent' => $request->tax_percent,
            'tax_number' => $request->tax_number,
            'company_details' => $request->company_details,
            'menu_style' => $request->menu_style ?? 0,
            'theme' => $request->theme ?? 'light',
            'color' => substr($request->color, 1) ?? '06bc76',
        ];
        
        $insert = __check($data);


        if ($insert) {
            return __request(1, __('success_text'), url('admin/settings?isAjax=1'));
        } else {
            return __request(0, __('error_text'), '');
        }
    }

    public function setting_status($type, $value)
    {
        // Validate input parameters
        if (empty($type)) {
            echo json_encode(array('st' => 0, 'message' => 'Setting type is required'));
            return;
        }

        // Toggle the value
        $data_value = ($value == 0) ? 1 : 0;

        // Update the setting using the service
        __check([$type => $data_value]);

        __updateCacheValue($type, $data_value);

        // Return the response
        echo json_encode(array('st' => 1, 'value' => $data_value));
    }


    public function add_email_settings(Request $request)
    {
        try {
            if ($request->mail_type == 'smtp') {
                $request->validate([
                    'mail_type' => 'required',
                    'smtp_mail' => 'required',
                    'smtp_port' => 'required',
                    'smtp_password' => 'required',
                    'smtp_host' => 'required',
                ]);
            } elseif ($request->mail_type == 'sendgrid') {
                $request->validate([
                    'mail_type' => 'required',
                    'sendgrid_api_key' => 'required',
                ]);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return __request(0, $errors, '');
        }

        $mailData = [
            'smtp_port' => $request->smtp_port ?? '',
            'smtp_password' => $request->smtp_password ?? '',
            'smtp_host' => $request->smtp_host ?? '',
            'no_reply' => $request->no_reply ?? '',
            'sendgrid_api_key' => $request->sendgrid_api_key ?? '',
        ];

        $data = [
            'smtp_mail' => $request->smtp_mail,
            'mail_type' => $request->mail_type ?? 'smtp',
            'smtp_config' => json_encode($mailData),
        ];


        $insert = __check($data);


        if ($insert) {
            EmailTemplates::install();
            return __request(1, __('success_text'), url('admin/settings/email-settings?isAjax=1'));
        } else {
            return __request(0, __('error_text'), '');
        }
    }



    public function add_email_template(Request $request)
    {
        try {

            $request->validate([
                'subject' => 'required|array',
                'message' => 'required|array',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return __request(0, $errors, '');
        }


        $subjects = $request->input('subject', []);
        $messages = $request->input('message', []);
        $language = $request->input('language', 'en');
        // Get existing config
        $existingConfig = Settings::whereKey('email_template_config')->first()?->value ?? [];

        $data = !empty($existingConfig) ? json_decode($existingConfig, true) : [];

        if (json_last_error() !== JSON_ERROR_NONE) {
            $data = [];
        }

        // Process both subject and message with the same logic
        $this->processTemplateData($data, 'subject', $subjects, $language);
        $this->processTemplateData($data, 'message', $messages, $language);


        $insert = __check(['email_template_config' => json_encode($data)]);



        if ($insert) {
            __updateCacheValue('email_template_config', json_encode($data));
            return __request(1, __('success_text'), url('admin/settings/email-settings?isAjax=1'));
        } else {
            return __request(0, __('error_text'), '');
        }
    }


    private function processTemplateData(array &$data, string $type, array $input, string $defaultLang): void
    {
        if (empty($input)) {
            return;
        }

        foreach ($input as $template => $content) {
            // Initialize template structure if not exists
            if (!isset($data[$template][$type]) || !is_array($data[$template][$type])) {
                $data[$template][$type] = [];
            }

            // Handle both single language and multi-language inputs
            if (is_array($content)) {
                foreach ($content as $lang => $value) {
                    $data[$template][$type][$lang] = $value;
                }
            } else {
                // Use default language for single value
                $data[$template][$type][$defaultLang] = $content;
            }
        }
    }


    public function testmail()
    {

        $data = [
            'email' => __settings('smtp_mail'),
            'name' => 'John Doe',
            'subject' => 'Welcome to MyApp!',

        ];


        $send = event(new AdminMail($data, 'testmail'));
        if (isset($send[0]['error'])) {
            __check(['is_smtp' => 0]);
            dd($send[0]['error']);
        } else {
            __check(['is_smtp' => 1]);
            echo '✅ Test email sent! Check your inbox or logs.';
            exit;
        }
    }

    public function add_new_payment(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required',
                'slug' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return __request(0, $errors, '');
        }

        $data = [
            'title' => $request->title,
            'slug' => $request->slug,
        ];

        if (isset($request->id) && !empty($request->id)) {
            $insert = $this->baseRepo->update($request->id, $data,  'payment_gateway_list');
        } else {
            $insert = $this->baseRepo->create($data, 'payment_gateway_list');
        }


        if ($insert) {
            return __request(1, __('success_text'), url('admin/settings/payment-settings?isAjax=1'));
        } else {
            return __request(0, __('error_text'), '');
        }
    }
}
