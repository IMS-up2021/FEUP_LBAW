<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionOrAnswer extends Model
{
    use HasFactory;

    protected $primaryKey = 'question_answer_id';

    protected $table = 'question_or_answer';

    public $timestamps = false;

    protected $fillable = [
        'question_answer_id',
        'score'
    ];

    public function publication()
    {
        return $this->belongsTo(Publication::class,'question_answer_id','id');
    }

}
