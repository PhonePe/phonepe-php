<?php

/**
 * Created by PhpStorm.
 * User: jigar.thakkar
 * Date: 08/11/16
 * Time: 7:12 PM
 */

use InterNations\Component\HttpMock\PHPUnit\HttpMockTrait;
use PhonePe\Models\CreditSuggestRequest;
use PhonePe\Models\CreditSuggestResponse;
use PhonePe\Models\Header;
use PhonePe\Models\Salt;
use PhonePe\PhonePeClientImpl;
use PHPUnit\Framework\TestCase;
require __DIR__ . '/../../../vendor/autoload.php';

class CreditSuggestExecTest extends TestCase
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

    public function testCreditSuggest() {
        $mockResponse = '{"success":true,"code":"SUCCESS","message":"Your request has been successfully completed.","data":{"merchantId":"merchantId","allowPartialPayment":"no","wallet":{"availableBalance":132632,"maxReceivable":867368,"state":"ACTIVATED","responseCode":"SUCCESS"}}}';
        $response = new CreditSuggestResponse();
        $response->success = true;
        $response->code = 200;
        $this->http->mock
            ->when()
            ->methodIs('GET')
            ->pathIs('/v1/account/merchantId/merchantUserId/credit/suggest')
            ->then()
            ->body($mockResponse)
            ->end();
        $this->http->setUp();

        $testRequest = new CreditSuggestRequest();
        $testRequest->header = new Header();
        $testRequest->header->salt = new Salt();
        $testRequest->header->salt->key = "saltKey";
        $testRequest->header->salt->index = 1;
        $testRequest->merchantId = "merchantId";
        $testRequest->merchantUserId = "merchantUserId";
        $testRequest->transactionId = "1234";
        $client1 = new PhonePeClientImpl();
        $client = PhonePeClientImpl::testConstruct('http://' . self::$host . ':' . self::$port);
        $result = $client->creditSuggest($testRequest);
        $this->assertEquals($result->code, "SUCCESS");
        $this->assertEquals($result->data->merchantId, "merchantId");
    }
}