<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use App\Models\House;
use App\Models\Business;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $data['propertyDistribution'] = [
            House::count(),
            Business::count()
        ];

        $data['houseDamageLevels'] = [
            House::where('damage_level', 'بسيط')->count(),
            House::where('damage_level', 'متوسط')->count(),
            House::where('damage_level', 'شديد')->count()
        ];

        $data['businessDamageLevels'] = [
            Business::where('damage_level', 'بسيط')->count(),
            Business::where('damage_level', 'متوسط')->count(),
            Business::where('damage_level', 'شديد')->count()
        ];

        $data['averages'] = [
            'houses' => [
                'avg_land' => House::avg('land_area'),
                'avg_building' => House::avg('building_area')
            ],
            'businesses' => [
                'avg_land' => Business::avg('land_area'),
                'avg_building' => Business::avg('building_area')
            ]
        ];

        return view('admin.home', $data);
    }
}