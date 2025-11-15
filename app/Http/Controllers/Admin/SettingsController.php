<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;

class SettingsController extends Controller
{
    protected $baseRepo;
    public function __construct(BaseRepository $baseRepo)
    {
        $this->baseRepo = $baseRepo;
    }

    public function index()
    {
        $data = [];
        $data['page_title'] = 'Site settings';
        $data['page'] = 'Settings';
        $data['module_list'] = $this->baseRepo->all('module_list');
        return __mainContent("backend.admin.settings.module", $data);
    }
}
