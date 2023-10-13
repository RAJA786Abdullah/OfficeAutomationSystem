<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RolePrivilege extends Model
{
    use HasFactory,SoftDeletes;
    protected $primaryKey = 'rolePrivilegeID';
    protected $table = 'rolePrivilege';
    protected $fillable = [];

    public function role(){
        return $this->belongsTo('App\Models\Role', 'roleID', 'roleID');
    }

    public function privilege(){
        return $this->belongsTo('App\Models\Privilege', 'privilegeID', 'privilegeID');
    }
}
