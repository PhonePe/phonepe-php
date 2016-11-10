<?php
/**
 * Created by PhpStorm.
 * User: jigar.thakkar
 * Date: 28/10/16
 * Time: 1:47 PM
 */

namespace PhonePe\Credit;

use PhonePe\Configuration\PhonePeClientConfig;
use PhonePe\Models\FulfillCreditRequest;
use PhonePe\Models\FulfillCreditResponse;
use PhonePe\Utils\ChecksumGenerator;
use PhonePe\Utils\RequestGenerator;

class FulfillCreditExec
{
    /**
     * @param FulfillCreditRequest $request
     * @param PhonePeClientConfig $phonePeClientConfig
     * @return FulfillCreditResponse
     */
    static function fulfillCredit(FulfillCreditRequest $request, PhonePeClientConfig $phonePeClientConfig) {
        $url = $phonePeClientConfig->mercuryBaseUrl . '/v1/credit/deferred/fulfill';
        $args = array($request->merchantId, $request->transactionId, $request->amount, $request->header->salt->key, $request->header->salt->index);
        $headers = 'Content-type:application/json ' . 'X-VERIFY:' . ChecksumGenerator::checkSumGenerate($args);
        $responseArray = RequestGenerator::postRequest($url, $request, $headers);
        $response = json_decode($responseArray[0]);
        return $response;
    }

}