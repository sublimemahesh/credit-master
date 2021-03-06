<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

//get registration type
if ($_POST['action'] == 'GETREGTYPE') {

    if ($_POST['type'] == 'route') {
        $ROUTE = new Route(NULL);
        $result = $ROUTE->all($_POST['collector_id']);
        echo json_encode(['type' => 'route', 'data' => $result]);
        header('Content-type: application/json');
        exit();
    } else if ($_POST['type'] == 'center') {
        $CENTER = new Center(NULL);
        $result = $CENTER->all($_POST['collector_id']);
        echo json_encode(['type' => 'center', 'data' => $result]);
        header('Content-type: application/json');
        exit();
    }
}

//get customer
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

//get gurantors
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

//verify loan
if ($_POST['action'] == 'VERIFY') {
    $LOAN = new Loan($_POST['loan_id']);
    $LOAN->effective_date = $_POST['effective_date'];
    $LOAN->verify_comments = $_POST['verify_comments'];
    $LOAN->balance_of_last_loan = $_POST['balance_of_last_loan'];
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

//Reject loan
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

//Delete loan
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

//approve loan
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

//pending loan
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

//check gurantter 2
if ($_POST['action'] == 'CHECKGUARANTER_2') {
    $LOAN = new Loan(NULl);

    $result = $LOAN->CheckGuarantor_2($_POST["guarantor_2"]);

    if ($result == TRUE) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    } else {
        $data = array("status" => FALSE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}

//check gurantter 3 
if ($_POST['action'] == 'CHECKGUARANTER_3') {
    $LOAN = new Loan(NULl);

    $result = $LOAN->CheckGuarantor_3($_POST["guarantor_3"]);

    if ($result == TRUE) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    } else {
        $data = array("status" => FALSE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}

//check customer has active loan
if ($_POST['action'] == 'CHECKCUSTOMERHASACTIVELOAN') {

    $LOAN = new Loan(NULl);
    $result = $LOAN->CheckCustomerHasActiveLoan($_POST["customer"]);

    if ($result == TRUE) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    } else {
        $data = array("status" => FALSE);
        header('Content-type: application/json');
        exit();
    }
}

//check customer has loan before create
if ($_POST['action'] == 'CUSTOMERHASLOAN') {

    $LOAN = new Loan(NULl);
    $result = $LOAN->CheckCustomerLoan($_POST["customer"]);

    if ($result == TRUE) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    } else {
        $data = array("status" => FALSE);
        header('Content-type: application/json');
        exit();
    }
}

//get loan processign fee
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

//before delete Customer has loan
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

//get Customer last loan amount by create loan 
if ($_POST['action'] == 'LAST_LOAN_AMOUNT_BY_CUSTOMER_IN_CREATE_LOAN') {

    $loan_amount = $_POST['loan_amount'];
    $customer_id = $_POST["customer_id"];

    $DEFULTDATA = new DefaultData(NULL);
    $LOAN = new Loan(NULL);
    $INSTALLMENT = new Installment(NULL);
    $balance_in_last_loan = 0;

    if ($_POST['issue_mode'] == 'cash') {

        $result = $DEFULTDATA->loanProcessingPreCash($loan_amount);
        $loan = $LOAN->getLoanDetailsByCustomer($customer_id);

        $paid_amount = $INSTALLMENT->getAmountByLoanId($loan[0]);

        //get total loan amount in customer
        if ($loan[1] == NULL) {
            $amount = 0;
            $total_loan_amount = $amount += ($loan[1] * $loan[2]) / 100;

            $loan_processing_fee = $result["total"];
            //cash total
            $total_deduction = (int) $result["total"];

            $balance_pay = $loan_amount - $total_deduction;

            echo json_encode(['balance_of_last_loan' => $balance_in_last_loan, 'balance_pay' => number_format($balance_pay, 2), 'total_deductions' => number_format($total_deduction, 2), 'loan_processing_fee' => $loan_processing_fee]);
            header('Content-type: application/json');
        } else {

            $total_loan_amount = $loan[1] += ($loan[1] * $loan[2]) / 100;

            //balance of last loan
            $LOAN_1 = new Loan($loan[0]);
            $status = $LOAN_1->getCurrentStatus();
            $balance_in_last_loan = $status['installment_amount'] * $status['actual-due-num-of-ins'];

            //loan processign fee
            $loan_processing_fee = $result["total"];

            //check paid amount has loan
            $total_deduction = ($balance_in_last_loan + $result["total"]);

            $balance_pay = $loan_amount - $total_deduction;

            echo json_encode(['balance_of_last_loan' => $balance_in_last_loan, 'balance_pay' => number_format($balance_pay, 2), 'total_deductions' => number_format($total_deduction, 2), 'loan_processing_fee' => $loan_processing_fee]);
            header('Content-type: application/json');
            exit();
        }
    } else if ($_POST['issue_mode'] == 'bank') {


        $result = $DEFULTDATA->loanProcessingPreBank($loan_amount);
        $loan = $LOAN->getLoanDetailsByCustomer($customer_id);

        $paid_amount = $INSTALLMENT->getAmountByLoanId($loan[0]);

        //get total loan amount in customer
        if ($loan[1] == NULL) {
            $amount = 0;
            $total_loan_amount = $amount += ($loan[1] * $loan[2]) / 100;

            //loan processign fee
            $loan_processing_fee = $result["total"];

            //cash total
            $total_deduction = (int) $result["total"];

            $balance_pay = $loan_amount - $total_deduction;

            echo json_encode(['balance_of_last_loan' => $balance_in_last_loan, 'balance_pay' => number_format($balance_pay, 2), 'total_deductions' => number_format($total_deduction, 2), 'loan_processing_fee' => $loan_processing_fee]);
            header('Content-type: application/json');
        } else {

            $total_loan_amount = $loan[1] += ($loan[1] * $loan[2]) / 100;
            //balance of last loan
            $LOAN_1 = new Loan($loan[0]);
            $status = $LOAN_1->getCurrentStatus();
            $balance_in_last_loan = $status['installment_amount'] * $status['actual-due-num-of-ins'];

            //loan processign fee
            $loan_processing_fee = $result["total"];

            //check paid amount has loan
            $total_deduction = ($balance_in_last_loan + $result["total"]);

            $balance_pay = $loan_amount - $total_deduction;

            echo json_encode(['balance_of_last_loan' => $balance_in_last_loan, 'balance_pay' => number_format($balance_pay, 2), 'total_deductions' => number_format($total_deduction, 2), 'loan_processing_fee' => $loan_processing_fee]);
            header('Content-type: application/json');
            exit();
        }
    } else if ($_POST['issue_mode'] == 'cheque') {


        $result = $DEFULTDATA->loanProcessingPreCheque($loan_amount);
        $loan = $LOAN->getLoanDetailsByCustomer($customer_id);

        $paid_amount = $INSTALLMENT->getAmountByLoanId($loan[0]);

        //get total loan amount in customer
        if ($loan[1] == NULL) {
            $amount = 0;
            $total_loan_amount = $amount += ($loan[1] * $loan[2]) / 100;

            //loan processign fee
            $loan_processing_fee = $result["total"];

            //cash total
            $total_deduction = (int) $result["total"];

            $balance_pay = $loan_amount - $total_deduction;

            echo json_encode(['balance_of_last_loan' => $balance_in_last_loan, 'balance_pay' => number_format($balance_pay, 2), 'total_deductions' => number_format($total_deduction, 2), 'loan_processing_fee' => $loan_processing_fee]);
            header('Content-type: application/json');
        } else {

            $total_loan_amount = $loan[1] += ($loan[1] * $loan[2]) / 100;
            //balance of last loan
            $LOAN_1 = new Loan($loan[0]);
            $status = $LOAN_1->getCurrentStatus();

            //loan processign fee
            $loan_processing_fee = $result["total"];


            $balance_in_last_loan = $status['installment_amount'] * $status['actual-due-num-of-ins'];


            //check paid amount has loan
            $total_deduction = ($balance_in_last_loan + $result["total"]);

            $balance_pay = $loan_amount - $total_deduction;

            echo json_encode(['balance_of_last_loan' => $balance_in_last_loan, 'balance_pay' => number_format($balance_pay, 2), 'total_deductions' => number_format($total_deduction, 2), 'loan_processing_fee' => $loan_processing_fee]);
            header('Content-type: application/json');
            exit();
        }
    } else {

        $result = $DEFULTDATA->loanProcessingPreCash($loan_amount);
        $loan = $LOAN->getLoanDetailsByCustomer($customer_id);

        $paid_amount = $INSTALLMENT->getAmountByLoanId($loan[0]);

        //balance of last loan
        $LOAN_1 = new Loan($loan[0]);
        $status = $LOAN_1->getCurrentStatus();
        $balance_in_last_loan = $status['installment_amount'] * $status['actual-due-num-of-ins'];

        //get total loan amount in customer
        $total_loan_amount = $loan[1] += ($loan[1] * $loan[2]) / 100;


        //check loan has paid 75%
        $total_loan_amount_precentage = ($total_loan_amount * 75) / 100;

        if ($total_loan_amount_precentage <= $paid_amount[0]) {

            $total_deduction = ($balance_in_last_loan + $result["total"]);

            $balance_pay = $loan_amount - $total_deduction;

            echo json_encode(['balance_of_last_loan' => $balance_in_last_loan]);
            header('Content-type: application/json');
            exit();
        } else {
            echo json_encode(['status' => 'status']);
            header('Content-type: application/json');
            exit();
        }
    }
}

//get Customer last loan amount
if ($_POST['action'] == 'LASTLOANAMOUNTBYCUSTOMER') {

    $loan_amount = $_POST['loan_amount'];
    $customer_id = $_POST["customer_id"];

    $loan_id = $_POST["loan_id"];


    $DEFULTDATA = new DefaultData(NULL);
    $LOAN = new Loan(NULL);
    $INSTALLMENT = new Installment(NULL);
    $balance_in_last_loan = 0;
    $down_payment = 0;
    $paid_loan_processing_fee = 0;

    if ($_POST['issue_mode'] == 'cash') {


        $result = $DEFULTDATA->loanProcessingPreCash($loan_amount);
        $loan = $LOAN->getLoanDetailsByCustomer($customer_id);

        $paid_amount = $INSTALLMENT->getAmountByLoanId($loan[0]);

        //get total loan amount in customer
        if ($loan[1] == NULL) {
            $amount = 0;
            $total_loan_amount = $amount += ($loan[1] * $loan[2]) / 100;

            //cash total
            $total_deduction = (int) $result["total"];

            $balance_pay = $loan_amount - $total_deduction;


            echo json_encode(['balance_of_last_loan' => number_format($balance_in_last_loan, 2), 'balance_pay' => number_format($balance_pay, 2), 'total_deductions' => number_format($total_deduction, 2)]);
            header('Content-type: application/json');
        } else {
            $total_loan_amount = $loan[1] += ($loan[1] * $loan[2]) / 100;

            //balance of last loan
            $LOAN_1 = new Loan($loan[0]);
            $status = $LOAN_1->getCurrentStatus();
            $balance_in_last_loan = $status['installment_amount'] * $status['actual-due-num-of-ins'];
            //down payment

            $down_payment = $INSTALLMENT->getAmountByType($loan_id, 'down_payment');

            //paid_fee
            $paid_loan_processing_fee = $INSTALLMENT->getAmountByType($loan_id, 'loan_processing_fee');

            //check paid amount has loan
            $total_deduction = ($balance_in_last_loan + $result["total"]);
            $balance_pay = $loan_amount - $total_deduction + ($down_payment[0] + $paid_loan_processing_fee[0]);

            echo json_encode(['balance_of_last_loan' => number_format($balance_in_last_loan, 2), 'balance_pay' => number_format($balance_pay, 2), 'total_deductions' => number_format($total_deduction, 2), 'down_payment' => number_format($down_payment[0], 2), 'paid_loan_processing_fee' => number_format($paid_loan_processing_fee[0], 2)]);
            header('Content-type: application/json');
            exit();
        }
    } else if ($_POST['issue_mode'] == 'bank') {

        $result = $DEFULTDATA->loanProcessingPreBank($loan_amount);
        $loan = $LOAN->getLoanDetailsByCustomer($customer_id);
        $paid_amount = $INSTALLMENT->getAmountByLoanId($loan[0]);

        //get total loan amount in customer
        if ($loan[1] == NULL) {
            $amount = 0;
            $total_loan_amount = $amount += ($loan[1] * $loan[2]) / 100;

            //cash total
            $total_deduction = (int) $result["total"];

            $balance_pay = $loan_amount - $total_deduction;

            echo json_encode(['balance_of_last_loan' => number_format($balance_in_last_loan, 2), 'balance_pay' => number_format($balance_pay, 2), 'total_deductions' => number_format($total_deduction, 2)]);
            header('Content-type: application/json');
        } else {

            $total_loan_amount = $loan[1] += ($loan[1] * $loan[2]) / 100;
            //balance of last loan
            $LOAN_1 = new Loan($loan[0]);
            $status = $LOAN_1->getCurrentStatus();

            $balance_in_last_loan = $status['installment_amount'] * $status['actual-due-num-of-ins'];
            //down payment
            $down_payment = $INSTALLMENT->getAmountByType($loan_id, 'down_payment');

            //paid_fee
            $paid_loan_processing_fee = $INSTALLMENT->getAmountByType($loan_id, 'loan_processing_fee');
            //check paid amount has loan
            $total_deduction = ($balance_in_last_loan + $result["total"]);

            $balance_pay = $loan_amount - $total_deduction + ($down_payment[0] + $paid_loan_processing_fee[0]);

            echo json_encode(['balance_of_last_loan' => number_format($balance_in_last_loan, 2), 'balance_pay' => number_format($balance_pay, 2), 'total_deductions' => number_format($total_deduction, 2), 'down_payment' => number_format($down_payment[0], 2), 'paid_loan_processing_fee' => number_format($paid_loan_processing_fee[0], 2)]);
            header('Content-type: application/json');
            exit();
        }
    } else if ($_POST['issue_mode'] == 'cheque') {


        $result = $DEFULTDATA->loanProcessingPreCheque($loan_amount);
        $loan = $LOAN->getLoanDetailsByCustomer($customer_id);

        $paid_amount = $INSTALLMENT->getAmountByLoanId($loan[0]);

        //get total loan amount in customer
        if ($loan[1] == NULL) {
            $amount = 0;
            $total_loan_amount = $amount += ($loan[1] * $loan[2]) / 100;

            //cash total
            $total_deduction = (int) $result["total"];

            $balance_pay = $loan_amount - $total_deduction;

            echo json_encode(['balance_of_last_loan' => number_format($balance_in_last_loan, 2), 'balance_pay' => number_format($balance_pay, 2), 'total_deductions' => number_format($total_deduction, 2)]);
            header('Content-type: application/json');
        } else {

            $total_loan_amount = $loan[1] += ($loan[1] * $loan[2]) / 100;
            //balance of last loan
            $LOAN_1 = new Loan($loan[0]);
            $status = $LOAN_1->getCurrentStatus();


            $balance_in_last_loan = $status['installment_amount'] * $status['actual-due-num-of-ins'];

            //down payment
            $down_payment = $INSTALLMENT->getAmountByType($loan_id, 'down_payment');

            //paid_fee
            $paid_loan_processing_fee = $INSTALLMENT->getAmountByType($loan_id, 'loan_processing_fee');
            //check paid amount has loan
            $total_deduction = ($balance_in_last_loan + $result["total"]);

            $balance_pay = $loan_amount - $total_deduction + ($down_payment[0] + $paid_loan_processing_fee[0]);

            echo json_encode(['balance_of_last_loan' => number_format($balance_in_last_loan, 2), 'balance_pay' => number_format($balance_pay, 2), 'total_deductions' => number_format($total_deduction, 2), 'down_payment' => number_format($down_payment[0], 2), 'paid_loan_processing_fee' => number_format($paid_loan_processing_fee[0], 2)]);
            header('Content-type: application/json');
            exit();
        }
    }
}
 
