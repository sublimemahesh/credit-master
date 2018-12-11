<?php

require("config.php");
    $query = "SELECT * FROM rent_a_car ORDER BY `sort` ASC";
    //   $stmt = $db->prepare($query);
    //   $result = $stmt->execute($query);
    // echo $result;
    $stmt = $db->query($query);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data);
?>