<?php

declare(strict_types = 1);

// Your Code

const TRANS_DIR = __DIR__ . '/../transaction_files';

function readTransactions()
{
    $transactions = [];

    $transactionFiles = scandir(TRANS_DIR);

    foreach ($transactionFiles as $file) {
        if ($file === '.' || $file === '..') {
            continue;
        }

        $transactions = array_merge($transactions, readTransactionsFromFile(TRANS_DIR . '/' . $file));
    }

    return $transactions;
}

function readTransactionsFromFile(string $fileName)
{
    $transactions = [];

    if(!file_exists($fileName)) {
        return [];
    }

    $handle = fopen($fileName, 'r');

    $headings = fgetcsv($handle, 0, ',');

    while (($data = fgetcsv($handle, 0, ',')) !== false) {
        array_push($transactions, array_combine($headings, $data));
    }

    fclose($handle);

    return $transactions;
}

function getSumOfTransactions(array $transactions)
{
    $transactions = getTransactionsAmountParsed($transactions);
    return array_sum(array_column($transactions, 'Amount'));
}

function getTotalExpeneses(array $transactions)
{
    $transactions = getTransactionsAmountParsed($transactions);

    $totalExpenses = 0;

    foreach ($transactions as $transaction) {
        if ($transaction['Amount'] < 0) {
            $totalExpenses += abs($transaction['Amount']);
        }
    }

    return $totalExpenses;
}

function getTotalEarnings(array $transactions)
{
    $transactions = getTransactionsAmountParsed($transactions);

    $totalEarnings = 0;

    foreach ($transactions as $transaction) {
        if ($transaction['Amount'] > 0) {
            $totalEarnings += $transaction['Amount'];
        }
    }

    return $totalEarnings;
}

function getTransactionsAmountParsed(array $transactions){
    $nf = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
    $currency = 'USD';
    $transactions = array_map(function ($transaction) use ($nf, $currency) {
        $transaction['Amount'] = $nf->parseCurrency($transaction['Amount'], $currency);

        return $transaction;

    }, $transactions);

    return $transactions;
}

function dd(...$args)
{
    var_dump(...$args);
    die;
}