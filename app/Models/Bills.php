<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bills extends Model
{
    use HasFactory;
    protected $table = 'bills';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_order_id',
        'recipient_name',
        'city_id',
        'district_id',
        'number_phone',
        'price',
        'address_detail',
        'deleted',
        'created_at',
        'updated_at'
    ];

    public function userOrder()
    {
        return $this->belongsTo('App\Models\User', 'user_order_id');
    }

    public function detailBill(){
        return $this->hasMany('App\Models\BillDetail');
    }

    public function cityBill(){
        return $this->belongsTo('App\Models\City', 'city_id');
    }

    public function districtBill(){
        return $this->belongsTo('App\Models\District', 'city_id');
    }
}
