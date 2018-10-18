<?php
include_once(dirname(__FILE__) . '/../../class/include.php');


if (isset($_POST['create'])) {
    
    $INSTALLMENT = new Installment(NULL);
    $VALID = new Validator();

    $INSTALLMENT->loan = $_POST['loan'];
    $INSTALLMENT->paid_date = $_POST['paid_date'];
    $INSTALLMENT->paid_amount = $_POST['paid_amount'];
    $INSTALLMENT->additional_interest = $_POST['additional_interest'];
    $INSTALLMENT->paid_by = $_POST['paid_by'];


    $VALID->check($INSTALLMENT, [
        'paid_date' => ['required' => TRUE],
        'paid_by' => ['required' => TRUE],
        

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

    
    $INSTALLMENT = new Center($_POST['id']);

    $INSTALLMENT->name = $_POST['name'];
    $INSTALLMENT->address =$_POST['address'];
    $INSTALLMENT->center_leader_name = $_POST['center_leader_name'];


    $VALID = new Validator();
    $VALID->check($INSTALLMENT, [
        'name' => ['required' => TRUE],
        'address' => ['required' => TRUE],
        'center_leader_name' => ['required' => TRUE]

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

