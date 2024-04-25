<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\Purchase;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
class CartLiveWire extends Component
{
    public $type_payment = "manually",$hash;

    public function render()
    {
        $Carts = Cart::all();
        $cost = 0;
        foreach($Carts as $cart)
        {
            $cost += $cart['cost'];
        }
        return view('livewire.cart-live-wire',[
            'Carts' => $Carts,
            'cost' => $cost
        ]);
    }

    public function removeCart($Item)
    {
        Cart::where("id",$Item['id'])->delete();
    }

    public function buyOneBook($Item)
    {
       $this->validate([
        'hash' => 'required|exists:customers,hash'
       ],
        [
            'required'=> 'من فضلك ضع رمز العميل',
            'exists'=> 'يوجد خطأ ف رمز العميل'
        ]);

        $Customer = Customer::where('hash',$this->hash)->first();


        if($this->type_payment != 'manually')
        {
            if($Customer->cash < $Item['cost'])
            {
             $this->dispatch('error', ['message' => 'لا يوجد رصيد كافي', 'type' => 'error']);
            }
            else
            {
             
             Customer::where('hash',$this->hash)->update([
                 'cash' => $Customer->cash - $Item['cost']
             ]);
             $Added = Purchase::create([
                 [
                    'book_id' => $Item['book_id'], 
                 'user_id' => auth()->user()->id,
                 'customer_id' => $Customer->id,
                 'cost' => $Item['cost'],
                 'created_at' => now(),

                 ]
             ]);
 
             if($Added)
             {
                Cart::where('id',$Item['id'])->delete();

                 $this->dispatch('success', ['message' => 'تم بنجاح', 'type' => 'success']);
 
             }
            }
         }
         else{
             $Added = Purchase::create([
                 'book_id' => $Item['book_id'], 
                 'user_id' => auth()->user()->id,
                 'customer_id' => $Customer->id,
                 'cost' => $Item['cost'],
                 'created_at' => now(),

             ]);
             if($Added)
             {
                Cart::where('id',$Item['id'])->delete();
                 $this->dispatch('success', ['message' => 'تم بنجاح', 'type' => 'success']);
                
             }
         }
    }

    public function HandlerSell()
    {

        $this->validate([
            'hash' => 'required|exists:customers,hash'
           ],
            [
                'required'=> 'من فضلك ضع رمز العميل',
                'exists'=> 'يوجد خطأ ف رمز العميل'
            ]);
            $Customer = Customer::where('hash',$this->hash)->first();

            if($this->type_payment != 'manually')
            {

               
                    $Carts = Cart::all();
                    $Cost = 0;
                    foreach($Carts as $Item) 
                    {
                        $Cost += $Item['cost'];
                        $IDCarts[] = $Item['id'];
                        $Items[] = 
                                [
                                'book_id' => $Item['book_id'],
                                'user_id' => auth()->user()->id,
                                'customer_id' => $Customer['id'],
                                'cost' => $Item['cost'],
                                'created_at' => now(),

                               ];
                    }
                    if($Customer->cash < $Cost)
                    {
                     $this->dispatch('error', ['message' => 'لا يوجد رصيد كافي', 'type' => 'error']);
                    }
                    else
                    {
                        $Added = Purchase::insert($Items);
                        if($Added)
                        {
                            Customer::where('hash',$this->hash)->update([
                                'cash' => $Customer->cash - $Cost
                            ]);
                           Cart::whereIn('id',$IDCarts)->delete();
                            $this->dispatch('success', ['message' => 'تم بنجاح', 'type' => 'success']);
                           
                        }
                    }

                 

            }else 
            {
                $Carts = Cart::all();
                foreach($Carts as $Item) 
                {
                    $IDCarts[] = $Item['id'];
                    $Items[] = 
                            [
                            'book_id' => $Item['book_id'],
                            'user_id' => auth()->user()->id,
                            'customer_id' => $Customer['id'],
                            'cost' => $Item['cost'],
                            'created_at' => now(),
                           ];
                }
                $Added = Purchase::insert($Items);

                if($Added)
                {
             
                   Cart::whereIn('id',$IDCarts)->delete();
                    $this->dispatch('success', ['message' => 'تم بنجاح', 'type' => 'success']);
                   
                }

            }
    }
}
