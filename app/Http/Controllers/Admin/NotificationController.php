<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Rules\NotificationExist;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
public function index(){
    return Notification::all();


}

    public function store(){
        request()->validate([
            'type' => ['required','in:email,tel',new NotificationExist],
            'data' => ['required'],
        ]);
        $type = request('type');
        $data = request('data');

        $notification = new Notification;

        $notification->type = $type;
        $notification->data = $data;

        $notification->save();

        return $notification;


    }
}
