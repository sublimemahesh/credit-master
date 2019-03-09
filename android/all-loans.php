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

//if ($_POST['action'] == 'center') {
//    foreach ($LOAN->allByStatus() as $key => $loan) {
//
//        $defultdata = DefaultData::getNumOfInstlByPeriodAndType($loan['loan_period'], $loan['installment_type']);
//
//        $first_installment_date = '';
//
//        if ($loan['installment_type'] == 4) {
//            $FID = new DateTime($loan['effective_date']);
//            $FID->modify('+7 day');
//            $first_installment_date = $FID->format('Y-m-d');
//        } elseif ($loan['installment_type'] == 30) {
//            $FID = new DateTime($loan['effective_date']);
//            $FID->modify('+1 day');
//            $first_installment_date = $FID->format('Y-m-d');
//        } elseif ($loan['installment_type'] == 1) {
//            $FID = new DateTime($loan['effective_date']);
//            $FID->modify('+1 months');
//            $first_installment_date = $FID->format('Y-m-d');
//        }
//
//        $start = new DateTime($first_installment_date);
//
//        $x = 0;
//        $ins_total = 0;
//        $total_paid = 0;
//        while ($x < $defultdata) {
//            if ($defultdata == 4) {
//                $add_dates = '+7 day';
//            } elseif ($defultdata == 30) {
//                $add_dates = '+1 day';
//            } elseif ($defultdata == 8) {
//                $add_dates = '+7 day';
//            } elseif ($defultdata == 60) {
//                $add_dates = '+1 day';
//            } elseif ($defultdata == 2) {
//                $add_dates = '+1 months';
//            } elseif ($defultdata == 1) {
//                $add_dates = '+1 months';
//            } elseif ($defultdata == 90) {
//                $add_dates = '+1 day';
//            } elseif ($defultdata == 12) {
//                $add_dates = '+7 day';
//            } elseif ($defultdata == 3) {
//                $add_dates = '+1 months';
//            } elseif ($defultdata == 100) {
//                $add_dates = '+1 day';
//            } elseif ($defultdata == 13) {
//                $add_dates = '+7 day';
//            }
//
//            $date = $start->format('Y-m-d');
//            $customer = $loan['customer'];
//            $CUSTOMER = new Customer($customer);
//            $route = $CUSTOMER->route;
//            $center = $CUSTOMER->center;
//            $LP = DefaultData::getLoanPeriod();
//            $IT = DefaultData::getInstallmentType();
//            $LPasDays = DefaultData::getLoanPeriodAsDays();
//            $amount = $loan['installment_amount'];
//            $Installment = new Installment(NULL);
//            $paid_amount = 0;
//
//            if ($IT == 30) {
//                $loanId = 'BLD' . $loan['id'];
//            } elseif ($IT == 4) {
//                $loanId = 'BLW' . $loan['id'];
//            } else {
//                $loanId = 'BLM' . $loan['id'];
//            }
//
////            $total_paid_amount = $Installment->getAmountByLoanId($loan['id']);
////
////            foreach ($Installment->CheckInstallmetByPaidDate($date, $loan['id']) as $paid) {
////                $paid_amount += $paid['paid_amount'];
////            }
//
//          
//            foreach ($Installment->getInstallmentByLoan($loan['id']) as $installment) {
//                $paid_amount = $paid_amount + $installment["paid_amount"];
//            }
//
//       
//
//            $ins_total += $amount;
//           
//
//            if (PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center) || PostponeDate::CheckIsPostPoneByDateAndAll($date)) {
//                $start->modify($add_dates);
//            } else {
////$_POST['date']
//
//                 if ($date == $_POST['date'] && $_POST['centerid'] == $CUSTOMER->center) {
//
//
//
//                    $CENTER = new Center($CUSTOMER->center);
//                    if ($CUSTOMER->center = $CENTER->id) {
//                        $area = 'Center - ' . $CENTER->name;
//                    }
////                else {
////                    $ROUTE = new Route($CUSTOMER->route);
////                    $area = 'Route - ' . $ROUTE->name;
////                }
//                   
//                  
//            
//            
//                    $due_and_excess = $paid_amount - $ins_total;
//                    
//         
//                    //       if ($due_and_excess < 0) {
//                    //           $due =  $total_paid - $ins_total;
//                    //           $due_amount = number_format($due, 2);
//                    //           if($CUSTOMER->od_interest_limit < (-1*($due))){
//                    //          $arries_interest = number_format($LOAN->getOdIntereset($loan['customer'], $due_and_excess, $loan['installment_type']), 2);
//                    //     }else{
//                    //         $arries_interest = '00.00';
//                    //     }
//                    //                       }else{
//                    //           $due =  '0.00';
//                    //             $arries_interest = '00.00';
//                    //       }
//                    //         if ($due_and_excess > 0) {
//                    //             $excess_amount = number_format($due_and_excess, 2);
//                    // } else {
//                    //     $excess_amount = '0.00';
//                    // }
//                    // $due_and_excess = $total_paid - $ins_total;
//
//                    if ($due_and_excess < 0) {
//                        $arriers_amount = $due_and_excess;
////                        $arries_interest = number_format($LOAN->getOdIntereset($loan['customer'], $due_and_excess, $loan['installment_type']), 2);
//                    } else {
//                        $arriers_amount = '0.00';
//                    }
//
//                    if ($due_and_excess > 0) {
//                        $excess_amount = $due_and_excess;
//                    } else {
//                        $excess_amount = '0.00';
//                    }
//
//
//
//
//                    $LOAN_1 = new Loan($loan['id']);
//                    $status = $LOAN_1->getCurrentStatus();
//                    
//                                                        // if ($status["arrears-excess"] > 0) {
//                                                        //  $arriers_amount  = -1 * ($status["arrears-excess"]);
//                                                        // } else {
//                                                        //     $arriers_amount = '0.00';
//                                                        // }
//                                                        
//                                                        // if ($status["arrears-excess"] < 0) {
//                                                        //  $excess_amount  = -1 * ($status["arrears-excess"]);
//                                                        // } else {
//                                                        //  $excess_amount = '0.00';
//                                                        // }
//                                                    
//                                                    
//
//                    //     echo round($arries_interest, 1);
//                    // }
//
//
//                    $fullAddress = [$CUSTOMER->address_line_1, $CUSTOMER->address_line_2, $CUSTOMER->address_line_3, $CUSTOMER->address_line_4, $CUSTOMER->address_line_5];
//                    $address = implode(',', array_filter($fullAddress, 'strlen'));
//
//                    $customer_name = $DefaultData->getFirstLetterName(ucwords($CUSTOMER->surname)) . $CUSTOMER->first_name . ' ' . $CUSTOMER->last_name;
//                    $instrollment_data['id'] = $loan['id'];
//                    $instrollment_data['loan_id'] = $loanId;
//                    $instrollment_data['customer_name'] = $customer_name;
//                    $instrollment_data['customer_no'] = $CUSTOMER->mobile;
//                    $instrollment_data['customer_address'] = $address;
//                    $instrollment_data['loan_amount'] = number_format($loan['loan_amount'], 2);
//                    $instrollment_data['loan_period'] = $LP[$loan['loan_period']];
//                    $instrollment_data['installment_type'] = $IT[$loan['installment_type']];
//                    $instrollment_data['installment_amount'] = number_format($amount, 2);
//                    $instrollment_data['arriers'] = $arriers_amount;
//                    $instrollment_data['total_due'] = $status["actual-due"];
//                    $instrollment_data['start_date'] = $first_installment_date;
//                    $instrollment_data['excess'] = $excess_amount;
//                    $instrollment_data['total_paid'] = $paid_amount;
//                    $instrollment_data['ins_total'] = $ins_total;
//                    $instrollment_data['installment_date'] = $date;
//                    $instrollment_data['area'] = $area;
//
//
//                    array_push($instrollment, $instrollment_data);
//                }
//                $start->modify($add_dates);
//                $x++;
//            }
//        }
//    }
//    echo json_encode($instrollment);
//}
//
//if ($_POST['action'] == 'route') {
//     foreach ($LOAN->allByStatus() as $key => $loan) {
//
//        $defultdata = DefaultData::getNumOfInstlByPeriodAndType($loan['loan_period'], $loan['installment_type']);
//
//        $first_installment_date = '';
//
//        if ($loan['installment_type'] == 4) {
//            $FID = new DateTime($loan['effective_date']);
//            $FID->modify('+7 day');
//            $first_installment_date = $FID->format('Y-m-d');
//        } elseif ($loan['installment_type'] == 30) {
//            $FID = new DateTime($loan['effective_date']);
//            $FID->modify('+1 day');
//            $first_installment_date = $FID->format('Y-m-d');
//        } elseif ($loan['installment_type'] == 1) {
//            $FID = new DateTime($loan['effective_date']);
//            $FID->modify('+1 months');
//            $first_installment_date = $FID->format('Y-m-d');
//        }
//
//        $start = new DateTime($first_installment_date);
//
//        $x = 0;
//        $ins_total = 0;
//        $total_paid = 0;
//        while ($x < $defultdata) {
//            if ($defultdata == 4) {
//                $add_dates = '+7 day';
//            } elseif ($defultdata == 30) {
//                $add_dates = '+1 day';
//            } elseif ($defultdata == 8) {
//                $add_dates = '+7 day';
//            } elseif ($defultdata == 60) {
//                $add_dates = '+1 day';
//            } elseif ($defultdata == 2) {
//                $add_dates = '+1 months';
//            } elseif ($defultdata == 1) {
//                $add_dates = '+1 months';
//            } elseif ($defultdata == 90) {
//                $add_dates = '+1 day';
//            } elseif ($defultdata == 12) {
//                $add_dates = '+7 day';
//            } elseif ($defultdata == 3) {
//                $add_dates = '+1 months';
//            } elseif ($defultdata == 100) {
//                $add_dates = '+1 day';
//            } elseif ($defultdata == 13) {
//                $add_dates = '+7 day';
//            }
//
//            $date = $start->format('Y-m-d');
//            $customer = $loan['customer'];
//            $CUSTOMER = new Customer($customer);
//            $route = $CUSTOMER->route;
//            $center = $CUSTOMER->center;
//            $LP = DefaultData::getLoanPeriod();
//            $IT = DefaultData::getInstallmentType();
//            $amount = $loan['installment_amount'];
//            $Installment = new Installment(NULL);
//            $paid_amount = 0;
//
//            if ($IT == 30) {
//                $loanId = 'BLD' . $loan['id'];
//            } elseif ($IT == 4) {
//                $loanId = 'BLW' . $loan['id'];
//            } else {
//                $loanId = 'BLM' . $loan['id'];
//            }
//
////            $total_paid_amount = $Installment->getAmountByLoanId($loan['id']);
////
////            foreach ($Installment->CheckInstallmetByPaidDate($date, $loan['id']) as $paid) {
////                $paid_amount += $paid['paid_amount'];
////            }
//
//          
//            foreach ($Installment->getInstallmentByLoan($loan['id']) as $installment) {
//                $paid_amount = $paid_amount + $installment["paid_amount"];
//            }
//
//       
//
//            $ins_total += $amount;
//           
//
//            if (PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center) || PostponeDate::CheckIsPostPoneByDateAndAll($date)) {
//                $start->modify($add_dates);
//            } else {
////$_POST['date']
//
//                 if ($date == $_POST['date'] && $_POST['centerid'] == $CUSTOMER->center) {
//
//
//
//                    $CENTER = new Center($CUSTOMER->center);
//                    if ($CUSTOMER->center = $CENTER->id) {
//                        $area = 'Center - ' . $CENTER->name;
//                    }
////                else {
////                    $ROUTE = new Route($CUSTOMER->route);
////                    $area = 'Route - ' . $ROUTE->name;
////                }
//                   
//                    $due_and_excess = $paid_amount - $ins_total;
//                    
//         
//                    //       if ($due_and_excess < 0) {
//                    //           $due =  $total_paid - $ins_total;
//                    //           $due_amount = number_format($due, 2);
//                    //           if($CUSTOMER->od_interest_limit < (-1*($due))){
//                    //          $arries_interest = number_format($LOAN->getOdIntereset($loan['customer'], $due_and_excess, $loan['installment_type']), 2);
//                    //     }else{
//                    //         $arries_interest = '00.00';
//                    //     }
//                    //                       }else{
//                    //           $due =  '0.00';
//                    //             $arries_interest = '00.00';
//                    //       }
//                    //         if ($due_and_excess > 0) {
//                    //             $excess_amount = number_format($due_and_excess, 2);
//                    // } else {
//                    //     $excess_amount = '0.00';
//                    // }
//                    // $due_and_excess = $total_paid - $ins_total;
//
//                    if ($due_and_excess < 0) {
//                        $due_amount = $due_and_excess;
////                        $arries_interest = number_format($LOAN->getOdIntereset($loan['customer'], $due_and_excess, $loan['installment_type']), 2);
//                    } else {
//                        $due_amount = '0.00';
//                    }
//
//                    if ($due_and_excess > 0) {
//                        $excess_amount = number_format($due_and_excess, 2);
//                    } else {
//                        $excess_amount = '0.00';
//                    }
//
//                    $LOAN_1 = new Loan($loan['id']);
//                    $status = $LOAN_1->getCurrentStatus();
//
//
//                    //     echo round($arries_interest, 1);
//                    // }
//
//
//                    $fullAddress = [$CUSTOMER->address_line_1, $CUSTOMER->address_line_2, $CUSTOMER->address_line_3, $CUSTOMER->address_line_4, $CUSTOMER->address_line_5];
//                    $address = implode(',', array_filter($fullAddress, 'strlen'));
//
//                    $customer_name = $DefaultData->getFirstLetterName(ucwords($CUSTOMER->surname)) . $CUSTOMER->first_name . ' ' . $CUSTOMER->last_name;
//                    $instrollment_data['id'] = $loan['id'];
//                    $instrollment_data['loan_id'] = $loanId;
//                    $instrollment_data['customer_name'] = $customer_name;
//                    $instrollment_data['customer_no'] = $CUSTOMER->mobile;
//                    $instrollment_data['customer_address'] = $address;
//                    $instrollment_data['loan_amount'] = number_format($loan['loan_amount'], 2);
//                    $instrollment_data['loan_period'] = $LPasDays[$loan['loan_period']];
//                    $instrollment_data['installment_type'] = $IT[$loan['installment_type']];
//                    $instrollment_data['installment_amount'] = number_format($amount, 2);
//                    $instrollment_data['arriers'] = $due_amount;
//                    $instrollment_data['total_due'] = $status["actual-due"];
//                    $instrollment_data['start_date'] = $first_installment_date;
//                    $instrollment_data['excess'] = $excess_amount;
//                    $instrollment_data['total_paid'] = $paid_amount;
//                    $instrollment_data['installment_date'] = $date;
//                    $instrollment_data['area'] = $area;
//
//
//                    array_push($instrollment, $instrollment_data);
//                }
//                $start->modify($add_dates);
//                $x++;
//            }
//        }
//    }
//    echo json_encode($instrollment);
//}
?>