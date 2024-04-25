<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Stripe;
use App\Notifications\Payment as NotificationsPayment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;

class StripeController extends Controller
{
    public function stripe(Request $request)
    {
        $request->validate([
            'hash' => 'required|exists:customers,hash',
            'price' => 'required|numeric'
        ],[
            'required' => 'مطلوب..',
            'exists' => 'غير صحيح'
        ]);
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $response = $stripe->checkout->sessions->create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'BookShop',
                        ],
                        'unit_amount' => $request->price*100,
                    ],
                    'quantity' => '1',
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('stripe.success').'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('stripe.cancel'),
        ]);
        if(isset($response->id) && $response->id != ''){
            // session()->put('product_name', $request->product_name);
            // session()->put('quantity', $request->quantity);
            session()->put('price', $request->price);
            session()->put('hash', $request->hash);
            return redirect($response->url);
        } else {
            return redirect()->route('stripe.cancel');
        }
    }

    public function success(Request $request)
    {
        if(isset($request->session_id)) {
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
            $response = $stripe->checkout->sessions->retrieve($request->session_id);

            $Customer = Customer::where('hash',session()->get('hash'))->first();
            $cash = $Customer['cash'] + Session::get("price") * 47;
            $Updated = Customer::where('hash',session()->get('hash'))->update([
                'cash' => $cash
            ]);
            
            DB::table("payment_history")->insert([
                'price' => Session::get("price") * 47,
                'customer_id' => $Customer['id'],
            ]);
            $data = [
                'type' => 'cash',
                'name'=>$Customer['name'],
                'price' => Session::get("price") * 47,
                'customer_id' => $Customer['name']
            ];  
            $admins = Admin::all();
            Notification::send($admins,new \App\Notifications\Payment($data));
            session()->forget('price');
            session()->forget('hash');

           return redirect()->route("home.cash")->with('success','تم الشحن بنجااااح');
        } else {
            return redirect()->route("home.cash")->with('error','يوجد خطأ ما');
        }
    }

    public function cancel()
    {
      return redirect()->route("home.cash")->with('error','يوجد خطأ ما');
    }
}