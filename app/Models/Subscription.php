<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $table = 'subscription';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'tag_id',
        'date'
    ];

    public function user()
    {
        return User::find($this->user_id);
    }

    public function tag()
    {
        return Tag::find($this->tag_id);
    }

}
