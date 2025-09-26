<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class FlatRentDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'rent_bill_config_id',
        'bill_id',
        'amount'

    ];

}
