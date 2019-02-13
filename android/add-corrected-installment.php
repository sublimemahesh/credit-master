<?php

require("config.php");


if (!empty($_POST)) {
    $query = "UPDATE `installment` SET `paid_date` = :paiddate ,`time` = :paidtime,`paid_amount`= :paidamount,`status`= 'paid' WHERE `id` = :loan";
    $params = array(
        ':loan' => $_POST['loan'],
        ':paidtime' => $_POST['paidtime'],
        ':paiddate' => $_POST['paiddate'],
        ':paidamount' => $_POST['paidamount']
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
