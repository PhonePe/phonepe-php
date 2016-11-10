<?php

/**
 * Created by PhpStorm.
 * User: jigar.thakkar
 * Date: 21/10/16
 * Time: 4:36 PM
 */

namespace PhonePe\Models;

class Response
{
    /**
     * @var string
     */
    public $merchantId;
    /**
     * @var string
     */
    public $transactionId;
    /**
     * @var string
     */
    public $merchantUserId;
    /**
     * @var integer
     */
    public $amount;
    /**
     * @var integer
     */
    public $mobileNumber;
    /**
     * @var string
     */
    public $status;
    /**
     * @var string
     */
    public $providerReferenceId;
    /**
     * @var string
     */
    public $payResponseCode;
    /**
     * @var string
     */
    public $paymentState;
    /**
     * @var string
     */
    public $allowPartialPayment;
    /**
     * @var UpiDetails
     */
    public $upi;
    /**
     * @var WalletDetails
     */
    public $wallet;
}