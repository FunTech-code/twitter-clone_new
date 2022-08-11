<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Tweet;
use App\User;

class UserController extends Controller
{
    public function showUserPage()
    {
        $tweets = Tweet::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        $user = User::where('id', Auth::user()->id)->first();

        return view('user', [
            'user' => $user,
            'tweets' => $tweets,
        ]);
    }

}
