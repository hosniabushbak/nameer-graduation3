<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // protected function guard()
    // {
    //     return Auth::guard('student');
    // }

    protected function credentials(Request $request)
    {
        return $request->only('phone_code','phone', 'password'); // , 'mac_id'
    }

    protected function validateLogin(Request $request)
    {
        return $request->validate([
            'phone_code' => 'required',
            'phone' => 'required',
            'password' => 'required',
            'mac_id' => 'required',
        ]);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        // return $this->response_api(false, __('auth.admin.failed'),200);
        return redirect()->back()->withErrors([ __('auth.admin.failed')]);
    }

    public function username()
    {
        return ['phone_code', 'phone'];
    }

    protected function attemptLogin(Request $request)
    {

        return Auth::guard('student')->attempt(
            $this->credentials($request), $request->boolean('remember')
        );
    }
    // public function logout()
    // {
    //     $this->guard()->logout();
    //     return redirect()->route('home');
    // }
}
