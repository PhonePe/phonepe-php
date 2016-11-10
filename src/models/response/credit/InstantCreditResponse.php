<?php

/**
 * Created by PhpStorm.
 * User: jigar.thakkar
 * Date: 27/10/16
 * Time: 1:24 AM
 */

namespace PhonePe\Models;

class InstantCreditResponse
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
     * @var Response
     */
    public $data;
    /**
     * @var string
     */
    public $message;
}