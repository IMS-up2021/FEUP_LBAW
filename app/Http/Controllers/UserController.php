<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Answer;
use App\Models\Appeal;
use App\Models\Question;
use Illuminate\Http\Request;

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
}
