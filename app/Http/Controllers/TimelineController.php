<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class TimelineController extends Controller
{
    public function showTimelinePage(Request $request, Response $response)
    {
        return view('timeline', [
          'image_url' => 'https://thumb.ac-illust.com/77/77d8905d1a9192f70ecacde86aae5de6_t.jpeg',
          'name' => '田中太郎',
        ]);
    }
    public function postTweet(Request $request, Response $response)
    {
        $rules = [
            'tweet' => ['string', 'required', 'max:140'],
            'image_url' => ['nullable', 'string', 'max:200'],
        ];
        $message = [
            'tweet.required' => 'ツイートは必ず入力してください。',
            'tweet.max:140' => 'ツイートは140文字以内で入力してください。',
            'image_url.max:200' => '画像URLは200文字以内としてください。',
        ];
        $validator = Validator::make($request->all(), $rules, $message);
        
        if($validator->fails()){
            return redirect('/timeline')
            ->withErrors($validator)
            ->withInput();
        }
       return back();
    }
}
