<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\FlatRent;
use App\Models\House;
use App\Models\Flat;
class Floor extends Model
{

    protected $table = 'floors';
    protected $fillable = [
        'created_by',
        'house_id',
        'name',
    ];

    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function house()
    {
        return $this->belongsTo(House::class);
    }

    public function flats()
    {
        return $this->hasMany(Flat::class);
    }

    public function flat_rents()
    {
        return $this->hasMany(FlatRent::class);
    }


}
