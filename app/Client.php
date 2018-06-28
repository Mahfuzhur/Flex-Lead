<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Client extends Model
{
    use SoftDeletes;
    protected $table = "client";
    protected $hidden = [
        'remember_token','password'
    ];
    protected $fillable = ['name','phone','nid','address'];
    protected $date = ['deleted_at'];

    public function setNameAttribute($value){
        $this->attributes['name'] = ($value);
    }
    public function setPhoneAttribute($value){
        $this->attributes['phone'] = ($value);
    }
    public function setNidAttribute($value){
        $this->attributes['nid'] = ($value);
    }public function setAddressAttribute($value){
    $this->attributes['address'] = ($value);
}
}
