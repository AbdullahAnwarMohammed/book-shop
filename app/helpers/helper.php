<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

if(!function_exists('isActiveRouteAdmin'))
{
    function isActiveRouteAdmin($route)
    {
        $login = Auth::guard('admin')->check() ? "admin." : "sellers.";
        return Route::is($login.$route) ? "active" : "";
    }
}