<?php
/**
 * Created by PhpStorm.
 * User: jigar.thakkar
 * Date: 04/11/16
 * Time: 4:01 PM
 */

namespace PhonePe\Utility;



use PhonePe\Configuration\PhonePeClientConfig;
use PhonePe\Models\CreditSuggestRequest;
use PhonePe\Models\CreditSuggestResponse;
use PhonePe\Utils\ChecksumGenerator;
use PhonePe\Utils\RequestGenerator;

class CreditSuggestExec
{
    /**
     * @param CreditSuggestRequest $request
     * @param PhonePeClientConfig $phonePeClientConfig
     * @return CreditSuggestResponse
     */
    static function creditSuggest(CreditSuggestRequest $request, PhonePeClientConfig $phonePeClientConfig) {
        $url = $phonePeClientConfig->mercuryBaseUrl . '/v1/account/'. $request->merchantId .'/' . $request->merchantUserId . '/credit/suggest';
        $args = array($request->merchantId, $request->merchantUserId, $request->header->salt->key, $request->header->salt->index);
        $headers = 'Content-type:application/json ' . 'X-VERIFY:' . ChecksumGenerator::checkSumGenerate($args);
        $response = json_decode(RequestGenerator::getRequest($url, $headers));
        return $response;
    }
}