<?php

include_once(dirname(__FILE__) . '/../class/include.php');


$P_DATE = new PostponeDate(NULL);
$LOAN = new Loan(NULL);
$DefaultData = new DefaultData(NULL);

$LOAN->status = 'issued';

$today = date("Y-m-d");
$instrollment = array();


if ($_POST['action'] == 'center') {
foreach ($LOAN->allByStatus() as $key => $loan) {

    $LT = $loan['installment_type'];
    if ($LT == 30) {
        $loanId = 'BLD' . $loan['id'];
    } elseif ($LT == 4) {
        $loanId = 'BLW' . $loan['id'];
    } else {
        $loanId = 'BLM' . $loan['id'];
    }

    $Customer = new Customer($loan['customer']);
    $DefaultData = new DefaultData();
    $IT = DefaultData::getInstallmentType();
    $numOfInst = DefaultData::getNumOfInstlByPeriodAndType($loan['loan_period'], $loan['installment_type']);
    $PR = DefaultData::getLoanPeriod();
    $LOAN_1 = new Loan($loan['id']);
    $selectedDate = $_POST['date'];
    // $selectedDate = $today;

    $status = $LOAN_1->getStatusbyDate($selectedDate);

//    echo $PR[$loan['loan_period']];
//    echo $numOfInst;
//    echo $PR[$loan['installment_type']];

    $first_letter = $DefaultData->getFirstLetterName(ucwords($Customer->surname));
    $customer_name = $Customer->title . ' ' . $first_letter . ' ' . $Customer->first_name . ' ' . $Customer->last_name;

    $fullAddress = [$Customer->address_line_1, $Customer->address_line_2, $Customer->address_line_3, $Customer->address_line_4, $Customer->address_line_5];
    $address = implode(',', array_filter($fullAddress, 'strlen'));

    $due_and_excess = $status["arrears-excess"];
    if ($due_and_excess > 0) {
        $arriers_amount = $due_and_excess;
        $excess_amount = '0.00';
//                        $arries_interest = number_format($LOAN->getOdIntereset($loan['customer'], $due_and_excess, $loan['installment_type']), 2);
    } else {
        $arriers_amount = '0.00';
        $excess_amount = $due_and_excess;
    }


    $CENTER = new Center($Customer->center);
    if ($Customer->center = $CENTER->id) {
        $area = 'Center - ' . $CENTER->name;
    } else {
        $ROUTE = new Route($Customer->route);
        $area = 'Route - ' . $ROUTE->name;
    }

    if ($status["od_amount"] == 0) {
        $aod = '0.00';
    } else {
       
      $aod = $status["od_amount"];
       
   
    }
//    echo $loan['create_date'];
//    echo number_format($loan['loan_amount'], 2);
//    echo number_format($loan['installment_amount'], 2);
//    echo '<b>' . round($status["system-due-num-of-ins"], 1) . ' | ' . number_format($status["system-due"], 2) . '</b>';
//    echo '<b>' . round($status["actual-due-num-of-ins"], 1) . ' | ' . number_format($status["actual-due"], 2) . '</b>';
//    echo '<b>' . round($status["receipt-num-of-ins"], 1) . ' | ' . number_format($status["receipt"], 2) . '</b>';

    if ($Customer->center != 0 && $Customer->center == $_POST['centerid']) {

        $instrollment_data['id'] = $loan['id'];
        $instrollment_data['loan_id'] = $loanId;
        $instrollment_data['customer_name'] = $customer_name;
        $instrollment_data['customer_no'] = $Customer->mobile;
        $instrollment_data['customer_address'] = $address;
        $instrollment_data['loan_amount'] = number_format($loan['loan_amount'], 2);
        $instrollment_data['loan_period'] = $PR[$loan['loan_period']];
        $instrollment_data['installment_type'] = $IT[$loan['installment_type']];
        $instrollment_data['installment_amount'] = number_format($loan['installment_amount'], 2);
        $instrollment_data['arriers'] = -1 * $arriers_amount;
        $instrollment_data['total_due'] = $status["actual-due"];
        $instrollment_data['start_date'] = $status["first_installment_date"];
        $instrollment_data['excess'] = -1 * $excess_amount;
        $instrollment_data['total_paid'] = $status["receipt"];
        $instrollment_data['ins_total'] = $status["total_installment_amount"];
        $instrollment_data['installment_date'] = "ddd";
        $instrollment_data['aod'] = $aod;
        $instrollment_data['area'] = $area;
       


        array_push($instrollment, $instrollment_data);
    }
}
echo json_encode($instrollment);
}
if ($_POST['action'] == 'route') {
foreach ($LOAN->allByStatus() as $key => $loan) {

    $LT = $loan['installment_type'];
    if ($LT == 30) {
        $loanId = 'BLD' . $loan['id'];
    } elseif ($LT == 4) {
        $loanId = 'BLW' . $loan['id'];
    } else {
        $loanId = 'BLM' . $loan['id'];
    }

    $Customer = new Customer($loan['customer']);
    $DefaultData = new DefaultData();
    $IT = DefaultData::getInstallmentType();
    $numOfInst = DefaultData::getNumOfInstlByPeriodAndType($loan['loan_period'], $loan['installment_type']);
    $PR = DefaultData::getLoanPeriod();
    $LOAN_1 = new Loan($loan['id']);
    $selectedDate = $_POST['date'];
    // $selectedDate = $today;

    $status = $LOAN_1->getStatusbyDate($selectedDate);

//    echo $PR[$loan['loan_period']];
//    echo $numOfInst;
//    echo $PR[$loan['installment_type']];

    $first_letter = $DefaultData->getFirstLetterName(ucwords($Customer->surname));
    $customer_name = $Customer->title . ' ' . $first_letter . ' ' . $Customer->first_name . ' ' . $Customer->last_name;

    $fullAddress = [$Customer->address_line_1, $Customer->address_line_2, $Customer->address_line_3, $Customer->address_line_4, $Customer->address_line_5];
    $address = implode(',', array_filter($fullAddress, 'strlen'));

    $due_and_excess = $status["arrears-excess"];
    if ($due_and_excess > 0) {
        $arriers_amount = $due_and_excess;
        $excess_amount = '0.00';
//                        $arries_interest = number_format($LOAN->getOdIntereset($loan['customer'], $due_and_excess, $loan['installment_type']), 2);
    } else {
        $arriers_amount = '0.00';
        $excess_amount = $due_and_excess;
    }


    $CENTER = new Center($Customer->center);
    if ($Customer->center = $CENTER->id) {
        $area = 'Center - ' . $CENTER->name;
    } else {
        $ROUTE = new Route($Customer->route);
        $area = 'Route - ' . $ROUTE->name;
    }

    if ($status["od_amount"] == 0) {
        $aod = '0.00';
    } else {
       
      $aod = $status["od_amount"];
       
   
    }
//    echo $loan['create_date'];
//    echo number_format($loan['loan_amount'], 2);
//    echo number_format($loan['installment_amount'], 2);
//    echo '<b>' . round($status["system-due-num-of-ins"], 1) . ' | ' . number_format($status["system-due"], 2) . '</b>';
//    echo '<b>' . round($status["actual-due-num-of-ins"], 1) . ' | ' . number_format($status["actual-due"], 2) . '</b>';
//    echo '<b>' . round($status["receipt-num-of-ins"], 1) . ' | ' . number_format($status["receipt"], 2) . '</b>';

    if ($Customer->route != 0 && $Customer->route == $_POST['routeid']) {

        $instrollment_data['id'] = $loan['id'];
        $instrollment_data['loan_id'] = $loanId;
        $instrollment_data['customer_name'] = $customer_name;
        $instrollment_data['customer_no'] = $Customer->mobile;
        $instrollment_data['customer_address'] = $address;
        $instrollment_data['loan_amount'] = number_format($loan['loan_amount'], 2);
        $instrollment_data['loan_period'] = $PR[$loan['loan_period']];
        $instrollment_data['installment_type'] = $IT[$loan['installment_type']];
        $instrollment_data['installment_amount'] = number_format($loan['installment_amount'], 2);
        $instrollment_data['arriers'] = -1 * $arriers_amount;
        $instrollment_data['total_due'] = $status["actual-due"];
        $instrollment_data['start_date'] = $status["first_installment_date"];
        $instrollment_data['excess'] = -1 * $excess_amount;
        $instrollment_data['total_paid'] = $status["receipt"];
        $instrollment_data['ins_total'] = $status["total_installment_amount"];
        $instrollment_data['installment_date'] = "ddd";
        $instrollment_data['aod'] = $aod;
        $instrollment_data['area'] = $area;
       


        array_push($instrollment, $instrollment_data);
    }
}
echo json_encode($instrollment);
}
?>