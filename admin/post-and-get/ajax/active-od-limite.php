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
   
    //get show end date in message
    $END_DATE = new DateTime($_POST['od_date_start']);
    $END_DATE->modify('-1 days');
    $END_DATE = $END_DATE->format('Y-m-d');

    $result = $OD->checkOdDates($_POST['id'], $_POST['od_date_start'], $end);
    $array_res_row = $result['array_res'];

    if ($array_res_row['od_date_start'] == NULL) {

        if ($result['status'] == TRUE) {
            $data = array("status" => TRUE, "od_date_start" => $array_res_row['od_date_start'], "od_date_end" => $END_DATE,"arr_od_end_date" => $array_res_row['od_date_end'],"id"=>$_POST['id']);
            header('Content-type: application/json');
            echo json_encode($data);
        } else {
            $data = array("status" => FALSE);
            header('Content-type: application/json');
            echo json_encode($data);
            exit();
        }
    } else {
        if ($result['status'] == TRUE) {
            $data = array("status" => TRUE, "od_date_start" => $array_res_row['od_date_start'], "od_date_end" => $END_DATE,"id"=>$_POST['id']);
            header('Content-type: application/json');
            echo json_encode($data);
        } else {
            $data = array("status" => FALSE);
            header('Content-type: application/json');
            echo json_encode($data);
            exit();
        }
    }
}

if ($_POST['action'] == 'CHECKSAMEDATES') {

    $OD = new Od(NULL);
    if ($_POST['od_date_end'] == NULL) {
        $END = new DateTime($_POST['od_date_start']);
        $END->modify('+2 years');
        $end = $END->format('Y-m-d');
    } else {
        $end = $_POST['od_date_end'];
    }
 

    $result = $OD->checkSameDates($_POST['id'], $_POST['od_date_start'], $end);
    $array_res_row = $result['array_res'];

    if ($array_res_row['od_date_start'] == NULL) {

        if ($result['status'] == TRUE) {
            $data = array("status" => TRUE,);
            header('Content-type: application/json');
            echo json_encode($data);
        } else {
            $data = array("status" => FALSE);
            header('Content-type: application/json');
            echo json_encode($data);
            exit();
        }
    } else {
        if ($result['status'] == TRUE) {
            $data = array("status" => TRUE,);
            header('Content-type: application/json');
            echo json_encode($data);
        } else {
            $data = array("status" => FALSE);
            header('Content-type: application/json');
            echo json_encode($data);
            exit();
        }
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
 