<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Publication;
use Illuminate\Http\Request;
use App\Models\QuestionOrAnswer;
use Illuminate\Support\Facades\Auth;
use App\Models\Tag;


class QuestionController extends Controller
{
    public function createQuestion(Request $request)
    {
        //Validate the request
        $request->validate([
            'title' => 'required|max:255',
            'tag_id' => 'required|exists:tag,id',
            'content' => 'required|max:1000',
            'date' => 'required|date'
        ]);

        $publication = Publication::create([
            'user_id' => Auth::id(),
            'tag_id' =>  $request->tag_id, 
            'content' => $request->content,
            'date' => date('Y-m-d H:i:s')
        ]);
        $questionOrAnswer = QuestionOrAnswer::create([
            'question_answer_id' => $publication->id,
        ]);


        //Create the question
        $question = Question::create([
            'question_id' => $questionOrAnswer->question_answer_id,
            'title' => $request->title
        ]);
        //Return the question
        if($question) {
            return redirect('/home?error=0');
        }
        else{ 
            return redirect('/home?error=1');
        }
    }

    public function showCreateForm()
    {
        $tags = Tag::all();
        return view('pages.createQuestion', [
            'tags' =>  $tags
        ]);
    }

    public function show(Question $question){
        $questionOrAnswer = $question->questionOrAnswer;
        $publication = $questionOrAnswer->publication;
        $questionOrAnswer->publication = $publication;
        $question->questionOrAnswer = $questionOrAnswer;
        return view('pages.question', [
            'question' => $question
        ]);
    }
}
