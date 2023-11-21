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
