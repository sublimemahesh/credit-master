<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

if ($_POST['action'] == 'GETREGTYPE') {

    if ($_POST['type'] == 'route') {
        $ROUTE = new Route(NULL);
        $result = $ROUTE->all();
        echo json_encode(['type' => 'route', 'data' => $result]);
        header('Content-type: application/json');
        exit();
    } else if ($_POST['type'] == 'center') {
        $CENTER = new Center(NULL);
        $result = $CENTER->all();
        echo json_encode(['type' => 'center', 'data' => $result]);
        header('Content-type: application/json');
        exit();
    }
}

if ($_POST['action'] == 'GETCUSTOMER') {
    header('Content-type: application/json');

    if ($_POST['type'] == 'route') {
        $CUSTOMER = new Customer(NULL);
        $result = $CUSTOMER->getCustomerByRoute($_POST['value']);
        echo json_encode(['type' => 'route', 'data' => $result]);
        exit();
    } else if ($_POST['type'] == 'center') {

        $CUSTOMER = new Customer(NULL);
        $result = $CUSTOMER->getCustomrByCenter($_POST['value']);

        $CENTER = new Center($_POST['value']);
        $leader = $CENTER->leader;
        echo json_encode(['type' => 'center', 'data' => $result, 'leader' => $leader]);
        exit();
    }
}

if ($_POST['action'] == 'GETGURANTOR') {

    header('Content-type: application/json');

    if ($_POST['type'] == 'route') {
        $CUSTOMER = new Customer(NULL);
        $result = $CUSTOMER->getCustomerByRoute($_POST['value']);

        echo json_encode(['type' => 'route', 'data' => $result]);
        exit();
    } else if ($_POST['type'] == 'center') {

        $CUSTOMER = new Customer(NULL);
        $result = $CUSTOMER->getCustomrByCenter($_POST['value']);

        $CENTER = new Center($_POST['value']);
        $leader = $CENTER->leader;
        echo json_encode(['type' => 'center', 'data' => $result, 'leader' => $leader]);
        exit();
    }
}

if ($_POST['action'] == 'VERIFY') {
    $LOAN = new Loan($_POST['loan_id']);
    $LOAN->effective_date = $_POST['effective_date'];
    $LOAN->verify_comments = $_POST['verify_comments'];
    $LOAN->verify_by = $_POST['verify_by'];
    $LOAN->status = 'verified';
    $result = $LOAN->update();

    $VALID = new Validator();
    $VALID->addError("Loan was successfully verified!...", 'success');
    $_SESSION['ERRORS'] = $VALID->errors();


    echo json_encode(['status' => 'verified', 'data' => $result]);
    header('Content-type: application/json');
    exit();
}

if ($_POST['action'] == 'REJECT') {
    $LOAN = new Loan($_POST['loan_id']);
    $LOAN->status = 'rejected';
    $result = $LOAN->update();

    $VALID = new Validator();
    $VALID->addError("Loan was successfully rejected!...", 'success');
    $_SESSION['ERRORS'] = $VALID->errors();

    echo json_encode(['status' => 'rejected', 'data' => $result]);
    header('Content-type: application/json');
    exit();
}

if ($_POST['action'] == 'DELETE') {
    $LOAN = new Loan($_POST['loan_id']);
    $result = $LOAN->delete();

    $VALID = new Validator();
    $VALID->addError("Loan was successfully deleted!...", 'success');
    $_SESSION['ERRORS'] = $VALID->errors();

    echo json_encode(['status' => 'deleted', 'data' => $result]);
    header('Content-type: application/json');
    exit();
}

if ($_POST['action'] == 'APPROVE') {

    $LOAN = new Loan($_POST['loan_id']);
    $LOAN->issue_mode = $_POST['issue_mode'];
    $LOAN->effective_date = $_POST['effective_date'];
    $LOAN->approved_by = $_POST['approved_by'];
    $LOAN->verify_comments = $_POST['verify_comments'];
    $LOAN->status = 'approve';
    $result = $LOAN->update();

    $VALID = new Validator();
    $VALID->addError("Loan was successfully approved!...", 'success');
    $_SESSION['ERRORS'] = $VALID->errors();

    echo json_encode(['status' => 'approve', 'data' => $result]);
    header('Content-type: application/json');
    exit();
}

if ($_POST['action'] == 'PENDING') {
    $LOAN = new Loan($_POST['loan_id']);
    $LOAN->effective_date = $_POST['effective_date'];
    $LOAN->verify_comments = $_POST['verify_comments'];
    $LOAN->status = 'pending';
    $result = $LOAN->update();

    $VALID = new Validator();
    $VALID->addError("Loan was successfully backed to pending!...", 'success');
    $_SESSION['ERRORS'] = $VALID->errors();

    echo json_encode(['status' => 'pending', 'data' => $result]);
    header('Content-type: application/json');
    exit();
}

if ($_POST['action'] == 'ISSUE') {

    $LOAN = new Loan($_POST['loan_id']);
    $LOAN->issued_date = $_POST['issued_date'];
    $LOAN->issue_by = $_POST['issue_by'];
    $LOAN->effective_date = $_POST['effective_date'];
    $LOAN->issue_mode = $_POST['issue_mode'];
    $LOAN->issue_note = $_POST['issue_note'];
    $LOAN->loan_processing_pre = $_POST['loan_processing_pre_amount'];
    $LOAN->status = 'issued';


    $result = $LOAN->update();

    $EffectiveDate = New EffectiveDate(NULL);

    $EffectiveDate->loan = $LOAN->id;
    $EffectiveDate->date = $LOAN->effective_date;
    $EffectiveDate->loan_period = $LOAN->loan_period;
    $EffectiveDate->installment_type = $LOAN->installment_type;
    $EffectiveDate->installment_amount = $LOAN->installment_amount;

    $EffectiveDate->create();

    $VALID = new Validator();
    $VALID->addError("Loan was successfully issued!...", 'success');
    $_SESSION['ERRORS'] = $VALID->errors();

    echo json_encode(['status' => 'issued', 'data' => $result]);
    header('Content-type: application/json');
    exit();
}

if ($_POST['action'] == 'CHECKGUARANTER_2') {
    $CHECKGUARANTER = new Loan(NULl);
    $result = $CHECKGUARANTER->CheckGuarantor_2($_POST["guarantor_2"]);

    if ($result == TRUE) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    } else {
        header('Content-type: application/json');
        exit();
    }
}

if ($_POST['action'] == 'CHECKGUARANTER_3') {
    $CHECKGUARANTER = new Loan(NULl);

    $result = $CHECKGUARANTER->CheckGuarantor_3($_POST["guarantor_3"]);

    if ($result == TRUE) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    } else {
        header('Content-type: application/json');
        exit();
    }
}

if ($_POST['action'] == 'CHECKCUSTOMERHASACTIVELOAN') {
    $CHECKCUSTOMER = new Loan(NULl);

    $result = $CHECKCUSTOMER->CheckCustomerHasActiveLoan($_POST["customer"]);

    if ($result == TRUE) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    } else {
        header('Content-type: application/json');
        exit();
    }
}

if ($_POST['action'] == 'lOANPROCESSINGPRE') {
    $amount = $_POST['loan_amount'];

    if ($_POST['issue_mode'] == 'cash') {

        $DEFULTDATA = new DefaultData(NULL);
        $result = $DEFULTDATA->loanProcessingPreCash($amount);

        echo json_encode(['result' => $result]);
        header('Content-type: application/json');
        exit();
    } else if ($_POST['issue_mode'] == 'bank') {

        $DEFULTDATA = new DefaultData(NULL);
        $result = $DEFULTDATA->loanProcessingPreBank($amount);

        echo json_encode(['result' => $result]);
        header('Content-type: application/json');
        exit();
    } else if ($_POST['issue_mode'] == 'cheque') {

        $DEFULTDATA = new DefaultData(NULL);
        $result = $DEFULTDATA->loanProcessingPreCheque($amount);

        echo json_encode(['result' => $result]);
        header('Content-type: application/json');
        exit();
    }
}

//Before Delete Customer has loan

if ($_POST['action'] == 'CHECKCUSTOMERHASLOAN') {

    $LOAN = new Loan(NULL);

    $result = $LOAN->CheckCustomerHasLoan($_POST["customer"]);

    if ($result == TRUE) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    } else {
        header('Content-type: application/json');
        exit();
    }
}


//get Customer last loan amount


if ($_POST['action'] == 'LASTLOANAMOUNT') {

    $amount = $_POST['loan_amount'];
    $interest_rate = $_POST['interest_rate'];

    if ($_POST['issue_mode'] == 'cash') {

        $DEFULTDATA = new DefaultData(NULL);
        $LOAN = new Loan(NULL);
        $INSTALLMENT = new Installment(NULL);

        $result = $DEFULTDATA->loanProcessingPreCash($amount);
        $loan = $LOAN->getLoanDetailsByCustomer($_POST["customer_id"]);
        $paid_amount = $INSTALLMENT->getAmountByLoanId($loan[0]);


        //get total loan amount in customer
        $total_loan_amount = $amount += ($loan[1] * $interest_rate) / 100;

        $balance_in_last_loan = ($total_loan_amount - $paid_amount[0]);

        //check paid amount has loan
        if ($total_loan_amount != $balance_in_last_loan) {
            //total deduction 
            $total_deduction = ($balance_in_last_loan + $result["total"]);
            $loan_amount = $_POST['loan_amount'];
            $balance_pay = $loan_amount - $total_deduction;

            echo json_encode(['balance_of_last_loan' => $balance_in_last_loan, 'balance_pay' => $balance_pay, 'total_deductions' => $total_deduction]);
            header('Content-type: application/json');
            exit();
        } else {
            echo json_encode(['balance_of_last_loan' => 0, 'balance_pay' => 0, 'total_deductions' => 0]);
            header('Content-type: application/json');
            exit();
        }
    } else if ($_POST['issue_mode'] == 'bank') {

        $DEFULTDATA = new DefaultData(NULL);
        $LOAN = new Loan(NULL);
        $INSTALLMENT = new Installment(NULL);

        $result = $DEFULTDATA->loanProcessingPreBank($amount);
        $loan = $LOAN->getLoanDetailsByCustomer($_POST["customer_id"]);

        $paid_amount = $INSTALLMENT->getAmountByLoanId($loan[0]);


        //get total loan amount in customer
        $total_loan_amount = $amount += ($loan[1] * $interest_rate) / 100;

        //balance in loan
        $balance_in_last_loan = ($total_loan_amount - $paid_amount[0]);

        //check paid amount has loan
        if ($total_loan_amount != $balance_in_last_loan) {
            //total deduction 
            $total_deduction = ($balance_in_last_loan + $result["total"]);
            $loan_amount = $_POST['loan_amount'];
            $balance_pay = $loan_amount - $total_deduction;

            echo json_encode(['balance_of_last_loan' => $balance_in_last_loan, 'balance_pay' => $balance_pay, 'total_deductions' => $total_deduction]);
            header('Content-type: application/json');
            exit();
        } else {
            echo json_encode(['balance_of_last_loan' => 0, 'balance_pay' => 0, 'total_deductions' => 0]);
            header('Content-type: application/json');
            exit();
        }
    } else if ($_POST['issue_mode'] == 'cheque') {

        $DEFULTDATA = new DefaultData(NULL);
        $LOAN = new Loan(NULL);
        $INSTALLMENT = new Installment(NULL);


        $result = $DEFULTDATA->loanProcessingPreCheque($amount);
        $loan = $LOAN->getLoanDetailsByCustomer($_POST["customer_id"]);
        $paid_amount = $INSTALLMENT->getAmountByLoanId($loan[0]);


        //get total loan amount in customer
        $total_loan_amount = $amount += ($loan[1] * $interest_rate) / 100;

        //balance in loan
        $balance_in_last_loan = ($total_loan_amount - $paid_amount[0]);

        //check paid amount has loan
        if ($total_loan_amount != $balance_in_last_loan) {
            //total deduction 
            $total_deduction = ($balance_in_last_loan + $result["total"]);
            $loan_amount = $_POST['loan_amount'];
            $balance_pay = $loan_amount - $total_deduction;

            echo json_encode(['balance_of_last_loan' => $balance_in_last_loan, 'balance_pay' => $balance_pay, 'total_deductions' => $total_deduction]);
            header('Content-type: application/json');
            exit();
        } else {
            echo json_encode(['balance_of_last_loan' => 0, 'balance_pay' => 0, 'total_deductions' => 0]);
            header('Content-type: application/json');
            exit();
        }
    }
}

