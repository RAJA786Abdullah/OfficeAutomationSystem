<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccessLevel extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'accessLevel';
    protected $primaryKey = 'accessLevelID';
    protected $fillable = [];

    public function privilege(){
        return $this->hasMany('App\Models\Privilege', 'accessLevelID', 'accessLevelID');
    }

    public function modules(){
        return $this->belongsToMany('App\Models\Module', 'privilege', 'accessLevelID', 'moduleID');
    }
}
