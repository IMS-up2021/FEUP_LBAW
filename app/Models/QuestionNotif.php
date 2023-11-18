<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionNotif extends Model
{CREATE TABLE question_notif(
    notification_id INTEGER PRIMARY KEY,
    FOREIGN KEY (notification_id) REFERENCES notification(id) ON DELETE CASCADE,
    question_id INTEGER NOT NULL REFERENCES Question(question_id) ON DELETE CASCADE
);
    use HasFactory;

    protected $primaryKey = 'notification_id';

    protected $table = 'question_notif';

    public $timestamps = false;

    protected $fillable = [
        'question_id'
    ];

    public function notification()
    {
        return $this->belongsTo(Notification::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

}

