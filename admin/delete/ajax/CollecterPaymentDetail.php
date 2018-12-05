<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');


if ($_POST['option'] == 'delete') {
    $COLLECTORPYMENTDETAILS = new CollectorPaymentDetail($_POST['id']);

    $result = $COLLECTORPYMENTDETAILS->delete();

    if ($result) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}