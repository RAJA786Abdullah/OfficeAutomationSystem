<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function users(){
        return $this->hasMany('App\Models\User','department_id','userID');
    }

    public function documentTypes(){
        return $this->hasMany('App\Models\DocumentType','department_id','id');
    }

}

