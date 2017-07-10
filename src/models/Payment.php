<?php

namespace Mobidev\Mpesa\models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';

    protected $fillable = [
        'phone_no',
        'sender_first_name',
        'sender_middle_name',
        'sender_last_name',
        'transaction_id',
        'amount',
        'status',
        'business_number',
        'acc_no',
        'transaction_type',
        'transaction_time',
        'latest_org_balance',
        'is_matched'
    ];


    /**
     * @param $transaction_time
     */
    public function setTransactionTimeAttribute($transaction_time)
    {
        $this->attributes['transaction_time'] = Carbon::parse($transaction_time)->toDateTimeString();
    }
}
