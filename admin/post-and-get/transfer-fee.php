<?php

include_once(dirname(__FILE__) . '/../../class/include.php');


if (isset($_POST['create'])) {

    $TRANSFER_FEE = new TransferFee(NULL);
    $VALID = new Validator();

    $TRANSFER_FEE->from_account = $_POST['from_account'];
    $TRANSFER_FEE->to_account = $_POST['to_account'];
    $TRANSFER_FEE->date = $_POST['date'];
    $TRANSFER_FEE->time = $_POST['time'];
    $TRANSFER_FEE->amount = $_POST['amount'];
    $TRANSFER_FEE->purpose = $_POST['purpose'];


    $VALID->check($TRANSFER_FEE, [
        'from_account' => ['required' => TRUE],
        'to_account' => ['required' => TRUE],
        'amount' => ['required' => TRUE],
    ]);

    if ($VALID->passed()) {
        $TRANSFER_FEE->create();

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


    $TRANSFER_FEE = new TransferFee($_POST['id']);

    $TRANSFER_FEE->from_account = $_POST['from_account'];
    $TRANSFER_FEE->to_account = $_POST['to_account'];
    $TRANSFER_FEE->date = $_POST['date'];
    $TRANSFER_FEE->time = $_POST['time'];
    $TRANSFER_FEE->amount = $_POST['amount'];
    $TRANSFER_FEE->purpose = $_POST['purpose'];


    $VALID = new Validator();
    $VALID->check($TRANSFER_FEE, [
        'from_account' => ['required' => TRUE],
        'to_account' => ['required' => TRUE],
        'amount' => ['required' => TRUE],
    ]);

    if ($VALID->passed()) {
        $TRANSFER_FEE->update();

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

