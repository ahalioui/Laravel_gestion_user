<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TestController extends Controller
{
   public function bar()
   {
       Mail::to('test@mail.test')->send(new TestMail());

       return view('test.bar');
   }

}
