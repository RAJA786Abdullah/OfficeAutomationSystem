<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Document extends Model implements Auditable
{
    use HasFactory,SoftDeletes;
    use \OwenIt\Auditing\Auditable;

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

    public function remarks(){
        return $this->hasMany('App\Models\Remark','document_id','id');
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

    public function scopeDashboardDocumentTitle($query,$id)
    {
        try {
            $query = $query->where('id',$id)->with('documentType','file','department')->first();
            $subject = $query->subject;
            $departmentNumber = $query->documentType->code;
            $fileNumber = $query->file->code;
            $ionNumber = $query->document_unique_identifier;
            $departmentName = $query->department->name;
            $createdAt = date('d M Y', strtotime($query->created_at));
            $docTitle = "$departmentNumber/$fileNumber/$ionNumber/$departmentName dated $createdAt";
            return ['subject'=>$subject, 'docTitle'=>$docTitle];
        }catch (\Exception $e)
        {
            dd($e);
        }
    }
    public static function getContentType($fileExtension) {
        $contentTypeMap = [
            // for images
            'jpg' => 'image/jpeg','image/jpg',
            'png' => 'image/png',
            'bmp' => 'image/bmp',
            'tiff' => 'image/tif',

            // for docs
            'pdf' => 'application/pdf',
            'word' => 'application/doc','application/docx',
            'xlsx' => 'application/xls','application/xlsx',
            'powerpoint' => 'application/ppt','application/pptx',
            'spreadsheet' => 'application/csv',

        ];

        // Use the default content type 'application/octet-stream' for unknown extensions
        return $contentTypeMap[$fileExtension] ?? 'application/octet-stream';
    }

}
