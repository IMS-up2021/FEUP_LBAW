<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Question;

class HomeController extends Controller
{
    /**
     * Show the home page.
     */
    public function show()
    {
        if (!Auth::check()) {
            // Not logged in, redirect to login.
            return redirect('/login');
        }
        
        $questions = Question::all();
        
        $top_questions = Question::select('question.*')
        ->join('question_or_answer', 'question_or_answer.question_answer_id', '=', 'question.question_id')
        ->orderBy('question_or_answer.score', 'desc')
        ->take(3)
        ->get();
    

        return view('pages.home', [
            'questions' => $questions,  
            'top_questions' => $top_questions
        ]);
    }
}
