<?php

/**
 * Created by PhpStorm.
 * User: jigar.thakkar
 * Date: 24/10/16
 * Time: 3:57 PM
 */

namespace PhonePe\Models;

class RegularCreditRequest extends Request
{
    /**
     * @var Header
     * @required
     */
    public $header;
}