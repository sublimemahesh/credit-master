<?php

include_once(dirname(__FILE__) . '/../class/include.php');


$P_DATE = new PostponeDate(NULL);
$LOAN = new Loan(NULL);

$LOAN->status = 'issued';

$today = date("Y-m-d");
$instrollment = array();

if($_POST['action'] == 'center'){
foreach ($LOAN->allByStatus() as $key => $loan) {

    $defultdata = DefaultData::getNumOfInstlByPeriodAndType($loan['loan_period'], $loan['installment_type']);

    $start_date = $loan['effective_date'];
    $start = new DateTime("$start_date");

    $x = 0;
    $ins_total = 0;
    $total_paid = 0;
    $instrollment_data = array();
    while ($x < $defultdata) {
        if ($defultdata == 4) {
            $add_dates = '+7 day';
        } elseif ($defultdata == 30) {
            $add_dates = '+1 day';
        } elseif ($defultdata == 8) {
            $add_dates = '+7 day';
        } elseif ($defultdata == 60) {
            $add_dates = '+1 day';
        } elseif ($defultdata == 2) {
            $add_dates = '+1 months';
        } elseif ($defultdata == 1) {
            $add_dates = '+1 months';
        } elseif ($defultdata == 90) {
            $add_dates = '+1 day';
        } elseif ($defultdata == 12) {
            $add_dates = '+7 day';
        } elseif ($defultdata == 3) {
            $add_dates = '+1 months';
        } elseif ($defultdata == 100) {
            $add_dates = '+1 day';
        } elseif ($defultdata == 13) {
            $add_dates = '+7 day';
        }


        $date = $start->format('Y-m-d');
        $customer = $loan['customer'];
        $CUSTOMER = new Customer($customer);
        $route = $CUSTOMER->route;
        $center = $CUSTOMER->center;
        $LP = DefaultData::getLoanPeriod();
        $IT = DefaultData::getInstallmentType();
        $amount = $loan['installment_amount'];
        $Installment = new Installment(NULL);
        $paid_amount = 0;

        foreach ($Installment->CheckInstallmetByPaidDate($date, $loan['id']) as $paid) {
            $paid_amount += $paid['paid_amount'];
        }

        $ins_total += $amount;
        $total_paid += $paid_amount;


        if (PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center) || PostponeDate::CheckIsPostPoneByDateAndAll($date)) {
            $start->modify($add_dates);
        } else {
//$_POST['date']

            if ($date == $_POST['date'] && $_POST['centerid'] == $CUSTOMER->center) {



                $CENTER = new Center($CUSTOMER->center);
                if ($CUSTOMER->center = $CENTER->id) {
                    $area = 'Center - ' . $CENTER->name;
                } 
//                else {
//                    $ROUTE = new Route($CUSTOMER->route);
//                    $area = 'Route - ' . $ROUTE->name;
//                }
                
                $customer_name = $CUSTOMER->surname . ' ' . $CUSTOMER->first_name . ' ' . $CUSTOMER->last_name;
                $instrollment_data['id'] = $loan['id'];
                $instrollment_data['customer_name'] = $customer_name;
                $instrollment_data['customer_no'] = $CUSTOMER->mobile;
                $instrollment_data['loan_amount'] = number_format($loan['loan_amount'], 2);
                $instrollment_data['loan_period'] = $LP[$loan['loan_period']];
                $instrollment_data['installment_type'] = $IT[$loan['installment_type']];
                $instrollment_data['installment_amount'] = number_format($amount, 2);
                $instrollment_data['installment_date'] = $date;
                $instrollment_data['area'] = $area;


//                $a = array("id" => 1,"create_date" => "2018-11-15","customer"=>61,"loan_amount" =>"23000","effective_date" => "21-09-2015");
//                $instrollment_data['id'] = $loan['id'];
//                $instrollment_data['create_date'] = $loan['create_date'];
//                $instrollment_data['customer'] = $loan['customer'];
//                $instrollment_data['loan_amount'] = $loan['loan_amount'];
//                $instrollment_data['effective_date'] = $loan['effective_date'];

                array_push($instrollment, $instrollment_data);
            }
            $start->modify($add_dates);
            $x++;
        }
    }
}

echo json_encode($instrollment);
}

if($_POST['action'] == 'route'){
foreach ($LOAN->allByStatus() as $key => $loan) {

    $defultdata = DefaultData::getNumOfInstlByPeriodAndType($loan['loan_period'], $loan['installment_type']);

    $start_date = $loan['effective_date'];
    $start = new DateTime("$start_date");

    $x = 0;
    $ins_total = 0;
    $total_paid = 0;
    $instrollment_data = array();
    while ($x < $defultdata) {
        if ($defultdata == 4) {
            $add_dates = '+7 day';
        } elseif ($defultdata == 30) {
            $add_dates = '+1 day';
        } elseif ($defultdata == 8) {
            $add_dates = '+7 day';
        } elseif ($defultdata == 60) {
            $add_dates = '+1 day';
        } elseif ($defultdata == 2) {
            $add_dates = '+1 months';
        } elseif ($defultdata == 1) {
            $add_dates = '+1 months';
        } elseif ($defultdata == 90) {
            $add_dates = '+1 day';
        } elseif ($defultdata == 12) {
            $add_dates = '+7 day';
        } elseif ($defultdata == 3) {
            $add_dates = '+1 months';
        } elseif ($defultdata == 100) {
            $add_dates = '+1 day';
        } elseif ($defultdata == 13) {
            $add_dates = '+7 day';
        }


        $date = $start->format('Y-m-d');
        $customer = $loan['customer'];
        $CUSTOMER = new Customer($customer);
        $route = $CUSTOMER->route;
        $center = $CUSTOMER->center;
        $LP = DefaultData::getLoanPeriod();
        $IT = DefaultData::getInstallmentType();
        $amount = $loan['installment_amount'];
        $Installment = new Installment(NULL);
        $paid_amount = 0;

        foreach ($Installment->CheckInstallmetByPaidDate($date, $loan['id']) as $paid) {
            $paid_amount += $paid['paid_amount'];
        }

        $ins_total += $amount;
        $total_paid += $paid_amount;


        if (PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center) || PostponeDate::CheckIsPostPoneByDateAndAll($date)) {
            $start->modify($add_dates);
        } else {
//$_POST['date']

            if ($date == $_POST['date'] && $_POST['routeid'] == $CUSTOMER->route) {



                $ROUTE = new Center($CUSTOMER->route);
                if ($CUSTOMER->route = $ROUTE->id) {
                    $area = 'Route - ' . $ROUTE->name;
                } 
//                else {
//                    $ROUTE = new Route($CUSTOMER->route);
//                    $area = 'Route - ' . $ROUTE->name;
//                }
                
                $customer_name = $CUSTOMER->surname . ' ' . $CUSTOMER->first_name . ' ' . $CUSTOMER->last_name;
                $instrollment_data['id'] = $loan['id'];
                $instrollment_data['customer_name'] = $customer_name;
                $instrollment_data['customer_no'] = $CUSTOMER->mobile;
                $instrollment_data['loan_amount'] = number_format($loan['loan_amount'], 2);
                $instrollment_data['loan_period'] = $LP[$loan['loan_period']];
                $instrollment_data['installment_type'] = $IT[$loan['installment_type']];
                $instrollment_data['installment_amount'] = number_format($amount, 2);
                $instrollment_data['installment_date'] = $date;
                $instrollment_data['area'] = $area;


//                $a = array("id" => 1,"create_date" => "2018-11-15","customer"=>61,"loan_amount" =>"23000","effective_date" => "21-09-2015");
//                $instrollment_data['id'] = $loan['id'];
//                $instrollment_data['create_date'] = $loan['create_date'];
//                $instrollment_data['customer'] = $loan['customer'];
//                $instrollment_data['loan_amount'] = $loan['loan_amount'];
//                $instrollment_data['effective_date'] = $loan['effective_date'];

                array_push($instrollment, $instrollment_data);
            }
            $start->modify($add_dates);
            $x++;
        }
    }
}

echo json_encode($instrollment);
}
// echo json_encode($data);
//   $stmt = $db->prepare($query);
//   $result = $stmt->execute($query);
// echo $result;
// $stmt = $db->query($query);
// $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
// echo json_encode($data);
?>