<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    
    public function logout()
    {
        Auth::guard('admin')->logout();

        // Optionally, you can redirect the user after logout
        return redirect()->route('admin.login'); // Redirect to admin login page
    }
}
