<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BillConfig extends Model
{

    protected $table = 'bill_configs';

    protected $fillable = [

        'name',

    ];
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function rentBillConfigs()
    {
        return $this->hasMany('RentBillConfig');
    }

}
