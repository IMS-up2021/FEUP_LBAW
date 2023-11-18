<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $primaryKey = 'answer_id';

    protected $table = 'answer';

    public $timestamps = false;

    CREATE TABLE answer(
        answer_id INTEGER PRIMARY KEY,
        FOREIGN KEY (answer_id) REFERENCES question_or_answer(questionAnswer_id) ON DELETE CASCADE,
        question_id INTEGER NOT NULL REFERENCES Question(question_id) ON DELETE CASCADE
    );

    protected $fillable = [
        'question_id'
    ];

    public function questionOrAnswer()
    {
        return $this->belongsTo(QuestionOrAnswer::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function answerNotifications()
    {
        return $this->hasMany(AnswerNotification::class);
    }


}
