<?php

include_once(dirname(__FILE__) . '/../../class/include.php');


$USER = new User(NULL);

$email = $_POST['email'];

if (empty($email)) {
    header('Location: ../forget-password.php?message=11');
    exit();
}

if ($USER->checkEmail($email)) {

    if ($USER->GenarateCode($email)) {
        $res = $USER->SelectForgetUser($email);

        $username = $USER->username;
        $email = $USER->email;
        $resetcode = $USER->restCode;

        date_default_timezone_set('Asia/Colombo');

        $todayis = date("l, F j, Y, g:i a");

        $subject = 'Dashboard - Password Reset';
        $from = 'noreply@sublime.lk'; // give from email address


        $headers = "From: " . $from . "\r\n";
        $headers .= "Reply-To: " . $email . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $html = "<table style='border:solid 1px #F0F0F0; font-size: 15px; font-family: sans-serif; padding: 0;'>";

        $html .= "<tr><th colspan='3' style='font-size: 18px; padding: 30px 25px 0 25px; color: #fff; text-align: center; background-color: #4184F3;'><h2>Sublime Holdings</h2> </th> </tr>";

        $html .= "<tr><td colspan='3' style='font-size: 16px; padding: 20px 25px 10px 25px; color: #333; text-align: left; background-color: #fff;'><h3>" . $subject . "</h3> </td> </tr>";

        $html .= "<tr><td colspan='3' style='font-size: 14px; padding: 5px 25px 10px 25px; color: #666; background-color: #fff; line-height: 25px;'><b>Password Reset Code: </b> " . $resetcode . "</td></tr>";

        $html .= "<tr><td colspan='3' style='font-size: 14px; padding: 0 25px 10px 25px; color: #666; background-color: #fff; '><b>Username: </b> " . $username . "</td></tr>";

        $html .= "<tr><td colspan='3' style='font-size: 14px; background-color: #FAFAFA; padding: 25px; color: #333; font-weight: 300; text-align: justify; '>Thank you</td></tr>";

        $html .= "</table>";

        if (mail($email, $subject, $html, $headers)) {
            header('Location: ../reset-password.php?message=12');
        } else {
            header('Location: ../reset-password.php?message=14');
        }
    }



    exit();
} else {
    header('Location: ../forget-password.php?message=13');
    exit();
}

