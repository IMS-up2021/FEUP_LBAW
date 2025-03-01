<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\AuthorizationException;

class HomeController extends Controller
{
    public function show()
    {
        
        if (!Auth::check()) {
            // Not logged in, redirect to login.
            return redirect('/login');
        }

        if (Auth::user()->blocked) {
            return redirect('/appeal')->withErrors([
                'email' => 'Your account is blocked. Please contact support.',
            ])->onlyInput('email');
        }

        
        
        $questions = Question::all();
        
        $top_questions = Question::select('question.*')
        ->join('question_or_answer', 'question_or_answer.question_answer_id', '=', 'question.question_id')
        ->orderBy('question_or_answer.score', 'desc')
        ->take(3)
        ->get();
        
        //já não dá erro ao carregar a página
        $recentQuestions = Question::select('question.*')
        ->join('question_or_answer', 'question.question_id', '=', 'question_or_answer.question_answer_id')
        ->join('publication', 'question_or_answer.question_answer_id', '=', 'publication.id')
        ->orderBy('publication.date', 'desc')
        ->take(5)
        ->get();
    

        return view('pages.home', [
            'recentQuestions' => $recentQuestions,
            'questions' => $questions,  
            'top_questions' => $top_questions
        ]);
    }

    public function search(Request $request)
    {
        if (Auth::user()->blocked) {
            return redirect('/appeal')->withErrors([
                'email' => 'Your account is blocked. Please contact support.',
            ])->onlyInput('email');
        }
        
        $validatedData = $request->validate([
            'search' => 'required|string|max:255',
        ]);

        $search_input = $validatedData['search'];
    
        $questions = Question::where(function ($query) use ($search_input) {
            $query->whereRaw('tsvectors @@ to_tsquery(?, ?)', ['english', $search_input]);
        })->get();
    
        return view('pages.search', ['questions' => $questions]);
    }

    public function showAbout()
    {
        return view('pages.aboutUs');
    }
    public function showFAQ()
    {
        return view('pages.faq');
    }
    public function showContact()
    {
        return view('pages.contact');
    }
}