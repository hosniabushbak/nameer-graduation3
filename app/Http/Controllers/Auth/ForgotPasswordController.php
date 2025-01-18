<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Mail\SendOtp;
use App\Models\HouseOwner;
use Carbon\Carbon;
use Exception;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    // use SendsPasswordResetEmails;

    public function showLinkRequestForm()
    {
        return view('auth.passwords.phone');
    }

    public function sendResetOTPCode(Request $request)
    {
        $this->validateEmail($request);

        $student = HouseOwner::where('email', $request->email)->first();

        if($student){
            // send otp to the phone number
            // $phone = $request->phone_code . $request->phone;
            // $otp = $this->sendOTP($phone);

            // send the otp to the email
            $otp = rand(1000, 9999);
            $data = [
                'title' =>  'طلب كود التفعيل',
                'otp' =>  $otp,
            ];

            Mail::to($student->email)->send(new SendOtp($data));

            $data['otp'] = $otp;
            $data['otp_expired_at'] = Carbon::now()->addMinutes(60);
            $student->update($data);
        }else{
            return back();
        }

        return redirect()->route('otp_page', ['email'=> $request->email]);
    }

    public function otpPage()
    {
        return view('auth.passwords.otp');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|numeric',
            'password' => 'required|min:6|max:25|confirmed',
            'password_confirmation' => 'required',
        ]);

        try{
            $student = HouseOwner::where('email', $request->email)->first();

            if($student->otp !== $request->otp){
                return back()->with([
                    'msg_status' => 'error',
                    'msg_content' => 'رمز ال OTP غير صحيح'
                ]);
            }

            if($student->otp_expired_at <= Carbon::now()){
                return back()->with([
                        'msg_status' => 'error',
                        'msg_content' => 'رمز ال OTP منتهي الصلاحية، حاول مجدداً'
                    ]);
            }

            $student->update([
                'password' => bcrypt($request->password),
                'status' => 1,
                'otp_expired_at' => Carbon::now(),
            ]);

            return redirect()->route('login')->with([
                    'msg_status' => 'otp_success',
                    'msg_content' => 'تم تغيير كلمة المرور بنجاح، سجل دخول بكلمة المرور الجديدة'
                ]);
        } catch (Exception $e) {
            return $this->sendError($this->exMessage($e));
        }
    }
    protected function validateEmail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            // 'phone_code' => 'required',
            // 'phone'      => 'required|digits_between:9,13|exists:students,phone|regex:/^[1-9][0-9]+$/',
        ]);
    }
}
