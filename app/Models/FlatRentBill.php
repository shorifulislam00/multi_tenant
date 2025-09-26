<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FlatRentBill extends Model 
{

    protected $table = 'flat_rent_bills';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function transanctions()
    {
        return $this->belongsTo('Transaction');
    }

    public function rentBillConfigs()
    {
        return $this->hasMany('RentBillConfig');
    }

}