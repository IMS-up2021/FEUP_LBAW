<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Comment;
use App\Models\Question;
use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function showComments($id)
    {
        $question = Question::findOrFail($id);
        $questionOrAnswer_id = $question->questionOrAnswer->question_answer_id;
        $comments = Comment::where('question_answer_id', $questionOrAnswer_id)->get();
    
        return view('pages.questionComments', [
            'question' => $question,
            'comments' => $comments,
        ]);
    }

    public function showAnswerComments($id, $answer_id)
    {
        $answer = Answer::findOrFail($answer_id);
        $questionOrAnswer_id = $answer->questionOrAnswer->question_answer_id;
        $comments = Comment::where('question_answer_id', $questionOrAnswer_id)->get();
    
        return view('pages.answerComments', [
            'answer' => $answer,
            'comments' => $comments,
        ]);
    }

    public function createQuestionComment(Request $request){
        //Validate the request
        $request->validate([
            'content' => 'required|max:1000',
            'question_id' => 'required|exists:question,question_id',
        ]);

        $publication = Publication::create([
            'user_id' => Auth::id(),
            'tag_id' =>  $request->tag_id, 
            'content' => $request->content,
            'date' => $request->date,
        ]);

        $publication_id = $publication->id;
        
        $comment = Comment::create([
            'comment_id' => $publication_id,
            'question_answer_id' => $request->question_id,
        ]);

        if($comment) {
            return redirect('/question/'.$request->question_id.'/comments?error=0');
        }
        else{ 
            return redirect('/question/'.$request->question_id.'/comments?error=1');
        }

    }

    public function createAnswerComment(Request $request){
        //Validate the request
        $request->validate([
            'content' => 'required|max:1000',
            'answer_id' => 'required|exists:answer,answer_id',
        ]);

        $publication = Publication::create([
            'user_id' => Auth::id(),
            'tag_id' =>  $request->tag_id, 
            'content' => $request->content,
            'date' => $request->date,
        ]);

        $publication_id = $publication->id;
        
        $comment = Comment::create([
            'comment_id' => $publication_id,
            'question_answer_id' => $request->answer_id,
        ]);

        if($comment) {
            return redirect('/question/'.$request->question_id.'/answer/'.$request->answer_id.'/comments?error=0');
        }
        else{ 
            return redirect('/question/'.$request->question_id.'/answer/'.$request->answer_id.'/comments?error=1');
        }

    }

}
