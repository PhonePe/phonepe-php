<?php

/**
 * Created by PhpStorm.
 * User: jigar.thakkar
 * Date: 24/10/16
 * Time: 4:12 PM
 */

namespace PhonePe\Models;

class Header
{
    /**
     * @var Salt
     * @required
     */
    public $salt;
    /**
     * @var string
     */
    public $callBackUri;
}