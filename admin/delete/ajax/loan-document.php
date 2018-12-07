<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');


if ($_POST['option'] == 'delete') {

    $LOAN_DOCUMENT = new LoanDocument($_POST['id']);
    unlink('../../../upload/loan/document/' . $LOAN_DOCUMENT->image_name);
    unlink('../../../upload/loan/document/thumb/' . $LOAN_DOCUMENT->image_name);
    $result = $LOAN_DOCUMENT->delete();

    if ($result) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}