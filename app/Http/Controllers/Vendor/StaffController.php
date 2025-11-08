<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function customer_list()
    {
        $data = [];
        $data['page_title'] = 'Customers';
        return __mainContent('backend.vendor.staff.customers', $data);
    }
}
