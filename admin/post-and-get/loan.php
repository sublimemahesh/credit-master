<?php

include_once(dirname(__FILE__) . '/../../class/include.php');


if (isset($_POST['create-new-loan'])) {

    $LOAN = new Loan(NULL);
    $VALID = new Validator();
    if ($_POST['guarantor_1_id'] == NULL) {
        $guarantor = $_POST['guarantor_1'];
    } else {
        $guarantor = $_POST['guarantor_1_id'];
    }
    

    $LOAN->create_date = $_POST['create_date'];
    $LOAN->customer = $_POST['customer'];
    $LOAN->guarantor_1 = $guarantor;
    $LOAN->guarantor_2 = $_POST['guarantor_2'];
    $LOAN->guarantor_3 = $_POST['guarantor_3'];
    $LOAN->loan_amount = $_POST['loan_amount'];
    $LOAN->interest_rate = $_POST['interest_rate'];
    $LOAN->loan_period = $_POST['loan_period'];
    $LOAN->installment_type = $_POST['installment_type'];
    $LOAN->installment_amount = $_POST['installment_amount'];
    $LOAN->number_of_installments = $_POST['number_of_installments'];
    $LOAN->effective_date = $_POST['effective_date'];
    $LOAN->issue_mode = $_POST['issue_mode'];
    $LOAN->loan_processing_pre = $_POST['loan_processing_fee'];
    $LOAN->create_by = $_POST['create_by'];

    //has od limite
    if ($_POST['od_active'] == 1) {
        $LOAN->od_interest_limit = $_POST['od_interest_limit'];
        $LOAN->od_date = $_POST['od_date'];
    } else {
        $LOAN->od_interest_limit = 'NOT';
    }

    $VALID->check($LOAN, [
        'create_date' => ['required' => TRUE],
        'customer' => ['required' => TRUE],
//        'guarantor_2' => ['required' => TRUE],
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

        header("location: ../add-loan-document.php?id=" . $LOAN->id);
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
    $LOAN->registration_type = $_POST['registration_type'];
    $LOAN->customer = $_POST['customer'];
    $LOAN->guarantor_1 = $_POST['guarantor_1'];
    $LOAN->guarantor_2 = $_POST['guarantor_2'];
    $LOAN->guarantor_3 = $_POST['guarantor_3'];
    $LOAN->loan_amount = $_POST['loan_amount'];
    $LOAN->issue_mode = $_POST['issue_mode'];
    $LOAN->loan_period = $_POST['loan_period'];
    $LOAN->interest_rate = $_POST['interest_rate'];
    $LOAN->installment_type = $_POST['installment_type'];



    $VALID = new Validator();
    $VALID->check($LOAN, [
        'create_date' => ['required' => TRUE],
        'customer' => ['required' => TRUE],
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

if (isset($_POST['update-loan'])) {


    $LOAN = new Loan($_POST['id']);

    $LOAN->guarantor_2 = $_POST['guarantor_2'];
    $LOAN->guarantor_3 = $_POST['guarantor_3'];
    $LOAN->loan_amount = $_POST['loan_amount'];
    $LOAN->issue_mode = $_POST['issue_mode'];
    $LOAN->loan_period = $_POST['loan_period'];
    $LOAN->interest_rate = $_POST['interest_rate'];
    $LOAN->installment_type = $_POST['installment_type'];
    $LOAN->number_of_installments = $_POST['number_of_installments'];
    $LOAN->installment_amount = $_POST['installment_amount'];
    $LOAN->effective_date = $_POST['effective_date'];


    //has od limite
    if ($_POST['od_active'] == 1) {
        $LOAN->od_interest_limit = $_POST['od_interest_limit'];
        $LOAN->od_date = $_POST['od_date'];
    } else {
        $LOAN->od_interest_limit = 'NOT';
    }


    $VALID = new Validator();
    $VALID->check($LOAN, [
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
if (isset($_POST['update-od'])) {


    $LOAN = new Loan($_POST['id']);

    //has od limite
    if ($_POST['od_active'] == 1) {
        $LOAN->od_interest_limit = $_POST['od_interest_limit'];
        $LOAN->od_date = $_POST['od_date'];
    } else {
        $LOAN->od_interest_limit = 'NOT';
    }


    $VALID = new Validator();
    $VALID->check($LOAN, [
    ]);



    if ($VALID->passed()) {
        $LOAN->updateOd();

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