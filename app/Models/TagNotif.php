<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagNotif extends Model
{
    use HasFactory;

    protected $primaryKey = 'notification_id';	

    protected $table = 'tag_notif';

    public $timestamps = false;

    protected $fillable = [
        'tag_id'
    ];

    public function notification()
    {
        return $this->belongsTo(Notification::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
    
    
}
