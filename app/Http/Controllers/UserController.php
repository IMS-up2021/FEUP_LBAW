<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Answer;
use App\Models\Appeal;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show($id){
        $user = User::findOrFail($id);
        $questions = Question::whereHas('questionOrAnswer', function ($query) use ($id) {
            $query->whereHas('publication', function ($query) use ($id) {
                $query->where('user_id', $id);
            });
        })->get();
        $answers = Answer::whereHas('questionOrAnswer', function ($query) use ($id) {
            $query->whereHas('publication', function ($query) use ($id) {
                $query->where('user_id', $id);
            });
        })->get();
        return view('pages.user', ['user' => $user, 'questions' => $questions, 'answers' => $answers]);
    }

    public function editProfileForm($id) {

        $user = User::find($id);
        return view('pages.editProfileForm', ['user' => $user]);
    }

    public function editProfile(Request $request, $id) {

        $validatedData = $request->validate([
            'username' => 'required|max:255',
            'email' => 'required|email|max:250',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:1,2,3',
            'description' => 'required|max:255',
        ]);

        $user = User::find($id);

        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($validatedData['password']);
        $user->description = $request->description;
        $user->save();
    }

    public function showAppeal(){
        $this->authorize('showAppeal', User::class);
        return view('pages.appeal');
    }

    public function createAppeal(Request $request){

        $request->validate([
            'description' => 'required|max:255',
        ]);

        $user = User::findOrFail(auth()->user()->id);

        $appeal = Appeal::create([
            'user_id' => $user->id,
            'description' => $request->description,
        ]);

        if($appeal) {
            return redirect('/appeal?error=0');
        }
        else{ 
            return redirect('/appeal?error=1');
        }
    }

    public function showForgetPassword(){
        return view('pages.forgetPassword');
    }
}
