<?php

require("config.php");

if (!empty($_POST)) {

    $response = array("error" => FALSE);

    $query = "SELECT * FROM user WHERE username = :username";

    $query_params = array(
        ':username' => $_POST['username']
    );

    try {
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }

    catch (PDOException $ex) {
        $response["error"] = true;
        $response["message"] = "Database Error1. Please Try Again!";
        die(json_encode($response));
    }

    $validated_info = false;
    $login_ok = false;
    $username = $_POST['username'];

    $row = $stmt->fetch();

    if (md5($_POST['password']) == $row['password']) {
        $login_ok = true;
    }

    if ($login_ok == true) {
        $response["error"] = false;
        $response["message"] = "Login successful!";
        $response["user"]["uid"] = $row["id"];
        $response["user"]["name"] = $row["name"];
        $response["user"]["username"] = $row["username"];
        $response["user"]["email"] = $row["email"];
        $response["user"]["contact"] = 13;
        $response["user"]["verified"] = $row["isActive"];
        $response["user"]["created_at"] = $row["createdAt"];
        die(json_encode($response));

    } else {
        $response["error"] = true;
        $response["message"] = "Invalid Credentials!";
        die(json_encode($response));
    }

} else {

    echo 'Micro Credit';
}

?>