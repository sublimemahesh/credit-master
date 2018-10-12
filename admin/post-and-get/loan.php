<?php

include_once(dirname(__FILE__) . '/../../class/include.php');


if (isset($_POST['add-loan'])) {

    $LOAN = new Loan(NULL);
    $VALID = new Validator();

    $LOAN->create_date = $_POST['create_date'];
    $LOAN->customer = $_POST['customer'];
    $LOAN->guarantor_1 = $_POST['guarantor_1'];
    $LOAN->guarantor_2 = $_POST['guarantor_2'];
    $LOAN->loan_amount = $_POST['loan_amount'];
    $LOAN->loan_period = $_POST['loan_period'];
    $LOAN->interest_rate = $_POST['interest_rate'];
    $LOAN->installment_type = $_POST['installment_type'];


    $VALID->check($LOAN, [
        'create_date' => ['required' => TRUE],
        'customer' => ['required' => TRUE],
        'guarantor_1' => ['required' => TRUE],
        'loan_amount' => ['required' => TRUE],
    ]);



    if ($VALID->passed()) {
        $LOAN->create();

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


    $LOAN = new Loan($_POST['id']);

    $LOAN->create_date = $_POST['create_date'];
    $LOAN->customer = $_POST['customer'];
    $LOAN->guarantor_1 = $_POST['guarantor_1'];
    $LOAN->guarantor_2 = $_POST['guarantor_2'];
    $LOAN->loan_amount = $_POST['loan_amount'];
    $LOAN->loan_period = $_POST['loan_period'];
    $LOAN->interest_rate = $_POST['interest_rate'];
    $LOAN->installment_type = $_POST['installment_type'];


    $VALID = new Validator();
    $VALID->check($LOAN, [
        'create_date' => ['required' => TRUE],
        'customer' => ['required' => TRUE],
        'guarantor_1' => ['required' => TRUE],
        'loan_amount' => ['required' => TRUE],
    ]);



    if ($VALID->passed()) {
        $LOAN->update();

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

