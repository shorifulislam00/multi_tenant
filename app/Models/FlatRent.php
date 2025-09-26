<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Flat;
use App\Models\Floor;
use App\Models\House;
class FlatRent extends Model
{

    protected $table = 'flat_rents';

    protected $fillable = [
        'created_by',
        'house_id',
        'floor_id',
        'flat_id',
        'rent_date',
        'advance_amount',
        'tenant_name',
        'meter_reading',
        'rent_amount',
        'mobile_no',
        'email',
        'address',

    ];
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function flat()
    {
        return $this->belongsTo(Flat::class);
    }
    public function floor()
    {
        return $this->belongsTo(Floor::class);
    }

    public function house()
    {
        return $this->belongsTo(House::class);
    }


    public function tenant_ledger()
    {
        return $this->hasOne(TenantLedger::class);
    }

    public function rentBillConfigs()
    {
        return $this->hasMany(RentBillConfig::class);
    }


    public function electric_meter_reading()
    {
        return $this->hasMany(ElectricMeterReading::class);
    }

}
