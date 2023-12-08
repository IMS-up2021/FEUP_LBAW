<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $primaryKey = 'question_id'; 

    protected $table = 'question';
    
    public $timestamps = false;
    
    protected $fillable = [
        'question_id',
        'title',
        'status',
    ];
 
    public function questionOrAnswer()
    {
        return $this->belongsTo(QuestionOrAnswer::class, 'question_id', 'question_answer_id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

}
