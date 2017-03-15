<?php

namespace Mobidev\Mpesa\models;

use Illuminate\Database\Eloquent\Model;

class MpesaBalance extends Model
{
    protected $table = 'mpesa_balance';

    protected $fillable = ['mpesa_balance', 'last_updated'];
}
