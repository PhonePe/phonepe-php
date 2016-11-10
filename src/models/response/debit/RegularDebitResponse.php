<?php

/**
 * Created by PhpStorm.
 * User: jigar.thakkar
 * Date: 27/10/16
 * Time: 3:42 AM
 */

namespace PhonePe\Models;

class RegularDebitResponse
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
    public $redirectUrl;
    /**
     * @var string
     */
    public $message;
    /**
     * @var Response
     */
    public $data;
}