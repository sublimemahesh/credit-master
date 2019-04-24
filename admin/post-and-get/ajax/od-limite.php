<?php

date_default_timezone_set("Asia/Calcutta");
$time = date('H:i:s');
include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');


if ($_POST['action'] == 'CHECKOD') {

    $LOAN = new Loan($_POST["loan_id"]);
    $result = $LOAN->getSelectedDayLoanDetails($_POST["paid_date"]);
 

    echo json_encode(['all_amount' => $result['all_amount'], 'od_amount' => $result['od_amount'], 'due_and_excess' => number_format($result['due_and_excess'], 2)]);

    header('Content-type: application/json');
    exit();
}

