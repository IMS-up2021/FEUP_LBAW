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
    Route::post('/',[QuestionController::class, 'createQuestion'])->name('createQuestion');
    Route::get('/',[QuestionController::class, 'showCreateForm']);
    Route::post('/{id}', [QuestionController::class, 'createAnswer'])->name('createAnswer');
    Route::get('/{id}',[QuestionController::class, 'show']);
    Route::delete('/{id}', [QuestionController::class, 'deleteQuestion'])->name('deleteQuestion');
    Route::get('/{id}/edit', [QuestionController::class, 'showEditForm'])->name('showEditForm');
    Route::put('/{id}/edit', [QuestionController::class, 'updateQuestion'])->name('updateQuestion');
});

//User
Route::group(['middleware' => 'auth','prefix' => 'user'], function () {
    Route::get('/{id}',[UserController::class, 'show']);
});

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
