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
        return ($key);
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
    function __footer($isBack = false, $url = null)
    {
        $data = [];
        $data['isBack'] = $isBack;
        $data['url'] = $url;
        return view('backend.sidebar.sidebar_footer', compact('data'));
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
            return "<a href='javascript:;' data-toggle='modal' data-target='#{$modal['target']}' class='btn btn-secondary text-right btn-sm addBtn'> <i class='fa fa-plus'></i> {$text}</a>";
        } elseif (!empty($modal) && isset($modal['is_sidebar']) && $modal['is_sidebar'] == 1) {
            return "<a href='javascript:;'  class='btn btn-secondary text-right btn-sm addBtn {$modal['class']}Sidebar' onclick='sidebar(`{$modal['class']}Sidebar`)'> <i class='fa fa-plus'></i> {$text}</a>";
        } else {
            return "<a href='{$url}' class='btn btn-secondary text-right btn-sm addBtn'> <i class='fa fa-plus'></i> {$text}</a>";
        }
    }
}


if (!function_exists('__status')) {
    function __status($id, $status, $table)
    {
        // $id = html_escape($id);
        // $status = html_escape($status);
        // $table = html_escape($table);

        $badge_class = $status == 1 ? 'badge-success' : 'badge-danger';
        $icon_class = $status == 1 ? 'fa-check' : 'fa-ban';
        $status_text = $status == 1 ? (!empty(lang('activated')) ? lang('activated') : "activated") : (!empty(lang('inactive')) ? lang('inactive') : "inactive");

        $prams = "{$id},{$status},'{$table}'";

        $link = '<a href="javascript:;" data-status="' . $status . '" onclick="changeStatus(event,this,' . $prams . ')"  class="badge ' . $badge_class . ' changeStatus">';
        $link .= '<i class="fa ' . $icon_class . '"></i> &nbsp;' . $status_text . '</a>';

        return $link;
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
