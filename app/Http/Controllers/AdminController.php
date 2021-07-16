<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Provider;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function users($user_type)
    {
      $users = User::where('user_type',$user_type)->get();
      return view('backend.users.list',compact('users','user_type'));
    }

    public function user_view(User $user)
    {
      return $user;
    }

    public function user_edit(User $user)
    {
        return view('backend.users.edit',compact('user'));
    }
    public function user_create($user_type)
    {
      return view('backend.users.create',compact('user_type'));
    }
    public function user_update(Request $request , User $user)
    {
      
      $user->name = $request->name;
      $user->phone = $request->phone;
      if ($user->save()) {
        return redirect()->back();
      }
    }
    public function user_delete(Request $request , User $user)
    {
      return $user;
    }
    public function user_store(Request $request,$user_type)
    {
    try {
      $user =  User::create([
        'name' => $request->name,
        'email' =>$request->email,
        'password' => Hash::make($request->password),
        'user_type'=>$user_type
    ]);
    return redirect()->route('admin.users',$user_type);
    } catch (\Throwable $th) {
      //throw $th;
    }

    }

    /**
     * Show All Customers 
     */
    public function customers()
    {
      $users = User::where('user_type',0)->get();
      return view('backend.users.customers.index',compact('users'));
    }

    /**
     * Show Single Customer Informations 
     */
    public function customers_show(User $user)
    {
      return view('backend.users.customers.show',compact('user'));
    }

    /**
     * Edit Customer Informations
     */
    public function customers_edit(User $user)
    {
      return view('backend.users.customers.edit',compact('user'));
    }

    /**
     * Update Customer Informations
     */
    public function customers_update(Request $request , User $user)
    {
        $validated = $request->validate([
          'name' => 'required',
          'email' => 'required',
        
          
      ]);
      if ($validated) {
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password != null) {
          $user->password = Hash::make($request->password);
    
        }
        $user->save();
        return redirect()->route('admin.users.customers_show',$user->id);
      }else{
        return redirect()->back();
      }
      
    }

    /**
     * Delete Customer Record
     */
    public function customers_destroy(Request $request , User $user)
    {
      if ($user->delete()) {
        return redirect()->route('admin.users.customers');
      }
    }

    /**
     * Show All Providers
     */
    public function providers()
    {
      $users = User::where('user_type',1)->get();
      return view('backend.users.providers.index',compact('users'));
    }

    /**
     * Show Single Provider Informations
     */
    public function providers_show(User $user)
    {
      return view('backend.users.providers.show',compact('user'));
    }

    /**
     * Edit Single Provider Informations
     */
    public function providers_edit(User $user)
    {
      return view('backend.users.providers.edit',compact('user'));
    }

    /**
     * Update Single Provider Informations
     */
    public function providers_update(Request $request , User $user)
    {
      $provider = $user->provider;
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
           if ($request->has('avatar')) {
            $random = Str::random(40);
            $file = $request->file('avatar');     
            $filename = $file->getClientOriginalName();
            $avatar = explode('.',$filename);
            $avatar = $random.'.'.$file->extension(); 
            if($fil= $file->move(public_path(), $avatar)){
                $user->avatar = $avatar;
                $user->save();
            }
           }
       }
       return redirect()->route('admin.users.providers_edit',$user->id);
    }

    /**
     * Delete Single Provider 
     */
    public function providers_destroy(Request $request , User $user)
    {
      $user->provider->is_approved = false;
      $user->provider->save();
      return $user->provider;
    }

    public function provider_approve(Provider $provider)
    {
      $provider->is_approved = true;
      if ($provider->save()) {
        return redirect()->back();
      }
    }
}
