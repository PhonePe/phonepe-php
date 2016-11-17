<?php

/**
 * Created by PhpStorm.
 * User: jigar.thakkar
 * Date: 08/11/16
 * Time: 7:12 PM
 */

use InterNations\Component\HttpMock\PHPUnit\HttpMockTrait;
use PhonePe\Models\Header;
use PhonePe\Models\RegularCreditRequest;
use PhonePe\Models\Salt;
use PhonePe\PhonePeClientImpl;
use PHPUnit\Framework\TestCase;
require __DIR__ . '/../../../vendor/autoload.php';

class RegularCreditTest extends TestCase
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

    public function testRegularCredit() {
        $mockResponse = '{"success":true,"code":"SUCCESS","redirectUrl":"https://mercury-uat.phonepe.com/v1/credit/action?token=ABCXYZTOKEN","message":"Please Redirect to the given url.","data":null}';
        $this->http->mock
            ->when()
            ->methodIs('POST')
            ->pathIs('/v1/credit/')
            ->then()
                ->body($mockResponse)
            ->end();
        $this->http->setUp();

        $testRequest = new RegularCreditRequest();
        $testRequest->header = new Header();
        $testRequest->header->salt = new Salt();
        $testRequest->header->salt->key = "saltKey";
        $testRequest->header->salt->index = 1;
        $testRequest->header->callBackUri = "www.merchant.com";
        $testRequest->amount = 100;
        $testRequest->merchantId = 'DemoMerchant';
        $testRequest->transactionId = 'TX123456789';
        $testRequest->merchantUserId = "U123456789";
        $testRequest->mobileNumber = "9xxxxxxxxxx";
        $testRequest->shortName = "demo";
        $testRequest->merchantOrderId = "O1234";
        $testRequest->email = "test@phonepe.com";
        $testRequest->message = "Test Payment";
        $testRequest->subMerchant = "Sub-merchant";
        $client = PhonePeClientImpl::testConstruct('http://' . self::$host . ':' . self::$port);
        $result = $client->regularCredit($testRequest);
        $this->assertEquals($result->success, true);
        $this->assertEquals($result->code, "SUCCESS");
        $this->assertEquals($result->redirectUrl, 'https://mercury-uat.phonepe.com/v1/credit/action?token=ABCXYZTOKEN');
    }
}