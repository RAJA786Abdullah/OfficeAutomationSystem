<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;
    protected $table = 'userRole';
    protected $primaryKey = ['userID','roleID'];
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = ['userID','roleID'];

    public function role(){
        return $this->belongsTo('App\Models\Role', 'roleID', 'roleID');
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'userID', 'userID');
    }
}
