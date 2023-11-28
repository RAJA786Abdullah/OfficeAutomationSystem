<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocRead extends Model
{
    use HasFactory,SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $guarded = [];

    public function users(){
        return $this->hasMany('App\Models\User','department_id','userID');
    }
}
