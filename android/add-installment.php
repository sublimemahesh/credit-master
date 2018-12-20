<?php

require("config.php");


if (!empty($_POST)) {
    $query = "INSERT INTO `installment` (`loan`,`installment_date`,`paid_date`,`time`,`paid_amount`,`collector`,`receipt_no`) VALUES (:loan, :instalmentdate, :paiddate, :paidtime, :paidamount, :collector, :receipt)";
    $params = array(
        ':loan' => $_POST['loan'],
        ':instalmentdate' => $_POST['instalmentdate'],
        ':paidtime' => $_POST['paidtime'],
        ':paiddate' => $_POST['paiddate'],
        ':paidamount' => $_POST['paidamount'],
        ':receipt' => $_POST['receipt_no'],
        ':collector' => $_POST['uid']
    );
    try {
        $stmt = $db->prepare($query);
        $result = $stmt->execute($params);
        $response["error"] = FALSE;
        $response["message"] = "success!";
        echo json_encode($response);
        
    } catch (PDOException $ex) {
        $response["error"] = TRUE;
        $response["message"] = "Database Error1. Please Try Again!";
        die(json_encode($response));
    }
} else {
    $response["error"] = TRUE;
    $response["message"] = "Please Try Again!";
    die(json_encode($response));
}
