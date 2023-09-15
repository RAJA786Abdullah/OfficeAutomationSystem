<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Setting extends Model
{
    use HasFactory;
	protected $table = 'setting';
    protected $primaryKey = 'settingID';
    public $timestamps = false;
    protected $fillable = ['settingID','settingTypeID','fieldTypeID','settingName','settingCode','label','tab','group','sortOrder','defaultValue'];

    public function settingType()
    {
        return $this->belongsTo('App\Models\SettingType','settingTypeID','settingTypeID');
    }

	public function fieldType()
    {
        return $this->belongsTo('App\Models\FieldType','fieldTypeID','fieldTypeID');
    }

	public function settingValues()
    {
        return $this->hasMany('App\Models\SettingValue','settingID','settingID');
    }

    public static function getSettings(){
       return DB::select("
            SELECT
                    setting.settingID,
                    setting.settingTypeID,
                    setting.fieldTypeID,
                    setting.settingName,
                    setting.settingCode,
                    setting.label,
                    setting.`group`,
                    setting.tab,
                    setting.sortOrder,
                    fieldType.fieldType,
                    fieldType.fieldTypeCode,
                    setting.dateCreated,
                    settingValue.foreignID,
                    CASE WHEN settingValue.settingValue IS NULL THEN setting.defaultValue ELSE settingValue.settingValue END AS settingValue
                FROM setting
                INNER JOIN fieldType ON setting.fieldTypeID = fieldType.fieldTypeID
                INNER JOIN settingType ON settingType.settingTypeID = setting.settingTypeID
                LEFT join settingValue ON settingValue.settingID = setting.settingID
                -- WHERE setting.group <> 'client'
                ORDER by setting.group,setting.tab,setting.sortOrder
        ");
    }
}
