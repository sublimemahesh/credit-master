<?php

include_once(dirname(__FILE__) . '/../../class/include.php');


if (isset($_POST['create'])) {

    $INSTALLMENT = new Installment(NULL);
    $VALID = new Validator();


    $INSTALLMENT->loan = $_POST['loan'];
    $INSTALLMENT->installment_date = $_POST['installment_date'];
    $INSTALLMENT->paid_date = $_POST['paid_date'];
    $INSTALLMENT->time = $_POST['time'];
    $INSTALLMENT->paid_amount = $_POST['paid_amount'];
    $INSTALLMENT->additional_interest = $_POST['additional_interest'];


    $VALID->check($INSTALLMENT, [
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
    $INSTALLMENT->installment_date = $_POST['installment_date'];
    $INSTALLMENT->paid_date = $_POST['paid_date'];
    $INSTALLMENT->paid_amount = $_POST['paid_amount'];
    $INSTALLMENT->additional_interest = $_POST['additional_interest'];
    $INSTALLMENT->status = $_POST['status'];

    $VALID = new Validator();
    $VALID->check($INSTALLMENT, [
        'paid_amount' => ['required' => TRUE],
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

