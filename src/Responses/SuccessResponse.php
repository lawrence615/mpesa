<?php
/**
 * Created by PhpStorm.
 * User: Lawrence
 * Date: 1/21/17
 * Time: 10:48 PM
 */

namespace App\Responses;


class SuccessResponse extends BaseResponse
{


    /**
     * SuccessResponse constructor.
     * @param $message
     * @param array|null $payload
     */
    public function __construct($message, array $payload = null)
    {
        parent::__construct($message, $payload);

        $this->success = true;
    }
}