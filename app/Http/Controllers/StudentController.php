<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function index () {
        $name = "nameer";
        $family = "Isleem";
        return view('nameer', compact('name', 'family'));
    }

}
