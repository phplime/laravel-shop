<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function order_list()
    {
        $data = array();
        $data['page_title'] = "Order List";
        $data['page'] = "Order";
        return view('backend.vendor.order_list', $data);
    }


    public function all_order_list()
    {
        $data = array();
        $data['page_title'] = "All Orders";
        $data['page'] = "Orders";
        return view('backend.vendor.all_order_list', $data);
    }

    public function order_details($order_id = null)
    {
        $data = array();
        $data['page_title'] = "Order Details";
        $data['page'] = "Order";
        return view('backend.vendor.order_details', $data);
    }
}
