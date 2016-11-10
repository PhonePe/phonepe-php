<?php
/**
 * Created by PhpStorm.
 * User: jigar.thakkar
 * Date: 28/10/16
 * Time: 1:43 PM
 */

namespace PhonePe\Credit;



use PhonePe\Configuration\PhonePeClientConfig;
use PhonePe\Models\InstantCreditRequest;
use PhonePe\Models\InstantCreditResponse;
use PhonePe\Utils\ChecksumGenerator;
use PhonePe\Utils\RequestGenerator;

class InstantCreditExec
{
    /**
     * @param InstantCreditRequest $request
     * @param PhonePeClientConfig $phonePeClientConfig
     * @return InstantCreditResponse|mixed
     */
    static function instantCredit(InstantCreditRequest $request, PhonePeClientConfig $phonePeClientConfig) {
        $url = $phonePeClientConfig->mercuryBaseUrl . '/v1/credit/instant';
        $args = array($request->merchantId, $request->transactionId, $request->amount, $request->header->salt->key, $request->header->salt->index);
        $headers = 'Content-type:application/json ' .'X-VERIFY:' . ChecksumGenerator::checkSumGenerate($args);
        $responseArray = RequestGenerator::postRequest($url, $request, $headers);
        $response = json_decode($responseArray[0]);
        return $response;
    }
}