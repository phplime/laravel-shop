<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;

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
}
