
<?php

include_once(dirname(__FILE__) . '/../class/include.php');

//post variables
$uid = $_POST['collector'];
$keyword = $_POST['search_key'];

//Object Initiate
$LOAN = new Loan(NULL);
$DEFAULTDATA = new DefaultData(NULL);
$CENTER = new Center(NULL);
$ROUTE = new Route(NULL);
$COLLETOR_CENTERS = $CENTER->getCentersByCollector($uid);
$COLLETOR_ROUTES = $ROUTE->getRouteByCollector($uid);


$RESULT = $LOAN->allLoanByKeyword($keyword);
$loanarray = array();

foreach ($RESULT as $res) {
    $CUSTOMER = new Customer($res['customer_id']);
    $LOAN = new Loan($res['loan_id']);
    $loan_data = array();

    //customer name initiate
    $first_letter = $DEFAULTDATA->getFirstLetterName(ucwords($CUSTOMER->surname));
    $customer_name = $CUSTOMER->title . ' ' . $first_letter . ' ' . $CUSTOMER->first_name . ' ' . $CUSTOMER->last_name;

    //customer address 
    $fullAddress = [$CUSTOMER->address_line_1, $CUSTOMER->address_line_2, $CUSTOMER->address_line_3, $CUSTOMER->address_line_4, $CUSTOMER->address_line_5];
    $address = implode(',', array_filter($fullAddress, 'strlen'));

    //loan id format
    $INSTYP = $LOAN->installment_type;
    if ($INSTYP == 30) {
        $loanId = 'BLD' . $LOAN->id;
    } elseif ($INSTYP == 4) {
        $loanId = 'BLW' . $LOAN->id;
    } else {
        $loanId = 'BLM' . $LOAN->id;
    }


    //
    $IT = $DEFAULTDATA->getInstallmentType();
    $PR = $DEFAULTDATA->getLoanPeriod();

    if ($CUSTOMER->center !== 0) {
        foreach ($COLLETOR_CENTERS as $center) {
            if ($center['id'] == $CUSTOMER->center) {
                $CENTER = new Center($CUSTOMER->center);
                $loan_data['id'] = $LOAN->id;
                $loan_data['loan_id'] = $loanId;
                $loan_data['customer_name'] = $customer_name;
                $loan_data['customer_no'] = $CUSTOMER->mobile;
                $loan_data['customer_address'] = $address;
                $loan_data['loan_amount'] = $LOAN->loan_amount;
                $loan_data['loan_period'] = $PR[$LOAN->loan_period];
                $loan_data['installment_type'] = $IT[$LOAN->installment_type];
                $loan_data['installment_amount'] = $LOAN->installment_amount;
                $loan_data['area'] = 'Center-' . $CENTER->name;
            }
        }
    }
    if ($CUSTOMER->route !== 0) {
        foreach ($COLLETOR_ROUTES as $route) {
            if ($route['id'] == $CUSTOMER->route) {
                $ROUTE = new Route($CUSTOMER->route);
                $loan_data['id'] = $LOAN->id;
                $loan_data['loan_id'] = $loanId;
                $loan_data['customer_name'] = $customer_name;
                $loan_data['customer_no'] = $CUSTOMER->mobile;
                $loan_data['customer_address'] = $address;
                $loan_data['loan_amount'] = $LOAN->loan_amount;
                $loan_data['loan_period'] = $PR[$LOAN->loan_period];
                $loan_data['installment_type'] = $IT[$LOAN->installment_type];
                $loan_data['installment_amount'] = $LOAN->installment_amount;
                $loan_data['area'] = 'Route-' . $ROUTE->name;
            }
        }
    }

    array_push($loanarray, $loan_data);
}
//skip empty arrays
$FinalFilterArray = array_values(array_filter($loanarray));
echo json_encode($FinalFilterArray);

