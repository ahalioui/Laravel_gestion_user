<?php

namespace App\Http\Controllers;

use App\Mail\testMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class testController extends Controller
{
    public function bar()

    {
        Mail::to('test@mail.com')->send(new testMail());

        return view('test.bar');
    }
}
