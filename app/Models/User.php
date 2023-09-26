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

    public function userType(){
        return $this->belongsTo('App\Models\UserType', 'userTypeID', 'userTypeID');
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
        return $this->hasMany('App\Models\Remark', 'userID', 'id');
    }

    public function Document(){
        return $this->hasMany('App\Models\Document', 'created_by', 'id');
    }

    public function isAdmin()
    {
        return $this->roles[0]->roleName === 'Admin'; // You can adjust this logic based on your user role implementation
    }
}
