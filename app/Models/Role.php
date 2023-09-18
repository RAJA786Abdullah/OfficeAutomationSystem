<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table = 'roles';
    protected $primaryKey = 'roleID';
    protected $guarded= [];
    public $timestamps = false;

    public function privileges(){
        return $this->belongsToMany('App\Models\Privilege', 'rolePrivilege', 'roleID', 'privilegeID');
    }

    public function userRoles(){
        return $this->hasMany('App\Models\userRole', 'roleID', 'roleID');
    }

    public function users(){
        return $this->belongsToMany('App\Models\User', 'userRole', 'roleID', 'userID');
    }

    public function role_privilege(){
        return $this->hasMany('App\Models\RolePrivilege', 'roleID', 'roleID');
    }
}
