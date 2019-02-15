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

if ($_POST['action'] == 'CHECKNIC&MOBILEINCUSTOMER') {

    $CUSTOMER = new Customer(NULL);

    $UPPERNIC = strtoupper($_POST["NicNumber"]);

    $nic = $CUSTOMER->CheckNicNumberInCustomer($UPPERNIC);
    $mobile = $CUSTOMER->CheckMobileNumberInCustomer($_POST["MobileNumber"]);

    if ($nic == TRUE) {
        $data = array("status" => 'nicIsExist');
        header('Content-type: application/json');
        echo json_encode($data);
    } else if ($mobile == TRUE) {
        $data = array("status" => 'mobileIsExist');
        header('Content-type: application/json');
        echo json_encode($data);
    } else {
        $data = array("status" => 'false');
        header('Content-type: application/json');
        echo json_encode($data);
        exit();
    }
}

if ($_POST['action'] == 'CHECKNIC&MOBILEEXISTCUSTOMER') {
    $CUSTOMER = new Customer(NULL);
    $UPPERNIC = strtoupper($_POST["nicNumber"]);
    $result1 = $CUSTOMER->CheckNicNumberInCustomerExist($UPPERNIC, $_POST["id"]);
    $result2 = $CUSTOMER->CheckMobileNumberInCustomerExist($_POST["mobileNumber"], $_POST["id"]);
    if ($result1 == TRUE) {
        $data = array("status" => 'nicIsExist');
        header('Content-type: application/json');
        echo json_encode($data);
    } else if ($result2 == TRUE) {
        $data = array("status" => 'mobileIsExist');
        header('Content-type: application/json');
        echo json_encode($data);
    } else {
        $data = array("status" => 'fales');
        header('Content-type: application/json');
        echo json_encode($data);
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

//branch code
if ($_POST['action'] == 'GETBRANCHCODE') {

    $BRANCH = new Branch(NULL);
    $result = $BRANCH->getBrachCode($_POST["branch_id"]);

    if ($result == TRUE) {
        echo json_encode(['branch_codes' => $result['code']]);
        header('Content-type: application/json');
    } else {
        header('Content-type: application/json');
        exit();
    }
}

//check customer bank details
if ($_POST['action'] == 'CHECKCUSTOMERBANKDETAILS') {

    $CUSTOMER = new Customer(NULL);
    $result = $CUSTOMER->checkCustomerBankDetails($_POST["customer"]);
  
    if ($result == TRUE) {
        echo json_encode(['status' => 'sucess','data' => $result]);
        header('Content-type: application/json');
    } else {
        header('Content-type: application/json');
        exit();
    }
}

if ($_POST['action'] == 'ADDBRANCHNAME') {

    $BRANCH = new Branch(NULL);

    $BRANCH->bank_id = $_POST['bank_id'];
    $BRANCH->name = $_POST['branch_name'];

    $result = $BRANCH->create();

    $allbranch = $BRANCH->getBrachByBank($_POST['bank_id']);

    if ($result == TRUE) {
        $data = array("status" => TRUE);
        echo json_encode(['result' => $result, 'branches' => $allbranch]);
        header('Content-type: application/json');
    } else {
        header('Content-type: application/json');
        exit();
    }
}

if ($_POST['action'] == 'CHECKGUARANTER_2') {

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

//customer has active loan

if ($_POST['action'] == 'CHECKCUSTOMERHASLOAN') {

    $LOAN = new Loan(NULL);

    $result = $LOAN->CheckCustomerHasLoan($_POST["customer"]);

    if ($result == TRUE) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    } else {
        header('Content-type: application/json');
        exit();
    }
}