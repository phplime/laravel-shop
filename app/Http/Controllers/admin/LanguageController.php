<?php

namespace App\Http\Controllers\Admin;

use App\Support\Make;
use App\Models\LanguageData;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

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

        $data['country_list'] = $this->baseRepo->all('country_list');
        $data['language_list'] = $this->baseRepo->all('language_list');
        return __mainContent('backend.language.language_list', $data);
    }


    public function language_data(Request $request)
    {
        $data = [];
        $data['page_title'] = 'Language Data';
        $data['page'] = 'Language';
        $perPage = max(1, min((int) $request->query('per_page', 15), 100));
        $q = request('q');
        $data['language_data'] = $this->baseRepo->paginate('language_data', $perPage, ['en' => $q, 'keyword' => $q], ['*'], ['id' => 'desc']);
        $data['language_list'] = $this->baseRepo->all('language_list');
        return __mainContent('backend.language.language_data', $data);
    }



    public function add_language_data(Request $request)
    {
        $slug = Make::slug($request->keyword); // normalize keyword

        // Check if keyword already exists
        $exists = LanguageData::where('keyword', $slug)->exists();
        if ($exists) {
            return __request(0, "{$slug} Keyword already exists", '');
        }

        // Validate value
        try {
            $request->validate([
                'keyword' => 'required|string',
                'value' => 'required|string',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return __request(0, $errors, '');
        }

        // Insert new record
        $language = LanguageData::create([
            'keyword' => $slug,
            'en' => $request->value,
        ]);

        if ($language) {
            return __request(1, __('success_text'), url('admin/language-data?isAjax=1'));
        }

        return __request(0, 'Save change error!!', '');
    }




    public function add_new_language(Request $request)
    {
        try {
            $request->validate([
                'country_id' => 'required',
                'language_name' => 'required|alpha|unique:language_list,language_name',
                'slug' => 'required|alpha|unique:language_list,slug',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return __request(0, $errors, '');
        }

        $data = [
            'language_name' => $request->language_name,
            'slug' => Make::slug($request->slug),
            'direction' => $request->direction,
            'country_id' => $request->country_id,
            'status' => 1,
        ];

        if (isset($request->id) && !empty($request->id)):
            $insert = $this->baseRepo->update($request->id, $data, 'language_list');
        else:
            $insert = $this->baseRepo->create($data, 'language_list');
        endif;

        if ($insert) {
            $this->addLanguageColumn($data['slug']);
            return __request(1, __('success_text'), url('admin/language-list?isAjax=1'));
        } else {
            return __request(0, __('error_text'), '');
        }
    }

    private function addLanguageColumn(string $slug)
    {
        if (!Schema::hasColumn('language_data', $slug)) {
            Schema::table('language_data', function (Blueprint $table) use ($slug) {
                $table->text($slug)->nullable();
            });
        }
    }





    public function deleteLanguage(Request $request, $id)
    {
        // Find the language
        $language = DB::table('language_list')->where('id', $id)->first();

        if (!$language) {
            return response()->json([
                'status' => 0,
                'message' => 'Language not found'
            ]);
        }

        $slug = $language->slug;

        // Delete the language from language_list
        $deleted = DB::table('language_list')->where('id', $id)->delete();

        if ($deleted) {
            $this->removeLanguageColumn($slug);

            return __request(1, __('success_text'), '');
        }

        return __request(0, __('error'), '');
    }

    private function removeLanguageColumn(string $slug)
    {
        $slug = str($slug)->slug('_'); // normalize column name

        if (Schema::hasColumn('language_data', $slug)) {
            Schema::table('language_data', function (Blueprint $table) use ($slug) {
                $table->dropColumn($slug);
            });
        }
    }


    public function add_all_language_data(Request $request, string $langName)
    {
        try {
            $request->validate([
                'keyword' => 'array',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->all();

            dd($errors);
            return redirect()->back()->with('error', $errors);
        }
        $keywords = $request->input('keyword');
        $values = $request->input($langName);

        $updated = false;
        foreach ($values as $index => $value) {
            $keyword = $keywords[$index] ?? null;

            if (!$keyword) {
                continue; // skip if keyword missing
            }

            $data = [
                $langName => trim($value),
            ];

            $update = DB::table('language_data')
                ->where('keyword', $keyword)
                ->update($data);

            if ($update) {
                $updated = true;
            }
        }


        if ($updated) {
            return redirect()->back()->with('success', __('Save Change Successful'));
        } else {
            return redirect()->back()->with('error', __('Something went wrong!!'));
        }
    }
}
