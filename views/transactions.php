<!DOCTYPE html>
<html>
    <head>
        <title>Transactions</title>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
                text-align: center;
            }

            table tr th, table tr td {
                padding: 5px;
                border: 1px #eee solid;
            }

            tfoot tr th, tfoot tr td {
                font-size: 20px;
            }

            tfoot tr th {
                text-align: right;
            }
        </style>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Check #</th>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <!-- YOUR CODE -->
                <?php foreach ($transactions as $transaction) : ?>
                    <tr>
                        <td><?= formatDate($transaction['Date']) ?></td>
                        <td><?= $transaction['Check #'] ?></td>
                        <td><?= $transaction['Description'] ?></td>
                        <td><?= $transaction['Amount'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total Income:</th>
                    <td>$<?= $totalEarnings ?></td>
                </tr>
                <tr>
                    <th colspan="3">Total Expense:</th>
                    <td>$<?= $totalExpenses ?></td>
                </tr>
                <tr>
                    <th colspan="3">Net Total:</th>
                    <td>$<?= $netTotal ?></td>
                </tr>
            </tfoot>
        </table>
    </body>
</html>
