<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Remark extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

    public function user(){
        return $this->belongsTo('App\Models\User', 'userID', 'userID');
    }

    public function toUser(){
        return $this->belongsTo('App\Models\User', 'toUserID', 'userID');
    }

    public function document(){
        return $this->belongsTo('App\Models\Document', 'document_id', 'id');
    }
}
