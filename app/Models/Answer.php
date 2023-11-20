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

    protected $fillable = [
        'answer_id',
        'question_id'
    ];

    public function questionOrAnswer()
    {
        return $this->belongsTo(QuestionOrAnswer::class,'answer_id', 'question_answer_id');
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
