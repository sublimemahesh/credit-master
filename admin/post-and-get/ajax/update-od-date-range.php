<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

$OD = new Od(NULL);

$result = $OD->checkOdDates($_POST['id'], $_POST['od_date_start'], $_POST['od_date_end']);
$array_res_row = $result['array_res'];

$END = new DateTime($_POST['od_date_start']);
$END->modify('-1 day');
$END = $END->format('Y-m-d');

$OD_1 = new Od($array_res_row['id']);

$OD_1->od_date_end = $END;

$OD_1->update();

$OD->loan = $_POST['id'];
$OD->od_date_start = $_POST['od_date_start'];
$OD->od_date_end = $_POST['od_date_end'];
$OD->od_interest_limit = $_POST['od_interest_limit'];

$result = $OD->create();


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
 