<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// Route::get('/', function () {
//     return view('welcome');
// });
//Auth::routes();


Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
    Auth::routes();


    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::post('/storeDamages', [HomeController::class, 'storeDamages'])->name('storeDamages');
    Route::post('/storeB', [HomeController::class, 'storeB'])->name('storeB');

});


//Route::get('/nameer', [StudentController::class, 'index']);


