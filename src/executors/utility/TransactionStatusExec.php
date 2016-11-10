<?php
/**
 * Created by PhpStorm.
 * User: jigar.thakkar
 * Date: 06/11/16
 * Time: 6:16 AM
 */

namespace PhonePe\Utility;



use PhonePe\Configuration\PhonePeClientConfig;
use PhonePe\Models\TransactionStatusRequest;
use PhonePe\Models\TransactionStatusResponse;
use PhonePe\Utils\ChecksumGenerator;
use PhonePe\Utils\RequestGenerator;

class TransactionStatusExec
{
    /**
     * @param TransactionStatusRequest $request
     * @param PhonePeClientConfig $phonePeClientConfig
     * @return TransactionStatusResponse
     */
    static function transactionStatus(TransactionStatusRequest $request, PhonePeClientConfig $phonePeClientConfig) {
        $url = $phonePeClientConfig->mercuryBaseUrl . '/v1/transaction/'. $request->merchantId .'/' . $request->transactionId . '/status';
        $args = array($request->merchantId, $request->transactionId, $request->header->salt->key, $request->header->salt->index);
        $headers = 'Content-type:application/json ' . 'X-VERIFY:' . ChecksumGenerator::checkSumGenerate($args);
        $response = json_decode(RequestGenerator::getRequest($url, $headers));
        return $response;
    }
}