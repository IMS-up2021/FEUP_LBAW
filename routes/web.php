<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Home
Route::redirect('/', '/login');


Route::get('/home', [HomeController::class, 'show'])->name('home');
Route::get('/home/search', [HomeController::class, 'search'])->name('search');

// Question
Route::group(['middleware' => 'auth','prefix' => 'question'], function () {

    //Create Question
    Route::post('/',[QuestionController::class, 'createQuestion'])->name('createQuestion');
    Route::get('/',[QuestionController::class, 'showCreateForm']);
   
    //Answer
    Route::get('/{id}/answer',[QuestionController::class, 'show']);
    Route::post('/{id}/answer', [QuestionController::class, 'createAnswer'])->name('createAnswer');
    Route::delete('/{id}/answer/', [QuestionController::class, 'deleteAnswer'])->name('deleteAnswer');

    //Edit Answer
    Route::get('/{id}/answer/{answer_id}/edit', [QuestionController::class, 'showEditAnswerForm'])->name('showEditAnswerForm');
    Route::put('/{id}/answer/{answer_id}/edit', [QuestionController::class, 'updateAnswer'])->name('updateAnswer');

    //Show Question
    Route::get('/{id}',[QuestionController::class, 'show']);

    //Delete Question
    Route::delete('/{id}', [QuestionController::class, 'deleteQuestion'])->name('deleteQuestion');
   
    //Edit Question
    Route::get('/{id}/edit', [QuestionController::class, 'showEditForm'])->name('showEditForm');
    Route::put('/{id}/edit', [QuestionController::class, 'updateQuestion'])->name('updateQuestion');
});

//User
Route::group(['middleware' => 'auth','prefix' => 'user'], function () {
    Route::get('/{id}',[UserController::class, 'show']);
});
Route::get('/{id}', [UserController::class, 'showProfile']);

// Authentication
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'authenticate');
    Route::get('/logout', 'logout')->name('logout');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'showRegistrationForm')->name('register');
    Route::post('/register', 'register');
});
