<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class EditUserController extends Controller
{
    public function showEditUserPage()
    {
        return view('edit',[
          'image_url' => 'https://thumb.ac-illust.com/77/77d8905d1a9192f70ecacde86aae5de6_t.jpeg',
        ]);
    }
    
    public function editComplete(EditUserRequest $request, Response $response)
    {
        $rules = [
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:50'],
            'tel_number' => ['required', 'string', 'regex:/^[0-9-]{10,13}$/', 'min:10', 'max:13'],
            'image_url' => ['nullable', 'string', 'max:200'],
            'profile' => ['nullable', 'string', 'max:200'],
        ];
        $message = [
            'name.required' => '名前は必ず入力してください。',
            'name.max:50' => '名前は50文字以内で入力してください。',
            'email.required' => 'メールアドレスは必ず入力してください。',
            'email.email' => '有効なメールアドレスを入力してください。',
            'email.max:50' => 'メールアドレスは50文字以内で入力してください。',
            'tel_number.required' => '電話番号は必ず入力してください。',
            'tel_number.regex:/^[0-9-]{10,13}$/' => '電話番号は数字もしくは-で記入してください。',
            'tel_number.min:10' => '電話番号は10文字以上13文字以内で入力してください。',
            'tel_number.max:13' => '電話番号は10文字以上13文字以内で入力してください。',
            'image_url.max:200' => '画像URLは200文字以内としてください。',
            'profile.max:200' => 'プロフィールは200文字以内で入力してください。',
        ];
        $validator = Validator::make($request->all(), $rules, $message);
        if($validator->fails()){
            return redirect('/edituser')
            ->withErrors($validator)
            ->withInput();
        }
       return view('edit');
    }
}
