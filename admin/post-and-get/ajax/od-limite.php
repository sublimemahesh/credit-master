<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');


if ($_POST['action'] == 'CHECKOD') {

    $LOAN = new Loan($_POST["loan_id"]);

    $result = $LOAN->getOdAmount($_POST["paid_date"]);
    dd($result['od_limite']);
    echo json_encode(['od_limite' => $result['od_limite'], 'due_and_excess' => $result['due_and_excess'],'all_amount' => $result['all_amount'] ]);
    header('Content-type: application/json');
    exit();
}