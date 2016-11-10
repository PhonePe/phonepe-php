<?php
/**
 * Created by PhpStorm.
 * User: nishant.mittal
 * Date: 09/11/16
 * Time: 3:33 PM
 */

namespace PhonePe\Models;


class WalletDetails
{
    /**
     * @var integer
     */
    public $availableBalance;
    /**
     * @var integer
     */
    public $usableBalance;
    /**
     * @var string
     */
    public $state;
    /**
     * @var string
     */
    public $responseCode;
}