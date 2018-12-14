<?php
include_once(dirname(__FILE__) . '/../../class/include.php');

if (isset($_POST['add-city'])) {    
    
    $CITY = new City(NULL);
    $VALID = new Validator();
    $CITY->name = ucfirst($_POST['city_name']);

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

 