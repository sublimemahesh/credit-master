<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');


if ($_POST['action'] == 'CHECKOD') {

    $LOAN = new Loan($_POST["loan_id"]);  
    $result = $LOAN->getStatusbyDate($_POST["paid_date"]);
    
    $all_amount = explode("-", $result['all_amount']);
    
    echo json_encode(['all_amount' => $all_amount[1], 'od_amount' => $result['od_amount'], 'due_and_excess' => $result['due_and_excess']]);

    header('Content-type: application/json');
    exit();
}

