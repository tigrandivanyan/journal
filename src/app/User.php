<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use \Carbon\Carbon;


class User extends Authenticatable
{
    use SoftDeletes, Notifiable, HasRolesAndAbilities;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


    protected $fillable = ['username', 'password', 'password_confirmation', 'change_password'];
    protected $with = ['abilities', 'roles', 'operator'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function getDeletedAtAttribute($value)
    {
        return (boolval($value) ? $value : false);
    }



    public function entry()
    {
        return $this->hasMany(Entrie::class, 'user_id');
    }

    public function operator()
    {
        return $this->hasOne(Operator::class);
    }

    public function role()
    {
        return $this->hasOne(AssignedRole::class, 'entity_id');
    }

    public function ballTechnician()
    {
        return $this->hasOne(BallTechnician::class);
    }

    public function chef()
    {
        return $this->hasOne(Chef::class, 'user_id');
    }
    private function _pickRole()
    {
        if ($this->isA('chef')) {
            return $this->chef;
        }
        if ($this->isAn('operator')) {
            return $this->operator;
        }
    }
    public function getNameRuAttribute()
    {
        $nameEntity = $this->_pickRole();
        if ($nameEntity) {
            return $nameEntity->name_ru;
        }
        return $this->name;
    }
    public function getNameLvAttribute()
    {
        $nameEntity = $this->_pickRole();
        if ($nameEntity) {
            return $nameEntity->name_lv;
        }
        return $this->name;
    }
    public function getStudioIdAttribute()
    {
        foreach ($this->abilities as $ability) {
            if ($ability->name == 'edit-studio' &&
                $ability->entity_type &&
                $ability->entity_type === Studio::class
            ) {
                return $ability->entity_id;
            }
        }
    }


    public function getStudioAttribute()
    {
        return Studio::find($this->getStudioIdAttribute());
    }


    public static function getUsersByRole($role)
    {
        $role = \Bouncer::role()->where(['name' => $role])->first();
        return $role->users;
    }

    public function storeEntry($entryData, $mailSend = null)  //save new entry to DB and associate it with user/operator
    {
        $createdEntry = $this->entry()->create([
            'tour'=> $entryData->tour,
            'occurred_at'=> $entryData->date.' '.$entryData->time,
            'chef_id'=> $entryData->chef_id,
            'description'=>trim($entryData->description),
            'current_rng_state'=>$entryData->current_rng_state,
            'description_type_id'=>$entryData->description_type_id,
            'studio_id'=> $entryData->studio_id,
            'announcement'=> $entryData->announcement,
            'mail'=> $mailSend
        ]);

        return $createdEntry;
    }


    public function updateEntry($entryData)
    {
        $tour = (trim($entryData->tour)=='' || trim($entryData->tour)== 0) ? null : trim($entryData->tour);

        $entryToUpdate = Entrie::findOrFail($entryData->entry_id);

        $announcement = null;
        $announcement_deleted = null;
        $announcement_del = null;
//:todo this one will not work I suppose, we have changet announcement_deleted to announcement_del  so we need to deal with it now
        if ($entryData->announcement == 1) {
            $announcement = 1;
        } elseif($entryData->announcement == 0 && $entryToUpdate->announcement_deleted == 0 && $entryToUpdate->announcement == 1) {
            $announcement = 0;
            $announcement_del = Carbon::now();
        } elseif($entryData->announcement == 0 && $entryToUpdate->announcement_deleted == 1 && $entryToUpdate->announcement == 1) {
            $announcement = 0;
        }


        $entryToUpdate->update([
            'tour' => $tour,
            'occurred_at'=> $entryData->date.' '.$entryData->time,
            'description' => trim($entryData->description),
            'announcement_del' => $announcement_del,
            'announcement' => $announcement
        ]);

        return true;
    }
}
