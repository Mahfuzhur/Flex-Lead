<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Delivery extends Model
{
    use SoftDeletes;
    protected $table = "delivery";
    protected $fillable = ['clientId','deliveryTransporterId','receiverName','receiverPhone','geoStartLatitude','geoStartLongitude','geoEndLatitude','geoEndLongitude','weight','totalPrice','payPerson','oyp','paidAmount','due'];

    protected $date=['deleted_at'];

    public function setClientIdAttribute($value){
        $this->attributes['clientId'] = ($value);
    }
    public function setDeliveryTransporterIdAttribute($value){
        $this->attributes['deliveryTransporterId'] = ($value);
    }
    public function setReceiverNameAttribute($value){
        $this->attributes['receiverName'] = ($value);
    }
    public function setReceiverPhoneAttribute($value){
        $this->attributes['receiverPhone'] = ($value);
    }
    public function setGeoGeoStartLatitudeAttribute($value){
        $this->attributes['geoStartLatitude'] = ($value);
    }
    public function setGeoStartLongitudeAttribute($value){
        $this->attributes['geoStartLongitude'] = ($value);
    }
    public function setGeoEndLatitudeAttribute($value){
        $this->attributes['geoEndLatitude'] = ($value);
    }
    public function setGeoEndLongitudeAttribute($value){
        $this->attributes['geoEndLongitude'] = ($value);
    }
    public function setWeightAttribute($value){
        $this->attributes['weight'] = ($value);
    }
    public function setTotalPriceAttribute($value){
        $this->attributes['totalPrice'] = ($value);
    }
    public function setPayPersonAttribute($value){
        $this->attributes['payPerson'] = ($value);
    }
    public function setOtpAttribute($value){
        $this->attributes['otp'] = ($value);
    }
    public function setPaidAmountAttribute($value){
        $this->attributes['paidAmount'] = ($value);
    }
    public function setDueAttribute($value){
        $this->attributes['due'] = ($value);
    }
}
