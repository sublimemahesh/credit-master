<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');


if ($_POST['action'] == 'CHECKOD') {

    $LOAN = new Loan($_POST["loan_id"]);
    $result = $LOAN->getOdAmount($_POST["paid_date"]);  
    echo json_encode(['all_amount' => $result['all_amount'], 'od_amount' => $result['od_amount'], 'due_and_excess' => $result['due_and_excess']]);

    header('Content-type: application/json');
    exit();
}

