<?php

include_once(dirname(__FILE__) . '/../../class/include.php');


if (isset($_POST['create-new-loan'])) {

    $LOAN = new Loan(NULL);
    $VALID = new Validator();

    $LOAN->create_date = $_POST['create_date'];
    $LOAN->customer = $_POST['customer'];
    $LOAN->guarantor_1 = $_POST['guarantor_1'];
    $LOAN->guarantor_2 = $_POST['guarantor_2'];
    $LOAN->loan_amount = $_POST['loan_amount'];
    $LOAN->interest_rate = $_POST['interest_rate'];
    $LOAN->loan_period = $_POST['loan_period'];
    $LOAN->installment_type = $_POST['installment_type'];
    $LOAN->installment_amount = $_POST['installment_amount'];
    $LOAN->number_of_installments = $_POST['number_of_installments'];
    $LOAN->effective_date = $_POST['effective_date'];


    $VALID->check($LOAN, [
        'create_date' => ['required' => TRUE],
        'customer' => ['required' => TRUE],
        'guarantor_1' => ['required' => TRUE],
        'guarantor_2' => ['required' => TRUE],
        'loan_amount' => ['required' => TRUE],
        'interest_rate' => ['required' => TRUE],
        'loan_period' => ['required' => TRUE],
        'installment_type' => ['required' => TRUE],
        'installment_amount' => ['required' => TRUE],
        'number_of_installments' => ['required' => TRUE]
    ]);


    if ($VALID->passed()) {
        $LOAN->create();

        if (!isset($_SESSION)) {
            session_start();
        }

        $VALID->addError("Loan was created successfully", 'success');
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
    $LOAN->issue_mode = $_POST['issue_mode'];
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

