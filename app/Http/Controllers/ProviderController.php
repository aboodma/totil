<?php

namespace App\Http\Controllers;

use App\Provider;
use Illuminate\Http\Request;
use App\User;
use App\Notification;
use App\Wallet;
use App\Order;
use App\Service;
use App\ProviderService;
use VideoThumbnail;
use Illuminate\Support\Facades\Hash;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use FFMpeg\Filters\Video\VideoFilters;
use Illuminate\Support\Str;
use ProtoneMedia\LaravelFFMpeg\FFMpeg\CopyFormat;
class ProviderController extends Controller
{

    public function dashboard()
    {
        return view('website.provider.dashboard');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return view('website.provider.profile');
    }

    public function update_profile(Request $request)
    {
        $slug = slugify($request->name);
       $provider = auth()->user()->provider;
       $provider->slug = $slug;
       $provider->about_me = $request->about_me;
       $provider->provider_type_id = $request->provider_type;
       $provider->country_id = $request->country_id;
       $provider->links_tiktok = $request->tiktok;
       $provider->links_fb = $request->fb;
       $provider->links_ig = $request->ig;
       $provider->links_snap = $request->snap;
       $provider->links_tweet = $request->tweet;
       $provider->links_youtube = $request->youtube;
       if ($provider->save()) {
           $user = auth()->user();
           $user->name = $request->name;
           if ($request->has('video')) {
            $random = Str::random(40);
            $file = $request->file('video');
            $filename = $file->getClientOriginalName();
            $newName = $random.'.'.$file->extension();
            $fil= $file->move(public_path()."/uploads/ham_videos/", $newName);
            FFMpeg::fromDisk('unoptimized_video')->open('ham_videos/'.$newName)
                ->export()
                ->save("/uploads/provider/".$random.'.webm');
                // unlink($path.'/'.$newName);
                $provider->video ="uploads/provider/".$random.'.webm';
           }
           if ($request->has('avatar')) {
            $random = Str::random(40);
            $file = $request->file('avatar');     
            $filename = $file->getClientOriginalName();
            $avatar = explode('.',$filename);
            $avatar = $random.'.'.$file->extension(); 
            if($fil= $file->move(public_path()."/uploads/avatars/", $avatar)){
                $user->avatar = "/uploads/avatars/".$avatar;
                $user->save();
            }
           }
       }
       return redirect()->route('provider.profile');
    }

    public function payment_settings()
    {
       return view('website.provider.payment_settings');
    }
    public function update_payment_settings(Request $request)
    {
        $provider = auth()->user()->provider;
        $provider->account_name = $request->account_name;
        $provider->iban = $request->iban;
        if ($provider->save()) {
            return redirect()->route('provider.payment_settings');
        }
    }
    public function services()
    {
        return view('website.provider.services');
    }
    public function orders($status)
    {
        if ($status == "onGoing") {
            $orders = auth()->user()->provider->orders->wherein('status',[0,1]);

        }else{
            $orders = auth()->user()->provider->orders->wherein('status',[2,3,4,5]);
            
        }
        return view('website.provider.orders',compact('orders'));
    }
    public function orders_procced(Order $order)
    {
        return view('website.provider.order_procced',compact('order'));
    }
    public function video_order_upload(Request $request)
    {
        if($request->hasFile('video')){
            $random = Str::random(40);
            $file = $request->file('video');     
            $filename = $file->getClientOriginalName();
            $newName = explode('.',$filename);
            
            $newName = $random.'.'.$file->extension();
            $fil= $file->move(public_path(), $newName);
            // FFMpeg::fromDisk('unoptimized_video')->open('ham_video/'.$newName)
            // ->export()
            // ->save($random.'.webm');
            // unlink($path.'/'.$newName);
        }
        $thumb = VideoThumbnail::createThumbnail(public_path($newName), public_path('uploads/thumbs/'), $random.'.jpg', 0, 540, 902);
     
        $order = Order::find($request->order_id);
        $order_details = $order->details;
        $order_details->provider_message = $newName;
        $order_details->save();
        $order->status = 2;
        $order->save();
            $Providernotify = new Notification;
            $Providernotify->user_id = auth()->user()->id;
            $Providernotify->msg = "Order Status Updated";
            $Providernotify->type = 1;
            $Providernotify->save();

            $Customernotify = new Notification;
            $Customernotify->user_id = $order->user_id;
            $Customernotify->msg = "Order Status Updated";
            $Customernotify->type = 1;
            $Customernotify->save();
        $wallet = new Wallet();
        $wallet->user_id = auth()->user()->id;
        $wallet->transaction_type = 0 ;
        $wallet->amount = $order->total_price;
        $wallet->save();
        return route('provider.orders',"onGoing");

    }

    public function OrderChangeStatus($status,Order $order)
    {
       $order->status = $status;
       if ($order->save()) {
        $Providernotify = new Notification;
        $Providernotify->user_id = auth()->user()->id;
        $Providernotify->msg = "Order Status Updated";
        $Providernotify->type = 1;
        $Providernotify->save();

        $Customernotify = new Notification;
        $Customernotify->user_id = $order->user_id;
        $Customernotify->msg = "Order Status Updated";
        $Customernotify->type = 1;
        $Customernotify->save();
        return redirect()->route('provider.orders',"onGoing");
       }
    }
    public function other_order_upload(Request $request)
    {
        $order = Order::find($request->order_id);
        $order_details = $order->details;
        $order_details->provider_message = $request->provider_note;
        $order_details->save();
        $order->status = 2;
        $order->save();
        $Providernotify = new Notification;
            $Providernotify->user_id = auth()->user()->id;
            $Providernotify->msg = "Order Status Updated";
            $Providernotify->type = 1;
            $Providernotify->save();

            $Customernotify = new Notification;
            $Customernotify->user_id = $order->user_id;
            $Customernotify->msg = "Order Status Updated";
            $Customernotify->type = 1;
            $Customernotify->save();
        return redirect()->route('provider.orders',"onGoing");

    }
    public function add_service(Service $service)
    {
       return view('website.provider.add_service',compact('service'));
    }
    public function store_service(Request $request)
    {
        $service_provider = new ProviderService();
        $service_provider->service_id = $request->service_id;
        $service_provider->provider_id = auth()->user()->provider->id;
        $service_provider->price = $request->price;
        if ($service_provider->save()) {
            return redirect()->route('provider.services');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$user_type)
    {
        if($request->hasFile('video')){
            $random = Str::random(40);
            $file = $request->file('video');     
            $filename = $file->getClientOriginalName();
            $path = public_path().'/uploads/ham_video';
            $newName = explode('.',$filename);
            $newName = $random.'.'.$newName[1];
            $fil= $file->move($path, $newName);
            FFMpeg::fromDisk('unoptimized_video')->open('ham_video/'.$newName)
            ->export()
            ->save("provider/".$random.'.webm');
            unlink($path.'/'.$newName);
        }
        $user =  User::create([
            'name' => $request->name,
            'email' =>$request->email,
            'password' => Hash::make($request->password),
            'user_type'=>$user_type
        ]);
        if ($user) {
            $provider = new Provider();
            $provider->user_id = $user->id;
            $provider->video = "provider/".$random.'.webm';
            $provider->about_me = $request->about_me;
            $provider->provider_type_id = $request->provider_type;
            $provider->country_id = $request->country_id;
            $provider->is_approved = $request->is_approved;
            $provider->save();
            return $provider;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function show(Provider $provider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function edit(Provider $provider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user,$user_type)
    {

        $user->name = $request->name;
        $user->phone = $request->phone;
        if ($user->save()) {
            $provider = Provider::where('user_id',$user->id)->first();
            $provider->about_me = $request->about_me;
            $provider->country_id = $request->country_id;
            $provider->provider_type_id = $request->provider_type;
            $provider->is_approved = $request->is_approved;
            if ($provider->save()) {
                return redirect()->back();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user ,Provider $provider)
    {
        if ($user->delete()) {
            if ($provider->delete()) {
                return redirect()->back();
            }
        }

    }
}
