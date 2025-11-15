<?php

namespace App\Http\Controllers\Admin;

use App\Support\Make;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;
use App\Http\Requests\PackageRequest;
use App\Services\PackageService;

class PackageController extends Controller
{
    protected $baseRepo;
    protected $packageService;
    public function __construct(BaseRepository $baseRepo, PackageService $packageService)
    {
        $this->baseRepo = $baseRepo;
        $this->packageService = $packageService;
    }


    public function index()
    {
        $data = [];
        $data['page_title'] = 'Package List';
        $data['page'] = 'Packages';
        $data['package_list'] = $this->packageService->getPackageDetails();
        $data['feature_list'] = $this->baseRepo->all('feature_list', ['id' => 'asc']);
        return __mainContent("backend.admin.packages.package_list", $data);
    }

    public function create_package()
    {
        $data = [];
        $data['page_title'] = 'Create package';
        $data['page'] = 'Packages';
        $data['module_list'] = $this->baseRepo->all('module_list');
        $data['feature_list'] = $this->baseRepo->all('feature_list', ['id' => 'asc']);

        $data['module_feature_list'] = $this->baseRepo->all('module_feature_list');
        $data['order_type_list'] = $this->baseRepo->all('order_type_list');
        return __mainContent("backend.admin.packages.createPlan", $data);
    }


    public function edit_package($id = null)
    {
        $data = [];
        $data['page_title'] = 'Create package';
        $data['page'] = 'Packages';
        $data['module_list'] = $this->baseRepo->all('module_list');
        $data['feature_list'] = $this->baseRepo->all('feature_list', ['id' => 'asc']);

        $data['module_feature_list'] = $this->baseRepo->all('module_feature_list');
        $data['order_type_list'] = $this->baseRepo->all('order_type_list');
        $data['package_list'] = $this->packageService->getPackageDetails(['slug' => $id]);

        return __mainContent("backend.admin.packages.createPlan", $data);
    }


    public function feature_list()
    {
        $data = [];
        $data['page_title'] = 'Feature List';
        $data['page'] = 'Packages';
        $data['feature_list'] = $this->baseRepo->all('feature_list', ['id' => 'asc']);
        return __mainContent("backend.admin.packages.feature_list", $data);
    }


    public function feature_create()
    {
        $page_title = 'Feature Create';
        return view('backend.admin.packages.create_feature', compact('page_title'));
    }



    public function add_new_feature(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'slug' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return __request(0, $errors, '');
        }

        $data = [
            'name' => $request->name,
            'slug' => Make::slug($request->slug),
            'status' => 1,
        ];

        if (isset($request->id) && !empty($request->id)):
            $insert = $this->baseRepo->update($request->id, $data, 'feature_list');
        else:
            $insert = $this->baseRepo->create($data, 'feature_list');
        endif;


        if ($insert) {
            return __request(1, __('success_text'), url('admin/feature-list?isAjax=1'));
        } else {
            return __request(0, __('error_text'), '');
        }
    }







    public function savePackage(PackageRequest $request)
    {

        try {
            $package = $this->packageService->savePackage($request->validated(), $request->id);

            return __request(1, __('Save changes successfully'), url('admin/package_list'));
        } catch (\Exception $e) {
            return __request(0, $e->getMessage(), '');
        }
    }


    public function savePackage__(Request $request)
    {
        try {
            // 🔹 Validate inputs
            $request->validate([
                'package_name'   => 'required|string|max:255',
                'slug'           => 'required|string|max:255',
                'package_type'   => 'required|string',
                'price'          => 'nullable|numeric|min:0',
                'previous_price' => 'nullable|numeric|min:0',
                'duration'       => 'nullable|integer|min:1',
                'store_limit'    => 'nullable|integer|min:1',
                'feature_id'     => 'nullable|array',
                'feature_id.*'   => 'integer',
                'module_ids'     => 'nullable|array',
                'module_ids.*'   => 'integer',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return __request(0, $errors, '');
        }

        // 🔹 Prepare sanitized data
        $data = [
            'package_name'    => $request->package_name,
            'store_limit'     => $request->store_limit ?? 1,
            'slug'            => Make::slug($request->slug),
            'price'           => $request->price ?? 0,
            'previous_price'  => $request->previous_price ?? 0,
            'package_type'    => $request->package_type,
            'duration'        => $request->duration ?? 1,
            'is_private'      => $request->has('is_private') ? 1 : 0,
            'module_ids'      => json_encode($request->module_ids ?? []),
            'created_at'      => now(),
        ];

        // 🔹 Insert or update the main record
        if (!empty($request->id)) {
            $insert = $this->baseRepo->update($request->id, $data, 'package_list');
            $packageId = $request->id;
        } else {
            $insert = $this->baseRepo->create($data, 'package_list');
            $packageId = $insert;
        }

        // 🔹 If package saved successfully
        if ($insert) {
            // Handle related features
            if (!empty($request->feature_id)) {
                // Delete old links if editing
                if (!empty($request->id)) {
                    $this->baseRepo->deleteBy('active_package_features', ['package_id' => $packageId]);
                }

                // Prepare bulk insert data
                $activeFeatures = collect($request->feature_id)->map(function ($fid) use ($packageId) {
                    return [
                        'package_id' => $packageId,
                        'feature_id' => $fid,
                    ];
                })->toArray();

                // Bulk insert
                $this->baseRepo->insertAll($activeFeatures, 'active_package_features');
            }

            return __request(1, __('Save changes successfully'), url('admin/package?isAjax=1'));
        }

        // 🔹 If insert/update failed
        return __request(0, __('Something went wrong!'), url('admin/package?isAjax=1'));
    }
}
