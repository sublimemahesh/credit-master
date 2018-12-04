<?php
include_once(dirname(__FILE__) . '/../../class/include.php');


if (isset($_POST['add-branch'])) {
    
    $BANK = new Branch(NULL);
    $VALID = new Validator();

    $BANK->name = $_POST['name'];
    $BANK->bank_id = $_POST['bank_id'];
    
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
 
if (isset($_POST['update'])) {

    
    $BANK = new Bank($_POST['id']);

    $BANK->name = $_POST['name'];


    $VALID = new Validator();
    $VALID->check($BANK, [
        'name' => ['required' => TRUE],

    ]);



    if ($VALID->passed()) {
        $BANK->update();

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

