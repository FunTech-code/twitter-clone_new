<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\TimelineRequest;

class TimelineController extends Controller
{
    public function showTimelinePage(Request $request, Response $response)
    {
        return view('timeline', [
          'image_url' => 'https://thumb.ac-illust.com/77/77d8905d1a9192f70ecacde86aae5de6_t.jpeg',
          'name' => '田中太郎',
        ]);
    }
    public function postTweet(TimelineRequest $request, Response $response)
    {
        return view('timeline');
    }
}
