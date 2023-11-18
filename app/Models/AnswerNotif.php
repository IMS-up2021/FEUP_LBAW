<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerNotif extends Model
{CREATE TABLE answer_notif(
    notification_id INTEGER PRIMARY KEY,
    FOREIGN KEY (notification_id) REFERENCES notification(id) ON DELETE CASCADE,
    answer_id INTEGER NOT NULL REFERENCES answer(answer_id) ON DELETE CASCADE
);

    use HasFactory;

    protected $primaryKey = 'notification_id';

    protected $table = 'answer_notif';

    public $timestamps = false;

    protected $fillable = [
        'answer_id'
    ];

    public function notification()
    {
        return $this->belongsTo(Notification::class);
    }

    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }

}
