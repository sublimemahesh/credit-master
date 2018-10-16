<?php
include_once(dirname(__FILE__) . '/../../class/include.php');


if (isset($_POST['add-center'])) {
    
    $CENTER = new Center(NULL);
    $VALID = new Validator();

    $CENTER->name = $_POST['name'];
    $CENTER->address = $_POST['address'];
    $CENTER->center_leader_name = $_POST['center_leader_name'];


    $VALID->check($CENTER, [
        'name' => ['required' => TRUE],
        'address' => ['required' => TRUE],
        'center_leader_name' => ['required' => TRUE],

    ]);



    if ($VALID->passed()) {
        $CENTER->create();

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

    $CENTER->name = $_POST['name'];
    $CENTER->address =$_POST['address'];
    $CENTER->center_leader_name = $_POST['center_leader_name'];


    $VALID = new Validator();
    $VALID->check($CENTER, [
        'name' => ['required' => TRUE],
        'address' => ['required' => TRUE],
        'center_leader_name' => ['required' => TRUE]

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

