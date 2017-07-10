<?php
/**
 * Created by PhpStorm.
 * User: Lawrence
 * Date: 1/21/17
 * Time: 11:06 PM
 */

namespace App\Responses;


class ExceptionResponse extends BaseResponse
{

    /**
     * ExceptionResponse constructor.
     * @param $message
     * @param array|null $payload
     */
    public function __construct($message, array $payload = null)
    {
        parent::__construct($message, $payload);

        $this->success = false;
        $this->error = true;
    }
}