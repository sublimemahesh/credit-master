<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

if ($_POST['action'] == 'DIRECTISSUE') {

    $LOAN = new Loan($_POST['loan_id']);

    $LOAN->effective_date = $_POST['effective_date'];
    $LOAN->issued_date = $_POST['issued_date'];
    $LOAN->issue_note = $_POST['issue_note'];
    $LOAN->issue_by = $_POST['issue_by'];
    $LOAN->status = 'issued';

    $history = $LOAN->getCustomersHistoryByloanId($LOAN->id);
    $LOAN->history = $history;



    $result = $LOAN->update();

    $VALID = new Validator();
    $VALID->addError("Loan was successfully issued!...", 'success');
    $_SESSION['ERRORS'] = $VALID->errors();

    echo json_encode(['status' => 'issued', 'data' => $result]);
    header('Content-type: application/json');
    exit();
}

