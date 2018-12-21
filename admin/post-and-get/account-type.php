<?php

include_once(dirname(__FILE__) . '/../../class/include.php');


if (isset($_POST['create'])) {

    $ACCOUNT_TYPE = new AccountType(NULL);
    $VALID = new Validator();

    $ACCOUNT_TYPE->name = ucfirst($_POST['name']);


    $VALID->check($ACCOUNT_TYPE, [
        'name' => ['required' => TRUE],
        
    ]);

    if ($VALID->passed()) {
        $ACCOUNT_TYPE->create();

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


    $ACCOUNT_TYPE = new Route($_POST['id']);

    $ACCOUNT_TYPE->name = ucfirst($_POST['name']);
    $ACCOUNT_TYPE->code = $_POST['code'];
    $ACCOUNT_TYPE->start_location = ucfirst($_POST['start_location']);
    $ACCOUNT_TYPE->end_location = ucfirst($_POST['end_location']);
    $ACCOUNT_TYPE->collector = $_POST['collector'];


    $VALID = new Validator();
    $VALID->check($ACCOUNT_TYPE, [
        'name' => ['required' => TRUE],
        'code' => ['required' => TRUE],
        'collector' => ['required' => TRUE],
    ]);

    if ($VALID->passed()) {
        $ACCOUNT_TYPE->update();

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

