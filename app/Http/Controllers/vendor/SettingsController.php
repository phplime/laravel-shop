<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Symfony\Component\Clock\now;

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
        $data['page_title'] = 'Settings';
        $data['page'] = 'settings';
        return view('backend.vendor_settings.settings', $data);
    }

    public function general()
    {
        $data = [];
        $data['page_title'] = 'General Settings';
        $data['page'] = 'settings';
        return view('backend.vendor_settings.general_settings', $data);
    }


    public function email_settings()
    {
        $data = [];
        $data['page_title'] = 'Email Settings';
        $data['page'] = 'settings';
        return view('backend.vendor_settings.vendor_email_settings', $data);
    }


    public function apperence()
    {
        $data = [];
        $data['page_title'] = 'Apperence';
        $data['page'] = 'settings';
        return view('backend.vendor_settings.apperence', $data);
    }


    public function available_days()
    {
        $data = [];
        $data['page_title'] = 'Available days';
        $data['page'] = 'settings';
        return view('backend.vendor_settings.available_days', $data);
    }


    public function payment_settings()
    {
        $data = [];
        $data['page_title'] = 'Payment Settings';
        $data['page'] = 'settings';
        return view('backend.vendor_settings.payment_settings', $data);
    }


    public function slider()
    {
        $data = [];
        $data['page_title'] = 'Slider';
        $data['page'] = 'settings';

        $data['slider_list'] = $this->baseRepo->select_by_vendor_id('vendor_slider_list');

        return __mainContent('backend.vendor_settings.slider', $data);
    }
    /* ======================================
    Slider Index ARea ENd
    ======================================== */



    public function add_slider(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->first();
            return __request(0, $errors, '');
        }

        $data = [
            'user_id' => Auth::id(),
            'vendor_id' => __activeVendor(),
            'title' => $request->title,
            'thumb' => $request->image,
            'image' => $request->image,
        ];


        if ($request->id) {
            $insert = $this->baseRepo->update($request->id, $data, 'vendor_slider_list');
        }else{
            $insert = $this->baseRepo->create($data, 'vendor_slider_list');
        }


        if ($insert) {
            return __request(1, __('success_text'), url('vendor/settings/slider?isAjax=1'));
        } else {
            return __request(0, 'Something wait wrong!!', '');
        }

    }


    public function qrcode()
    {
        $data = [];
        $data['page_title'] = 'QR code';
        $data['page'] = 'settings';
        return view('backend.vendor_settings.qr_code_generate', $data);
    }


    public function order_types()
    {
        $data = [];
        $data['page_title'] = 'order types Configuration';
        $data['page'] = 'order config';
        return view('backend.vendor_settings.order_types_configuration', $data);
    }



    public function order_type_settings($type = '')
    {
        $data = [];
        $data['page_title'] = 'Cod Config';
        $data['page'] = 'order config';
        return view('backend.vendor_settings.order_types.pickup', $data);
    }



    public function order_config($type = '')
    {
        $data = [];
        $data['page_title'] = 'Order Configuration';
        $data['page'] = 'order config';
        // dd('hi');
        return view('backend.vendor_settings.order_configuration', $data);
    }



    public function item_config($type = '')
    {
        $data = [];
        $data['page_title'] = 'Item Configuration';
        $data['page'] = 'order config';
        return view('backend.vendor_settings.item_configuration', $data);
    }

    public function tax_config()
    {
        $data = [];
        $data['page_title'] = 'Tax Configuration';
        $data['page'] = 'order config';
        $data['tax_list'] = $this->baseRepo->select_by_vendor_id('vendor_tax_list');
        return view('backend.vendor_settings.tax_configuration', $data);
    }
    /* ======================================
    Tax Configuration Area End
    ======================================== */



    public function add_new_tax(Request $request)
    {
        try {
            $request->validate([
                'tax_name' => 'required',
                'tax_percentage' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->first();
            return __request(0, $errors, '');
        }

        $data = [
            'user_id' => Auth::id(),
            'vendor_id' => __activeVendor('id'),
            'tax_name' => $request->tax_name,
            'tax_percentage' => $request->tax_percentage,
            'tax_status' => 'include',
            'status' => 1,
            'created_at' => now(),
        ];

        if (isset($request->id) && !empty($request->id)) {
            $insert = $this->baseRepo->update($request->id, $data, 'vendor_tax_list');
        }else{
            $insert = $this->baseRepo->create($data, 'vendor_tax_list');
        }

        if ($insert) {
            return __request(1, __('success_text'), url('vendor/settings/tax-configuration?isAjax=1'));
        } else {
            return __request(0, __('error_text'), '');
        }

    }
    /* ======================================
    Add New Tax Area End
    ======================================== */


}
