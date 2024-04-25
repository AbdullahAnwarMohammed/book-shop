<?php

namespace App\Livewire;

use App\Models\Purchase;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class History extends Component
{   
    public $date = null;
    public $per_page = 4;
    use WithPagination;
    public function render()
    {
       
    

        if($this->date != null)
        {
            //whereDate / whereMonth / whereDay / whereYear / whereTime
            $purchases = Purchase::where('user_id',auth()->user()->id)
            ->whereDate('created_at',$this->date)
            ->paginate($this->per_page);

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
        else 
        {
            //whereDate / whereMonth / whereDay / whereYear / whereTime
            $purchases = Purchase::where('user_id',auth()->user()->id)
            ->paginate($this->per_page);

          // عمليات بيع 
          $recoveryFalse = Purchase::where('user_id',auth()->user()->id)
          ->where('recovery',0)
          ->count();

          // عمليات استرجاع
          $recoveryTrue = Purchase::where('user_id',auth()->user()->id)
          ->where('recovery',1)
          ->count();

        }   
     
        return view('livewire.history',
    [
        'purchases' => $purchases,
        'recoveryFalse' => $recoveryFalse,
        'recoveryTrue' => $recoveryTrue
    ]);
    }

    public function updateDATA()
    {
        
       $this->render();
    }

    public function allPurchases()
    {
        $this->date = null;
    }



    public function recoveryHandler($item)
    {
        
        Purchase::where('id',$item['id'])->update([
            'recovery' => 1
        ]);
        $this->dispatch('success', ['message' => 'تم بنجاح', 'type' => 'success']);


    }

    public function recoveryRemove($item)
    {
        Purchase::where('id',$item['id'])->update([
            'recovery' => 0
        ]);
        $this->dispatch('success', ['message' => 'تم بنجاح', 'type' => 'success']);
    }
}
