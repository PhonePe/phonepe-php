<?php

/**
 * Created by PhpStorm.
 * User: jigar.thakkar
 * Date: 24/10/16
 * Time: 4:15 PM
 */

namespace PhonePe\Models;

class DebitSuggestRequest
{
    /**
     * @var Header
     * @required
     */
    public $header;
    /**
     * @var string
     * @required
     */
    public $merchantId;
    /**
     * @var string
     * @required
     */
    public $merchantUserId;

}