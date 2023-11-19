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
        
        $questions = Question::whereHas('questionOrAnswer',function($query){
            $query->whereHas('publication',function($query){
                $query->where('user_id',Auth::id());
            });
        })->get();
        
        return view('pages.home', [
            'questions' => $questions,  
        ]);
    }
}
