<?php

include_once(dirname(__FILE__) . '/../../class/include.php');


if (isset($_POST['add-center'])) {

    $CENTER = new Center(NULL);
    $VALID = new Validator();

    $CENTER->name = ucfirst($_POST['name']);
    $CENTER->address = $_POST['address'];
    $CENTER->leader = $_POST['leader'];
    $CENTER->collector = $_POST['collector'];


    $VALID->check($CENTER, [
        'name' => ['required' => TRUE],
        'address' => ['required' => TRUE],
        'leader' => ['required' => TRUE],
        'collector' => ['required' => TRUE],
    ]);



    if ($VALID->passed()) {

        $RESULT = $CENTER->create();

        $CUSTOMER = new Customer(NULL);
        $CUSTOMER->updateCustomerCenter($RESULT->id, $RESULT->leader);

        header('Location: ' . $_SERVER['HTTP_REFERER']);

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


    $CENTER = new Center($_POST['id']);

    $CENTER->name = ucfirst($_POST['name']);
    $CENTER->address = $_POST['address'];
    $CENTER->leader = $_POST['leader'];
    $CENTER->collector = $_POST['collector'];


    $VALID = new Validator();
    $VALID->check($CENTER, [
        'name' => ['required' => TRUE],
        'address' => ['required' => TRUE],
        'leader' => ['required' => TRUE],
        'collector' => ['required' => TRUE]
    ]);



    if ($VALID->passed()) {
        $CENTER->update();

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

