<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountLedger extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ["type","action_date",'account_id', "expense_id", "account_id", "reff_id", "comment", "dr","cr"];

}
