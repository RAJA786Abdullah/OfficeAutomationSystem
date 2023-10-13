<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classification extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

    public function document(){
        return $this->hasOne('App\Models\Document','classification_id','id');
    }
}
