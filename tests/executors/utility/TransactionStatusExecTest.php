<?php

/**
 * Created by PhpStorm.
 * User: jigar.thakkar
 * Date: 08/11/16
 * Time: 7:12 PM
 */
use InterNations\Component\HttpMock\PHPUnit\HttpMockTrait;
use PhonePe\Models\Header;
use PhonePe\Models\Salt;
use PhonePe\Models\TransactionStatusRequest;
use PhonePe\PhonePeClientImpl;
use PHPUnit\Framework\TestCase;
use WireMock\Client\WireMock;

require __DIR__ . '/../../../vendor/autoload.php';

class TransactionStatusExecTest extends TestCase
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

    public function testTransactionStatus() {
        $mockresponse = '{ "success": true, "code": "PAYMENT_SUCCESS", "message": "Your payment is successful.", "data": { "transactionId": "TX123456789", "merchantId": "merchantId", "amount": 100, "providerReferenceId": "PPXXXXXX", "paymentState": "COMPLETED", "payResponseCode": "SUCCESS" } }';
        $this->http->mock
            ->when()
            ->methodIs('GET')
            ->pathIs('/v1/transaction/merchantId/TX123456789/status')
            ->then()
            ->body($mockresponse)
            ->end();
        $this->http->setUp();

        $testRequest = new TransactionStatusRequest();
        $testRequest->header = new Header();
        $testRequest->header->salt = new Salt();
        $testRequest->header->salt->key = "saltKey";
        $testRequest->header->salt->index = 1;
        $testRequest->merchantId = 'merchantId';
        $testRequest->merchantUserId = "merchantUserId";
        $testRequest->transactionId = "TX123456789";
        $client = PhonePeClientImpl::testConstruct('http://' . self::$host . ':' . self::$port);
        $result = $client->transactionStatus($testRequest);
        $this->assertEquals($result->code, "PAYMENT_SUCCESS");
        $this->assertEquals($result->data->paymentState, "COMPLETED");
    }
}