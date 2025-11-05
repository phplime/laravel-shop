<?php

namespace App\Http\Controllers\admin;

use App\Models\LanguageData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;

class LanguageController extends Controller
{
    protected  $baseRepo;
    public function __construct(BaseRepository $baseRepo)
    {
        $this->baseRepo = $baseRepo;
    }
    public function index()
    {
        return view('backend.language.home');
    }


    public function language_list()
    {
        $data = [];
        $data['page_title'] = 'Language List';
        $data['page'] = 'Language';

        // $data['country_list'] = all('country_list');
        return __mainContent('backend.language.language_list', $data);
    }


    public function language_data()
    {
        $data = [];
        $data['page_title'] = 'Language Data';
        $data['page'] = 'Language';

        $data['language_data'] = $this->baseRepo->paginate(15, 'language_data');
        // return view('backend.language.language_data', $data);
        return __mainContent('backend.language.language_data', $data);
    }

    public function add_language_data(Request $request)
    {
        try {
            $request->validate([
                'keyword' => 'required',
                'value' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->first();
            return __request(0, $errors, '');
        }

        $locale = 'en';
        $language = LanguageData::updateOrCreate(
            [
                'locale' => $locale,
                'key' => strtolower($request->keyword),
            ],
            [
                'value' => $request->value,
            ]
        );


        if ($language) {
            return __request(1, __('save_change_successful'), url('admin/language-data?isAjax=1'));
        } else {
            return __request(0, 'Save change error!!', '');
        }
    }
}
