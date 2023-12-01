<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'comment_id';

    protected $table = 'comment';

    public $timestamps = false;

    protected $fillable = [
        'comment_id',
        'question_answer_id',

    ];

    public function publication()
    {
        return $this->belongsTo(Publication::class, 'comment_id','id');
    }

    public function questionOrAnswer()
    {
        return $this->belongsTo(QuestionOrAnswer::class, 'question_answer_id', 'question_answer_id');
    }


    
}
