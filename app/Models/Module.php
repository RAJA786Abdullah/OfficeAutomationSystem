<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model
{
    use HasFactory,SoftDeletes;
    protected $primaryKey = 'moduleID';
    protected $table = 'modules';
    protected $fillable = [];

    public function privilege(){
        return $this->hasMany('App\Models\Privilege', 'moduleId', 'moduleId');
    }

    public function accessLevel(){
        return $this->belongsToMany('App\Models\AccessLevel', 'privilege', 'moduleID', 'accessLevelID');
    }
}
