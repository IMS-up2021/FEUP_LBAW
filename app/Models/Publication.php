<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 'publication';

    // Disable timestamps for this model
    public $timestamps = false;

    protected $fillable = [
        'user_id', 
        'tag_id', 
        'content', 
        'date'
    ];

    // User who created the publication
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }

    // Tag of the publication
    public function tag()
    {
        return $this->belongsTo(Tag::class,'tag_id','id');
    }
}
