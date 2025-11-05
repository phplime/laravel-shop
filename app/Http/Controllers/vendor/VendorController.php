<?php

namespace App\Http\Controllers\vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index()
    {
        $data = [];
        $data['page_title'] = 'Dashboard';
        return view('backend.vendor.dashboard', $data);
    }
}
