<?php

use \Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;




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
    function __request($status = 0, string|array $msg = '', string $url = '', array $extra = [])
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
    function user($key = null)
    {
        $user = \Illuminate\Support\Facades\Auth::user();

        if (is_null($key)) {
            return $user;
        }

        return $user?->$key ?? null;
    }
}

if (!function_exists('lang')) {
    function lang($key)
    {
        return __($key);
    }
}


if (!function_exists('__header')) {
    function __header($title = '', $url = '', $class = '')
    {
        $data = [];
        $data['title'] = $title;
        $data['url'] = $url;
        $data['class'] = $class;
        $data['method'] = 'POST';

        return view('backend.sidebar.sidebar_header', compact('data'));
    }
}


if (!function_exists('__footer')) {
    function __footer($param = [])
    {
        $data = [];
        $data['param'] = $param;
        return view('backend.sidebar.sidebar_footer', $data);
    }
}



if (!function_exists('__startForm')) {
    function __startForm($url = '', $method = '')
    {
        $data =  '<form action="' . $url . '" method="' . (!empty($method) ? $method : 'get') . '" enctype="multipart/form-data" onsubmit="formSubmit(event,this)" class="formSubmit">';
        return $data;
    }
}

if (!function_exists('__endForm')) {
    function __endForm()
    {
        return '</form>';
    }
}



if (!function_exists('__submitBtn')) {
    function __submitBtn($isAjax = false)
    {
        $ajaxBtn = $isAjax == 1 ? 'submitBtn' : '';
        return "<button type='submit' class='btn btn-primary submit {$ajaxBtn} '>" . __('submit') . " <i class='icofont-hand-drag1'></i></button>";
    }
}


if (!function_exists('submitBtn')) {
    function submitBtn()
    {
        return '<button type="submit" class="btn btn-primary">Submit <i class="icofont-hand-drag1"></i></button>';
    }
}


if (!function_exists('hidden')) {
    function hidden($name, $value)
    {
        return "<input type='hidden' name='{$name}' value='{$value}' />";
    }
}



if (!function_exists('__addBtn')) {
    function __addbtn($url, $text = '', $modal = [])
    {
        if ($text == '') {
            $text = lang('add_new');
        } else {
            $text = $text;
        }

        if (!empty($modal) && isset($modal['is_modal']) && $modal['is_modal'] == 1) {
            return "<a href='javascript:;' data-toggle='modal' data-target='#{$modal['target']}' class='btn btn-default text-right btn-sm addBtn'> <i class='fa fa-plus'></i> {$text}</a>";
        } elseif (!empty($modal) && isset($modal['is_sidebar']) && $modal['is_sidebar'] == 1) {
            return "<a href='javascript:;'  class='btn btn-default text-right btn-sm addBtn {$modal['class']}Sidebar' onclick='sidebar(`{$modal['class']}Sidebar`)'> <i class='fa fa-plus'></i> {$text}</a>";
        } else {
            return "<a href='{$url}' class='btn btn-default text-right btn-sm addBtn'> <i class='fa fa-plus'></i> {$text}</a>";
        }
    }
}


if (!function_exists('__status')) {
    function __status($id, $status, $table)
    {

        $badge_class = $status == 1 ? 'badge-success' : 'badge-danger';
        $icon_class = $status == 1 ? 'fa-check' : 'fa-ban';
        $status_text = $status == 1 ? (!empty(lang('activated')) ? lang('activated') : "activated") : (!empty(lang('inactive')) ? lang('inactive') : "inactive");

        $prams = "{$id},{$status},'{$table}'";

        $link = '<a href="javascript:;" data-status="' . $status . '" onclick="changeStatus(event,this,' . $prams . ')"  class="badge ' . $badge_class . ' changeStatus">';
        $link .= '<i class="fa ' . $icon_class . '"></i> &nbsp;' . $status_text . '</a>';

        return $link;
    }
}

if (!function_exists('duration_type')) {
    function duration_type()
    {
        return [
            'trial' => 'Trial',
            'monthly' => 'Monthly',
            'yearly' => 'Yearly',
            'lifetime' => 'Lifetime',
            'free' => 'Free',
            'days' => 'Days',
        ];
    }
}

if (!function_exists('__getStatus')) {
    function __getStatus($status, $is_active = false)
    {
        $status_configs = [
            'pending' => [
                'class' => 'status-label-danger',
                'icon' => 'fa-spinner'
            ],
            'accept' => [
                'class' => 'status-label-info',
                'icon' => 'fa-check'
            ],
            'processing' => [
                'class' => 'status-label-primary',
                'icon' => 'fa-cogs'
            ],
            'complete' => [
                'class' => 'status-label-success',
                'icon' => 'fa-check-circle'
            ],
            'cancel' => [
                'class' => 'status-label-danger',
                'icon' => 'fa-times-circle'
            ],
            'return' => [
                'class' => 'status-label-secondary',
                'icon' => 'fa-undo'
            ],
            'delivered' => [
                'class' => 'status-label-success',
                'icon' => 'fa-truck'
            ],
            'out_for_delivery' => [
                'class' => 'status-label-info',
                'icon' => 'fa-shipping-fast'
            ],
            'paid' => [
                'class' => 'status-label-success',
                'icon' => 'fa-dollar-sign'
            ],
            'unpaid' => [
                'class' => 'status-label-danger',
                'icon' => 'fa-exclamation-circle'
            ]
        ];

        $config = $status_configs[$status] ?? $status_configs['pending'];
        $active_class = $is_active ? ' status-label-active' : '';

        return '<label class="badge ' . $config['class'] . $active_class . '"> <i class="fa ' . $config['icon'] . '"></i> ' . __($status) . ' </label>';
    }
}



if (!function_exists('__adminMenu')) {
    function __adminMenu($data)
    {
        $menu_html = '';
        $menu_html .= '<div class="__adminMenuWrapper">';
        $menu_html .=   '<div class="__adminMenu">';
        $menu_html .=  '<ul>';
        foreach ($data as $menu_item) :
            $icon = !empty($menu_item['icon']) ? '<i class="' . $menu_item['icon'] . '"></i>' : '';
            $activeClass = !empty($menu_item['page_title']) &&  !empty($menu_item['_title']) && trim(strtolower($menu_item['page_title']))   == trim(strtolower($menu_item['_title'])) ? 'active' : '';
            $menu_html .= '<li class=' . $activeClass . '><a href="' . url($menu_item['url']) . '"> ' . $icon . ' ' . $menu_item['title'] . ' </a></li>';
        endforeach;
        $menu_html .= '</ul>';
        $menu_html .=  '</div>';
        $menu_html .= '</div>';

        echo $menu_html;
    }
}

if (!function_exists('__required')) {
    function __required($type = '')
    {
        if ($type == '') {
            return "<span class='error'> * </span>";
        } else {
            return 'required';
        }
    }
}



if (!function_exists('__editBtn')) {
    function __editBtn($url, $withText = false, $modal = [])
    {
        if ($withText == true) {
            $text = lang('edit');
        } else {
            $text = '';
        }

        if (!empty($modal) && isset($modal['is_modal']) && $modal['is_modal'] == 1) {
            return " <a href='javascript:;' data-toggle='modal' data-target='{$modal['target']}' class='btn btn-primary text-right btn-sm'> <i class='fa fa-edit'></i> {$text}</a>";
        } elseif (!empty($modal) && isset($modal['is_sidebar']) && $modal['is_sidebar'] == 1) {
            return " <a href='javascript:;' class='btn btn-primary text-right btn-sm {$modal['class']}Sidebar' onclick='sidebar(`{$modal['class']}Sidebar`)'> <i class='fa fa-edit'></i> {$text}</a>";
        } else {
            return "<a href='{$url}' class='btn btn-primary text-right btn-sm'> <i class='fa fa-edit'></i> {$text}</a>";
        }
    }
}


if (!function_exists('__deleteBtn')) {
    function __deleteBtn($id, $table, $withText = false)
    {
        $url = url("delete-item/{$id}/{$table}");
        if ($withText == true) {
            $text = lang('delete');
        } else {
            $text = '';
        }
        $msg = lang("are_you_sure");

        return "<a href='{$url}' class='btn btn-danger btn-sm action_btn' data-msg='{$msg}'> <i class='fa fa-trash'></i>  {$text}</a>";
    }
}


if (!function_exists('__mainContent')) {
    function __mainContent(string $viewPath, array $data = [])
    {
        /** @var \Illuminate\Http\Request $request */
        $request = request();

        // If it's an AJAX request, return only the partial view
        if ($request->ajax() || $request->input('isAjax') == 1) {
            return response()->view($viewPath, $data);
        }

        return view($viewPath, $data);
    }
}


// if (!function_exists('localizedRoute')) {
//     function localizedRoute($uri, $action, $name = null)
//     {
//         $urlStyle = config('localization.url_style', 'query');

//         if ($urlStyle === 'suffix') {
//             // Ensure locale placeholder is correctly inserted
//             $uri = ltrim($uri, '/');
//             Route::match(['get', 'post'], "/{locale}/{$uri}", $action)->name($name);
//         } else {
//             Route::match(['get', 'post'], $uri, $action)->name($name);
//         }
//     }
// }

if (!function_exists('localizedRoute')) {
    function localizedRoute(string $uri, array|string $action, ?string $name = null, array $methods = ['get', 'post']): void
    {
        $urlStyle = config('localization.url_style', 'query');
        $uri = ltrim($uri, '/');

        if ($urlStyle === 'suffix') {
            Route::match($methods, "/{locale}/{$uri}", $action)->name($name);
        } else {
            Route::match($methods, $uri, $action)->name($name);
        }
    }
}






if (!function_exists('__adminMenu')) {
    function __adminMenu($data)
    {
        $menuHtml = '';
        $menuHtml .= '<div class="__adminMenuWrapper">';
        $menuHtml .= '<div class="__adminMenu">';
        $menuHtml .= '<ul>';

        foreach ($data as $menuItem) {
            $icon = !empty($menuItem['icon']) ? '<i class="' . $menuItem['icon'] . '"></i>' : '';
            $activeClass = !empty($menuItem['page_title']) &&
                !empty($menuItem['_title']) &&
                trim(strtolower($menuItem['page_title'])) == trim(strtolower($menuItem['_title']))
                ? 'active'
                : '';

            $menuHtml .= '<li class="' . $activeClass . '">';
            $menuHtml .= '<a href="' . url($menuItem['url']) . '"> ' . $icon . ' ' . $menuItem['title'] . ' </a>';
            $menuHtml .= '</li>';
        }

        $menuHtml .= '</ul>';
        $menuHtml .= '</div>';
        $menuHtml .= '</div>';

        echo $menuHtml;
    }
}

if (!function_exists('isJson')) {
    function isJson($string)
    {
        if (empty($string) || !is_string($string)) {
            return false;
        }
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}

if (!function_exists('mail_type')) {
    function mail_type($type = '')
    {
        $mailType = [
            'recovery_mail' => ['SITE_NAME', 'USERNAME', 'PASSWORD'],
            'contact_mail' => ['SITE_NAME', 'NAME', 'EMAIL', 'MESSAGE'],
            'resend_verify_mail' => ['SITE_NAME', 'USERNAME', 'LINK'],
            'email_verification_mail' => ['SITE_NAME', 'USERNAME', 'EMAIL', 'NAME', 'PACKAGE_NAME', 'VERIFY_LINK'],
            // 'account_create_invoice' => ['SITE_NAME', 'USERNAME', 'PACKAGE_NAME', 'PRICE'],
            // 'new_user_mail' => ['SITE_NAME', 'USERNAME', 'EMAIL', 'PACKAGE_NAME'],
            'offline_payment_request_mail' => ['SITE_NAME', 'USERNAME', 'EMAIL', 'PACKAGE_NAME', 'PRICE', 'TXNID'],
            'payment_confirmation_mail' => ['SITE_NAME', 'USERNAME', 'EMAIL', 'PAYMENT_METHOD', 'PAYMENT_DATE', 'TXNID', 'EXPIRE_DATE', 'PACKAGE_NAME', 'PRICE'],
            'expire_reminder_mail' => ['SITE_NAME', 'USERNAME', 'EMAIL', 'EXPIRE_DATE', 'REMAINING_DAYS'],
            'account_expire_mail' => ['SITE_NAME', 'USERNAME', 'EMAIL', 'EXPIRE_DATE'],
        ];
        if ($type == '') {
            return $mailType;
        } else {
            return !empty($mailType[$type]) ? $mailType[$type] : '';
        }
    }
}

if (!function_exists('__site_language')) {
    function __site_language()
    {
        return app()->getLocale();
    }
}


if (!function_exists('addDays')) {
    function addDays($type, $duration, $isFormat = true)
    {
        if (in_array($type, ['yearly', 'year'])) {
            return $isFormat ? now()->addYears($duration)->format('Y-m-d H:i:s') : now()->addYears($duration);
        }

        if (in_array($type, ['trial', 'trail'])) {
            return $isFormat ? now()->addMonths($duration)->format('Y-m-d H:i:s') : now()->addMonths($duration);
        }
        if (in_array($type, ['monthly', 'month'])) {
            return $isFormat ? now()->addMonths($duration)->format('Y-m-d H:i:s') : now()->addMonths($duration);
        }
        if (in_array($type, ['weekly', 'week'])) {
            return $isFormat ? now()->addWeeks($duration)->format('Y-m-d H:i:s') : now()->addWeeks($duration);
        }
        if (in_array($type, ['daily', 'day'])) {
            return $isFormat ? now()->addDays($duration)->format('Y-m-d H:i:s') : now()->addDays($duration);
        }
        if (in_array($type, ['hourly', 'hour'])) {
            return $isFormat ? now()->addHours($duration)->format('Y-m-d H:i:s') : now()->addHours($duration);
        }
        if (in_array($type, ['minute', 'min'])) {
            return $isFormat ? now()->addMinutes($duration)->format('Y-m-d H:i:s') : now()->addMinutes($duration);
        }
        if (in_array($type, ['second', 'sec'])) {
            return $isFormat ? now()->addSeconds($duration)->format('Y-m-d H:i:s') : now()->addSeconds($duration);
        }
        return $isFormat ? now()->format('Y-m-d H:i:s') : now();
    }
}


if (!function_exists('getDuration')) {
    function getDuration($type, $duration, $withDuration = true)
    {
        if (in_array($type, ['yearly', 'year'])) {
            return ($withDuration ? $duration : '') . ' ' . ($duration == 1 ? __('year') : __('years'));
        }

        if (in_array($type, ['trial', 'trail'])) {
            return ($withDuration ? $duration : '') . ' ' . ($duration == 1 ? __('month') : __('months'));
        }
        if (in_array($type, ['monthly', 'month'])) {
            return ($withDuration ? $duration : '') . ' ' . ($duration == 1 ? __('month') : __('months'));
        }
        if (in_array($type, ['weekly', 'week'])) {
            return ($withDuration ? $duration : '') . ' ' . ($duration == 1 ? __('week') : __('weeks'));
        }
        if (in_array($type, ['daily', 'day'])) {
            return ($withDuration ? $duration : '') . ' ' . ($duration == 1 ? __('day') : __('days'));
        }
        if (in_array($type, ['hourly', 'hour'])) {
            return ($withDuration ? $duration : '') . ' ' . ($duration == 1 ? __('hour') : __('hours'));
        }
        if (in_array($type, ['minute', 'min'])) {
            return ($withDuration ? $duration : '') . ' ' . ($duration == 1 ? __('minute') : __('minutes'));
        }
        if (in_array($type, ['second', 'sec'])) {
            return ($withDuration ? $duration : '') . ' ' . ($duration == 1 ? __('second') : __('seconds'));
        }
    }
}


if (!function_exists('dateTime')) {
    function dateTime()
    {
        return now()->format('Y-m-d H:i:s');
    }
}


if (!function_exists('makeDate')) {

    function makeDate($date, $type = 'fulldate')
    {
        if (empty($date)) {
            return '';
        }

        $d = \Carbon\Carbon::parse($date);

        switch ($type) {
            case 'fulldate':
                return $d->format('d M, Y');
            case 'fulldatetime':
                return $d->format('d M, Y h:i A');
            case 'datewithdash':
                return $d->format('Y-m-d');
            case 'datetimewithdash':
                return $d->format('Y-m-d H:i:s');
            case 'time':
                return $d->format('h:i A');
            default:
                return $d->format('d M, Y');
        }
    }
}

if (!function_exists('getPercent')) {
    function getPercent($amount, $percent)
    {
        if ($amount == 0 || $amount == "0") {
            return 0;
        } else {
            return ($amount * $percent) / 100;
        }
    }
}


if (!function_exists('is_test')) {
    function is_test()
    {
        return 0;
    }
}

if (!function_exists('__setTemp')) {

    function __setTemp(string $key = 'temp', $data = null, int $minutes = 5): void
    {
        if ($data === null) {
            return;
        }

        $cacheKey = 'temp_session_' . $key;

        // If key exists and both old and new data are arrays, merge them
        if (\Illuminate\Support\Facades\Cache::has($cacheKey)) {
            $existingData = \Illuminate\Support\Facades\Cache::get($cacheKey);

            if (is_array($existingData) && is_array($data)) {
                $data = array_merge($existingData, $data);
            }
        }

        \Illuminate\Support\Facades\Cache::put($cacheKey, $data, now()->addMinutes($minutes));
    }
}

if (!function_exists('__getTemp')) {

    function __getTemp(string $key, $default = null)
    {
        $cacheKey = 'temp_session_' . $key;
        return \Illuminate\Support\Facades\Cache::get($cacheKey, $default);
    }
}

if (!function_exists('__forgetTemp')) {

    function __forgetTemp(string $key): void
    {
        $cacheKey = 'temp_session_' . $key;
        \Illuminate\Support\Facades\Cache::forget($cacheKey);
    }
}

if (!function_exists('__hasTemp')) {

    function __hasTemp(string $key): bool
    {
        $cacheKey = 'temp_session_' . $key;
        return \Illuminate\Support\Facades\Cache::has($cacheKey);
    }
}

if (!function_exists('__pagination')) {

    function __pagination($key, $class = 'ci-pagination')
    {
        $html = '';
        $html .= '<div class="' . $class . '">';
        $html .= $key->links('pagination::bootstrap-4');
        $html .= '</div>';
        return $html;
    }
}
