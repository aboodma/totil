<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Str;
use App\User;
use App\Book;
use VideoThumbnail;
use App\Notification;
use App\Wallet;
use App\Provider;
use App\ProviderType;
use App\Category;
use App\Country;
class ApiController extends Controller
{
    public function Login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validated) {
            $userdata = array(
                'email'=>$request->email,
                'password'=>$request->password,
            );
            try {
               $att = Auth::attempt($userdata);
                if ($att) {
                    $token = Str::random(60);

                    $request->user()->forceFill([
                        'api_token' => hash('sha256', $token),
                        'mobile_token' => $request->token,
                    ])->save();
                     return response()->json($request->user, 200);
                }
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }

    public function GetUserByToken()
    {

        $data = array(
            'user'=>auth()->user()->provider->loadMissing('orders.details')->loadMissing('orders.service'),
            'user'=>auth()->user(),
            'earnings'=>auth()->user()->wallets->where('transaction_type',0)->sum('amount'),
            'withdrawl'=>(auth()->user()->wallets->where('transaction_type',0)->sum('amount') - auth()->user()->wallets->where('transaction_type',1)->sum('amount')),
            'orders'=>auth()->user()->provider->orders->count(),
            'providerTypeName'=>auth()->user()->provider->ProviderType->name,
            'country'=>auth()->user()->provider->country->name,
        );

     return response()->json($data, 200);
    }

    public function user(Request $request)
    {
        return $request;
    }
    public function Logout(Request $request)
    {
        $user = auth()->user();
        $user->api_token = null;
        if ($user->save()) {
            return response()->json(1,200);
        }
    }
    public function SignUp(Request $request)
    {
        //  return $request->all();
      $validated = $request->validate([
        'name' => 'required',
        'email' => 'required|unique:users',
        'password' => 'required'
    ]);
    if ($validated) {
       // File is saved successfully
     $user =  User::create([
        'name' => $request->name,
        'email' =>$request->email,
        'password' => Hash::make($request->password),
        'user_type'=>0,
        'avatar'=>"no image",
        'api_token' => Str::random(60),
    ]);
  }
    if ($user) {
        $att = Auth::attempt($userdata);
        if ($att) {
                    $token = Str::random(60);
                    $request->user()->forceFill([
                        'api_token' => hash('sha256', $token),
                        'mobile_token' => $request->token,
                    ])->save();
                    return response()->json($user, 200);
                        }
            } else {
            return 0;
            }
    }

    public function Categories()
    {
        $categories = ProviderType::all();
        return response()->json($categories, 200);
    }
    public function Providers()
    {
        $providers = Provider::where('is_approved',true)->get()->loadMissing('user')->loadMissing('country')->loadMissing('providerType');
        return response()->json($providers, 200);

    }

    public function Provider(Provider $provider)
    {
        $provider->loadMissing('user')->loadMissing('providerType')->loadMissing('country')->loadMissing('books');
        return response()->json($provider, 200);
    }

    public function BookServices(Book $book)
    {
        $book->loadMissing('services');
        return response()->json($book, 200);
    }
    
}
