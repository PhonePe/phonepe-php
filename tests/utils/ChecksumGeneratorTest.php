<?php

/**
 * Created by PhpStorm.
 * User: jigar.thakkar
 * Date: 08/11/16
 * Time: 7:12 PM
 */

use PhonePe\Models\Header;
use PhonePe\Models\InstantDebitRequest;
use PhonePe\Models\Salt;
use PhonePe\PhonePeClientImpl;
use PhonePe\Utils\ChecksumGenerator;
use PHPUnit\Framework\TestCase;

require __DIR__ . '/../../vendor/autoload.php';

class ChecksumGeneratorTest extends TestCase
{
    public function testChecksumGenerator() {

        $args = Array("MerchantId", "TransactionId", "Amount", "Salt", 1);
        $result = ChecksumGenerator::checkSumGenerate($args);
        $this->assertEquals($result, '5fa90742c72a61bd4619345afa0d0809323e0fbb31839355d61a088d49975b24###1');
    }
}