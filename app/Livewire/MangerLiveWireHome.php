<?php

namespace App\Livewire;

use App\Models\Purchase;
use Carbon\Carbon;
use Livewire\Component;

class MangerLiveWireHome extends Component
{
    public function render()
    {
         //whereDate / whereMonth / whereDay / whereYear / whereTime
         // [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
         /* OR
         [
            $now->startOfWeek()->format('Y-m-d'), //This will return date in format like this: 2022-01-10
            $now->endOfWeek()->format('Y-m-d')
            ]
         */ 
        $now = Carbon::now();

        $purchases_this_day = Purchase::whereDate('created_at',date("Y-m-d"))
        ->pluck('cost')->toArray();
        $purchases_this_week = Purchase::whereBetween('created_at',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        ->pluck('cost')->toArray();
        $purchases_this_month = Purchase::whereMonth('created_at',Carbon::now()->month)
        ->pluck('cost')->toArray();
        $purchases_this_year = Purchase::whereYear('created_at',Carbon::now()->year)
        ->pluck('cost')->toArray();
        return view('livewire.manger-live-wire-home',[
            'purchases_this_day' => $purchases_this_day,
            'purchases_this_week' => $purchases_this_week,
            'purchases_this_month' => $purchases_this_month,
            'purchases_this_year' => $purchases_this_year
        ]);
    }
}
