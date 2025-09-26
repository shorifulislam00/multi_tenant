<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Flat extends Model
{

    protected $table = 'flats';

    protected $fillable = [
        'created_by',
        'house_id',
        'floor_id',
        'type',
        'flat_number',
        'sqr_feet',
        'description',
        'sell_rate',
        'rent_amount',
    ];

    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function floor()
    {
        return $this->belongsTo(Floor::class);
    }

    public function house()
    {
        return $this->belongsTo(House::class);
    }

    public function flat_rents()
    {
        return $this->hasMany(FlatRent::class);
    }

}
