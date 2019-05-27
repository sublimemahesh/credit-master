<?php

date_default_timezone_set("Asia/Calcutta");
$time = date('H:i:s');
include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');


if ($_POST['action'] == 'CHECKOD') {

    $LOAN = new Loan($_POST["loan_id"]);
    $result = $LOAN->getSelectedDayLoanStatus($_POST["paid_date"]);
   
    $all_amount = explode("-", $result['all_arress']);
 
    echo json_encode(['all_amount' => round($all_amount[1],2), 'od_amount' => $result['od_amount'], 'due_and_excess' =>  $result['actual-due']]);

    header('Content-type: application/json');
    exit();
}

