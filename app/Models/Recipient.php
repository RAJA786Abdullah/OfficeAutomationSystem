<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Recipient extends Model implements Auditable
{
    use HasFactory,SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $guarded = [];

    public function user(){
        return $this->belongsTo('App\Models\User', 'userID', 'userID');
    }

    public function document(){
        return $this->belongsTo('App\Models\Document', 'document_id', 'id');
    }
}
