<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function classification(){
        return $this->belongsTo('App\Models\Classification','classification_id','id');
    }

    public function department(){
        return $this->belongsTo('App\Models\Department','department_id','id');
    }

    public function documentType(){
        return $this->belongsTo('App\Models\DocumentType','document_type_id','id');
    }

    public function file(){
        return $this->belongsTo('App\Models\Files','file_id','id');
    }

    public function reference(){
        return $this->belongsTo('App\Models\Document','reference_id','id');
    }

    public function attachments(){
        return $this->hasMany('App\Models\Attachment','document_id','id');
    }

    public function recipients(){
        return $this->hasMany('App\Models\Recipient','document_id','id');
    }

    public function user(){
        return $this->belongsTo('App\Models\User','created_by','userID');
    }


    public function scopeDocumentTitle($query,$id)
    {
        try {
            $query = $query->where('id',$id)->with('documentType','file','department')->first();
            $departmentNumber = $query->documentType->code;
            $fileNumber = $query->file->code;
            $ionNumber = $query->document_unique_identifier;
            $departmentName = $query->department->name;
            $createdAt = date('d M Y', strtotime($query->created_at));
            return "$departmentNumber/$fileNumber/$ionNumber/$departmentName dated $createdAt";
        }catch (\Exception $e)
        {
            dd($e);
        }
    }
}
