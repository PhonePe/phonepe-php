<?php
namespace PhonePe\Debit;
use PhonePe\Configuration\PhonePeClientConfig;
use PhonePe\Models\InstantDebitRequest;
use PhonePe\Models\InstantDebitResponse;
use PhonePe\Utils\ChecksumGenerator;
use PhonePe\Utils\RequestGenerator;


/**
 * Created by PhpStorm.
 * User: jigar.thakkar
 * Date: 28/10/16
 * Time: 12:26 PM
 */

class InstantDebitExec
{
    /**
     * @param InstantDebitRequest $request
     * @param PhonePeClientConfig $phonePeClientConfig
     * @return InstantDebitResponse
     */
    static function instantDebit(InstantDebitRequest $request, PhonePeClientConfig $phonePeClientConfig) {
        $url = $phonePeClientConfig->mercuryBaseUrl . '/v1/debit/instant';
        $args = array($request->merchantId, $request->transactionId, $request->amount, $request->header->salt->key, $request->header->salt->index);
        $headers = 'Content-type:application/json ' . 'X-VERIFY:' . ChecksumGenerator::checkSumGenerate($args);
        $responseArray = RequestGenerator::postRequest($url, $request, $headers);
        $response = json_decode($responseArray[0]);
        return $response;
    }
}