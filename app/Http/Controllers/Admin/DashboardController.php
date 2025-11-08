<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Repositories\BaseRepository;

class DashboardController extends Controller
{
    protected BaseRepository $baseRepository;

    public function __construct(BaseRepository $baseRepository)
    {
        $this->baseRepository = $baseRepository;
    }


    public function index()
    {
        $data = [];
        $data['page_title'] = 'Dashboard';
        $data['page'] = 'Dashboard';
        return view('backend.admin.dashboard', $data);
    }


    public function user_list()
    {
        $page_title = 'User List';
        return view('backend.admin.auth.user_list', compact('page_title'));
    }


    public function user_details($username)
    {
        $page_title = 'User Details';
        return view('backend.admin.auth.user_details', compact('page_title'));
    }


    public function subscription_invoice($id)
    {
        $page_title = 'Subscription Invoice';
        return view('backend.invoices.subscription_invoice', compact('page_title'));
    }


    // public function language_list()
    // {
    //     $data = [];
    //     $data['page_title'] = 'Languages';


    //     // $data['country_list'] = all('country_list');
    //     return view('backend.language.language_list', $data);
    // }


    // public function language_data()
    // {
    //     $page_title = 'Language Data';
    //     return view('backend.language.language_data', compact('page_title'));
    // }


    public function add_language_data(Request $request)
    {
        $request->validate([
            'keyword' => 'required',
            'value' => 'required',
        ]);

        $data = [
            'keyword' => $request->keyword,
            'details' => $request->value,
        ];

        $last_id = $this->baseRepository->create($data, 'language_data');

        if ($last_id) {
            __request(1, 'Save change successful');
        } else {
            __request(0, 'Save change error!!');
        }
    }
}
