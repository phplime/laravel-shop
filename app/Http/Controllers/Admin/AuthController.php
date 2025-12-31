<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    protected $baseRepo;
    public function __construct(BaseRepository $baseRepo)
    {
        $this->baseRepo = $baseRepo;
    }


    public function item_delete($id, $table)
	{
		$del = $this->baseRepo->delete($id, $table);

		if ($del) {
			return redirect()->back()->with('success', 'Deleted Successfully');
		} else {
			__request(0, __('error_text'), '');
		}
	}
}
