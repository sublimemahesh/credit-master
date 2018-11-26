<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

if ($_POST['action'] == 'GETREGTYPE') {

    if ($_POST['type'] == 'route') {
        $ROUTE = new Route(NULL);
        $result = $ROUTE->all();
        echo json_encode(['type' => 'route', 'data' => $result]);
        header('Content-type: application/json');
        exit();
    } else if ($_POST['type'] == 'center') {
        $CENTER = new Center(NULL);
        $result = $CENTER->all();
        echo json_encode(['type' => 'center', 'data' => $result]);
        header('Content-type: application/json');
        exit();
    }
}


if ($_POST['action'] == 'CHECKNICNUMBERINCUSTOMER') {

    $CUSTOMER_NIC = new Customer(NULL);

    $result = $CUSTOMER_NIC->CheckNicNumberInCustomer($_POST["NicNumber"]);

    if ($result == TRUE) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    } else {
        header('Content-type: application/json');
        exit();
    }
}

if ($_POST['action'] == 'GETBANKNAME') {
    $BANK_NAME = new Branch(NULL);

    $result = $BANK_NAME->getBrachByBank($_POST["bank_id"]);
   
    if ($result == TRUE) {
        $data = array("status" => TRUE);       
        echo json_encode(['type' => 'name', 'data' => $result]);
        header('Content-type: application/json');
    } else {
        header('Content-type: application/json');
        exit();
    }
}
if ($_POST['action'] == 'CHECKMOBILENUMBERINCUSTOMER') {

    $CUSTOMER_MOBILE_NUMBER = new Customer(NULL);

    $result = $CUSTOMER_MOBILE_NUMBER->CheckMobileNumberInCustomer($_POST["MobileNumber"]);
    if ($result == TRUE) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    } else {
        header('Content-type: application/json');
        exit();
    }
}


