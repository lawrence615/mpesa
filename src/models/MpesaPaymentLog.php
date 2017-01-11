<?php

namespace Mobidev\Mpesa\models;

use Illuminate\Database\Eloquent\Model;

class MpesaPaymentLog extends Model
{
    protected $table = 'mpesa_payment_logs';

    protected $fillable = ['content', 'type'];
}
