<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

$OD = new Od($_POST['id']);

$OD->loan = $_POST['loan_id'];
$OD->od_date_start = $_POST['od_date_start'];
$OD->od_date_end = $_POST['od_date_end'];
$OD->od_interest_limit = $_POST['od_interest_limit'];

$result = $OD->update();

if ($result == TRUE) {
    $data = array("status" => TRUE, "loan_id" => $_POST['loan_id']);
    header('Content-type: application/json');
    echo json_encode($data);
} else {
    $data = array("status" => FALSE);
    header('Content-type: application/json');
    echo json_encode($data);
    exit();
}
 