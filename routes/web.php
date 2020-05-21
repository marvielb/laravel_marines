<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckChangePass;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//  IF USER IS NOT LOGIN!
Route::middleware(['preventbackbutton','guest'])->group(function() {

    Route::get('/applicants', 'ApplicantController@create');
    Route::post('/applicants', 'ApplicantController@store');
    
});

// IF USER IS LOGIN!
Route::middleware(['preventbackbutton','auth'])->group(function(){
    
    Route::get('/change_password', 'ChangePasswordController@ChangePass')->name('password');
    Route::get('/home', 'HomeController@index')->name('home')->middleware(CheckChangePass::class);
    Route::resource('/ranks', 'RankController');
    
});