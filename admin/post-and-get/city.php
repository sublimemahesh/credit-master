<?php
include_once(dirname(__FILE__) . '/../../class/include.php');


if (isset($_POST['add-city'])) {
    
    
    $CITY = new City(NULL);
    $VALID = new Validator();

    $CITY->name = $_POST['city_name'];


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

    
    $CITY = new Route($_POST['id']);

    $CITY->route_name = $_POST['route_name'];
    $CITY->route_code =$_POST['route_code'];
    $CITY->start_location = $_POST['start_location'];
    $CITY->end_location = $_POST['end_location'];


    $VALID = new Validator();
    $VALID->check($CITY, [
        'route_name' => ['required' => TRUE],
        'route_code' => ['required' => TRUE],
      

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

