<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\TimelineRequest;
use Carbon\Carbon;

class TimelineController extends Controller
{
    public function showTimelinePage(Request $request, Response $response)
    {
        $tweets = DB::table('tweets')->latest()->paginate(5);
        return view('timeline', [
            'user' => Auth::user(),
            'tweets' => $tweets,
        ]);
    }
    public function postTweet(TimelineRequest $request, Response $response)
    {
        $param = [
            'user_id'   => Auth::user()->id,
            'tweet'     => $request->tweet,
            'image_url' => $request->image_url,
            'created_user' => Auth::user()->name,
            'update_user' => Auth::user()->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('tweets')->insert($param); 
        return back();
    }
}
