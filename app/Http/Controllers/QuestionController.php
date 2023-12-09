<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Answer;
use App\Models\Comment;
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
                'date' => $request->date,
                'answer_id' => $answer->answer_id
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

    public function showEditForm($id)
    {
        $tags = Tag::all();
        $question = Question::findOrFail($id);
        if (Auth::check() && $question->questionOrAnswer->publication->user_id === Auth::id()) {
            return view('pages.editQuestion', ['question' => $question, 'tags' => $tags]);
        } else {
            return redirect('/home?error=2'); 
        }
    }

    public function showEditAnswerForm($id, $answer_id)
{
    $answer = Answer::findOrFail($answer_id);
    $question = Question::findOrFail($id);
    return view('pages.editAnswer', ['answer' => $answer, 'question' => $question]);
}

    public function deleteQuestion($id)
    {
        $question = Question::find($id);

        if (!$question) {
            return redirect('/home?error=1'); 
        }

        if ($question->questionOrAnswer->publication->user_id !== Auth::id()) {
            return redirect('/home?error=2'); 
        }

        $question->delete();

        return redirect('/home?success=1');
    }

    public function updateQuestion(Request $request)
    {
        $question = Question::findOrFail($request->id);

        // Check if the authenticated user is the creator of the question
        if (Auth::check() && $question->questionOrAnswer->publication->user_id === Auth::id()) {
            // Validate the request
            $request->validate([
                'title' => 'required|max:255',
                'content' => 'required|max:1000',
                'tag_id' => 'required|exists:tag,id',

            ]);

            $question->update([
                'title' => $request->title,
            ]);

            $question->questionOrAnswer->publication->update([
                'content' => $request->content,
                'tag_id' => $request->tag_id,
            ]);

            return redirect('question/'. $question->question_id); 
        } else {
            return redirect('/home?error=2'); 
        }
    }

    public function deleteAnswer(Request $request,$id)
{
    $answer = Answer::findOrFail($request->answer_id);

    $question = Question::findOrFail($id);
    
    if (Auth::check() && $answer->questionOrAnswer->publication->user_id === Auth::id()) {
        $answer->delete();
        return redirect('question/'. $question->question_id . '?error=0'); 
    } else {
        return redirect('question/' . $question->question_id . '?error=6'); // Unauthorized access
    }
}

public function updateAnswer(Request $request, $question_id, $answer_id)
{
    $answer = Answer::findOrFail($answer_id);

    $question = Question::findOrFail($question_id);
    
    // Validate the request
    $request->validate([
        'content' => 'required|max:1000',
    ]);
    if (Auth::check() && $answer->questionOrAnswer->publication->user_id === Auth::id()) {

        $answer->questionOrAnswer->publication->update([
        'content' => $request->content,
    ]);

        return redirect('question/'. $question->question_id); 
    } else {
        return redirect('question/' . $question->question_id . '?error=6'); 
    }
}

public function markAsCorrect(Request $request, $answer_id)
{
    $answer = Answer::find($answer_id);
    $answer->is_correct = true;
    $answer->save();

    return response()->json(['success' => true]);
}


}
