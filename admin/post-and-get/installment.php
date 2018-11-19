<?php

include_once(dirname(__FILE__) . '/../../class/include.php');


if (isset($_POST['create'])) {

    $INSTALLMENT = new Installment(NULL);
    $VALID = new Validator();
    
    $INSTALLMENT->loan = $_POST['loan'];
    $INSTALLMENT->paid_date = $_POST['paid_date'];
    $INSTALLMENT->paid_amount = $_POST['paid_amount'];
    $INSTALLMENT->additional_interest = $_POST['additional_interest'];


    $VALID->check($INSTALLMENT, [
        'paid_date' => ['required' => TRUE],
        'paid_amount' => ['required' => TRUE],
    ]);


    if ($VALID->passed()) {
        $INSTALLMENT->create();

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


    $INSTALLMENT = new Installment($_POST['id']);

    $INSTALLMENT->paid_date = $_POST['paid_date'];
    $INSTALLMENT->paid_amount = $_POST['paid_amount'];
    $INSTALLMENT->additional_interest = $_POST['additional_interest'];
 


    $VALID = new Validator();
    $VALID->check($INSTALLMENT, [
        'paid_date' => ['required' => TRUE],
         
    ]);



    if ($VALID->passed()) {
        $INSTALLMENT->update();

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

