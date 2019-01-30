<?php

echo '<table border="1">';
echo '<tr><th>#</th><th>PAYMENT</th><th>INTEREST</th><th>PRINCIPAL</th><th>BALANCE</th></tr>';
$start_date = '2014-12-14';
$end_date = '2015-03-12';
$count = 0;
do {
    $count++;

    // calculate interest on outstanding balance
    $interest = $balance * $rate / 100;

    // what portion of payment applies to principal?
    $principal = $payment - $interest;

    // watch out for balance < payment
    if ($balance < $payment) {
        $principal = $balance;
        $payment = $interest + $principal;
    } // if
    // reduce balance by principal paid
    $balance = $balance - $principal;

    // watch for rounding error that leaves a tiny balance
    if ($balance < 0) {
        $principal = $principal + $balance;
        $interest = $interest - $balance;
        $balance = 0;
    } // if

    echo "<tr>";
    echo "<td>$count</td>";
    echo "<td>" . number_format($payment, 2, ".", ",") . "</td>";
    echo "<td>" . number_format($interest, 2, ".", ",") . "</td>";
    echo "<td>" . number_format($principal, 2, ".", ",") . "</td>";
    echo "<td>" . number_format($balance, 2, ".", ",") . "</td>";
    echo "</tr>";

    @$totPayment = $totPayment + $payment;
    @$totInterest = $totInterest + $interest;
    @$totPrincipal = $totPrincipal + $principal;

    if ($payment < $interest) {
        echo "</table>";
        echo "<p>Payment < Interest amount - rate is too high, or payment is too low</p>";
        exit;
    } // if
} while ($balance > 0);

echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td><b>" . number_format($totPayment, 2, ".", ",") . "</b></td>";
echo "<td><b>" . number_format($totInterest, 2, ".", ",") . "</b></td>";
echo "<td><b>" . number_format($totPrincipal, 2, ".", ",") . "</b></td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
echo "</table>";
?>