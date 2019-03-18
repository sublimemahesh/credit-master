<?php

include_once(dirname(__FILE__) . '/../class/include.php');
$LOAN = new Loan(NULL);
$INSTALLMENT = new Installment(NULL);
$LOAN->status = 'released';
$LOAN->collector = $_POST['uid'];
$DefaultData = new DefaultData(NULL);

$instrollment = array();


foreach ($LOAN->getAllApprovedLoansByCollector() as $key => $loan) {


    $customer = $loan['customer'];
    $CUSTOMER = new Customer($customer);
    $route = $CUSTOMER->route;
    $center = $CUSTOMER->center;
    $LP = $DefaultData->getLoanPeriod();
    $LT = $DefaultData->getInstallmentType();
    $amount = $loan['installment_amount'];



    if ($LT == 30) {
        $loanId = 'BLD' . $loan['id'];
    } elseif ($LT == 4) {
        $loanId = 'BLW' . $loan['id'];
    } else {
        $loanId = 'BLM' . $loan['id'];
    }

    $x = 0;
    $ins_total = 0;
    $total_paid = 0;
    $instrollment_data = array();

    $customer_name = $DefaultData->getFirstLetterName(ucwords($CUSTOMER->surname)) . ' ' . $CUSTOMER->first_name . ' ' . $CUSTOMER->last_name;
    $fullAddress = [$CUSTOMER->address_line_1, $CUSTOMER->address_line_2, $CUSTOMER->address_line_3, $CUSTOMER->address_line_4, $CUSTOMER->address_line_5];
    $address = implode(',', array_filter($fullAddress, 'strlen'));
    $CENTER = new Center($CUSTOMER->center);
    if ($CUSTOMER->center = $CENTER->id) {
        $area = 'Center - ' . $CENTER->name;
    } else {
        $ROUTE = new Route($CUSTOMER->route);
        $area = 'Route - ' . $ROUTE->name;
    }
    $PaidDownpayments = 0;
    $DownPayments = $INSTALLMENT->getPaidDownPayments($loan['id']);
    foreach ($DownPayments as $DownPayment) {
        $PaidDownpayments += $DownPayment['paid_amount'];
    }

    $PaidProcessingFee = 0;
    $ProcessingFees = $INSTALLMENT->getPaidLoanProcessingFee($loan['id']);
    foreach ($ProcessingFees as $ProcessingFee) {
        $PaidProcessingFee += $ProcessingFee['paid_amount'];
    }



    $amount_payable = $loan['loan_amount'] - $loan['loan_processing_pre'] - $loan['balance_of_last_loan']+$PaidProcessingFee+$PaidDownpayments;

    $instrollment_data['customer'] = $customer_name;
    $instrollment_data['customer_no'] = $CUSTOMER->mobile;
    $instrollment_data['customer_address'] = $address;

    $instrollment_data['id'] = $loan['id'];
    $instrollment_data['loan_id'] = $loanId;
    $instrollment_data['create_date'] = $loan['create_date'];
    $instrollment_data['loan_amount'] = number_format($loan['loan_amount'], 2);
    $instrollment_data['loan_processing_fee'] = $loan['loan_processing_pre'];
    $instrollment_data['balance_of_last_loan'] = $loan['balance_of_last_loan'];
    $instrollment_data['loan_amount_payable'] = number_format($amount_payable, 2);
    $instrollment_data['installment_type'] = $LT[$loan['installment_type']];
    $instrollment_data['area'] = $area;
    $instrollment_data['loan_period'] = $LP[$loan['loan_period']];
    $instrollment_data['installment_amount'] = number_format($amount, 2);

    array_push($instrollment, $instrollment_data);
}

echo json_encode($instrollment);
?>