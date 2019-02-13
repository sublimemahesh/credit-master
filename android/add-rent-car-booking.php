<?php

    require("config.php");
    
        date_default_timezone_set('Asia/Colombo');

        $now = date('Y-m-d H:i:s');

    if (!empty($_POST)) {
            $query = "INSERT INTO rent_car_booking (id, user, rentcar, start_date, end_date, booked_date_time, start_destination, end_destination, price) VALUES (:bookingid, :user, :rentcar, :startdate, :enddate, :date_booked, :startdestination, :enddestination, :price)";
            $params = array(
                ':bookingid' => '',
                ':user' => $_POST['user'],
                ':rentcar' => $_POST['rentcar'],
                ':startdate' => $_POST['startdate'],
                ':enddate' => $_POST['enddate'],
                ':date_booked' => $now,
                ':startdestination' => $_POST['startdestination'],
                ':enddestination' => $_POST['enddestination'],
                ':price' => $_POST['price']
            );
            try {
                $stmt = $db->prepare($query);
                $result1 = $stmt->execute($params);
               }

			catch (PDOException $ex) {

            $response["error"] = TRUE;
            $response["message"] = "Database Error1. Please Try Again!";
            die(json_encode($response));
        }
 
    if($result1){
	
        $query = "SELECT * FROM users WHERE unique_id = :user_id";

        //now lets update what :user should be
        $query_params = array(
            ':user_id' =>$_POST['user']
        );

        try {
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        }
		
        catch (PDOException $ex) {
            $response["error"] = TRUE;
            $response["message"] = "Database Error2. Please Try Again!";
            die(json_encode($response));
        }


        $vehicle_query = "SELECT * FROM rent_a_car WHERE id = :rent_car_id";

        //now lets update what :user should be
        $vehicle_query_params = array(
            ':rent_car_id' =>$_POST['rentcar']
        );

        try {
            $vehicle_statement = $db->prepare($vehicle_query);
            $vehicle_result = $vehicle_statement->execute($vehicle_query_params);
        }
		
        catch (PDOException $ex) {
            $response["error"] = TRUE;
            $response["message"] = "Database Error3. Please Try Again!";
            die(json_encode($response));
        }

        $vehicle_row = $vehicle_statement->fetch();
        $row = $stmt->fetch();
        
        

        if ($row) {

            $name = $row["name"];
            $email = $row['email'];
            $contact = $row['contact_no'];
            
            $rentcar = $_POST['rentcar'];
            $startdate = $_POST['startdate'];
            $endtime = $_POST['enddate'];
            
            $startdestination = $_POST['startdestination'];
            $enddestination = $_POST['enddestination'];
    
            $price = $_POST['price'];
            
            $subject = "Taxi App - Rent a Car Booking";
            $message = "Hello $name,\n\nYou have a booking..\n\nYour booking details are bellow:\n\nEmail : $email\n\nContact : $contact\n\nRent Car : $rentcar\n\nStart Date : $startdate\n\nEnd Date : $endtime\n\nStart Destination : $startdestination\n\nEnd Destination : $enddestination\n\nPrice : Rs $price\n\nRegards,\nTaxi App";
            $from = "info@galle.website";
            $headers = "From:" . $from;

            mail($email,$subject,$message,$headers);

            $response["error"] = FALSE;
            $response["message"] = "Register successful!";
            echo json_encode($response);
        }else{
            $response["error"] = TRUE;
            $response["message"] = "Mail Query Error";
            die(json_encode($response));
        }
    }
        
    
    } else {
        $response["error"] = TRUE;
                $response["message"] = "Please Try Again!";
                die(json_encode($response));
    }
