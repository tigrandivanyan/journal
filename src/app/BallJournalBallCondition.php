<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BallJournalBallCondition extends Model
{

    public function ballJournal()
    {
        return $this->hasMany(BallJournal::class);
    }

}
