<?php
/**
 * Created by PhpStorm.
 * User: jigar.thakkar
 * Date: 06/11/16
 * Time: 6:10 AM
 */

namespace PhonePe\Utility;



use PhonePe\Configuration\PhonePeClientConfig;
use PhonePe\Models\DebitSuggestRequest;
use PhonePe\Models\DebitSuggestResponse;
use PhonePe\Utils\ChecksumGenerator;
use PhonePe\Utils\RequestGenerator;

class DebitSuggestExec
{
    /**
     * @param DebitSuggestRequest $request
     * @param PhonePeClientConfig $phonePeClientConfig
     * @return DebitSuggestResponse
     */
    static function debitSuggest(DebitSuggestRequest $request, PhonePeClientConfig $phonePeClientConfig) {
        $url = $phonePeClientConfig->mercuryBaseUrl . '/v1/account/'. $request->merchantId .'/' . $request->merchantUserId . '/debit/suggest';
        $args = array($request->merchantId, $request->merchantUserId, $request->header->salt->key, $request->header->salt->index);
        $headers = 'Content-type:application/json ' . 'X-VERIFY:'. ChecksumGenerator::checkSumGenerate($args);
        $response = json_decode(RequestGenerator::getRequest($url, $headers));
        return $response;
    }
}