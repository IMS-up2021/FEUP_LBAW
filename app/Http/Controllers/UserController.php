<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Answer;
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
}
