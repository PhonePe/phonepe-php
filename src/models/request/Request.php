<?php

/**
 * Created by PhpStorm.
 * User: jigar.thakkar
 * Date: 21/10/16
 * Time: 4:36 PM
 */

namespace PhonePe\Models;

class Request
{
    /**
     * @var string
     * @required
     */
    public $merchantId;
    /**
     * @var string
     * @required
     */
    public $transactionId;
    /**
     * @required
     * @var string
     */
    public $merchantUserId;
    /**
     * @required
     * @var string
     */
    public $merchantOrderId;
    /**
     * @required
     * @var integer
     */
    public $amount;
    /**
     * @required
     * @var string
     */
    public $subMerchant;
    /**
     * @Assert\Email
     */
    public $email;
    /**
     * @var string
     */
    public $shortName;
    /**
     * @var string
     */
    public $message;
    /**
     * @var string
     */
    public $mobileNumber;
}
