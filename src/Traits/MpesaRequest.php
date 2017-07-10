<?php

namespace Mobidev\Mpesa\Traits;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Mobidev\Mpesa\Services\OnlineCheckout;

trait MpesaRequest
{

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var
     */
    protected $passkey;

    /**
     * @var
     */
    protected $merchant_id;

    /**
     * @var
     */
    protected $callback_ur;

    /**
     * @array
     */
    protected $config;


    protected $timestamp;


    private function setConfig()
    {
        $this->client = $this->setClient();
        if (function_exists('config')) {
            $this->setApiSettings(config('mpesa'));
        }
    }


    protected function setClient()
    {
        return new Client();
    }

    public function setApiSettings($settings)
    {
        // Setting Online Checkout parameters
        collect($settings['online_checkout'])->map(function ($value, $key) {
            $this->config[$key] = $value;
        });

        if ($this instanceof OnlineCheckout) {
            $this->setOnlineCheckoutOptions($settings);
        } else {
            throw new \Exception('Invalid settings provided.');
        }
    }


    public function setTimestamp()
    {
        $this->timestamp = Carbon::now()->format('YmdHis');
        return $this->timestamp;
    }

    public function generateTransactionNumber()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 17; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    private function performOnlineCheckoutRequest()
    {
        // setup payload
        $this->createRequestPayload();

        try {
            $response = $this->makeHttpRequestToSafaricom();
        } catch (\Exception $exception) {

        }
    }

    private function createRequestPayload()
    {

    }

    private function makeHttpRequestToSafaricom()
    {

    }
}
