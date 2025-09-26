<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RentBillConfig extends Model
{

    protected $table = 'rent_bill_configs';
    protected $fillable = [
        'bill_config_id',
        'flat_rent_id',
        'amount',
    ];
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function flatRant()
    {
        return $this->belongsTo(FlatRent::class);
    }

    public function billConfig()
    {
        return $this->belongsTo(BillConfig::class);
    }

    public function flatRentBills()
    {
        return $this->belongsTo(FlatRentBill::class);
    }

}
