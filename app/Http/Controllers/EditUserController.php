<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\EditUserRequest;
use Carbon\Carbon;

class EditUserController extends Controller
{
    public function showEditUserPage()
    {
        $user = DB::table('users')->where('id', Auth::user()->id)->first();

        return view('edit', [
            'user' => $user,
        ]);
    }
    
    public function editComplete(EditUserRequest $request, Response $response)
    {
        $image_url = null;
        if(!empty($request['image_url'])){
            $filename = $request->image_url->getClientOriginalName();
            $image_url = $request->image_url->storeAs('',$filename,'public');
        }else if(!empty($request['image_url_before'])){
            $image_url = $request['image_url_before'];
        }
        $param = [
            'name' => $request['name'],
            'email' => $request['email'],
            'tel_number' => $request['tel_number'],
            'profile' => $request['profile'],
            'image_url' => $image_url,
            'update_user' => $request['name'],
            'updated_at' => Carbon::now()
        ];

        DB::table('users')->where('id', Auth::user()->id)->update($param);
        $tweets = DB::table('tweets')->where('user_id', Auth::user()->id)->get();
        $user = DB::table('users')->where('id', Auth::user()->id)->first();

        return view('edit', [
            'user' => $user,
            'tweets' => $tweets
        ]);
    }
}
