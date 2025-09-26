<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectricMeterReading extends Model
{
    use HasFactory;

    protected $table = 'electric_meter_readings';

    protected $fillable = [

        'house_id',
        'flat_id',
        'year_id',
        'month_id',
        'previous_meter_reading',
        'present_meter_reading',
        'rate',
        'amount',

    ];
    public function houses()
    {
        return $this->belongsTo(House::class);
    }
    public function flat_rents()
    {
        return $this->belongsTo(FlatRent::class);
    }
}
