<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Rules\NotificationExist;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
public function index(){

    $notifications=Notification::all();
    return view ('notifications.index')->with('notifications', $notifications);


}

    public function store(Request $request)
    {
        // request()->validate([
        //     'type' => ['required','in:email,tel',new NotificationExist],
        //     'data' => ['required'],
        // ]);
        // $type = request('type');
        // $data = request('data');

        // $notification = new Notification();

        // $notification->type = $request->type;
        // $notification->data = $request->data;

        // $notification->save();

        // return redirect()->route('admin.users.index');

        // Notification::create([
        //     'type'=>$request->type,
        //     'data'=>$request->data
        // ]);

        // return redirect()->route('admin.users.index');

        $request->validate([
            'type' => ['required', 'string', 'max:255'],
            'data' => ['required', 'string',],
            
        ]);

        $notification = Notification::create([
            'type' => $request->type,
            'data' => $request->data,
            
        ]);

        return redirect()->route('admin.users.index');
    }

    public function update(Request $request, Notification $notification)
    {
        $notification->type = $request->type;
        $notification->data = $request->data;
        $notification->save();

        return redirect()->route('admin.users.index');

    }

    public function destroy(Notification $notification)
    {
        $notification->delete();

        return redirect()->route('admin.users.index');
    }

    public function edit(Notification $notification)
    {   
        
        return view('admin.notifications.edit', [
            'notification' => $notification,
        
        ]);
    }

    public function create()
    {
        return view('admin.notifications.create');
    }


}
