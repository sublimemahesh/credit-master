<?php

include_once(dirname(__FILE__) . '/../../class/include.php');


if (isset($_POST['create'])) {

    $POSTPONE_DATE = new PostponeDate(NULL);
    $VALID = new Validator();


    $POSTPONE_DATE->all = $_POST['all'];
    $POSTPONE_DATE->route = $_POST['route'];
    $POSTPONE_DATE->center = $_POST['center'];
    $POSTPONE_DATE->customer = $_POST['customer'];
    $POSTPONE_DATE->date = $_POST['date'];
    $POSTPONE_DATE->reason = $_POST['reason'];
    
    $VALID->check($POSTPONE_DATE, [
        'date' => ['required' => TRUE],
    ]);


    if ($VALID->passed()) {
        $POSTPONE_DATE->create();

        if (!isset($_SESSION)) {
            session_start();
        }

        $VALID->addError("Your data was saved successfully", 'success');
        $_SESSION['ERRORS'] = $VALID->errors();

          header("location: ../calender.php");
    } else {

        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}



if (isset($_POST['update'])) {


    $POSTPONE_DATE = new PostponeDate($_POST['id']);

    $POSTPONE_DATE->date = $_POST['date'];
    $POSTPONE_DATE->all = $_POST['all'];
    $POSTPONE_DATE->route = $_POST['route'];
    $POSTPONE_DATE->center = $_POST['center'];
    $POSTPONE_DATE->reason = $_POST['reason'];

    $VALID = new Validator();
    $VALID->check($POSTPONE_DATE, [
        'date' => ['required' => TRUE],
        'reason' => ['required' => TRUE],
    ]);



    if ($VALID->passed()) {
        $POSTPONE_DATE->update();

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