<?php

namespace App\Http\Controllers\Admin;

use App\Support\Make;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;

class ModuleController extends Controller
{
    protected $baseRepo;
    public function __construct(BaseRepository $baseRepo)
    {
        $this->baseRepo = $baseRepo;
    }

    public function index()
    {
        $data = [];
        $data['page_title'] = 'Module List';
        $data['page'] = 'Module';
        $data['module_list'] = $this->baseRepo->all('module_list');
        $data['feature_list'] = $this->baseRepo->all('feature_list');
        $data['module_feature_list'] = $this->baseRepo->all('module_feature_list');
        $data['order_type_list'] = $this->baseRepo->all('order_type_list');
        return __mainContent("backend.admin.module.module", $data);
    }



    public function add_order_types(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required',
                'slug' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->first();
            return __request(0, $errors, '');
        }

        $data = [
            'title' => $request->title,
            'slug' => Make::slug($request->slug),
            'status' => 1,
        ];

        if (isset($request->id) && !empty($request->id)):
            $insert = $this->baseRepo->update($request->id, $data, 'order_type_list');
        else:
            $insert = $this->baseRepo->create($data, 'order_type_list');
        endif;


        if ($insert) {
            return __request(1, __('success_text'), url('admin/module?isAjax=1'));
        } else {
            return __request(0, __('error_text'), '');
        }
    }




    public function add_module_features(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required',
                'slug' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->first();
            return __request(0, $errors, '');
        }

        $data = [
            'title' => $request->title,
            'slug' => !empty($request->slug) ? Make::slug($request->slug) : Make::slug($request->title),
            'status' => 1,
        ];

        if (isset($request->id) && !empty($request->id)):
            $insert = $this->baseRepo->update($request->id, $data, 'module_feature_list');
        else:
            $insert = $this->baseRepo->create($data, 'module_feature_list');
        endif;


        if ($insert) {
            return __request(1, __('success_text'), url('admin/module?isAjax=1'));
        } else {
            return __request(0, __('error_text'), '');
        }
    }

    /* ────────────────────────────────────────
                     Add new module
    ────────────────────────────────────────── */

    public function add_new_module(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required',
                'slug' => 'required',
                'features_ids' => 'required|array|min:1',
                'order_type_ids' => 'required|array|min:1',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return __request(0, $errors, '');
        }

        $data = [
            'title' => $request->title,
            'slug' => Make::slug($request->slug),
            'feature_ids' => json_encode($request->features_ids),
            'order_type_ids' => json_encode($request->order_type_ids),
            'status' => 1
        ];


        if (isset($request->id) && !empty($request->id)):
            $insert = $this->baseRepo->update($request->id, $data, 'module_list');
        else:
            $insert = $this->baseRepo->create($data, 'module_list');
        endif;

        if ($insert) {
            return __request(1, __('success_text'), url('admin/module?isAjax=1'));
        } else {
            return __request(0, __('error_text'), '');
        }
    }
}
