<?php 
include_once(dirname(__FILE__) . '/../../class/include.php');


if (isset($_POST['create'])) {

    $ACCOUNTS = new Account(NULL);
    $VALID = new Validator();

    $ACCOUNTS->account_type = $_POST['account_type'];
    $ACCOUNTS->user = $_POST['user'];


    $VALID->check($ACCOUNTS, [
        'account_type' => ['required' => TRUE],
    ]);

    if ($VALID->passed()) {
        $ACCOUNTS->create();

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


    $ACCOUNTS = new Account($_POST['id']);

    $ACCOUNTS->account_type = $_POST['account_type'];
    $ACCOUNTS->user = $_POST['user'];



    $VALID = new Validator();
    $VALID->check($ACCOUNTS, [
        'account_type' => ['required' => TRUE],
    ]);

    if ($VALID->passed()) {
        $ACCOUNTS->update();

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