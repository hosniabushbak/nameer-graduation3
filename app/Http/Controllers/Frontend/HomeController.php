<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Category;
use App\Models\Course;
use App\Models\Faq;
use App\Models\GuestQuestion;
use App\Models\House;
use App\Models\Instructor;
use App\Models\Owner;
use App\Models\Review;
use App\Models\Slider;
use App\Models\HouseOwner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Twilio\Rest\Client;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['settings'] = new \App\Models\Setting();
        return view('frontend.index', $data);
    }

    public function form()
    {
        $data['settings'] = new \App\Models\Setting();
        return view('frontend.form', $data);
    }

    public function storeDamages (Request $request) {

        $validator = Validator::make($request->all(), [
            'id_number' => 'required|unique:owners,id_number',
            'phone' => 'required|unique:owners,phone',
            'email' => 'nullable|email|unique:owners,email'
        ], [
            'id_number.required' => 'رقم الهوية مطلوب',
            'id_number.unique' => 'رقم الهوية مسجل مسبقاً',
            'phone.required' => 'رقم الجوال مطلوب',
            'phone.unique' => 'رقم الجوال مسجل مسبقاً',
            'email.email' => 'البريد الإلكتروني غير صحيح',
            'email.unique' => 'البريد الإلكتروني مسجل مسبقاً'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $dataR = $request->only(['ownership_type', 'land_area', 'building_area', 'floors_count', 'rooms_count', 'damage_level', 'damage_description', 'damage_photos']);
        $dataOwner = $request->only(['name', 'id_number', 'phone', 'email', 'address']);

        $createOwner = Owner::create($dataOwner);
        $dataR['owner_id'] = $createOwner->id;
        $createHouse = $createOwner->House()->create($dataR);

        return back()->with('success', 'تم تسجيل طلبك بنجاح. سيتم التواصل معك قريباً');
    }

    public function storeB (Request $request) {


//        $validator = Validator::make($request->all(), [
//            'id_number' => 'required|unique:owners,id_number',
//            'phone' => 'required|unique:owners,phone',
//            'email' => 'nullable|email|unique:owners,email',
//            'business_name' => 'required',
//            'commercial_registration' => 'required|unique:businesses',
//            'business_type' => 'required'
//        ], [
//            'id_number.required' => 'رقم الهوية مطلوب',
//            'id_number.unique' => 'رقم الهوية مسجل مسبقاً',
//            'phone.required' => 'رقم الجوال مطلوب',
//            'phone.unique' => 'رقم الجوال مسجل مسبقاً',
//            'email.email' => 'البريد الإلكتروني غير صحيح',
//            'email.unique' => 'البريد الإلكتروني مسجل مسبقاً',
//            'business_name.required' => 'اسم المنشأة مطلوب',
//            'commercial_registration.required' => 'السجل التجاري مطلوب',
//            'commercial_registration.unique' => 'السجل التجاري مسجل مسبقاً',
//            'business_type.required' => 'نوع النشاط التجاري مطلوب'
//        ]);

//        if ($validator->fails()) {
//            return redirect()->back()
//                ->withErrors($validator)
//                ->withInput();
//        }


        $dataOwner = $request->only([
            'name',
            'id_number',
            'phone',
            'email',
            'address'
        ]);

        $createOwner = Owner::create($dataOwner);
        $dataBusiness = $request->only([
            'business_name',
            'commercial_registration',
            'pre_disaster_address',
            'business_type',
            'land_area',
            'building_area',
            'employees_count',
            'building_age',
            'damage_level',
            'equipment_losses',
            'inventory_losses',
            'damage_photos',
            'estimated_cost',
            'ownership_document',
            'licenses',
            'inspection_report'
        ]);
        $dataBusiness['owner_id'] = $createOwner->id;
        $createBusiness = $createOwner->business()->create($dataBusiness);

        if ($request->hasFile('damage_photos')) {
            foreach ($request->file('damage_photos') as $photo) {
                $createBusiness->addMedia($photo)
                    ->toMediaCollection('damage_photos');
            }
        }
dd(1);
        return back()->with('success', 'تم تسجيل طلبك بنجاح. سيتم التواصل معك قريباً');

    }

    public function about()
    {
        $data['settings'] = new \App\Models\Setting();
        return view('frontend.about', $data);
    }

    public function faq()
    {
        $data['settings'] = new \App\Models\Setting();
        $data['faqs'] = Faq::where('status', 1)->get();
        return view('frontend.faq', $data);
    }

    public function contact()
    {
        $data['settings'] = new \App\Models\Setting();
        return view('frontend.contact', $data);
    }

    public function sendContact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ], [
            'name.required' => 'الاسم مطلوب',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'البريد الإلكتروني غير صحيح',
            'subject.required' => 'الموضوع مطلوب',
            'message.required' => 'الرسالة مطلوبة'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        return redirect()->back()
            ->with('success', 'تم إرسال رسالتك بنجاح. سنقوم بالرد عليك في أقرب وقت');
    }

}
