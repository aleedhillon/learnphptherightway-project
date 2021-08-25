<?php

declare(strict_types = 1);

require_once './../app/App.php';

$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;

define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('FILES_PATH', $root . 'transaction_files' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);

/* YOUR CODE (Instructions in README.md) */

switch($_SERVER['REQUEST_URI']) {
    case '/':
        $transactions = readTransactions();
        $netTotal = getSumOfTransactions($transactions);
        $totalExpenses = getTotalExpeneses($transactions);
        $totalEarnings = getTotalEarnings($transactions);

        // dd($transactions, $sum);
        include_once VIEWS_PATH . 'transactions.php';
        break;
    default:
        throw new Exception('Page not found');
}
