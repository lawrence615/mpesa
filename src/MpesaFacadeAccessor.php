<?php

namespace Mobidev\Mpesa;


use App\Http\Requests;

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
     * Consists of passkey concatenated with MERCHANT_ID and TIMESTAMP
     *
     * @var string
     */
    protected $password;
    /**
     * @var int
     */
    protected $amount;

    /**
     * @var int
     */
    protected $number;

    /**
     * @var int
     */
    protected $referenceId;

    /**
     * @var string
     */
    protected $passkey;

    /**
     * @var
     */
    protected $c2b_pay_bill;

    /**
     * @var string
     */
    protected $timestamp;

    /**
     * @var array
     */
    protected $requestKeys;

    /**
     * @var string
     */
    protected $request;


    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $endpoint;


    public function __construct($config_handler = null)
    {
        // check if C2B Paybill Number is set
        if ($config_handler['c2b_pay_bill_number'] == null) {
            throw new \Exception('C2B Paybill Number should be provided');
        }

        // check if the passkey is set also
        if ($config_handler['passkey'] == null) {
            throw new \Exception('Passkey should be provided');
        }

        // assign values needed for processing
        $this->endpoint = "https://safaricom.co.ke/mpesa_online/lnmo_checkout_server.php?wsdl";
        $this->c2b_pay_bill = $config_handler['c2b_pay_bill_number'];
        $this->passkey = $config_handler['passkey'];
    }


    public function process($amount, $number, $referenceId)
    {
        // @TODO validate the data captured

        $this->amount = $amount;
        $this->number = sprintf('254%s', substr(trim($number), -9));
        $this->referenceId = $referenceId;
        $this->initialize();

        // execute the request
        $this->execute();
    }
}
