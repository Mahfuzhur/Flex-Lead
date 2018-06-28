<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
class Transporter extends Model
{
    use SoftDeletes;
    protected $table = "transporter";

    protected $fillable = ['name','phone','nid','address','pic','dob','email'];
    protected $date = ['deleted_at'];
    protected $hidden = [
        'remember_token','password','authentication_token','nid'
    ];
    public static function getByDistance($lat, $lng, $distance)
    {
        $results = DB::select(DB::raw('SELECT id, ( 3959 * acos( cos( radians(' . $lat . ') ) * cos( radians( geoLat ) ) * cos( radians( geoLan ) - radians(' . $lng . ') ) + sin( radians(' . $lat .') ) * sin( radians(geoLat) ) ) ) AS distance FROM transporter HAVING distance < ' . $distance . ' ORDER BY distance') );

        return $results;
    }

}
