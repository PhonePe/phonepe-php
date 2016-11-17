<?php
/**
 * Created by PhpStorm.
 * User: jigar.thakkar
 * Date: 10/11/16
 * Time: 2:46 PM
 */

namespace PhonePe\Utils;

/**
 * Class RequestGenerator
 * @package PhonePe\Utils
 */
class RequestGenerator
{
    /**
     * @desc Helper function to send a post request
     * @param $url
     * @param $body
     * @param $headers
     * @return array
     */
    static function postRequest($url, $body, $headers) {
        // Creating Array of headers
        $headers = explode(" ", $headers);
        // Encoding Request Body in JSON
        $body = json_encode($body);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        $responseHeaders = curl_getinfo($ch);
        curl_close($ch);
        return array($response, $responseHeaders);
    }

    /**
     * @desc Helper function to send a get request
     * @param $url
     * @param $headers
     * @return mixed
     */
    static function getRequest($url, $headers) {
        // Creating Array of headers
        $headers = explode(" ", $headers);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

}