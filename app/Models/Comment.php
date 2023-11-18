<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    CREATE TABLE comment(
        comment_id INTEGER PRIMARY KEY,
        FOREIGN KEY (comment_id) REFERENCES publication(id) ON DELETE CASCADE,
        questionAnswer_id INTEGER NOT NULL REFERENCES question_or_answer(questionAnswer_id) ON DELETE CASCADE
    );
    
    protected $primaryKey = 'comment_id';

    protected $table = 'comment';

    public $timestamps = false;

    protected $fillable = [
        'questionAnswer_id'
    ];

    public function publication()
    {
        return $this->belongsTo(Publication::class);
    }

    public function questionOrAnswer()
    {
        return $this->belongsTo(QuestionOrAnswer::class);
    }


    
}
