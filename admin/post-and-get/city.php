<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if (isset($_POST['add-city'])) {

    $CITY = new City(NULL);
    $VALID = new Validator();
    $CITY->name = ucfirst($_POST['city_name']);
    $CITY->postal_code = $_POST['postal_code'];

    $VALID->check($CITY, [
        'name' => ['required' => TRUE],
    ]);
    if ($VALID->passed()) {
        $CITY->create();

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


    $CITY = new City($_POST['id']);

    $CITY->name = ucfirst($_POST['name']);
    $CITY->postal_code = $_POST['postal_code'];

    $VALID = new Validator();
    $VALID->check($CITY, [
        'name' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $CITY->update();
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
