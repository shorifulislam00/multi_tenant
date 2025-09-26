<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;


    protected $fillable = [
        'flat_rent_id',
        'year_id',
        'month_id',
        'amount',
        'is_paid',

    ];

    public function flatRent()
    {
        return $this->belongsTo(FlatRent::class);
    }
}
