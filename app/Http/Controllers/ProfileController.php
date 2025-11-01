<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProfileController extends Controller
{

    public function index($slug = null)
    {
        $data = [];
        $data['page_title'] = 'Profile';
        return view('profile.pages.my_profile', compact('data'));
    }
    /* ======================================
    Profile Index End
    ======================================== */


    public function home($slug)
    {
        $data = [];
        $data['page_title'] = 'Home';
        return view('profile.home', compact('data'));
    }
    /* ======================================
    Home Index Area End
    ======================================== */


    public function menu($slug)
    {
        $data = [];
        $data['page_title'] = 'Menu';
        return view('profile.pages.menu', compact('data'));
    }
    /* ======================================
    Menu Index Area End
    ======================================== */


    public function all_items($slug)
    {
        $data = [];
        $data['page_title'] = 'Items';
        return view('profile.pages.all_items', compact('data'));
    }
    /* ======================================
    All Items Index Area End
    ======================================== */


    public function special_items($slug)
    {
        $data = [];
        $data['page_title'] = 'Special Items';
        return view('profile.pages.special_items', compact('data'));
    }
    /* ======================================
    All Items Index Area End
    ======================================== */



    public function my_order($slug)
    {
        $data = [];
        $data['page_title'] = 'My Orders';
        return view('profile.pages.my_order', compact('data'));
    }
    /* ======================================
    My Order Index Area end
    ======================================== */



    public function view_order($order_id)
    {
        $data = [];
        $data['page_title'] = 'View Order';
        return view('profile.pages.view_order', compact('data'));
    }
    /* ======================================
    View Order Index Area End
    ======================================== */



    public function checkout($slug)
    {
        $data = [];
        $data['page_title'] = 'View Order';
        return view('profile.pages.checkout', compact('data'));
    }
}
