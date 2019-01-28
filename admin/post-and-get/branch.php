<?php

include_once(dirname(__FILE__) . '/../../class/include.php');


if (isset($_POST['add-branch'])) {

    $BRANCH = new Branch(NULL);
    $VALID = new Validator();

    $BRANCH->name = $_POST['name'];
    $BRANCH->code = $_POST['code'];
    $BRANCH->bank_id = $_POST['bank_id'];

    $VALID->check($BRANCH, [
        'name' => ['required' => TRUE],
    ]);

    if ($VALID->passed()) {
        $BRANCH->create();

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


    $BRANCH = new Bank($_POST['id']);

    $BRANCH->name = $_POST['name'];
    $BRANCH->code = $_POST['code'];

    $VALID = new Validator();
    $VALID->check($BRANCH, [
        'name' => ['required' => TRUE],
    ]);



    if ($VALID->passed()) {
        $BRANCH->update();

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

