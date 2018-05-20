<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transporter extends Model
{
    use SoftDeletes;
    protected $table = "transporter";
    protected $hidden = [
        'remember_token','password'
    ];
    protected $fillable = ['name','phone','nid','address','pic','dob','email'];
    protected $date = ['deleted_at'];
}
