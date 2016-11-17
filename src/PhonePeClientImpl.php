<?php
use Configuration\PhonePeClientConfig;
use Executors\BackToSourceExec;
use Executors\CreditSuggestExec;
use Executors\DebitSuggestExec;
use Executors\DeferredCreditExec;
use Executors\FulfillCreditExec;
use Executors\InstantCreditExec;
use Executors\InstantDebitExec;
use Executors\RegularCreditExec;
use Executors\RegularDebitExec;
use Executors\TransactionStatusExec;

/**
 * Created by PhpStorm.
 * User: jigar.thakkar
 * Date: 04/11/16
 * Time: 3:23 PM
 */

namespace PhonePe;


use PhonePe\Configuration\PhonePeClientConfig;
use PhonePe\Credit\BackToSourceExec;
use PhonePe\Credit\DeferredCreditExec;
use PhonePe\Credit\FulfillCreditExec;
use PhonePe\Credit\InstantCreditExec;
use PhonePe\Credit\RegularCreditExec;
use PhonePe\Debit\InstantDebitExec;
use PhonePe\Debit\RegularDebitExec;
use PhonePe\Models\BackToSourceCreditRequest;
use PhonePe\Models\CreditSuggestRequest;
use PhonePe\Models\DebitSuggestRequest;
use PhonePe\Models\DeferredCreditRequest;
use PhonePe\Models\FulfillCreditRequest;
use PhonePe\Models\InstantCreditRequest;
use PhonePe\Models\InstantDebitRequest;
use PhonePe\Models\RegularCreditRequest;
use PhonePe\Models\RegularDebitRequest;
use PhonePe\Models\TransactionStatusRequest;
use PhonePe\Utility\CreditSuggestExec;
use PhonePe\Utility\DebitSuggestExec;
use PhonePe\Utility\TransactionStatusExec;

class PhonePeClientImpl implements PhonePeClient
{
    private $phonePeClientConfig;

    function __construct()
    {
        $this->phonePeClientConfig = new PhonePeClientConfig();
    }
    public static function testConstruct($hostname) {
        $instance = new self();
        $instance->phonePeClientConfig = new PhonePeClientConfig();
        $instance->phonePeClientConfig->mercuryBaseUrl = $hostname;
        return $instance;
    }

    /**
     * @desc UI flow for crediting amount to Customer
     * @param RegularCreditRequest $creditRequest
     * @return Models\RegularCreditResponse
     */
    function regularCredit(RegularCreditRequest $creditRequest) {
        return RegularCreditExec::regularCredit($creditRequest, $this->phonePeClientConfig);
    }

    /**
     * @desc Direct API to credit amount to customer
     * @param InstantCreditRequest $creditRequest
     * @return Models\InstantCreditResponse
     */
    function instantCredit(InstantCreditRequest $creditRequest) {
        return InstantCreditExec::instantCredit($creditRequest, $this->phonePeClientConfig);
    }

    /**
     * @desc UI based workflow to allow for Login/Registration to initiate a deferred credit request
     * @param DeferredCreditRequest $creditRequest
     * @return Models\DeferredCreditResponse
     */
    function deferredCredit(DeferredCreditRequest $creditRequest)
    {
        return DeferredCreditExec::deferredCredit($creditRequest, $this->phonePeClientConfig);
    }

    /**
     * @desc API based flow to fulfill the deferred request
     * @param FulfillCreditRequest $fulfillRequest
     * @return Models\FulfillCreditResponse
     */
    function fulfillCredit(FulfillCreditRequest $fulfillRequest) {
        return FulfillCreditExec::fulfillCredit($fulfillRequest, $this->phonePeClientConfig);
    }

    /**
     * @desc API flow to reverse a previous transaction
     * @param BackToSourceCreditRequest $creditRequest
     * @return Models\BackToSourceCreditResponse
     */
    function backToSourceCredit(BackToSourceCreditRequest $creditRequest) {
        return BackToSourceExec::backToSource($creditRequest, $this->phonePeClientConfig);
    }

    /**
     * @desc  Regular debit is a UI based workflow to allow for Login/Registration to accept payments
     * @param RegularDebitRequest $debitRequest
     * @return Models\RegularDebitResponse
     */
    function regularDebit(RegularDebitRequest $debitRequest) {
        return RegularDebitExec::regularDebit($debitRequest, $this->phonePeClientConfig);
    }

    /**
     * @desc This is an API only workflow that instantly debits a PhonePe users wallet account
     * @param InstantDebitRequest $debitRequest
     * @return Models\InstantDebitResponse
     */
    function instantDebit(InstantDebitRequest $debitRequest) {
        return InstantDebitExec::instantDebit($debitRequest, $this->phonePeClientConfig);
    }

    /**
     * @desc This API is used to check the status of the transaction
     * @param TransactionStatusRequest $statusRequest
     * @return Models\TransactionStatusResponse
     */
    function transactionStatus(TransactionStatusRequest $statusRequest) {
        return TransactionStatusExec::transactionStatus($statusRequest, $this->phonePeClientConfig);
    }

    /**
     * @desc Used in a debit scenario to check the instruments available for payment, along with usable balance in the wallet
     * @param DebitSuggestRequest $debitSuggestRequest
     * @return Models\DebitSuggestResponse
     */
    function debitSuggest(DebitSuggestRequest $debitSuggestRequest) {
        return DebitSuggestExec::debitSuggest($debitSuggestRequest, $this->phonePeClientConfig);
    }

    /**
     * @desc Used in a credit scenario to check the maximum balance that can be received in the wallet
     * @param CreditSuggestRequest $creditSuggestRequest
     * @return Models\CreditSuggestResponse
     */
    function creditSuggest(CreditSuggestRequest $creditSuggestRequest) {
        return CreditSuggestExec::creditSuggest($creditSuggestRequest, $this->phonePeClientConfig);
    }
}