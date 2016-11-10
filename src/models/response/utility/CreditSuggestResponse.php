<?php

/**
 * Created by PhpStorm.
 * User: jigar.thakkar
 * Date: 06/11/16
 * Time: 4:41 AM
 */

namespace PhonePe\Models;

class CreditSuggestResponse
{
    /**
     * @var boolean
     */
    public $success;
    /**
     * @var string
     */
    public $code;
    /**
     * @var string
     */
    public $message;
    /**
     * @var Response
     */
    public $data;
}