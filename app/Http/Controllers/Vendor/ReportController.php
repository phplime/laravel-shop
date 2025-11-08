<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function item_reports()
    {
        $data = [];
        $data['page_title'] = 'Item Statistics';
        $data['page'] = 'Reports';
        return __mainContent('backend.vendor.reports.item_statistics', $data);
    }


    public function order_reports()
    {
        $data = [];
        $data['page_title'] = 'Order Reports';
        $data['page'] = 'Reports';
        return __mainContent('backend.vendor.reports.order_reports', $data);
    }
}
