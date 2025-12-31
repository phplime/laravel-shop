<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Package;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Repositories\BaseRepository;
use App\Services\SubscriptionService;
use App\Services\UserAccessService;
use App\Models\Vendor;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    protected BaseRepository $baseRepository;
    protected SubscriptionService $subscriptionService;
    protected UserAccessService $userAccessService;

    public function __construct(
        BaseRepository $baseRepository,
        SubscriptionService $subscriptionService,
        UserAccessService $userAccessService
    ) {
        $this->baseRepository = $baseRepository;
        $this->subscriptionService = $subscriptionService;
        $this->userAccessService = $userAccessService;
    }


    public function index()
    {
        $data = [];

        $data['page_title'] = 'Dashboard';
        $data['page'] = 'Dashboard';
        return view('backend.admin.dashboard', $data);
    }


    public function subscriber_list()
    {
        $data = [];
        $data['page_title'] = 'Subscriber List';

        $data['subscriber_list'] = User::where('role', '!=', 'admin')
            ->with(['package', 'subscription'])
            ->filter(request()->all())
            ->orderBy('id', 'asc')
            ->paginate(5)
            ->withQueryString();



        return view('backend.admin.auth.user_list', $data);
    }


    public function vendor_list()
    {
        $data = [];
        $data['page_title'] = 'Vendor List';

        $data['vendor_list'] = Vendor::filter(request()->all())
            ->orderBy('id', 'asc')
            ->paginate(5)
            ->withQueryString();


        return view('backend.admin.auth.vendor_list', $data);
    }



    public function user_details($username)
    {
        $user = User::where('username', $username)->firstOrFail();

        // Sync data before viewing to ensure accuracy
        $this->subscriptionService->syncUserAccessData($user->id);

        $data = $this->userAccessService->getUserAccessData($username);

        $data['page_title'] = 'User Details';

        return view('backend.admin.auth.user_details', $data);
    }

    public function update_user_access(Request $request)
    {
        $updated = $this->userAccessService->updateAccess(
            $request->user_id,
            $request->type,
            $request->id,
            $request->status
        );

        if ($updated) {
            return response()->json(['st' => 1, 'msg' => __('success_msg')]);
        }

        return response()->json(['st' => 0, 'msg' => __('something_went_wrong')]);
    }


    public function subscription_invoice($id)
    {
        $page_title = 'Subscription Invoice';
        return view('backend.invoices.subscription_invoice', compact('page_title'));
    }


    // public function language_list()
    // {
    //     $data = [];
    //     $data['page_title'] = 'Languages';


    //     // $data['country_list'] = all('country_list');
    //     return view('backend.language.language_list', $data);
    // }


    // public function language_data()
    // {
    //     $page_title = 'Language Data';
    //     return view('backend.language.language_data', compact('page_title'));
    // }


    public function add_language_data(Request $request)
    {
        $request->validate([
            'keyword' => 'required',
            'value' => 'required',
        ]);

        $data = [
            'keyword' => $request->keyword,
            'details' => $request->value,
        ];

        $last_id = $this->baseRepository->create($data, 'language_data');

        if ($last_id) {
            __request(1, 'Save change successful');
        } else {
            __request(0, 'Save change error!!');
        }
    }
}
