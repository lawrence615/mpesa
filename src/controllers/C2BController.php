<?php

namespace Mobidev\Mpesa\controllers;

//use App\Http\Controllers\Controller;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Events\Dispatcher;
use Illuminate\Http\Request;
use Mobidev\Mpesa\models\MpesaPaymentLog;
use Mobidev\Mpesa\models\Payment;


class C2BController extends BaseController
{

    protected $dispatcher;


    /**
     * C2BController constructor.
     * @param Dispatcher $dispatcher
     */
    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function receiver(Request $request)
    {

        // Receive the Soap IPN from Safaricom
        $input = $request->getContent(); //getting the file input

        // check if $input is empty
        if (empty($input)) {
            return;
        }

        // package the data in an array with the type value for logging in mpesa_payment_logs_table table
        $data = ['content' => $input, 'type' => 'c2b'];

        // save
        MpesaPaymentLog::create($data);

        // initialize the DOMDocument  and create an object that we use to call loadXML and parse the XML
        $xml = new \DOMDocument();
        $xml->loadXML($input);// for c2b


        $data['phone_no'] = "+254" . substr(trim($xml->getElementsByTagName('MSISDN')->item(0)->nodeValue), -9);
        if ($xml->getElementsByTagName('KYCInfo')->length == 2) {
            $data['sender_first_name'] = $xml->getElementsByTagName('KYCValue')->item(0)->nodeValue;
            $data['sender_last_name'] = $xml->getElementsByTagName('KYCValue')->item(1)->nodeValue;
        } elseif ($xml->getElementsByTagName('KYCInfo')->length == 3) {
            $data['sender_first_name'] = $xml->getElementsByTagName('KYCValue')->item(0)->nodeValue;
            $data['sender_middle_name'] = $xml->getElementsByTagName('KYCValue')->item(1)->nodeValue;
            $data['sender_last_name'] = $xml->getElementsByTagName('KYCValue')->item(2)->nodeValue;
        }
        $data['transaction_id'] = $xml->getElementsByTagName('TransID')->item(0)->nodeValue;
        $data['amount'] = $xml->getElementsByTagName('TransAmount')->item(0)->nodeValue;
        $data['business_number'] = $xml->getElementsByTagName('BusinessShortCode')->item(0)->nodeValue;
        $data['acc_no'] = preg_replace('/\s+/', '', $xml->getElementsByTagName('BillRefNumber')->item(0)->nodeValue);
        $data['transaction_time'] = $xml->getElementsByTagName('TransTime')->item(0)->nodeValue;
        $data['transaction_type'] = $xml->getElementsByTagName('TransType')->item(0)->nodeValue; // The type of the transaction eg. Paybill, Buygoods etc,

        /**
         * save this in the payments table, but we first check if it exists (Safaricom sometimes send the notification twice)
         */
        $transaction = Payment::whereTransactionId($data['transaction_id'])->first();
        if ($transaction === null) {
            $result = Payment::create($data);

            $payload = [
                'payment' => $result
            ];

            // Fire the 'payment received' event
            $this->dispatcher->fire('c2b.received.payment', $payload);

        }

    }
}
