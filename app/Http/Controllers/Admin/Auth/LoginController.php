<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller For Admin
    |--------------------------------------------------------------------------
    */

    use AuthenticatesUsers;


    protected $redirectTo = "admin";
    public $guard_name;

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    protected function guard($email)
    {
        $admin_gaurd = Admin::where('email', $email)->first();
        if($admin_gaurd){
            $this->guard_name = 'admin';
            return Auth::guard('admin');
        }

    }

    protected function credentials(Request $request)
    {
        return $request->only('email', 'password');
    }

    protected function validateLogin(Request $request)
    {
        return Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ],
        [
            'email.required' => __('auth.admin.email_required'),
            'email.email' => __('auth.admin.email_correct'),
            'password.required' => __('auth.admin.password_required'),
            'password.min' => __('auth.admin.password_min'),
        ]);
    }


    protected function attemptLogin(Request $request)
    {
        $response = $this->guard($request->email)->attempt(
            $this->credentials($request), $request->filled('remember_token')
        );

        return $response;
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();
        $this->guard($request->email)->user();

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard($request->email)->user())) {
            return $response;
        }
        
        return redirect()->route('admin.home');
        // return $this->response_api(true, __('auth.admin.login_successfully'),200);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        // return $this->response_api(false, __('auth.admin.failed'),200);
        return redirect()->back()->withErrors([ __('auth.admin.failed')]);
    }

    public function logout()
    {
        $guards = array_keys(config('auth.guards'));
        foreach ($guards as $guard) {
          if(Auth::guard($guard)->check()){
            Auth::guard($guard)->logout();
          }
        }

        return redirect()->route('admin.login');
    }

}
