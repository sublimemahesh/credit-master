<?php

require("config.php");

    $query = "SELECT (SELECT COUNT(id) FROM booking WHERE is_approved = 0) AS pendingbookingcount,(SELECT COUNT(id) FROM booking WHERE is_approved = 1) AS acceptedbookingcount,(SELECT COUNT(id) FROM booking WHERE is_approved = 2) AS cancelledbookingcount FROM `booking` WHERE user = :uid";
    
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