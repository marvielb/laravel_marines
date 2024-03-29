<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckChangePass;
use App\Http\Middleware\RedirectIfExamCodeSet;
use App\Http\Middleware\RedirectIfExamCodeNotSet;
use App\Http\Middleware\RedirectIfExamFinished;

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
Route::middleware(['preventbackbutton', 'guest'])->group(function () {

    Route::get('/', 'HomeController@welcome');

    Route::get('/applicants', 'ApplicantController@create');
    Route::post('/applicants', 'ApplicantController@store');
});

// IF USER IS LOGIN!
Route::middleware(['preventbackbutton', 'auth'])->group(function () {

    // HOME
    Route::get('/home', 'HomeController@index')->name('home')->middleware(CheckChangePass::class);

    // FOR LOGOUT
    Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');


    // CHANGE PASSWORD
    Route::get('/change_password', 'ChangePasswordController@viewChangePass')->name('password');
    Route::post('/change_password', 'ChangePasswordController@changePassword');

    Route::resource('/ranks', 'RankController');
    Route::get('/api/ranks/all', 'RankController@all');
    Route::get('/api/ranks', 'RankController@pagination');
    Route::get('/api/ranks/{rank}', 'RankController@edit');

    Route::resource('/questionclassifications', 'QuestionClassificationController');
    Route::get('/api/questionclassifications/all', 'QuestionClassificationController@all');
    Route::get('/api/questionclassifications', 'QuestionClassificationController@pagination');
    Route::get('/api/questionclassifications/{questionclassification}', 'QuestionClassificationController@edit');

    Route::resource('/questions', 'QuestionController');
    Route::get('/api/questions', 'QuestionController@pagination');
    Route::get('/api/questions/{question}', 'QuestionController@edit');
    Route::get('/api/questions/{question}/answer', 'QuestionController@correctAnswer');


    Route::get('/questions/{question}/choices', 'ChoiceController@index');
    Route::post('/questions/{questionId}/choices', 'ChoiceController@store');
    Route::patch('/questions/{questionId}/choices/{choice}', 'ChoiceController@update');
    Route::delete('/questions/{questionId}/choices/{choice}', 'ChoiceController@destroy');
    Route::get('/api/questions/{questionId}/choices', 'ChoiceController@pagination');
    Route::get('/api/questions/{questionId}/choices/{choice}', 'ChoiceController@edit');
    Route::patch('/api/questions/{question}/choices/{choice}/correct', 'ChoiceController@setAsCorrectAnswer');


    Route::resource('/questiongroups', 'QuestionGroupController');
    Route::get('/api/questiongroups', 'QuestionGroupController@pagination');
    Route::get('/api/questiongroups/{questiongroup}', 'QuestionGroupController@edit');

    Route::resource('questiongroups.ranks', 'QuestionGroupRankController');
    Route::get('/api/questiongroups/{questiongroupid}/ranks', 'QuestionGroupRankController@pagination');

    Route::resource('questiongroups.questions', 'QuestionGroupQuestionController');
    Route::get('/api/questiongroups/{questiongroupid}/questions', 'QuestionGroupQuestionController@pagination');


    Route::resource('users', 'UserController');
    Route::get('/api/users', 'UserController@pagination');
    Route::get('/api/users/{user}', 'UserController@edit');


    //Exam Code Generator
    Route::get('/codegenerator', 'ExamCodeGeneratorController@create');
    Route::post('/api/codegenerator', 'ExamCodeGeneratorController@store');

    //Exam confirmation
    Route::get('/confirm', 'ExamConfirmationController@index')->middleware(RedirectIfExamCodeSet::class);
    Route::post('/api/confirm', 'ExamConfirmationController@edit');

    //Actual Exam
    Route::get('/examsheet', 'ExamController@index')->middleware([RedirectIfExamCodeNotSet::class, RedirectIfExamFinished::class]);
    Route::post('/api/exam/details', 'ExamController@getexamdetails');
    Route::post('/api/exam/getquestion', 'ExamController@getquestion');
    Route::post('/api/exam/answerquestion', 'ExamController@answerquestion');
    Route::post('/api/exam/done', 'ExamController@doneexam');

    //Results
    Route::get('/result/{exam_code}', 'ExamResultController@index')->middleware();
    Route::post('/api/exam/results', 'ExamResultController@getexamresults');
    Route::post('/api/exam/results/back', 'ExamResultController@back');
});
