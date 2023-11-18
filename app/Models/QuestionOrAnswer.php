<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionOrAnswer extends Model
{
    use HasFactory;

    protected $primaryKey = 'questionOrAnswer_id';

    protected $table = 'question_or_answer';

    public $timestamps = false;

    protected $fillable = [
        'score'
    ];

    public function publication()
    {
        return $this->belongsTo(Publication::class);
    }

}
