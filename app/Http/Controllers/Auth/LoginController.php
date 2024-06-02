<?php

namespace App\Http\Controllers\Auth;

use App\Constants\Constants;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
     * Auth guard
     *
     * @var
     */
    protected $auth;

    /**
     * lockoutTime
     *
     * @var
     */
    //protected $lockoutTime;

    /**
     * maxLoginAttempts
     *
     * @var
     */
    //protected $maxLoginAttempts;

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
    /**
     * Create a new controller instance.
     *
     * LoginController constructor.
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->auth = $auth;
    }


    public function login(Request $request)
    {
        $request->validate([
            'username_email' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
        
        // Attempt the login using both email and username
        $credentials = $request->only('username_email', 'password');
        $remember = $request->filled('remember');
        if (
            Auth::attempt(['email' => $credentials['username_email'], 'password' => $credentials['password'], 'status' => Constants::STATUS_ACTIVE, 'activation_status' => Constants::STATUS_ACTIVE], $remember)
            || Auth::attempt(['username' => $credentials['username_email'], 'password' => $credentials['password'], 'status' => Constants::STATUS_ACTIVE, 'activation_status' => Constants::STATUS_ACTIVE], $remember)
        ) {
            // Successful login
            $request->session()->regenerate();
            $this->clearLoginAttempts($request);
            // return redirect()->route('home');
           
            return redirect()->intended('/home');

        } else {
            // FAIL: If the login attempt was unsuccessful we will increment the number of attempts
            // to login and redirect the user back to the login form. Of course, when this
            // user surpasses their maximum number of attempts they will get locked out.
            $this->incrementLoginAttempts($request);

            return redirect()->back()
                ->with('message', 'Incorrect Credentials')
                ->with('status', 'danger')
                ->withInput();
        }
    }
}
