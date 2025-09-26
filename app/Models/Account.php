<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{

    protected $table = 'accounts';

    protected $fillable = [
        'created_by',
        'name',
        'acc_number',
        'branch_name',
        'opening_balance',
        'balance',
    ];
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function transanction()
    {
        return $this->hasMany(Transaction::class);
    }
    public function add_funds()
    {
        return $this->hasMany(AddFund::class);
    }

    public function transaction_payment()
    {
        return $this->hasMany(TransactionPayment::class);
    }

}
