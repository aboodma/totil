<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Provider;
use App\Notification;
use App\Order;
use App\OrderDetail;
use App\OrderReview;
use App\ProviderType;
use Crypt;
use App\User;
use Illuminate\Support\Facades\Hash;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use FFMpeg\Filters\Video\VideoFilters;
use Illuminate\Support\Str;
use ProtoneMedia\LaravelFFMpeg\FFMpeg\CopyFormat;
use Buglinjo\LaravelWebp\Facades\Webp;
use Session;
use Config;
use App;
class HomeController extends Controller
{
  
    /**
     * Create a new controller instance.
     *
     * @return void
     */

      public function changeLocale($locale)
      {
         App()->setLocale($locale);
         //store the locale in session so that the middleware can register it
         session()->put('locale', $locale);
         // return app()->getLocale();
         return  redirect()->route('welcome');
      }


     public function provider_profile(Provider $provider)
     {
        return view('website.provider_profile',compact('provider'));
     }

     public function featured()
     {
        $providers = Provider::where('is_approved',true)->get();
        return view('website.featured',compact('providers'));
     }

     public function FilterByType(ProviderType $providerType)
     {
        $providers = $providerType->provider;
        return view('website.byType',compact('providers','providerType'));
     }

     public function customer_dashboard()
     {
        return view('website.customer.dashboard');
     }
     public function checkout(Request $request)
     {
      //   return $request->all();
        return view('website.checkout',compact('request'));
     }

     public function payment_info(Request $request)
     {
        return view('website.payment_info',compact('request'));
     }
     public function pay(Request $request)
     {

        $order = New Order;
        $order->user_id = auth()->user()->id;
        $order->provider_id = $request->provider_id;
        $order->service_id = $request->service_id;
        $order->total_price = $request->price;
        $order->status = 0;
        if (isset($request->is_public)) {
           $order->is_public = $request->is_public;
         }
        if ($order->save()) {
            $order_details = new OrderDetail();
            $order_details->order_id = $order->id;
            $order_details->from = $request->from;
            $order_details->to  = $request->to;
            $order_details->customer_message = $request->customer_message;
            $order_details->provider_message = " ";
            $order_details->save();
            $Customernotify = new Notification;
            $Customernotify->user_id = auth()->user()->id;
            $Customernotify->msg = "New Order Placed";
            $Customernotify->type = 0;
            $Customernotify->save();

            $Providernotify = new Notification;
            $Providernotify->user_id = Provider::find($request->provider_id)->user_id;
            $Providernotify->msg = "New Order Placed";
            $Providernotify->type = 0;
            $Providernotify->save();

        }

        $order_id =  Crypt::encrypt($order->id);
        
        return redirect()->route('order_complete',$order_id);
     }
     public function order_complete($d_order_id)
     {
      $order_id =  Crypt::decrypt($d_order_id);
      $order = Order::find($order_id);
      return view('website.order_complete',compact('d_order_id'));
     }
     public function categories()
     {
       $categories = ProviderType::all();
       return view('website.categories',compact('categories'));
     }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function be_our_partner()
    {
       return view('website.be_partner');
    }
    public function provider_request(Request $request)
    {
      //  return $request->all();
      $validated = $request->validate([
         'name' => 'required',
         'email' => 'required|unique:users',
         'password' => 'required',
         'about_me' => 'required',
         'provider_type_id' => 'required',
         'country_id' => 'required',
     ]);
     if ($validated) {
      $random = Str::random(40);
      $file = $request->file('avatar');     
      $filename = $file->getClientOriginalName();
      $avatar = explode('.',$filename);
      $avatar = $random.'.'.$file->extension(); 
      
    if ($fil= $file->move(public_path(), $avatar)) {
        // File is saved successfully
    
      $user =  User::create([
         'name' => $request->name,
         'email' =>$request->email,
         'password' => Hash::make($request->password),
         'user_type'=>1,
         'avatar'=>$avatar,
         'api_token' => Str::random(60),
     ]);
   }
     if ($user) {
      $provider = new Provider();
     
         $random = Str::random(40);
         $file = $request->file('video');     
         $filename = $file->getClientOriginalName();
         $newName = explode('.',$filename);
         
         $newName = $random.'.'.$file->getClientOriginalExtension();
         $fil= $file->move(public_path(), $newName);
         // FFMpeg::fromDisk('unoptimized_video')->open('ham_video/'.$newName)
         // ->export()
         // ->save("provider/".$random.'.webm');
         // unlink($path.'/'.$newName);
         $provider->video = $newName;
     
   
        $provider->user_id = $user->id;
      
        $provider->about_me = $request->about_me;
        $provider->provider_type_id = $request->provider_type_id;
        $provider->country_id = $request->country_id;
        $provider->is_approved = false;
        if ($provider->save()) {
           return route('request_submited',$user->id);
        }
     }
     }else{
        return 0;
     }
       
    }

    public function request_submited(User $user)
    {
       return view('website.request_submited',compact('user'));
    }

    public function reviews(Request $request)
    {
       $provider = Provider::find($request->provider_id);
       return view('parts.reviews',compact('provider'));
    }
    
    public function search(Request $request)
    {
       
       $categories = ProviderType::where('name', 'like', '%' .$request->q . '%')->get();
       $providers = User::where('user_type',1)->where('name', 'like', '%' .$request->q . '%')->get();
       return view('website.search',compact('categories','providers'));
    }
    
}
