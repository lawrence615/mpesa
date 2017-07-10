<?php

namespace Mobidev\Mpesa;


use App\Http\Requests;
use Mobidev\Mpesa\Services\OnlineCheckout;

/**
 * PROCESS FLOW
 * Initiating C2B(paybill via web) by submitting authentication details, transaction details, callback url and callback method
 *
 * After request submission, we receive feedback with validity status of the request
 *
 * The C2B API handles customer validation and authentication via USSD push. The customer then confirms the transaction
 *
 *
 *
 *
 *
 * MORE INFO
 * CheckOutHeader carries authentication and validation parameters
 * processCheckOutRequest carries the transaction parameters
 *
 * SAG should allocate the MERCHANT_ID AKA Paybill No.
 * SAG allocates the passkey which should be used to generate the PASSWORD using the formula base64_encode(hash("sha256", $MERCHANT_ID . $passkey . $TIMESTAMP));
 */
class MpesaFacadeAccessor
{


    /**
     * Mpesa Online Checkout API provider object.
     *
     * @var
     */
    public static $provider;

    /**
     * @return mixed
     */
    public static function getProvider()
    {
        return new OnlineCheckout();
    }

}
