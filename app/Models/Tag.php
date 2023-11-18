<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $primaryKey = 'tag_id';

    protected $table = 'tag';

    public $timestamps = false;

    protected $fillable = [
        'tagName'
    ];

    public function publications()
    {
        return $this->hasMany(Publication::class);
    }

    public function tagNotifications()
    {
        return $this->hasMany(TagNotification::class);
    }
    // Maybe need the subscription
}
