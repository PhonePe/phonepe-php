<?php

/**
 * Created by PhpStorm.
 * User: jigar.thakkar
 * Date: 04/11/16
 * Time: 3:17 PM
 */

namespace PhonePe;


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

interface PhonePeClient
{

    function regularCredit(RegularCreditRequest $creditRequest);

    function instantCredit(InstantCreditRequest $creditRequest);

    function deferredCredit(DeferredCreditRequest $creditRequest);

    function fulfillCredit(FulfillCreditRequest $fulfillRequest);

    function backToSourceCredit(BackToSourceCreditRequest $creditRequest);

    function regularDebit(RegularDebitRequest $debitRequest);

    function instantDebit(InstantDebitRequest $debitRequest);

    function transactionStatus(TransactionStatusRequest $statusRequest);

    function debitSuggest(DebitSuggestRequest $debitSuggestRequest);

    function creditSuggest(CreditSuggestRequest $creditSuggestRequest);
}