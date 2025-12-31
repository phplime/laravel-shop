<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SetTimezone
{
    public function handle(Request $request, Closure $next)
    {
        // 1. শপ চিনুন — আপনার লজিক অনুযায়ী (slug, header, subdomain, auth user)
        $shop = $this->resolveShop($request);

        // 2. টাইমজোন সেট করুন (PHP + Carbon উভয়ের জন্য)
        if ($shop && $shop->timezone) {
            date_default_timezone_set($shop->timezone);
        } else {
            date_default_timezone_set(__settings('timezone', 'Asia/Dhaka'));
        }

        return $next($request);
    }

    protected function resolveShop(Request $request)
    {
        // ✅ আপনার লজিক অনুযায়ী শপ খুঁজুন
        // উদাহরণ ১: URL থেকে slug (e.g., /{shop_slug}/dashboard)
        $slug = $request->route('shop_slug') ?? $request->shop_slug;

        // উদাহরণ ২: auth user-এর মাধ্যমে
        // $user = $request->user();
        // return $user?->shop;

        return $slug ? \App\Models\Shop::where('slug', $slug)->first() : null;
    }
}
