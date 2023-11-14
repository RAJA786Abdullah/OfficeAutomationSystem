<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContracts;

class User extends Authenticatable implements AuditableContracts
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $primaryKey = 'userID';
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userRoles(){
        return $this->hasMany('App\Models\UserRole', 'userID', 'userID');
    }

    public function roles(){
        return $this->belongsToMany('App\Models\Role', 'userRole', 'userID', 'roleID');
    }

    public function userSettings(){
        return $this->hasMany('App\Models\UserSetting', 'userID', 'userID');
    }

    public function settings(){
        return $this->belongsToMany('App\Models\Setting', 'userSettings', 'userID', 'settingID');
    }

    public function branch(){
        return $this->belongsTo('App\Models\Branch', 'branch_id', 'id');
    }

    public function department(){
        return $this->belongsTo('App\Models\Department', 'department_id', 'id');
    }

    public function recipients(){
        return $this->hasMany('App\Models\Recipient','userID','id');
    }

    public function remarks(){
        return $this->hasMany('App\Models\Remark', 'userID', 'userID');
    }

    public function document(){
        return $this->hasOne('App\Models\Document', 'created_by', 'userID');
    }

    public function isAdmin()
    {
        return $this->roles[0]->roleName === 'Admin';
    }

//    public function isExecutive()
//    {
//        dd($this->roles);
//            $a = $this->roles[0]->roleName === 'Executive';
//            dd($a);
////        return
//    }

}
