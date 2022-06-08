<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BallJournal extends Model
{
    protected $fillable= [
        'date',
        'time',
        'ball_technician_id',
        'event_type_id',
        'description',
        'studio_id',
        'ball_set_number',
        'ball_set_status',
        'ball_number',
        'ball_change_reason',
        'entry_completion_status',
        'announcement',
        'mail',
        'operator_journal_entrie_id',
        'binded_edited_entry_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'ball_technician_id');
    }

    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }

    public function type()
    {
        return $this->belongsTo(BallJournalEventType::class, 'event_type_id');
    }
    public function ballCondition()
    {
        return $this->belongsTo(BallJournalBallCondition::class, 'ball_change_reason');
    }

}
