<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if (isset($_POST['create'])) {
   
    $GNDIVISION = new GnDivision(NULL);
    $VALID = new Validator();
    $GNDIVISION->name = ucfirst($_POST['name']);
    

    $VALID->check($GNDIVISION, [
        'name' => ['required' => TRUE],
    ]);
    if ($VALID->passed()) {
        $GNDIVISION->create();

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


    $GNDIVISION = new GnDivision($_POST['id']);

    $GNDIVISION->name = ucfirst($_POST['name']);    

    $VALID = new Validator();
    $VALID->check($GNDIVISION, [
        'name' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $GNDIVISION->update();
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
