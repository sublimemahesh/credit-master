<?php

include_once(dirname(__FILE__) . '/../../class/include.php');


if (isset($_POST['create'])) {

    $EXPENSES = new Expenses(NULL);
    $VALID = new Validator();

    $EXPENSES->date = $_POST['date'];
    $EXPENSES->amount = $_POST['amount'];
    $EXPENSES->time = $_POST['time'];
    $EXPENSES->reason = $_POST['reason'];


    $VALID->check($EXPENSES, [
        'date' => ['required' => TRUE],
    ]);



    if ($VALID->passed()) {

        $EXPENSES->create();


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


    $EXPENSES = new Expenses($_POST['id']);

    $EXPENSES->date = $_POST['date'];
    $EXPENSES->time = $_POST['time'];
    $EXPENSES->amount = $_POST['amount'];
    $EXPENSES->reason = $_POST['reason'];


    $VALID = new Validator();
    $VALID->check($EXPENSES, [
        'date' => ['required' => TRUE], 
    ]);



    if ($VALID->passed()) {
        $EXPENSES->update();

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

