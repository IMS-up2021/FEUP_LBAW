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

    public function search(Request $request)
    {
        $search_input = $request->search;
        $search_terms = explode(' ', trim($search_input));

        $questions = Question::where(function ($query) use ($search_terms) {
            foreach ($search_terms as $term) {
                $query->orWhereRaw('LOWER(title) LIKE ?', '%' . strtolower($term) . '%');
            }
        })->get();
        
        
        return view('pages.search', ['questions' => $questions]);
    }
}
