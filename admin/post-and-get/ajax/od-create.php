<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

$OD = new Od(NULL);
if ($_POST['od_date_end'] == NULL) {
    $END = new DateTime($_POST['od_date_start']);
    $END->modify('+2 years');
    $end = $END->format('Y-m-d');
}else{
    $end = $_POST['od_date_end'];
} 

$OD->loan = $_POST['id'];
$OD->od_date_start = $_POST['od_date_start'];
$OD->od_date_end = $end;
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
 