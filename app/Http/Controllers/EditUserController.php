<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\EditUserRequest;

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
        return view('edit');
    }
}
