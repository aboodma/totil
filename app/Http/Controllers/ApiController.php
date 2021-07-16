<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Str;
use App\User;
use App\Book;
use App\Order;
use App\BookService;
use App\OrderDetail;
use Crypt;
use VideoThumbnail;
use App\Notification;
use App\Wallet;
use App\Provider;
use App\ProviderType;
use Illuminate\Support\Facades\Hash;

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
				'email' => $request->email,
				'password' => $request->password,
			);
			$att = Auth::attempt($userdata);
			if ($att) {
				$token = Str::random(60);

				$request->user()->forceFill([
					'api_token' => hash('sha256', $token),
					'mobile_token' => $request->token,
				])->save();
				$data = array(
					"user"=>auth()->user(),
					"balance"=>auth()->user()->wallets->where('transaction_type',0)->sum('amount') - auth()->user()->wallets->where('transaction_type',1)->sum('amount')
				);
				return response()->json($data, 200);
			} else {
				return response()->json('Requested User Data Not Valid',502);
			}

		}
		else {
			return response()->json('Requested User Data Not Valid',502);
		}
	}

	public function GetUserByToken()
	{

		$data = array(
			"user"=>auth()->user(),
			"balance"=>auth()->user()->wallets->where('transaction_type',0)->sum('amount') - auth()->user()->wallets->where('transaction_type',1)->sum('amount')
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
			return response()->json(1, 200);
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
			$user = User::create([
				'name' => $request->name,
				'email' => $request->email,
				'phone' => $request->phone,
				'password' => Hash::make($request->password),
				'user_type' => 0,
				'avatar' => "no image",
				'api_token' => Str::random(60),
			]);
			if ($user) {
				$userdata = array(
					'email' => $request->email,
					'password' => $request->password,
				);
				$att = Auth::attempt($userdata);
				if ($att) {
					$token = Str::random(60);
					$request->user()->forceFill([
						'api_token' => hash('sha256', $token),
						'mobile_token' => $request->token,
					])->save();
					$data = array(
						"user"=>auth()->user(),
						"balance"=>auth()->user()->wallets->where('transaction_type',0)->sum('amount') - auth()->user()->wallets->where('transaction_type',1)->sum('amount')
					);
					return response()->json($data, 200);
				} else {
					return response()->json(502);
				}
			} else {
				return response()->json(502);
			}

		} else {
			return response()->json(502);
		}

	}

	public function Categories()
	{
		$categories = ProviderType::all();
		return response()->json($categories, 200);
	}

	public function Providers()
	{
		$providers = Provider::where('is_approved', true)->get()->loadMissing('user')->loadMissing('country')->loadMissing('providerType');
		return response()->json($providers, 200);

	}

	public function Provider(Provider $provider)
	{
		$provider->loadMissing('user')->loadMissing('providerType')->loadMissing('country')->loadMissing('books');
		return response()->json($provider, 200);
	}

	public function BookServices(Book $book)
	{
		$book->loadMissing('services')->loadMissing('services.service');
		return response()->json($book, 200);
	}

	public function providerFromCategory()
	{
		$categories = ProviderType::all()->loadMissing(['provider' => function ($q) {
			$q->where('is_approved', true)->first();


		}, 'provider.user']);
		return response()->json($categories, 200);
	}

	public function pay(Request $request)
	{

		$order = new Order;
		$order->user_id = auth()->user()->id;
		$order->book_id = $request->book_id;
		$order->provider_id = $request->provider_id;
		$order->service_id = $request->service_id;
		$order->book_service_id = $request->book_service_id;

		$order->total_price = $request->price;
		$order->status = 2;
		$order->is_public = 1;
		if ($request->payment_method == "wallet") {
			$wallet = new Wallet();
			$wallet->user_id = auth()->user()->id;
			$wallet->transaction_type = 1;
			$wallet->amount = $order->total_price;
			$wallet->save();
		}
		if ($order->save()) {
			$order_details = new OrderDetail();
			$order_details->order_id = $order->id;
			$order_details->from = "no";
			$order_details->to = "no";
			$order_details->customer_message = "no";
			$order_details->provider_message = BookService::where(['book_id' => $request->book_id, 'service_id' => $request->service_id])->first()->file_path;
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


		return response()->json(200);
	}

}
