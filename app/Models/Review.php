<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'review'; 

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'question_answer_id',
        'positive',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function questionAnswer()
    {
        return $this->belongsTo(QuestionAnswer::class, 'question_answer_id');
    }
}
