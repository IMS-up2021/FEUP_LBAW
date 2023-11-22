<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Publication;
use Illuminate\Http\Request;
use App\Models\QuestionOrAnswer;
use Illuminate\Support\Facades\Auth;


class QuestionController extends Controller
{
    public function createQuestion(Request $request)
    {
        //Validate the request
        $request->validate([
            'title' => 'required|max:255',
            'tag_id' => 'required|exists:tag,id',
            'content' => 'required|max:1000',
        ]);

        $publication = Publication::create([
            'user_id' => Auth::id(),
            'tag_id' =>  $request->tag_id, 
            'content' => $request->content,
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

    public function createAnswer(Request $request){
        //Validate the request
        $request->validate([
            'content' => 'required|max:1000',
            'tag_id' => 'required|exists:tag,id',
            'question_id' => 'required|exists:question,question_id',
        ]);

        $publication = Publication::create([
            'user_id' => Auth::id(),
            'tag_id' =>  $request->tag_id, 
            'content' => $request->content,
            'date' => $request->date,
        ]);
        $questionOrAnswer = QuestionOrAnswer::create([
            'question_answer_id' => $publication->id,
        ]);

        //Create the question
        $answer = Answer::create([
            'answer_id' => $questionOrAnswer->question_answer_id,
            'question_id' => $request->question_id,
        ]);

        //Return the question
        if ($answer) {
            return response()->json([
                'content' => $request->content,
                'user' => Auth::user(), 
                'date' => $request->date
            ]);
        } else {
            return response()->json(['error' => 'Failed to create answer'], JsonResponse::HTTP_BAD_REQUEST);
        }

    }


    public function showCreateForm()
    {
        $tags = Tag::all();
        return view('pages.createQuestion', [
            'tags' =>  $tags
        ]);
    }

    public function show($id){
        $question = Question::findOrFail($id);
        $answers = Answer::where('question_id', $id)->get();
        return view('pages.question', [
            'question' => $question,
            'answers' => $answers,
        ]);
    }
}
