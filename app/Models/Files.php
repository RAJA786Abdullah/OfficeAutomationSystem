<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function documents(){
        return $this->hasMany('App\Models\Document','file_id','id');
    }

    public function department(){
        return $this->belongsTo('App\Models\Department','department_id','id');
    }
}
