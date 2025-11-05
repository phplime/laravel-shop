<?php

namespace App\Http\Controllers\vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
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
        return view('backend.vendor_settings.slider', $data);
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
        return view('backend.vendor_settings.order_types.dinein', $data);
    }


}
