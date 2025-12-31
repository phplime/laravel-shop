<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $baseRepo;
    public function __construct(BaseRepository $baseRepo)
    {
        $this->baseRepo = $baseRepo;
    }


    public function index()
    {
        $data = [];
        $data['page_title'] = 'Profile';
        $data['page'] = 'Profile';
        return __mainContent('backend.users.profile', $data);
    }


    public function account()
    {
        $data = [];
        $data['page_title'] = 'Account';
        $data['page'] = 'Profile';
        return __mainContent('backend.users.profile.account_info', $data);
    }


    public function password()
    {
        $data = [];
        $data['page_title'] = 'Password';
        $data['page'] = 'Profile';
        return __mainContent('backend.users.profile.password', $data);
    }


    public function onboarding()
    {
        $data = [];
        $data['page_title'] = 'Onboarding';
        $data['page'] = 'Profile';

        if (isset($_GET['step']) && $_GET['step'] == 2) {
            return __mainContent('backend.users.profile.step_2', $data);
        } else {
            return __mainContent('backend.users.profile.step_1', $data);
        }
    }
}
