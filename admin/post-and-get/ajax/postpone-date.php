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


if ($_POST['action'] == 'GETCUSTOMER') {
 header('Content-type: application/json');
    if ($_POST['type'] == 'route') {
        $CUSTOMER = new Customer(NULL);
        $result = $CUSTOMER->getCustomerByRoute($_POST['value']);
        echo json_encode(['type' => 'route', 'data' => $result]);
        exit();
    } else if ($_POST['type'] == 'center') {
        $CUSTOMER = new Customer(NULL);
        $result = $CUSTOMER->getCustomrByCenter($_POST['value']);
        echo json_encode(['type' => 'center', 'data' => $result]);
        exit();
    }
}