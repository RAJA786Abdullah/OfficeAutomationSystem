<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $primaryKey = 'userID';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'email',
        'password',
        'statusID',
        'userTypeID'
        ];

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

    public function userType(){
        return $this->belongsTo('App\Models\UserType', 'userTypeID', 'userTypeID');
    }
}
