<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    protected $baseRepo;
    public function __construct(BaseRepository $baseRepo)
    {
        $this->baseRepo = $baseRepo;
    }


    public function cookies()
    {
        $data = [];
        $data['page_title'] = 'Cookies';
        $data['page'] = 'Pages';
        $data['data'] = $this->baseRepo->get_page_ln_data_by_slug('vendor_page_list', 'page_id', 'cookies');
        return __mainContent('backend.vendor.pages.cookies',$data);
    }


    public function terms()
    {
        $data = [];
        $data['page_title'] = 'Terms';
        $data['page'] = 'Pages';
        $data['data'] = $this->baseRepo->get_page_ln_data_by_slug('vendor_page_list', 'page_id', 'terms');
        // echo '<pre>';print_r($data['data']);exit();
        return __mainContent('backend.vendor.pages.terms',$data);
    }



    public function add_page(Request $request)
    {
        try {
            $request->validate([
                'title.*' => 'required',
                'details.*' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->first();
            return __request(0, $errors, '');
        }

        $titles = $request->title;
        $is_modal = $request->is_modal;
        $id = $request->id;

        $data = [
            'user_id' => Auth::id(),
            'vendor_id' => __activeVendor(),
            'slug' => str_slug($request->slug),
            'is_modal' => isset($is_modal) ? 1 : 0,
        ];

        if ($id == 0) {
            $insert = $this->baseRepo->create($data, 'vendor_page_list');
        }else{
            $insert = $this->baseRepo->update($id, $data, 'vendor_page_list');
        }

        if ($insert) {
            if (is_array($titles)) {
                foreach ($titles as $lang => $names)
                {
                    $data = [
                        'title' => $names,
                        'details' => $request->details[$lang],
                    ];
                    $this->baseRepo->check_existing_language_datas($insert, 'page_id', $lang, $data, 'vendor_page_list_ln');
                }
            }
            return __request(1, __('success_text'), true);
        } else {
            return __request(0, __('error_text'), '');
        }
    }
}
