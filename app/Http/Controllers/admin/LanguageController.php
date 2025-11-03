<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function index()
    {
        return view('backend.language.home');
    }


    public function language_list()
    {
        $data = [];
        $data['page_title'] = 'Language List';
        $data['page'] = 'Language';

        // $data['country_list'] = all('country_list');
        return view('backend.language.language_list', $data);
    }


    public function language_data()
    {
        $data = [];
        $data['page_title'] = 'Language List';
        $data['page'] = 'Language';

        // $data['country_list'] = all('country_list');
        return view('backend.language.language_data', $data);
    }
}
