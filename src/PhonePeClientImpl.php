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
        $this->phonePeClientConfig->mercuryBaseUrl = 'https://mercury-uat.phonepe.com';
}

    function regularCredit(RegularCreditRequest $creditRequest) {
        return RegularCreditExec::regularCredit($creditRequest, $this->phonePeClientConfig);
    }

    function instantCredit(InstantCreditRequest $creditRequest) {
        return InstantCreditExec::instantCredit($creditRequest, $this->phonePeClientConfig);
    }

    function deferredCredit(DeferredCreditRequest $creditRequest)
    {
        return DeferredCreditExec::deferredCredit($creditRequest, $this->phonePeClientConfig);
    }

    function fulfillCredit(FulfillCreditRequest $fulfillRequest) {
        return FulfillCreditExec::fulfillCredit($fulfillRequest, $this->phonePeClientConfig);
    }

    function backToSourceCredit(BackToSourceCreditRequest $creditRequest) {
        return BackToSourceExec::backToSource($creditRequest, $this->phonePeClientConfig);
    }

    function regularDebit(RegularDebitRequest $debitRequest) {
        return RegularDebitExec::regularDebit($debitRequest, $this->phonePeClientConfig);
    }

    function instantDebit(InstantDebitRequest $debitRequest) {
        return InstantDebitExec::instantDebit($debitRequest, $this->phonePeClientConfig);
    }

    function transactionStatus(TransactionStatusRequest $statusRequest) {
        return TransactionStatusExec::transactionStatus($statusRequest, $this->phonePeClientConfig);
    }

    function debitSuggest(DebitSuggestRequest $debitSuggestRequest) {
        return DebitSuggestExec::debitSuggest($debitSuggestRequest, $this->phonePeClientConfig);
    }

    function creditSuggest(CreditSuggestRequest $creditSuggestRequest) {
        return CreditSuggestExec::creditSuggest($creditSuggestRequest, $this->phonePeClientConfig);
    }
}