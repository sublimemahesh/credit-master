<?php

include_once(dirname(__FILE__) . '/../../class/include.php');


if (isset($_POST['add-route'])) {

    $ROUTE = new Route(NULL);
    $VALID = new Validator();

    $ROUTE->name = ucfirst($_POST['name']);
    $ROUTE->code = $_POST['code'];
    $ROUTE->start_location = ucfirst($_POST['start_location']);
    $ROUTE->end_location = ucfirst($_POST['end_location']);
    $ROUTE->collector = $_POST['collector'];


    $VALID->check($ROUTE, [
        'name' => ['required' => TRUE],
        'code' => ['required' => TRUE],
        'start_location' => ['required' => TRUE],
        'end_location' => ['required' => TRUE],
        'collector' => ['required' => TRUE],
    ]);

    if ($VALID->passed()) {
        $ROUTE->create();

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


    $ROUTE = new Route($_POST['id']);

    $ROUTE->name = ucfirst($_POST['name']);
    $ROUTE->code = $_POST['code'];
    $ROUTE->start_location = ucfirst($_POST['start_location']);
    $ROUTE->end_location = ucfirst($_POST['end_location']);
    $ROUTE->collector = $_POST['collector'];


    $VALID = new Validator();
    $VALID->check($ROUTE, [
        'name' => ['required' => TRUE],
        'code' => ['required' => TRUE],
        'collector' => ['required' => TRUE],
    ]);

    if ($VALID->passed()) {
        $ROUTE->update();

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

