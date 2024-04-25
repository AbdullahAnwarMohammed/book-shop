<?php

namespace App\Livewire;

use App\Models\Customer;
use Livewire\Component;

class LiveWireCustomers extends Component
{
    public function render()
    {
        $Customers = Customer::all();
        return view('livewire.live-wire-customers',[
            'Customers' => $Customers
        ]);
    }
}
