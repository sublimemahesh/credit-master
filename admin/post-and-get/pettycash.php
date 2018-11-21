<?php

include_once(dirname(__FILE__) . '/../../class/include.php');


if (isset($_POST['create'])) {

    $PETTYCASH = new PettyCash(NULL);
    $VALID = new Validator();

    $PETTYCASH->date = $_POST['date'];
    $PETTYCASH->amount = $_POST['amount'];
    $PETTYCASH->type = $_POST['type'];
    $PETTYCASH->reason = $_POST['reason'];

    $VALID->check($PETTYCASH, [
        'date' => ['required' => TRUE],
    ]);

    if ($VALID->passed()) {
        $PETTYCASH->create();

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


    $PETTYCASH = new PettyCash($_POST['id']);
    $PETTYCASH->amount = $_POST['amount'];
    $PETTYCASH->date = $_POST['date'];
    $PETTYCASH->type = $_POST['type'];
    $PETTYCASH->reason = $_POST['reason'];

    $VALID = new Validator();
    $VALID->check($PETTYCASH, [
        'date' => ['required' => TRUE],
    ]);


    if ($VALID->passed()) {
        $PETTYCASH->update();

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

