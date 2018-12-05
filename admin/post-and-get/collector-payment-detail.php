<?php

include_once(dirname(__FILE__) . '/../../class/include.php');


if (isset($_POST['create'])) {

    $COLLECTORPYMENTDETAILS = new CollectorPaymentDetail(NULL);
    $VALID = new Validator();

    $COLLECTORPYMENTDETAILS->collector_id = $_POST['collector_id'];
    $COLLECTORPYMENTDETAILS->date = $_POST['date'];
    $COLLECTORPYMENTDETAILS->ammount = $_POST['ammount'];
    if ('is_issuied' == $_POST['select_type']) {
        $COLLECTORPYMENTDETAILS->is_issuied = 1;
    } elseif ('is_recived' == $_POST['select_type']) {
        $COLLECTORPYMENTDETAILS->is_recived = 1;
    } elseif ('is_settled' == $_POST['select_type']) {
        $COLLECTORPYMENTDETAILS->is_settled = 1;
    }



    $VALID->check($COLLECTORPYMENTDETAILS, [
        'date' => ['required' => TRUE],
    ]);

    if ($VALID->passed()) {
        $COLLECTORPYMENTDETAILS->create();

        if (!isset($_SESSION)) {
            session_start();
        }

        $VALID->addError("Your data was saved successfully", 'success');
        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {

        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

if (isset($_POST['update'])) {

    
    $COLLECTORPYMENTDETAILS = new CollectorPaymentDetail($_POST['id']);
    
    $COLLECTORPYMENTDETAILS->collector_id = $_POST['collector_id'];
    $COLLECTORPYMENTDETAILS->date = $_POST['date'];
    $COLLECTORPYMENTDETAILS->ammount = $_POST['ammount'];
     
    if ("is_issuied" == $_POST['select_type']) {
        $COLLECTORPYMENTDETAILS->is_issuied = 1;
       
    } elseif ("is_recived" == $_POST['select_type']) {
        $COLLECTORPYMENTDETAILS->is_recived = 1;
    } elseif ("is_settled" == $_POST['select_type']) {
        $COLLECTORPYMENTDETAILS->is_settled = 1;
    }


    $VALID = new Validator();
    $VALID->check($COLLECTORPYMENTDETAILS, [
        'date' => ['required' => TRUE],
    ]);



    if ($VALID->passed()) {
        $COLLECTORPYMENTDETAILS->update();

        if (!isset($_SESSION)) {
            session_start();
        }

        $VALID->addError("Your changes saved successfully", 'success');

        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {

        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['ERRORS'] = $VALID->errors();
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

