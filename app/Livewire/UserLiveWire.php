<?php

namespace App\Livewire;

use App\Models\Customer;
use App\Models\Purchase;
use Livewire\Component;

class UserLiveWire extends Component
{
    // `name`, `email`, `phone`, `fav`, `location`

    public $name,$email,$phone,$blocked,$fav,$location;
    public $search_customer;
    public $per_page = 4;
    public $show = false;
    public $date = null;

    public function render()
    {
        

        if($this->show)
        {
            $customers = Customer::search(trim($this->search_customer))->paginate($this->per_page);
        }
        else 
        {
            $customers = [];
        }

        if($this->date == null)
        {
              //whereDate / whereMonth / whereDay / whereYear / whereTime
              $purchases = Purchase::where('user_id',auth()->user()->id)
              ->whereDate('created_at',date("Y-m-d"))
              ->get();
  
            // عمليات بيع 
            $recoveryFalse = Purchase::where('user_id',auth()->user()->id)
            ->where('recovery',0)
            ->whereDate('created_at',date("Y-m-d"))
            ->count();
  
            // عمليات استرجاع
            $recoveryTrue = Purchase::where('user_id',auth()->user()->id)
            ->where('recovery',1)
            ->whereDate('created_at',date("Y-m-d"))

            ->count();
            
        }
       else
        {
          
            //whereDate / whereMonth / whereDay / whereYear / whereTime
            $purchases = Purchase::where('user_id',auth()->user()->id)
            ->whereDate('created_at',$this->date)
            ->get();

            // عمليات بيع 
            $recoveryFalse = Purchase::where('user_id',auth()->user()->id)
            ->where('recovery',0)
            ->whereDate('created_at',$this->date)
            ->count();

            // عمليات استرجاع
            $recoveryTrue = Purchase::where('user_id',auth()->user()->id)
            ->where('recovery',1)
            ->whereDate('created_at',$this->date)
            ->count();

        }   
       
    





        return view('livewire.user-live-wire',
        [
            'Customers' => $customers,
            'purchases' => $purchases,
            'recoveryFalse' => $recoveryFalse,
            'recoveryTrue' => $recoveryTrue,
        ]);
    }
    // الخزانة
    public function Cabinet()
    {
        $this->render();
    }
    public function search_customers()
    {
        !empty($this->search_customer) ? $this->show = true : $this->show = false;
        $this->render();
    }
    public function HandlerAdd()
    {
     $this->validate([
        'name' => 'required|unique:customers,name',
        'email' => 'required|email|unique:customers,email',
        'phone' => 'required|numeric|digits:11',
        
     ]);
     $Added = Customer::create([
        'name' => $this->name,
        'email' => $this->email,
        'phone' => $this->phone,
        'fav' => $this->fav,
        'location' => $this->location
     ]);  
    }
}
