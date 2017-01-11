<?php

namespace Mobidev\Mpesa\models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';

    protected $fillable = ['phone_no', 'client_name', 'transaction_id', 'amount', 'status', 'acc_no', 'transaction_type', 'transaction_time', 'is_matched'];


    /**
     * @param $transaction_time
     */
    public function setTransactionTimeAttribute($transaction_time)
    {
        $this->attributes['transaction_time'] = Carbon::parse($transaction_time)->toDateTimeString();
    }
}
