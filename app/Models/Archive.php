<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    use HasFactory;
//    use \OwenIt\Auditing\Auditable;
    public $timestamps = false;

    protected $guarded = [];

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id', 'userID');
    }

    public function document(){
        return $this->belongsTo('App\Models\Document', 'document_id', 'id');
    }
}
