<?php
/**
 * Created by PhpStorm.
 * User: jigar.thakkar
 * Date: 28/10/16
 * Time: 1:49 PM
 */

namespace PhonePe\Credit;



use PhonePe\Configuration\PhonePeClientConfig;
use PhonePe\Models\RegularCreditRequest;
use PhonePe\Models\RegularCreditResponse;
use PhonePe\Utils\ChecksumGenerator;
use PhonePe\Utils\RequestGenerator;

class RegularCreditExec
{
    /**
     * @param $responseHeader
     * @return RegularCreditResponse
     */
    static function getSuccessResponse($responseHeader) {
        $responseObject = new RegularCreditResponse();
        $responseObject->success = true;
        $responseObject->code = "SUCCESS";
        $responseObject->redirectUrl = $responseHeader['redirect_url'];
        $responseObject->message = "Please Redirect to the given url.";
        return $responseObject;
    }

    /**
     * @param RegularCreditRequest $request
     * @param PhonePeClientConfig $phonePeClientConfig
     * @return mixed|RegularCreditResponse
     */
    static function regularCredit(RegularCreditRequest $request, PhonePeClientConfig $phonePeClientConfig) {
        $url = $phonePeClientConfig->mercuryBaseUrl . '/v1/credit/';
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