<?php

/**
 * Created by PhpStorm.
 * User: jigar.thakkar
 * Date: 27/10/16
 * Time: 3:47 AM
 */

namespace PhonePe\Credit;


use PhonePe\Configuration\PhonePeClientConfig;
use PhonePe\Models\BackToSourceCreditRequest;
use PhonePe\Models\BackToSourceCreditResponse;
use PhonePe\Utils\ChecksumGenerator;
use PhonePe\Utils\RequestGenerator;

class BackToSourceCreditExec
{
    /**
     * @param BackToSourceCreditRequest $request
     * @param PhonePeClientConfig $phonePeClientConfig
     * @return BackToSourceCreditResponse
     */
    static function backToSource(BackToSourceCreditRequest $request, PhonePeClientConfig $phonePeClientConfig) {
        $url = $phonePeClientConfig->mercuryBaseUrl . '/v1/credit/backToSource';
        $args = array($request->merchantId, $request->transactionId, $request->amount, $request->header->salt->key, $request->header->salt->index);
        $headers = 'Content-type:application/json ' . 'X-VERIFY:' . ChecksumGenerator::checkSumGenerate($args);
        $responseArray = RequestGenerator::postRequest($url, $request, $headers);
        $response = json_decode($responseArray[0]);
        return $response;
    }
}