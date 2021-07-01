<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Order;
use App\Wallet;
use Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
   public function profile()
   {
       return view('website.customer.profile');
   }

   public function orders()
   {
       $user = auth()->user();
       $orders = $user->orders;
       return view('website.customer.orders',compact('orders'));
   }
   public function OrderTracking($id)
   {
    $order_id =  Crypt::decrypt($id);
    $order = Order::find($order_id);
    return view('website.customer.order_tracking',compact('order'));
   }

   public function videos()
   {
    $user = auth()->user();
    $orders = $user->orders->where('status',2);
    return view('website.customer.videos',compact('orders'));
   
   }
   public function wallet()
   {
       $wallets = Wallet::where('user_id',auth()->user()->id)->get();
       return view('website.customer.wallet',compact('wallets'));
   }

   public function UpdatePrfoile(Request $request)
   {
       $user  = auth()->user();
       $user->name = $request->name;
       if($request->password != null){
        $user->password = Hash::make($request->password);
       }
       $user->save();
   }
   public function payForFunds(Request $request)
   {
       return view('website.customer.pay_for_funds',compact('request'));
   }
   public function payFunds(Request $request)
   {
       $user = auth()->user();
       $wallet = new Wallet();
       $wallet->user_id = $user->id;
       $wallet->transaction_type = 0;
       $wallet->amount = $request->funds;
       if($wallet->save()){
           return redirect()->route('customer.wallet');
       }

   }
}
