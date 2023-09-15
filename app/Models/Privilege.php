<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{
    use HasFactory;
    protected $primaryKey = 'privilegeID';
    protected $table = 'privilege';
    protected $fillable = [];

    public function role(){
        return $this->belongsToMany('App\Models\Role', 'rolePrivilege', 'privilegeID', 'roleID');
    }

    public function role_privilege(){
        return $this->hasMany('App\Models\RolePrivilege', 'privilegeID', 'privilegeID');
    }

    public function modules(){
        return $this->belongsTo('App\Models\Module', 'moduleID', 'moduleID');
    }

    public function accessLevel(){
        return $this->belongsTo('App\Models\AccessLevel', 'accessLevelID', 'accessLevelID');
    }
}
