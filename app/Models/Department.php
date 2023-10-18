<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Department extends Model  implements Auditable
{
    use HasFactory,SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $guarded = [];

    public function users(){
        return $this->hasMany('App\Models\User','department_id','userID');
    }

    public function documentTypes(){
        return $this->hasMany('App\Models\DocumentType','department_id','id');
    }

    public function files(){
        return $this->hasMany('App\Models\Files','department_id','id');
    }

}

