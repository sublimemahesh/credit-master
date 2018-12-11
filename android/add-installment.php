<?php

require("config.php");


if (!empty($_POST)) {
    $query = "INSERT INTO `installment` (`loan`,`installment_date`,`paid_date`,`paid_amount`,`additional_interest`) VALUES (:loan, :instalmentdate, :paiddate, :paidamount, :interestamount)";
    $params = array(
        ':loan' => $_POST['loan'],
        ':instalmentdate' => $_POST['instalmentdate'],
        ':paiddate' => $_POST['paiddate'],
        ':paidamount' => $_POST['paidamount'],
        ':interestamount' => $_POST['interestamount']
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
