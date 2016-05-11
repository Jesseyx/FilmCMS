<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class PermissionCheck
{
    public function check($controller, $action)
    {
        // 检查用户是否登录
        if (!Auth::check()) {
            return false;
        }

        return Auth::user()->hasPermission($controller, $action);
    }
}