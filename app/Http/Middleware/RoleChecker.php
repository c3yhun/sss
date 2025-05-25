<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleChecker
{
    public function handle($request, Closure $next, $admin)
    {
        $roles = auth()->check() ? array(auth()->user()->user_role) : [];

        if (in_array($admin, $roles)) {
            return $next($request);
        }

        $notification = array(
            'message' => '👋 Buraya Giriş Yapmak için Yetkiniz Bulunmuyor!',
            'alert-type' => 'error'
        );

        return redirect()->route('admin.dashboard')->with($notification);
    }

}
