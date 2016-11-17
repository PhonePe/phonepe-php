<?php

/**
 * Created by PhpStorm.
 * User: nishant.mittal
 * Date: 09/11/16
 * Time: 11:09 AM
 */

namespace PhonePe\Utils;

/**
 * Class ChecksumGenerator
 * @package PhonePe\Utils
 */
class ChecksumGenerator
{
    /**
     * @desc Helper to generate checksum for authentication. Pass an array with all the keys to be hashed and the salt index.
     * The salt index will always be the last element in the array.
     * @param $args
     * @return string
     */
    static function checkSumGenerate($args){
        $arrLength = count($args);
        $string = "";
        for($x = 0; $x < $arrLength-1; $x++) {
            $string = $string.$args[$x];
        }
        $hashedStr = hash('sha256',$string);
        $hashedStr = $hashedStr."###".$args[$arrLength-1];
        return $hashedStr;
    }
}