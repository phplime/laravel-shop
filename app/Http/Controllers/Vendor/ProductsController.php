<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Dotenv\Util\Str;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $data = [];
        $data['page_title'] = 'Products';
        $data['page'] = 'products';
        return __mainContent('backend.products.product_list', $data);
    }



    public function create_product()
    {
        $data = [];
        $data['page_title'] = 'Create Product';
        $data['page'] = 'products';
        return __mainContent('backend.products.create_product', $data);
    }



    public function addons(Str $id)
    {
        $data = [];
        $data['page_title'] = 'Addons';
        $data['page'] = 'products';
        return __mainContent('backend.products.addon_list', $data);
    }



    public function category_list()
    {
        $data = [];
        $data['page_title'] = 'Categories';
        $data['page'] = 'products';
        return __mainContent('backend.products.category_list', $data);
    }



    public function subcategory_list()
    {
        $data = [];
        $data['page_title'] = 'Sub Categories';
        $data['page'] = 'products';
        return __mainContent('backend.products.subcategory_list', $data);
    }



    public function allergen_list()
    {
        $data = [];
        $data['page_title'] = 'Allergens';
        $data['page'] = 'products';
        return __mainContent('backend.products.allergen_list', $data);
    }



    public function addons_library()
    {
        $data = [];
        $data['page_title'] = 'Addon Library';
        $data['page'] = 'products';
        return __mainContent('backend.products.addon_library', $data);
    }



}
