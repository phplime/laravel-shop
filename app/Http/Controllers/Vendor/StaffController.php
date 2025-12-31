<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    protected $baseRepo;
    public function __construct(BaseRepository $baseRepo)
    {
        $this->baseRepo = $baseRepo;
    }


    public function customer_list()
    {
        $data = [];
        $data['page_title'] = 'Customers';
        $data['customer_list'] = $this->baseRepo->select_by_vendor_id('customer_list');
        return __mainContent('backend.vendor.staff.customers', $data);
    }


    public function add_customer(Request $request)
    {

        $id = $request->id;

        try {
            $request->validate([
                'name' => 'required',
                'phone' => 'required|unique:customer_list,phone,' . $id . ',id',
                'email' => 'required|unique:customer_list,email,' . $id . ',id',
            ],[
                'email.unique'   => 'This email is already exits!!.',
                'phone.unique'   => 'This phone number is already exits!!.',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->first();
            return __request(0, $errors, '');
        }


        $data = array(
            'vendor_id' => __activeVendor(),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'dial_code' => $request->dial_code,
            'created_at' => now(),
        );

        if (empty($id)) {
            $data['password'] = Hash::make('1234');
            $insert = $this->baseRepo->create($data, 'customer_list');
        }else{
            $insert = $this->baseRepo->update($id, $data, 'customer_list');
        }

        if ($insert) {
            return __request(1, __('success_text'), url('vendor/customer-list?isAjax=1'));
        } else {
            return __request(0, __('error_text'), '');
        }


    }
}
