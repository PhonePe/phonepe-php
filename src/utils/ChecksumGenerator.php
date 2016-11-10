<?php

/**
 * Created by PhpStorm.
 * User: nishant.mittal
 * Date: 09/11/16
 * Time: 11:09 AM
 */

namespace PhonePe\Utils;

class ChecksumGenerator
{
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