<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\EditUserRequest;
use App\Tweet;
use App\User;
use Carbon\Carbon;

class EditUserController extends Controller
{
    public function showEditUserPage()
    {
        $user = User::where('id', Auth::user()->id)->first();
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

        $user = User::find(Auth::user()->id);
        $input = $request->all();
        $user->fill($input);
        $user->image_url = $image_url;
        $user->update_user = Auth::user()->name;
        $user->save();
        
        $tweets = User::find(Auth::user()->id)->tweets()->orderBy('created_at', 'desc')->get();
        $user = User::where('id', Auth::user()->id)->first();

        return view('user', [
            'user' => $user,
            'tweets' => $tweets
        ]);
    }
}
