<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;
    protected $primaryKey = 'userTypeID';
    protected $table = 'userType';
    protected $fillable = [];

    public function user(){
        return $this->hasMany('App\Models\User','userTypeID', 'userTypeID');
    }
}
