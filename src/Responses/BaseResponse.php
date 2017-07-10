<?php
/**
 * Created by PhpStorm.
 * User: Lawrence
 * Date: 1/21/17
 * Time: 9:53 PM
 */

namespace App\Responses;


class BaseResponse
{

    protected $payload;
    protected $message;
    protected $success;
    protected $error = false;

    /**
     * BaseResponse constructor.
     * @param $payload
     * @param $message
     */
    public function __construct($message, array $payload = null)
    {
        $this->payload = $payload;
        $this->message = $message;
    }


    /**
     * @return mixed
     */
    public function isSuccessful()
    {
        return $this->success;
    }


    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }


    /**
     * @return array
     */
    public function getPayload()
    {
        return $this->payload;
    }


    /**
     * @return bool
     */
    public function isError()
    {
        return $this->error;
    }

}