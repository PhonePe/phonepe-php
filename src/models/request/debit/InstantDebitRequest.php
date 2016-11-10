<?php

/**
 * Created by PhpStorm.
 * User: jigar.thakkar
 * Date: 24/10/16
 * Time: 4:00 PM
 */

namespace PhonePe\Models;

class InstantDebitRequest extends Request
{
    /**
     * @var Header
     * @required
     */
    public $header;
}