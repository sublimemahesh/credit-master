<?php

include_once(dirname(__FILE__) . '/../class/include.php');
$INSTALLMENT_OBJ = new Installment(NULL);
$DefaultData = new DefaultData(NULL);

$uid = $_POST['collector'];

$INSTALLMENT_OBJ->collector = $uid;


$INSTALLMENT = $INSTALLMENT_OBJ->getModifiedInstallmentByCollector();

$instrollment = array();
foreach ($INSTALLMENT as $installment) {
    $LOAN = new Loan($installment['loan']);
    $CUSTOMER = new Customer($LOAN->customer);
    $LP = $DefaultData->getLoanPeriod();
    $IT = $DefaultData->getInstallmentType();

         $CENTER = new Center($CUSTOMER->center);
                    if ($CUSTOMER->center = $CENTER->id) {
                        $area = 'Center - ' . $CENTER->name;
                    }
                else {
                    $ROUTE = new Route($CUSTOMER->route);
                    $area = 'Route - ' . $ROUTE->name;
                }
    if ($IT == 30) {
        $loanId = 'BLD' . $LOAN->id;
    } elseif ($IT == 4) {
        $loanId = 'BLW' . $LOAN->id;
    } else {
        $loanId = 'BLM' . $LOAN->id;
    }


    $instrollment_data = array();

    $customer_name = $DefaultData->getFirstLetterName(ucwords($CUSTOMER->surname)) . ' ' . $CUSTOMER->first_name . ' ' . $CUSTOMER->last_name;
    $fullAddress = [$CUSTOMER->address_line_1, $CUSTOMER->address_line_2, $CUSTOMER->address_line_3, $CUSTOMER->address_line_4, $CUSTOMER->address_line_5];
    $address = implode(',', array_filter($fullAddress, 'strlen'));

    $instrollment_data['id'] = $installment['id'];
    $instrollment_data['loan_id'] = $loanId;
    $instrollment_data['customer_name'] = $customer_name;
    $instrollment_data['customer_no'] = $CUSTOMER->mobile;
    $instrollment_data['customer_address'] = $address;
    $instrollment_data['loan_amount'] = number_format($LOAN->loan_amount, 2);
    $instrollment_data['loan_period'] = $LP[$LOAN->loan_period];
    $instrollment_data['installment_type'] = $IT[$LOAN->installment_type];
    $instrollment_data['installment_amount'] = $LOAN->installment_amount;
    $instrollment_data['receipt'] = $installment['receipt_no'];
    $instrollment_data['paid_amount'] = $installment['paid_amount'];
    $instrollment_data['installment_date'] = $CUSTOMER->first_name;
    $instrollment_data['area'] = $area;

    array_push($instrollment, $instrollment_data);
}
echo json_encode($instrollment);
?>