<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\TimelineRequest;
use App\Tweet;
use Carbon\Carbon;

class TimelineController extends Controller
{
    public function showTimelinePage(Request $request, Response $response)
    {
        $tweets = Tweet::all();
        return view('timeline', [
            'user' => Auth::user(),
            'tweets' => $tweets,
        ]);
    }
    public function postTweet(TimelineRequest $request, Response $response)
    {
        $image_url = null;
        if(!empty($request['image_url'])){
            $filename = $request->image_url->getClientOriginalName();
            $image_url = $request->image_url->storeAs('',$filename,'public');
        }
        $param = [
            'user_id'   => Auth::user()->id,
            'tweet'     => $request->tweet,
            'image_url' => $image_url,
            'created_user' => Auth::user()->name,
            'update_user' => Auth::user()->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('tweets')->insert($param); 
        return back();
    }
}
