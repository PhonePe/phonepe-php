<?php

/**
 * Created by PhpStorm.
 * User: jigar.thakkar
 * Date: 24/10/16
 * Time: 4:12 PM
 */

namespace PhonePe\Models;

class Salt
{
    /**
     * @var integer
     * @required
     */
    public $index;
    /**
     * @var string
     * @required
     */
    public $key;
}