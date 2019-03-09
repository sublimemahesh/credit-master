<?php

require("config.php");

if (!empty($_POST)) {
    $query = "INSERT INTO `installment` (`loan`,`paid_date`,`time`,`paid_amount`,`additional_interest`,`collector`,`receipt_no`,`type`) VALUES (:loan, :paiddate, :paidtime, :paidamount, :paidinterest, :collector, :receipt, :type)";
    $params = array(
        ':loan' => $_POST['loan'],
        ':paidtime' => $_POST['paidtime'],
        ':paiddate' => $_POST['paiddate'],
        ':paidamount' => $_POST['paidamount'],
        ':paidinterest' => $_POST['paidinterest'],
        ':receipt' => $_POST['receipt_no'],
        ':type' => "installment",
        ':collector' => $_POST['uid']
    );
    try {
        $stmt = $db->prepare($query);
        $result = $stmt->execute($params);
        $response["error"] = FALSE;
        $response["message"] = "success!";
        echo json_encode($response);
        
        
        if ($_POST['loan_status'] == "complete") {
  
  $stmt = $db->prepare("UPDATE loan SET status = 'completed' WHERE id = :loanId");
            $stmt->bindparam(":loanId", $_POST['loan']);
            $stmt->execute();
}
        
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
