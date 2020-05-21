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

Auth::routes();

//  IF USER IS NOT LOGIN!
Route::middleware(['preventbackbutton','guest'])->group(function() {

    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/applicants', 'ApplicantController@create');
    Route::post('/applicants', 'ApplicantController@store');

});

// IF USER IS LOGIN!
Route::middleware(['preventbackbutton','auth'])->group(function(){

    // HOME
    Route::get('/home', 'HomeController@index')->name('home')->middleware(CheckChangePass::class);

    // FOR LOGOUT
    Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');


    // CHANGE PASSWORD
    Route::get('/change_password', 'ChangePasswordController@viewChangePass')->name('password');
    Route::post('/change_password', 'ChangePasswordController@changePassword');

    Route::resource('/ranks', 'RankController');
    Route::get('/api/ranks', 'RankController@pagination');
    Route::get('/api/ranks/{rank}', 'RankController@edit');
});
