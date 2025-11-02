<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $page_title = 'Packages';
        return view('backend.admin.packages.planList', compact('page_title'));
    }

    public function package_create()
    {
        $page_title = 'Package Create';
        return view('backend.admin.packages.createPlan', compact('page_title'));
    }


    public function feature()
    {
        $page_title = 'Features';
        return view('backend.admin.packages.feature_list', compact('page_title'));
    }


    public function feature_create()
    {
        $page_title = 'Feature Create';
        return view('backend.admin.packages.create_feature', compact('page_title'));
    }
}
