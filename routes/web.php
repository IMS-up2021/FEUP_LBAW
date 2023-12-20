<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
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

// About
Route::get('/about', [HomeController::class, 'showAbout'])->name('showAbout');

// FAQ
Route::get('/faq', [HomeController::class, 'showFAQ'])->name('showFAQ');

Route::get('/home', [HomeController::class, 'show'])->name('home');
Route::get('/home/search', [HomeController::class, 'search'])->name('search');

// Appeal for unblock
Route::group(['middleware' => 'auth', 'prefix' => 'appeal'], function () {
    Route::get('/',[UserController::class, 'showAppeal']);
    Route::post('/',[UserController::class, 'createAppeal'])->name('createAppeal');
});

// Forget password
Route::group(['prefix' => 'password'], function () {
    Route::middleware('guest')->group(function () {
        Route::get('/reset', [UserController::class, 'showForgetPassword'])->name('showForgetPassword');
        Route::post('/reset', [UserController::class, 'createForgetPassword'])->name('createForgetPassword');
        Route::get('/reset/{token}', [UserController::class, 'showResetPassword'])->name('showResetPassword');
        Route::post('/reset/{token}', [UserController::class, 'createResetPassword'])->name('createResetPassword');
    });
});


//Admin 
Route::group(['middleware' => 'auth','prefix' => 'administration'], function () {
    //Show Administration Page
    Route::get('/',[AdminController::class, 'showAdministration']);

    //Create Tag
    Route::get('/create-tag',[AdminController::class, 'showCreateTag']);
    Route::post('/create-tag',[AdminController::class, 'createTag'])->name('createTag');

    //Edit Tag
    Route::get('/edit-tag',[AdminController::class, 'showEditTag']);
    Route::get('/edit-tag/{id}',[AdminController::class, 'showEditTagForm'])->name('showEditTagForm');
    Route::put('/edit-tag/{id}',[AdminController::class, 'editTag'])->name('editTag');

    //Delete Tag
    Route::get('/delete-tag',[AdminController::class, 'showDeleteTag']);
    Route::delete('/delete-tag',[AdminController::class, 'deleteTag'])->name('deleteTag');

    //Create User
    Route::get('/create-user',[AdminController::class, 'showCreateUser']);
    Route::post('/create-user',[AdminController::class, 'createUser'])->name('createUser');

    //Edit User
    Route::get('/edit-user',[AdminController::class, 'showEditUser']);
    Route::get('/edit-user/{id}',[AdminController::class, 'showEditUserForm'])->name('showEditUserForm');
    Route::put('/edit-user/{id}',[AdminController::class, 'editUser'])->name('editUser');
    
    //Delete User
    Route::get('/delete-user',[AdminController::class, 'showDeleteUser']);
    Route::delete('/delete-user',[AdminController::class, 'deleteUser'])->name('deleteUser');

    //Search User
    Route::get('/search-user',[AdminController::class, 'showSearchUser']);
    Route::get('/search-user/search',[AdminController::class, 'searchUser'])->name('searchUser');

    //Block User
    Route::get('/block-user',[AdminController::class, 'showBlockUser']);
    Route::put('/block-user/{id}',[AdminController::class, 'blockUser'])->name('blockUser');
    
    //Show Appeals
    Route::get('/show-appeals',[AdminController::class, 'showAppeals']);
    Route::delete('/show-appeals',[AdminController::class, 'deleteAppeal'])->name('deleteAppeal');
});

// Question
Route::group(['middleware' => 'auth','prefix' => 'question'], function () {

    //Create Question
    Route::post('/',[QuestionController::class, 'createQuestion'])->name('createQuestion');
    Route::get('/',[QuestionController::class, 'showCreateForm']);

    //Create Review
    Route::post('/{id}',[QuestionController::class, 'createQuestionReview'])->name('createQuestionReview');
    Route::put('/{id}',[QuestionController::class, 'changeQuestionReview'])->name('changeQuestionReview');
    
    //Answer
    Route::get('/{id}/answer',[QuestionController::class, 'show']);
    Route::post('/{id}/answer', [QuestionController::class, 'createAnswer'])->name('createAnswer');
    Route::delete('/{id}/answer/', [QuestionController::class, 'deleteAnswer'])->name('deleteAnswer');
    Route::post('/{id}/mark-as-correct', [QuestionController::class, 'markAsCorrect'])->name('markAsCorrect');

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

    //Comments
    Route::get('/{id}/comments', [CommentController::class, 'showComments'])->name('showComments');
    Route::post('/{id}/comments', [CommentController::class, 'createQuestionComment'])->name('createQuestionComment');
    Route::delete('/{id}/comments', [CommentController::class, 'deleteQuestionComment'])->name('deleteQuestionComment');

    Route::get('/{id}/comments/{comment_id}/edit', [CommentController::class, 'showQuestionCommentForm'])->name('showQuestionCommentForm');
    Route::put('/{id}/comments/{comment_id}/edit', [CommentController::class, 'updateQuestionComment'])->name('updateQuestionComment');

    Route::get('/{id}/answer/{answer_id}/comments', [CommentController::class, 'showAnswerComments'])->name('showAnswerComments');
    Route::post('/{id}/answer/{answer_id}/comments', [CommentController::class, 'createAnswerComment'])->name('createAnswerComment');
    Route::delete('/{id}/answer/{answer_id}/comments', [CommentController::class, 'deleteAnswerComment'])->name('deleteAnswerComment');

    Route::get('/{id}/answer/{answer_id}/comments/{comment_id}/edit', [CommentController::class, 'showAnswerCommentForm'])->name('showAnswerCommentForm');
    Route::put('/{id}/answer/{answer_id}/comments/{comment_id}/edit', [CommentController::class, 'updateAnswerComment'])->name('updateAnswerComment');
});

//User
Route::group(['middleware' => 'auth','prefix' => 'user'], function () {
    Route::get('/{id}',[UserController::class, 'show']);
    Route::get('/{id}/edit', [UserController::class, 'editProfileForm'])->name('editProfileForm');
    Route::put('/{id}/edit', [UserController::class, 'editProfile'])->name('editProfile');
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
