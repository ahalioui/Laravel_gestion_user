<?php

namespace App\Http\Controllers\Auth;

use Exception;
use Throwable;
use Vonage\Client;
use App\Mail\testMail;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Notifications\Messages\VonageMessage;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function redirectTo()
    {
       if (Auth::user()->roles->pluck('name')->contains('admin')){
          return '/admin/users';
    } 
        

      return '/home';
        
    }

       /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            

                $destinataire = Notification::where('type' ,'email') ->get()->pluck('data');
                foreach($destinataire as $email){
                    try {
                        Mail::to($email)->send(new testMail(auth()->user()));
                    } catch (Throwable $e) {
                        report($e);
                    }
                }
            

           
         

                
                $message='xxx is connected';
                $phones = Notification::where('type' ,'phone') ->get()->pluck('data');
                foreach ($phones as $phone){
                    try{
                        $message = (new VonageMessage($message))->usingClient(resolve(Client::class))->from(config('vonage.sms_from'));
                        $payload = [
                            'type' => $message->type,
                            'from' => $message->from,
                            'to' => $phone,
                            'text' => trim($message->content),
                            'client-ref' => $message->clientReference,
                        ];

                        $message->client->message()->send($payload);
                    }catch (Throwable $e) {
                        report($e);
    
                    }
    
                }
            

            
        
           
            
            
            return $this->sendLoginResponse($request);

            // Mail::to('test@example.com')->send(new testMail(auth()->user()));
            // return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
}
