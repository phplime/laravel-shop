<?php

namespace App\Http\Controllers;

use HasinHayder\TyroLogin\Http\Controllers\LoginController as ControllersLoginController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends ControllersLoginController
{
    public function index(Request $request)
    {
        return parent::showLoginForm($request);
    }

    public function login(Request $request): RedirectResponse
    {


        // Add username validation ON TOP of package validation
        $validator = Validator::make(
            $request->all(),
            [
                'both' => 'required|string',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Inject username into request BEFORE package register logic runs
        $request->merge([
            'username' => $request->both,
        ]);

        // Now call package logic — it will receive the new username field
        return parent::login($request);
    }
}
