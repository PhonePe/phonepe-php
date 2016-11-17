<?php

/**
 * Created by PhpStorm.
 * User: jigar.thakkar
 * Date: 08/11/16
 * Time: 7:12 PM
 */

use InterNations\Component\HttpMock\PHPUnit\HttpMockTrait;
use PhonePe\Models\DebitSuggestRequest;
use PhonePe\Models\DebitSuggestResponse;
use PhonePe\Models\Header;
use PhonePe\Models\Salt;
use PhonePe\PhonePeClientImpl;
use PHPUnit\Framework\TestCase;
require __DIR__ . '/../../../vendor/autoload.php';

class DebitSuggestExecTest extends TestCase
{
    use HttpMockTrait;
    public static $host = 'localhost';
    public static $port = '8080';

    public static function setUpBeforeClass()
    {
        static::setUpHttpMockBeforeClass(self::$port, self::$host);
    }

    public static function tearDownAfterClass()
    {
        static::tearDownHttpMockAfterClass();
    }

    public function setUp()
    {
        $this->setUpHttpMock();
    }

    public function tearDown()
    {
        $this->tearDownHttpMock();
    }

    public function testDebitSuggest() {
        $mockresponse = '{ "success": true, "code": "SUCCESS", "message": "Your request has been successfully completed.", "data": { "merchantId": "merchantId", "allowPartialPayment": "no", "message": "Your request has been successfully completed.", "upi": { "enabled": true, "primaryAccount": "XXXXXXXX909" }, "wallet": { "availableBalance": 400000, "usableBalance": 400000, "state": "ACTIVATED", "responseCode": "SUCCESS" } } }';

        $this->http->mock
            ->when()
            ->methodIs('GET')
            ->pathIs('/v1/account/merchantId/merchantUserId/debit/suggest')
            ->then()
            ->body($mockresponse)
            ->end();
        $this->http->setUp();

        $testRequest = new DebitSuggestRequest();
        $testRequest->header = new Header();
        $testRequest->header->salt = new Salt();
        $testRequest->header->salt->key = "saltKey";
        $testRequest->header->salt->index = 1;
        $testRequest->merchantId = 'merchantId';
        $testRequest->merchantUserId = "merchantUserId";
        $testRequest->transactionId = "1234";
        $client = PhonePeClientImpl::testConstruct('http://' . self::$host . ':' . self::$port);
        $result = $client->debitSuggest($testRequest);
        $this->assertEquals($result->code, "SUCCESS");
        $this->assertEquals($result->data->merchantId, "merchantId");
    }
}