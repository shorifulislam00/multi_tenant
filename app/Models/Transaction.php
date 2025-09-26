<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{

    protected $table = 'transactions';

    protected $fillable = [
        'transaction_date',
        'transaction_type',
        'expense_id',
        'invoice_id',
        'amount',
        'final_amount',
        'notes',
    ];
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function expense()
    {
        return $this->belongsTo(Expense::class);
    }

    public function acc_expense_categories()
    {
        return $this->hasMany(AccExpenseCategory::class, 'transaction_id', "id");
    }


    public function transaction_payment()
    {
        return $this->hasOne(TransactionPayment::class);
    }

    public function fund_transfers()
    {
        return $this->hasMany(FundTransfer::class);
    }

    public function add_fund()
    {
        return $this->hasOne(AddFund::class);
    }


    public function flatRent()
    {
        return $this->belongsTo(FlatRent::class);
    }

    public function flatRentBill()
    {
        return $this->hasMany(FlatRentBill::class);
    }


}
