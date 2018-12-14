<?php
include_once(dirname(__FILE__) . '/../../class/include.php');


if (isset($_POST['add-bank'])) {
    
    $BANK = new Bank(NULL);
    $VALID = new Validator();

    $BANK->name = ucfirst($_POST['name']);
    
    $VALID->check($BANK, [
        'name' => ['required' => TRUE],
        
    ]);



    if ($VALID->passed()) {
        $BANK->create();

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
