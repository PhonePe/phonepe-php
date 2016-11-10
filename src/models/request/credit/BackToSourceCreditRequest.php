<?php

/**
 * Created by PhpStorm.
 * User: jigar.thakkar
 * Date: 24/10/16
 * Time: 3:58 PM
 */

namespace PhonePe\Models;

class BackToSourceCreditRequest extends Request
{
    /**
     * @var string
     * @required
     */
    public $providerReferenceId;
    /**
     * @required
     * @var Header
     */
    public $header;
}