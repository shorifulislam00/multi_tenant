<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TenantLedger extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ["action_date","flat_rent_id", "account_id", "year_id", "month_id", "dr", "cr","comment"];


    public function account_ledger()
    {
        return $this->hasOne(AccountLedger::class, "reff_id");
    }

    public function flat_rent()
    {
        return $this->belongsTo(FlatRent::class);
    }
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
