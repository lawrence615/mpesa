<?php
namespace Mobidev\Mpesa\Services;

use App\Responses\FailureResponse;
use Carbon\Carbon;
use Mobidev\Mpesa\Traits\MpesaRequest;

class OnlineCheckout
{

    use MpesaRequest;


    /**
     * @var
     */
    protected $amount;

    /**
     * @var
     */
    protected $number;

    /**
     * @var
     */
    protected $referenceId;


    public function __construct()
    {
        // set Mpesa API credentials
        $this->setConfig();
    }


    private function setOnlineCheckoutOptions($settings)
    {
        print_r($settings);
        exit;
        $this->config['passkey'] = $settings['passkey'];
        $this->config['merchant_id'] = $settings['merchant_id'];
        $this->config['callback_url'] = $settings['callback_url'];
    }


    /**
     * Function to perform Mpesa Online API Checkout
     *
     * @param array $data
     * @return FailureResponse
     */
    public function setOnlineCheckout($data)
    {

        // Checking if the values necessary are provided
        if (empty($data['amount']) || empty($data['number']) || empty($data['referenceId'])) {
            return new FailureResponse('Please provide all the values needed to complete the request.');
        }

        $this->amount = $data['amount'];
        $this->number = sprintf('254%s', substr(trim($data['number']), -9));
        $this->referenceId = $data['referenceId'];
        $this->initializeOnlineCheckout();

        // execute the request
        $this->executeOnlineCheckout();
    }

    protected function initializeOnlineCheckout()
    {

        $this->setTimestamp();
        $this->generatePassword();
        $this->replaceWithRealValues();
    }

    protected function executeOnlineCheckout()
    {

    }


    private function generatePassword()
    {
        $my_pass = $this->passkey;

        $this->password = base64_encode(hash("sha256", "683436" . $my_pass . $this->timestamp));

        return $this->password;
    }

    protected function replaceWithRealValues()
    {
        $this->requestKeys = [
            'OC_PAYBILL' => $this->merchant_id,
            'OC_PASSWORD' => $this->password,
            'OC_TIMESTAMP' => $this->timestamp,
            'OC_TRANS_ID' => self::generateTransactionNumber(),
            'OC_REF_ID' => $this->referenceId,
            'OC_AMOUNT' => $this->amount,
            'OC_NUMBER' => $this->number,
            'OC_CALL_URL' => $this->callback_url,
            'OC_CALL_METHOD' => 'POST',
        ];
    }
}