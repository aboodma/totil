<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class CustomController extends Controller
{
    public function users($user_type)
    {
      $users = User::where('user_type',$user_type)->get();
      return view('backend.users.list',compact('users'));
    }
}
