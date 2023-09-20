<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function file(){
        return $this->belongsTo('App\Models\Files','file_id','id');
    }

    public function attachments(){
        return $this->hasMany('App\Models\Attachment','document_id','id');
    }

    public function recipients(){
        return $this->hasMany('App\Models\Recipient','document_id','id');
    }

    public function classification(){
        return $this->belongsTo('App\Models\Classification','classification_id','id');
    }
}
