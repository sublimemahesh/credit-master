<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

$LOAN = new Loan($_POST['id']);
$LOAN->od_limit = $_POST['od_limit'];
$result = $LOAN->updateOdLimit();

if ($result == TRUE) {
    $data = array("status" => TRUE, "id" => $_POST['id']);
    header('Content-type: application/json');
    echo json_encode($data);
} else {
    $data = array("status" => FALSE);
    header('Content-type: application/json');
    echo json_encode($data);
    exit();
}

