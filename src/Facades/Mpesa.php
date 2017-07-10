<?php
namespace Mobidev\Mpesa\Facades;

use Illuminate\Support\Facades\Facade;


class Mpesa extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Mobidev\Mpesa\MpesaFacadeAccessor';
    }

}