<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [];
        $data['page_title'] = 'Dashboard';
        return __mainContent('backend.vendor.dashboard', $data);
    }



    public function subscription()
    {
        $data = [];
        $data['page_title'] = 'WhatsApp Order';
        $data['page'] = 'whatsapp';
        return view('backend.whatsapp.share', $data);
    }


    public function whatsapp_order()
    {
        $data = [];
        $data['page_title'] = 'WhatsApp Order';
        $data['page'] = 'whatsapp';
        return view('backend.whatsapp.share', $data);
    }



    public function subscriptions()
    {
        $data = [];
        $data['page_title'] = 'Subscriptions';
        $data['page'] = 'Subscriptions';
        return view('backend.users.subscription', $data);
    }



    public function subscription_list()
    {
        $data = [];
        $data['page_title'] = 'Subscriptions List';
        $data['page'] = 'Subscriptions';
        return view('backend.users.subscription_list', $data);
    }
}
