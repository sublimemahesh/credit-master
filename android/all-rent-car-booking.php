<?php

require("config.php");

    $query = "SELECT * ,(SELECT name FROM rent_a_car WHERE id = rentcar) AS rentcarname FROM `rent_car_booking` WHERE user = :uid";
    
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
        
        // echo json_encode($data);
   
    //   $stmt = $db->prepare($query);
    //   $result = $stmt->execute($query);

    // echo $result;

    // $stmt = $db->query($query);
    // $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // echo json_encode($data);
    
?>