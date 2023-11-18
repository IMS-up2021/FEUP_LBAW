<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moderator extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'moderator_id';

    protected $table = 'moderator';

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'moderator_id','id');
    }


}
