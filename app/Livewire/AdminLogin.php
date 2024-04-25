<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AdminLogin extends Component
{
    public $email,$password;
    public function render()
    {
        return view('livewire.admin-login');
    }

    public function LoginHandler()
    {
        $this->validate([
            'email' => 'required|email|exists:admins,email',
            'password' => 'required'
        ],[
            'required' => 'هذا الحقل اجباري',
            'email' => 'اكتب البريد بطريقة صحيح',
            'exists' => 'هذا البريد غير موجود من قبل'
        ]);

        $creds = ['email' => $this->email, 'password' => $this->password];
        if(Auth::guard('admin')->attempt($creds))
       {
            return redirect()->route("admin.home");
       }else{
            session()->flash("fail","يوجد خطأ فى البيانات");
            return redirect()->route("admin.login");

       }  

    }
}
