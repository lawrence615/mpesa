<?php

namespace Mobidev\Mpesa\Traits;

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
    protected $c2b_paybill;

    /**
     * @array
     */
    protected $config;


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
        if ($this instanceof OnlineCheckout) {
            $this->setOnlineCheckoutOptions($settings);
        }
    }

    private function setOnlineCheckoutOptions($settings)
    {
        $this->config['passkey'] = $settings['passkey'];
        $this->config['c2b_paybill'] = $settings['passkey'];
    }
}
