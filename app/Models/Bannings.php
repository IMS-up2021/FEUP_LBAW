<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bannings extends Model
{
    use HasFactory;

    protected $table = 'bannings';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'admin_id',
        'date'
    ];

    public function user()
    {
        return User::find($this->user_id);
    }

    public function admin()
    {
        return Admin::find($this->admin_id);
    }

}
