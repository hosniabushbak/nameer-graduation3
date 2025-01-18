<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Mail\NewStudentRegistered;
use App\Http\Mail\SendOtp;
use App\Models\Role;
use App\Models\Setting;
use App\Models\HouseOwner;
use App\Notifications\WelcomeNotification;
use App\Traits\Rule\CustomValidationRulesTrait;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers, CustomValidationRulesTrait;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $data['phone'] = $this->getPhoneNumber($data['phone']); 
        $check_phone = $this->checkPhone('students', $data['phone_code'], $data['phone']);

        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required'],
            'm_i'       => ['required', 'string'],
            'email'     => ['required',  'unique:students,email'],
            'phone'         => ['required', 'digits_between:9,15', $check_phone],
            'phone_code'    => ['required', 'numeric'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $student = HouseOwner::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'date_of_birth' => $data['date_of_birth'],
            'mac_id' => $data['m_i'],
            'phone_code' => $data['phone_code'],
            'phone' => $this->getPhoneNumber($data['phone']),
            'password' => Hash::make($data['password']),
        ]);

        $student_role = Role::where('name', 'student')->where('guard_name', 'student')->first();
        $student->assignRole([$student_role->name]);

        // send notification to the student to his email and mobile
        $student->notify(new WelcomeNotification($student));
        // send email to the admin
        $settings = new Setting();
        $admin_email = $settings->valueOf('email');
        if($admin_email){
            Mail::to($admin_email)->send(new NewStudentRegistered($student));
        }

        return $student;
    }

    protected function guard()
    {
        return Auth::guard('student');
    }

    protected function getPhoneNumber($phone)
    {
        $phone = $this->convertArNumberToEnNumber($phone);
        if (substr($phone, 0, 1) === '0') {
            $phone = substr($phone, 1);
        }
        return $phone;
    }

    function convertArNumberToEnNumber($number)
    {
        $arabic_eastern = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
        $arabic_western = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        return str_replace($arabic_eastern, $arabic_western, $number);
    }
}
