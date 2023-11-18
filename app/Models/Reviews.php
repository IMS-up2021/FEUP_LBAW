<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory;

    protected $table = 'reviews';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'questionAnswer_id',
        'positive',
        'date'
    ];

    public function user()
    {
        return User::find($this->user_id);
    }

    public function questionAnswer()
    {
        return QuestionAnswer::find($this->questionAnswer_id);
    }


}
