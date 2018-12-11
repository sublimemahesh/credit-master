<?php

require("config.php");

   if (!empty($_POST))  {


    $query = "SELECT * FROM users WHERE email = :email";
    
        $query_params = array(
            ':email' => $_POST['old_email']
        );
    
        try {
            $stmt   = $db->prepare($query);
            $result = $stmt->execute($query_params);
            
        }
        catch (PDOException $ex) {

            $response["error"] = true;
            $response["message"] = "Database Error1. Please Try Again!";
            die(json_encode($response));
        
        }

        $success = false;

        $row = $stmt->fetch();
        
$name = $_POST['name'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$oldemail = $_POST['old_email'];
       
        
          if ($row) {
            
            $stmt = $db->prepare("UPDATE users SET name = :newName, email = :newEmail, contact_no = :newContact WHERE email = :oldEmail");
            $stmt->bindparam(":newName", $name);
            $stmt->bindparam(":newEmail",$email);
            $stmt->bindparam(":newContact",$contact);
            $stmt->bindparam(":oldEmail",$oldemail);
            $stmt->execute();
            $success = true;
          }
          
            if ($success == true) {
           
        
            $response["error"] = false;
            $response["message"] = "Your details have been changed";
            die(json_encode($response));
        } else {
            $response["error"] = true;
            $response["message"] = "Invalid Oparation!";
            die(json_encode($response));        
        }



   
            // $stmt = $db->prepare("UPDATE users SET name = :newName WHERE email = :oldEmail");
            // $stmt->bindparam(":newName", $name);
            // $stmt->bindparam(":newEmail",$email);
            // $stmt->bindparam(":newContact",$contact);
            // $stmt->bindparam(":oldEmail",$oldemail);
            // $stmt->execute();
            // $success = true;
     
        if ($success == true) {
            $response["error"] = false;
            $response["message"] = "your details have been changed";
            $response["mail"] = $message;
            die(json_encode($response));
        }
   

} else {
            $response["error"] = TRUE;
            $response["message"] = "post Error";
            die(json_encode($response));
}

