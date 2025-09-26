<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class House extends Model
{

    protected $table = 'houses';

    protected $fillable = [
        'created_by',
        'name',
        'description',
        'address',
        'start_date',
        'business_electric_bill',
        'domestic_electric_bill',
    ];
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function floor()
    {
        return $this->hasMany(Floor::class, 'house_id');
    }

    public function flat()
    {
        return $this->hasMany(Flat::class, 'house_id');
    }
    public function flat_rents()
    {
        return $this->hasMany(FlatRent::class, 'house_id');
    }

    public function electric_meter_reading()
    {
        return $this->hasMany(ElectricMeterReading::class);
    }

}
