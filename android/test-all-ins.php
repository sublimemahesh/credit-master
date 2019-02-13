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

            if ($IT == 30) {
                $loanId = 'BLD' . $loan['id'];
            } elseif ($IT == 4) {
                $loanId = 'BLW' . $loan['id'];
            } else {
                $loanId = 'BLM' . $loan['id'];
            }

// $total_paid_amount = $INSTALLMENT->getAmountByLoanId($loan['id']);
            foreach ($Installment->CheckInstallmetByPaidDate1($date, $loan['id']) as $paid) {
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
                    $due_and_excess = $total_paid - $ins_total;
                    
                           if ($due_and_excess < 0) {
                              $due =  $total_paid - $ins_total;
                              $due_amount = number_format($due, 2);
                              
                              if($CUSTOMER->od_interest_limit < (-1*($due))){
                             $arries_interest = number_format($LOAN->getOdIntereset($loan['customer'], $due_and_excess, $loan['installment_type']), 2);
                        }else{
                            $arries_interest = '00.00';
                        }
                       
                                           }else{
                               $due =  '0.00';
                                $arries_interest = '00.00';
                           }
                           
                            if ($due_and_excess > 0) {
                    
                                $excess_amount = number_format($due_and_excess, 2);
                    } else {
                        $excess_amount = '0.00';
                    }
                    

                    
                    
                   
                                                       
                                                    //     echo round($arries_interest, 1);
                                                    // }


                    $fullAddress = [$CUSTOMER->address_line_1, $CUSTOMER->address_line_2, $CUSTOMER->address_line_3, $CUSTOMER->address_line_4, $CUSTOMER->address_line_5];
                    $address = implode(',', array_filter($fullAddress, 'strlen'));

                    $customer_name = $DefaultData->getFirstLetterName(ucwords($CUSTOMER->surname)) . $CUSTOMER->first_name . ' ' . $CUSTOMER->last_name;
                    $instrollment_data['id'] = $loan['id'];
                    $instrollment_data['loan_id'] = $loanId;
                    $instrollment_data['customer_name'] = $customer_name;
                    $instrollment_data['customer_no'] = $CUSTOMER->mobile;
                    $instrollment_data['customer_address'] = $address;
                    $instrollment_data['loan_amount'] = number_format($loan['loan_amount'], 2);
                    $instrollment_data['loan_period'] = $LP[$loan['loan_period']];
                    $instrollment_data['installment_type'] = $IT[$loan['installment_type']];
                    $instrollment_data['installment_amount'] = number_format($amount, 2);
                    $instrollment_data['due'] = $due_amount;
                    $instrollment_data['total_due'] = (-1*($arries_interest + $due));
                    $instrollment_data['excess'] = $excess_amount;
                    $instrollment_data['total_paid'] = $total_paid;
                    $instrollment_data['installment_date'] = $date;
                    $instrollment_data['area'] = $area;


                    array_push($instrollment, $instrollment_data);
                }
                $start->modify($add_dates);
                $x++;
            }
        }
    }
    echo json_encode($instrollment);
}

if ($_POST['action'] == 'route') {
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

            if ($IT == 30) {
                $loanId = 'BLD' . $loan['id'];
            } elseif ($IT == 4) {
                $loanId = 'BLW' . $loan['id'];
            } else {
                $loanId = 'BLM' . $loan['id'];
            }

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



    $due_and_excess = $total_paid - $ins_total;
                    
                           if ($due_and_excess < 0) {
                              $due =  $total_paid - $ins_total;
                              $due_amount = number_format($due, 2);
                              
                              if($CUSTOMER->od_interest_limit < (-1*($due))){
                             $arries_interest = number_format($LOAN->getOdIntereset($loan['customer'], $due_and_excess, $loan['installment_type']), 2);
                        }else{
                            $arries_interest = '00.00';
                        }
                       
                                           }else{
                               $due =  '0.00';
                                $arries_interest = '00.00';
                           }
                           
                            if ($due_and_excess > 0) {
                    
                                $excess_amount = number_format($due_and_excess, 2);
                    } else {
                        $excess_amount = '0.00';
                    }
                    
                    // $due_and_excess = $total_paid - $ins_total;

                    // if ($due_and_excess < 0) {
                    //     $due_amount = number_format($due_and_excess, 2);
                    //       $arries_interest = number_format($LOAN->getOdIntereset($loan['customer'], $due_and_excess, $loan['installment_type']), 2);
                    // } else {
                    //     $due_amount = '0.00';
                    // }

                    // if ($due_and_excess > 0) {
                    //     $excess_amount = number_format($due_and_excess, 2);
                    // } else {
                    //     $excess_amount = '0.00';
                    // }

                    $fullAddress = [$CUSTOMER->address_line_1, $CUSTOMER->address_line_2, $CUSTOMER->address_line_3, $CUSTOMER->address_line_4, $CUSTOMER->address_line_5];
                    $address = implode(',', array_filter($fullAddress, 'strlen'));



                    $customer_name = $DefaultData->getFirstLetterName(ucwords($CUSTOMER->surname)) . $CUSTOMER->first_name . ' ' . $CUSTOMER->last_name;
                    $instrollment_data['id'] = $loan['id'];
                    $instrollment_data['loan_id'] = $loanId;
                    $instrollment_data['customer_name'] = $customer_name;
                    $instrollment_data['customer_no'] = $CUSTOMER->mobile;
                    $instrollment_data['customer_address'] = $address;
                    $instrollment_data['loan_amount'] = number_format($loan['loan_amount'], 2);
                    $instrollment_data['loan_period'] = $LP[$loan['loan_period']];
                    $instrollment_data['installment_type'] = $IT[$loan['installment_type']];
                    $instrollment_data['installment_amount'] = number_format($amount, 2);
                   $instrollment_data['due'] = $due_amount;
                    $instrollment_data['total_due'] = (-1*($arries_interest + $due));
                    $instrollment_data['excess'] = $excess_amount;
                    $instrollment_data['total_paid'] = number_format($total_paid, 2);
                    $instrollment_data['installment_date'] = $date;
                    $instrollment_data['area'] = $area;

                    array_push($instrollment, $instrollment_data);
                }
                $start->modify($add_dates);
                $x++;
            }
        }
    }
    echo json_encode($instrollment);
}
?>