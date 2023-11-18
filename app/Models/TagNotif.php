<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagNotif extends Model
{CREATE TABLE tag_notif(
    notification_id INTEGER PRIMARY KEY,
    FOREIGN KEY (notification_id) REFERENCES notification(id) ON DELETE CASCADE,
    tag_id INTEGER NOT NULL REFERENCES tag(id) ON DELETE CASCADE
);  
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
