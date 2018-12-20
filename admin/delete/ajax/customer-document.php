<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');


if ($_POST['option'] == 'delete') {

    $CUSTOMER_DOCUMENT = new CustomerDocument($_POST['id']);
    unlink('../../../upload/customer/document/' . $CUSTOMER_DOCUMENT->image_name);
    unlink('../../../upload/customer/document/thumb/' . $CUSTOMER_DOCUMENT->image_name);
    $result = $CUSTOMER_DOCUMENT->delete();

    if ($result) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}