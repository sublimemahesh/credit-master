<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

//Check od dates in date range
if ($_POST['action'] == 'CHECKODDATES') {

    $OD = new Od(NULL);
    if ($_POST['od_date_end'] == NULL) {
        $END = new DateTime($_POST['od_date_start']);
        $END->modify('+2 years');
        $end = $END->format('Y-m-d');
    } else {
        $end = $_POST['od_date_end'];
    }

    $result = $OD->checkOdDates($_POST['id'], $_POST['od_date_start'], $end);
    $array_res_row = $result['array_res'];

    if ($result['status'] == TRUE) {
        $data = array("status" => TRUE, "od_date_start" => $array_res_row['od_date_start']);
        header('Content-type: application/json');
        echo json_encode($data);
    } else {
        $data = array("status" => FALSE);
        header('Content-type: application/json');
        echo json_encode($data);
        exit();
    }
}

//Check od has customer 
if ($_POST['action'] == 'CHECKOD') {

    $OD = new Od(NULL);
    $result = $OD->checkOdByLoan($_POST['id']);

    if ($result == TRUE) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    } else {
        $data = array("status" => FALSE);
        header('Content-type: application/json');
        echo json_encode($data);
        exit();
    }
} 
 