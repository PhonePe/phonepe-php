<?php

/**
 * Created by PhpStorm.
 * User: jigar.thakkar
 * Date: 28/10/16
 * Time: 12:32 PM
 */

namespace PhonePe\Debit;



use PhonePe\Configuration\PhonePeClientConfig;
use PhonePe\Models\RegularDebitRequest;
use PhonePe\Models\RegularDebitResponse;
use PhonePe\Utils\ChecksumGenerator;
use PhonePe\Utils\RequestGenerator;

class RegularDebitExec
{
    /**
     * @param $responseHeader
     * @return RegularDebitResponse
     */
    static function getSuccessResponse($responseHeader) {
        $responseObject = new RegularDebitResponse();
        $responseObject->success = true;
        $responseObject->code = "SUCCESS";
        $responseObject->redirectUrl = $responseHeader['redirect_url'];
        $responseObject->message = "Please Redirect to the given url.";
        return $responseObject;
    }

    /**
     * @param RegularDebitRequest $request
     * @param PhonePeClientConfig $phonePeClientConfig
     * @return mixed|RegularDebitResponse
     */
    static function regularDebit(RegularDebitRequest $request, PhonePeClientConfig $phonePeClientConfig)
    {
        $url = $phonePeClientConfig->mercuryBaseUrl . '/v1/debit/';
        $args = array($request->merchantId, $request->transactionId, $request->amount, $request->header->salt->key, $request->header->salt->index);
        $headers = 'Content-type:application/json ' . 'X-VERIFY:' . ChecksumGenerator::checkSumGenerate($args) . 'X-CALLBACK-URL:' . $request->header->callBackUri;
        $responseArray = RequestGenerator::postRequest($url, $request, $headers);
        if ($responseArray[1]['http_code'] != 302) {
            $response = json_decode($responseArray[0]);
            return $response;
        }
        return self::getSuccessResponse($responseArray[1]);
    }

}