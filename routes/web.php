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


    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/about', [HomeController::class, 'about'])->name('about');
    Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
    Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
    Route::post('/contact/send', [HomeController::class, 'sendContact'])->name('contact.send');
    Route::get('/form', [HomeController::class, 'form'])->name('form');
    Route::post('/storeDamages', [HomeController::class, 'storeDamages'])->name('storeDamages');
    Route::post('/storeB', [HomeController::class, 'storeB'])->name('storeB');

});


//Route::get('/nameer', [StudentController::class, 'index']);


