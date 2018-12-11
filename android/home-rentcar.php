<?php

require("config.php");

    $query = "SELECT (SELECT COUNT(id) FROM rent_car_booking WHERE status = 0) AS pendingrentcount,(SELECT COUNT(id) FROM rent_car_booking WHERE status = 1) AS acceptedrentcount,(SELECT COUNT(id) FROM rent_car_booking WHERE status = 2) AS cancelledrentcount FROM `rent_car_booking` WHERE user = :uid LIMIT 1";
    
     $query_params = array(
            ':uid' => $_POST['uid']
        );
    
        try {
            $stmt   = $db->prepare($query);
            $result = $stmt->execute($query_params);
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($data);
        }
        catch (PDOException $ex) {
            $response["error"] = true;
            $response["message"] = $ex;
            die(json_encode($response));
        }
?>