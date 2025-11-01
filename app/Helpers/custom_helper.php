<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

if (!function_exists('__request')) {
    /**
     * Universal Laravel response helper (AJAX + normal)
     *
     * @param int $status 1=success, 0=error, 2=warning/custom
     * @param string $msg
     * @param string $url
     * @param array $extra (optional extra data)
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    function __request($status = 0, string $msg = '', string $url = '', array $extra = [])
    {
        /** @var Request $request */
        $request = request();

        // Check if there's an error in extra array
        $hasExtraError = !empty($extra['error']) || !empty($extra['error_text']);
        $success = $status === 1 && !$hasExtraError;
        $error = !$success;

        // Default messages based on success/error state
        $msg = $msg ?: ($success ? "Save change successfully" : "Something went wrong!");

        // Response structure
        $response = array_merge([
            'st'      => $status,
            'success' => $success,
            'error'   => $error,
            'msg'     => $msg,
            'url'     => $url,
        ], $extra);

        // If AJAX → return JSON
        if ($request->ajax()) {
            return response()->json($response);
        }

        // For normal requests → set flash + redirect
        $flashType = $success ? 'success' : ($status === 2 ? 'warning' : 'error');

        Session::flash($flashType, $msg);
        $redirectUrl = $url ?: url()->previous();

        return Redirect::to($redirectUrl);
    }
}


if (!function_exists('user')) {
    /**
     * Get authenticated user data
     *
     * @param string|null $key The user property to get (id, name, email, role, etc.)
     * @return mixed
     */
    function user($key = null)
    {
        $user = \Illuminate\Support\Facades\Auth::user();

        if (is_null($key)) {
            return $user;
        }

        return $user?->$key ?? null;
    }
}
