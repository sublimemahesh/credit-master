<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

include_once(dirname(__FILE__) . '/../auth.php');


if (isset($_POST['add-district'])) {
    $DISTRICT = new District(NULL);
    $VALID = new Validator();

    $DISTRICT->name = filter_input(INPUT_POST, 'name');

    $VALID->check($DISTRICT, ['name' =>
            ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $DISTRICT->create();

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

if (isset($_POST['edit-district'])) {
    $DISTRICT = new District($_POST['id']);

    $DISTRICT->name = $_POST['name'];

    $VALID = new Validator();
    $VALID->check($DISTRICT, ['name' =>
            ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $DISTRICT->update();

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

        $DISTRICT = District::arrange($key, $img);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}