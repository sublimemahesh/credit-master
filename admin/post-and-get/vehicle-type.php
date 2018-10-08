<?php

include_once(dirname(__FILE__) . '/../../class/include.php');
include_once(dirname(__FILE__) . '/../auth.php');


if (isset($_POST['add-vehicle'])) {

    $VEHICLE_TYPE = New Vehicle_type(NULL);
    $VALID = new Validator();


    $VEHICLE_TYPE->name = $_POST['name'];

    $VALID->check($VEHICLE_TYPE, [
        'name' => ['required' => TRUE],
    ]);

    if ($VALID->passed()) {
        $VEHICLE_TYPE->create();

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
if (isset($_POST['edit-vehicle-type'])) {
  
    $VEHICLE_TYPE = New Vehicle_type($_POST['id']);
    $VALID = new Validator();

    $VEHICLE_TYPE->name = $_POST['name'];

    $VALID->check($VEHICLE_TYPE, [
        'name' => ['required' => TRUE],
    ]);

    if ($VALID->passed()) {
        $VEHICLE_TYPE->update();

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

if (isset($_POST['save-arrange'])) {

    foreach ($_POST['sort'] as $key => $img) {
        $key = $key + 1;

        $VEHICLE_TYPE = Vehicle_type::arrange($key, $img);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
?>
