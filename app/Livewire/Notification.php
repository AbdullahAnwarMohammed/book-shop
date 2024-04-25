<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Notification extends Component
{
 
    public function render()
    {
        return view('livewire.notification');
    }

    public function showNotificationAdmin()
    {
        $admin = Auth::guard('admin')->user();
        $unreadNotifications = $admin->unreadNotifications;
        foreach ($unreadNotifications as $notification) {
            $notification->markAsRead();
        }
    }
}
