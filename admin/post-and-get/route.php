<?php
include_once(dirname(__FILE__) . '/../../class/include.php');


if (isset($_POST['add-route'])) {
    
    $ROUTE = new Route(NULL);
    $VALID = new Validator();

    $ROUTE->route_name = $_POST['route_name'];
    $ROUTE->route_code = $_POST['route_code'];
    $ROUTE->start_location = $_POST['start_location'];
    $ROUTE->end_location = $_POST['end_location'];


    $VALID->check($ROUTE, [
        'route_name' => ['required' => TRUE],
        'route_code' => ['required' => TRUE],
        'start_location' => ['required' => TRUE],
        'end_location' => ['required' => TRUE],

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

    
    $ROUTE = new Center($_POST['id']);

    $ROUTE->center_name = $_POST['center_name'];
    $ROUTE->address =$_POST['address'];
    $ROUTE->center_leader_name = $_POST['center_leader_name'];


    $VALID = new Validator();
    $VALID->check($ROUTE, [
        'center_name' => ['required' => TRUE],
        'address' => ['required' => TRUE],
        'center_leader_name' => ['required' => TRUE]

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

