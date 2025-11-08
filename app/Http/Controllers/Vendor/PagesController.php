<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function cookies()
    {
        $data = [];
        $data['page_title'] = 'Cookies';
        $data['page'] = 'Pages';
        return __mainContent('backend.vendor.pages.cookies',$data);
    }



    public function terms()
    {
        $data = [];
        $data['page_title'] = 'Terms';
        $data['page'] = 'Pages';
        return __mainContent('backend.vendor.pages.terms',$data);
    }
}
