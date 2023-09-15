<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    use HasFactory;

    use HasFactory;
    protected $table = 'userSettings';
    protected $primaryKey = ['userID','settingID'];
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = ['userID','settingID'];

    public function setting(){
        return $this->belongsTo('App\Models\Setting', 'settingID', 'settingID');
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'userID', 'userID');
    }
}
