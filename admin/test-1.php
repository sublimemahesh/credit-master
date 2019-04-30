 <?php
public function getCurrentStatus() {

        date_default_timezone_set("Asia/Calcutta");
        $time = date('H:i:s');
        $today = date('Y-m-d H:i:s');
        $numOfInstallments = DefaultData::getNumOfInstlByPeriodAndType($this->loan_period, $this->installment_type);
        $first_installment_date = '';
        $paid_aditional_interrest = 0;

        //daily installment
        if ($this->installment_type == 30) {

            $FID = new DateTime($this->effective_date);
            $FID->modify('+1 day');
            $first_installment_date = $FID->format('Y-m-d ' . $time);


            $start = new DateTime($first_installment_date);
            $first_date = $start->format('Y-m-d ' . $time);

            $x = 0;
            $total_installment_amount = 0;
            $ins_total = 0;
            $total_paid = 0;
            $od_amount_all_array = array();

            $od_array = array();
            $last_od = array();
            $od_total = array();
            $last_od_balance = array();
            $od_balance_amount = array();

            while ($x < $numOfInstallments) {
                if ($numOfInstallments == 4) {
                    $modify_range = '+7 day';
                } elseif ($numOfInstallments == 30) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 8) {
                    $modify_range = '+7 day';
                } elseif ($numOfInstallments == 60) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 2) {
                    $modify_range = '+1 months';
                } elseif ($numOfInstallments == 1) {
                    $modify_range = '+1 months';
                } elseif ($numOfInstallments == 90) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 12) {
                    $modify_range = '+7 day';
                } elseif ($numOfInstallments == 3) {
                    $modify_range = '+1 months';
                } elseif ($numOfInstallments == 100) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 13) {
                    $modify_range = '+7 day';
                }

                $date = $start->format('Y-m-d ' . $time);

                $paid_amount = 0;
                $od_amount = 0;
                $od_amount_all = 0;
                $balance = 0;
                $loan_proccesign_fee_paid = 0;
                $total_od_paid = 0;
                $paid_all_amount_before_ins_date = 0;
                $paid_all_od_before_ins_date = 0;
                $last_od_amount = 0;
                $od_interest = 0;

                $customer = $this->customer;
                $CUSTOMER = new Customer($customer);
                $route = $CUSTOMER->route;
                $center = $CUSTOMER->center;
                $installment_amount = $this->installment_amount;

                $FID = new DateTime($date);
                $FID->modify($modify_range);
                $day_remove = '-1 day';
                $FID->modify($day_remove);
                $second_installment_date = $FID->format('Y-m-d ' . $time);
                $amount = $this->installment_amount;

                $INSTALLMENT = new Installment(NULL);
                $ALl_AMOUNT = $INSTALLMENT->getAmountByLoanId($this->id);

                foreach ($INSTALLMENT->CheckInstallmetByPaidDate($date, $this->id) as $paid) {
                    $paid_amount += $paid['paid_amount'];
                }

                foreach ($INSTALLMENT->getPaidAmountByBeforeDate($date, $this->id) as $before_payment_amount) {
                    $paid_all_amount_before_ins_date += $before_payment_amount['paid_amount'];
                    $paid_all_od_before_ins_date += $before_payment_amount['additional_interest'];
                }

                if (PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center) || PostponeDate::CheckIsPostPoneByDateAndAll($date) || PostponeDate::CheckIsPostPoneByDateCenterAll($date) || PostponeDate::CheckIsPostPoneByDateRouteAll($date)) {
                    $start->modify($modify_range);
                } else {


                    $ins_total += $amount;
                    $total_paid += $paid_amount;
                    $last_od_amount = (float) end($od_amount_all_array);

                    $balance = $paid_all_od_before_ins_date + $paid_all_amount_before_ins_date - $ins_total - $last_od_amount;

                    $OD = new OD(NULL);
                    $OD->loan = $this->id;
                    $AllOd = $OD->allOdByLoan();
                    $od = $OD->allOdByLoanAndDate($date, $balance);

                    //get daily loan od amount   
                    if (strtotime(date("Y/m/d")) < strtotime($date) || !$AllOd || PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center) || PostponeDate::CheckIsPostPoneByDateAndAll($date) || PostponeDate::CheckIsPostPoneByDateCenterAll($date) || PostponeDate::CheckIsPostPoneByDateRouteAll($date) || $ALl_AMOUNT[0] >= $ins_total) {
                        
                    } else {
                        if ($AllOd) {

                            foreach ($AllOd as $key => $allod) {

                                if (strtotime($allod['od_date_start']) <= strtotime($date) && strtotime($date) <= strtotime($allod['od_date_end']) && (-1 * ($allod['od_interest_limit'])) > $balance) {

                                    if (strtotime(date("Y/m/d")) <= strtotime($date)) {
                                        break;
                                    }

                                    $ODDATES = new DateTime($date);
                                    $ODDATES->modify(' +23 hours +59 minutes +58 seconds');

                                    $od_date_morning = $ODDATES->format('Y-m-d H:i:s');

                                    $paid_all_amount_before_ins_date1 = 0;
                                    $before_payment_amounts1 = $INSTALLMENT->getPaidAmountByBeforeDate($od_date_morning, $this->id);

                                    foreach ($before_payment_amounts1 as $before_payment_amount1) {
                                        $paid_all_amount_before_ins_date1 += $before_payment_amount1['paid_amount'];
                                    }

                                    $od_interest = $this->getOdIntereset1(-$ins_total + $paid_all_amount_before_ins_date1, $od['od_interest_limit']);

                                    $od_array[] = $od_interest;
                                    $od_amount_all = json_encode(round(array_sum($od_array), 2));

                                    if ($od_amount_all > 0 || $paid_all_od_before_ins_date == $last_od_amount) {
                                        array_push($od_amount_all_array, $od_amount_all);
                                    }
                                }
                            }
                        }
                    }

                    $total_installment_amount += $installment_amount;

                    if (strtotime(date("Y/m/d")) <= strtotime($date)) {
                        break;
                    }

                    $start->modify($modify_range);
                    $x++;

                    //end of the installment 
                    if ($numOfInstallments == $x) {

                        $ODDATES = new DateTime($date);
                        $ODDATES->modify('+23 hours +59 minutes +58 seconds');
                        $od_date_morning = $ODDATES->format('Y-m-d H:i:s');

                        //check log ends with od or installment 
                        $last_od_date = date('D/M/Y', strtotime($od_date_morning));
                        $last_installment_date = date('D/M/Y', strtotime($date));

                        if ($last_od_date == $last_installment_date) {
                            $last_loop_od = $od_interest;
                        } else {
                            $last_loop_od = 0;
                        }

                        //get installment end date
                        $INSTALLMENT_END = new DateTime($date);
                        $INSTALLMENT_END->modify('+1 day');
                        $installment_end = $INSTALLMENT_END->format('Y-m-d H:i:s');

                        //get 5 years ahead date from installment end date
                        $INSTALLMENT_UNLIMITED_END = new DateTime($date);
                        $INSTALLMENT_UNLIMITED_END->modify('+1725 day');
                        $installment_unlimited_end = $INSTALLMENT_UNLIMITED_END->format('Y-m-d H:i:s');


                        $start = strtotime($date);
                        $end = strtotime(date("Y/m/d"));
                        $days_between = floor(abs($end - $start) / 86400) - 1;
                        $od = $OD->allOdByLoanAndDate($date, $balance);
                        $y = 0;

                        $od_date_start1 = new DateTime($date);
                        $od_date_start1->modify('+47 hours +59 minutes +58 seconds');

                        $defult_val = $days_between;
                        $od_amount_all_array_1 = array();

                        while ($y <= $defult_val) {

                            if ($od['od_date_start'] <= $od_date_start1) {
                                $od_dates = '+1 day';
                            }

                            $od_date = $od_date_start1->format('Y-m-d H:i:s');

                            //getting echo $od_date; before of date from current od date
                            $OLDODDATE = new DateTime($od_date);
                            $od_date_remove1 = '-23 hours -59 minutes -58 seconds';

                            $OLDODDATE->modify($od_date_remove1);
                            $old_od_date = $OLDODDATE->format('Y-m-d H:i:s');

                            if (strtotime(date("Y/m/d")) <= strtotime($old_od_date) || strtotime($od['od_date_end'] . $time) < strtotime($old_od_date)) {
                                break;
                            }

                            $od_array[] = $od_interest;
                            $od_amount_all = json_encode(round(array_sum($od_array), 2));

                            if ($od_amount_all > 0 || $paid_all_od_before_ins_date == $last_od_amount) {

                                array_push($od_amount_all_array_1, $od_amount_all);
                            }

                            $od_date_start1->modify($od_dates);
                            $y++;

                            $last_od_amount = (float) end($od_amount_all_array_1);
                        }
                    }
                }
            }


            //weekly installment
        } else if ($this->installment_type == 4) {


            $FID = new DateTime($this->effective_date);
            $FID->modify('+7 day');
            $first_installment_date = $FID->format('Y-m-d ' . $time);


            $start = new DateTime($first_installment_date);
            $first_date = $start->format('Y-m-d ' . $time);

            $x = 0;
            $total_installment_amount = 0;
            $ins_total = 0;
            $total_paid = 0;
            $od_amount_all_array = array();
            $od_array = array();
            $last_od = array();
            $od_total = array();
            $last_od_balance = array();
            $od_balance_amount = array();

            while ($x < $numOfInstallments) {
                if ($numOfInstallments == 4) {
                    $modify_range = '+7 day';
                } elseif ($numOfInstallments == 30) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 8) {
                    $modify_range = '+7 day';
                } elseif ($numOfInstallments == 60) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 2) {
                    $modify_range = '+1 months';
                } elseif ($numOfInstallments == 1) {
                    $modify_range = '+1 months';
                } elseif ($numOfInstallments == 90) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 12) {
                    $modify_range = '+7 day';
                } elseif ($numOfInstallments == 3) {
                    $modify_range = '+1 months';
                } elseif ($numOfInstallments == 100) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 13) {
                    $modify_range = '+7 day';
                }

                $date = $start->format('Y-m-d ' . $time);

                $paid_amount = 0;
                $od_amount = 0;
                $od_amount_all = 0;
                $balance = 0;
                $loan_proccesign_fee_paid = 0;
                $total_od_paid = 0;
                $paid_all_amount_before_ins_date = 0;
                $paid_all_od_before_ins_date = 0;

                $customer = $this->customer;
                $CUSTOMER = new Customer($customer);
                $route = $CUSTOMER->route;
                $center = $CUSTOMER->center;
                $installment_amount = $this->installment_amount;

                $FID = new DateTime($date);
                $FID->modify($modify_range);
                $day_remove = '-1 day';
                $FID->modify($day_remove);
                $second_installment_date = $FID->format('Y-m-d ' . $time);
                $amount = $this->installment_amount;

                $INSTALLMENT = new Installment(NULL);
                $ALl_AMOUNT = $INSTALLMENT->getAmountByLoanId($this->id);

                foreach ($INSTALLMENT->CheckInstallmetByPaidDate($date, $this->id) as $paid) {
                    $paid_amount += $paid['paid_amount'];
                }

                $before_payment_amounts = $INSTALLMENT->getPaidAmountByBeforeDate($date, $this->id);

                foreach ($before_payment_amounts as $before_payment_amount) {
                    $paid_all_amount_before_ins_date += $before_payment_amount['paid_amount'];
                    $paid_all_od_before_ins_date += $before_payment_amount['additional_interest'];
                }

                if (PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center) || PostponeDate::CheckIsPostPoneByDateAndAll($date) || PostponeDate::CheckIsPostPoneByDateCenterAll($date) || PostponeDate::CheckIsPostPoneByDateRouteAll($date)) {
                    $start->modify($modify_range);
                } else {

                    $last_od_amount = (float) end($od_amount_all_array);

                    $ins_total += $amount;
                    $total_paid += $paid_amount;

                    $balance = $paid_all_od_before_ins_date + $paid_all_amount_before_ins_date - $ins_total - $last_od_amount;

                    $OD = new OD(NULL);
                    $OD->loan = $this->id;
                    $od = $OD->allOdByLoanAndDate($date, $balance);

                    if (strtotime(date("Y/m/d")) < strtotime($date) || PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center) || PostponeDate::CheckIsPostPoneByDateAndAll($date) || PostponeDate::CheckIsPostPoneByDateCenterAll($date) || PostponeDate::CheckIsPostPoneByDateRouteAll($date) || $ALl_AMOUNT[0] >= $ins_total) {
                        
                    } else {
                        if ($od !== false) {

                            $od_interest = $this->getOdIntereset(-$ins_total + $paid_all_amount_before_ins_date, $od['od_interest_limit']);

                            $y = 0;
                            $od_date_start = new DateTime($date);
                            $defult_val = 6;

                            while ($y <= $defult_val) {

                                if ($defult_val <= 6 && $this->od_date <= $od_date_start) {
                                    $od_dates = '+1 day';
                                }

                                $od_date = $od_date_start->format('Y-m-d H:i:s');

                                //// od dates range

                                $ODDATES = new DateTime($od_date);
                                $ODDATES->modify($od_dates);

                                $od_date_remove = '-1 day -23 hours -59 minutes -58 seconds';

                                $ODDATES->modify($od_date_remove);

                                $od_night = $ODDATES->format('Y-m-d H:i:s');
                                if ((strtotime(date("Y/m/d")) <= strtotime($od_date)) || strtotime($od['od_date_end'] . $time) <= strtotime($od_date)) {
                                    break;
                                }

                                $od_array[] = $od_interest;
                                $od_amount_all = json_encode(round(array_sum($od_array), 2));

                                if ($od_amount_all > 0) {

                                    array_push($od_amount_all_array, $od_amount_all);
                                }
                                $od_date_start->modify($od_dates);
                                $y++;
                            }
                        }
                    }
                }



                if (strtotime(date("Y/m/d")) <= strtotime($date)) {
                    break;
                }
                $total_installment_amount += $installment_amount;

                $start->modify($modify_range);
                $x++;

                if ($numOfInstallments == $x) {
                    //get installment end date
                    $INSTALLMENT_END = new DateTime($date);
                    $INSTALLMENT_END->modify('+7 day');
                    $installment_end = $INSTALLMENT_END->format('Y-m-d H:i:s');

                    //get 5 years ahead date from installment end date
                    $INSTALLMENT_UNLIMITED_END = new DateTime($date);
                    $INSTALLMENT_UNLIMITED_END->modify('+1725 day');
                    $installment_unlimited_end = $INSTALLMENT_UNLIMITED_END->format('Y-m-d H:i:s');


                    $start = strtotime($date);
                    $end = strtotime(date("Y/m/d"));

                    $days_between = floor(abs($end - $start) / 86400) - 1;

                    $z = 0;

                    $od_date_start1 = new DateTime($od_night);
                    $od_date_start1->modify('+1 day +23 hours +59 minutes +58 seconds');
                    $defult_val = $days_between;

                    //if having od after installment end
                    if ($od !== false) {

                        $last_od_date = date('D/M/Y', strtotime($od_night));
                        $last_installment_date = date('D/M/Y', strtotime($date));

                        if ($last_od_date == $last_installment_date) {
                            $last_loop_od = $od_interest;
                        } else {
                            $last_loop_od = 0;
                        }
                        $od_amount_all_array_1 = array();

                        while ($z <= $defult_val) {

                            if ($od['od_date_start'] <= $od_date_start1) {
                                $od_dates = '+1 day';
                            }


                            $od_date1 = $od_date_start1->format('Y-m-d H:i:s');

                            //getting brfore of date from current od date
                            $OLDODDATE = new DateTime($od_date1);
                            $od_date_remove1 = '-23 hours -59 minutes -58 seconds';

                            $OLDODDATE->modify($od_date_remove1);
                            $old_od_date = $OLDODDATE->format('Y-m-d H:i:s');


                            if (strtotime(date("Y/m/d")) <= strtotime($old_od_date) || strtotime($od['od_date_end'] . $time) < strtotime($old_od_date)) {
                                break;
                            }

                            $od_array[] = $od_interest;
                            $od_amount_all = json_encode(round(array_sum($od_array), 2));

                            if ($od_amount_all > 0 || $paid_all_od_before_ins_date == $last_od_amount) {

                                array_push($od_amount_all_array_1, $od_amount_all);
                            }

                            $od_date_start1->modify($od_dates);
                            $z++;
                        }
                        $last_od_amount = (float) end($od_amount_all_array_1);
                    }
                }
            }
        } else if ($this->installment_type == 1) {

            $FID = new DateTime($this->effective_date);
            $FID->modify('+1 months');
            $first_installment_date = $FID->format('Y-m-d ' . $time);


            $start = new DateTime($first_installment_date);
            $first_date = $start->format('Y-m-d ' . $time);

            $x = 0;
            $no_of_installments = 0;
            $total_installment_amount = 0;
            $ins_total = 0;
            $total_paid = 0;
            $od_amount_all_array = array();
            $od_array = array();
            $last_od = array();
            $od_total = array();
            $last_od_balance = array();
            $od_balance_amount = array();

            while ($x < $numOfInstallments) {
                if ($numOfInstallments == 4) {
                    $modify_range = '+7 day';
                } elseif ($numOfInstallments == 30) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 8) {
                    $modify_range = '+7 day';
                } elseif ($numOfInstallments == 60) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 2) {
                    $modify_range = '+1 months';
                } elseif ($numOfInstallments == 1) {
                    $modify_range = '+1 months';
                } elseif ($numOfInstallments == 90) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 12) {
                    $modify_range = '+7 day';
                } elseif ($numOfInstallments == 3) {
                    $modify_range = '+1 months';
                } elseif ($numOfInstallments == 100) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 13) {
                    $modify_range = '+7 day';
                }

                $date = $start->format('Y-m-d ' . $time);

                $paid_amount = 0;
                $od_amount = 0;
                $od_amount_all = 0;
                $balance = 0;
                $loan_proccesign_fee_paid = 0;
                $total_od_paid = 0;
                $paid_all_amount_before_ins_date = 0;
                $paid_all_od_before_ins_date = 0;

                $customer = $this->customer;
                $CUSTOMER = new Customer($customer);
                $route = $CUSTOMER->route;
                $center = $CUSTOMER->center;
                $installment_amount = $this->installment_amount;

                $FID = new DateTime($date);
                $FID->modify($modify_range);
                $day_remove = '-1 day';
                $FID->modify($day_remove);
                $second_installment_date = $FID->format('Y-m-d ' . $time);
                $amount = $this->installment_amount;

                $INSTALLMENT = new Installment(NULL);
                $ALl_AMOUNT = $INSTALLMENT->getAmountByLoanId($this->id);

                foreach ($INSTALLMENT->CheckInstallmetByPaidDate($date, $this->id) as $paid) {
                    $paid_amount += $paid['paid_amount'];
                }

                $before_payment_amounts = $INSTALLMENT->getPaidAmountByBeforeDate($date, $this->id);

                foreach ($before_payment_amounts as $before_payment_amount) {
                    $paid_all_amount_before_ins_date += $before_payment_amount['paid_amount'];
                    $paid_all_od_before_ins_date += $before_payment_amount['additional_interest'];
                }

                if (PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center) || PostponeDate::CheckIsPostPoneByDateAndAll($date) || PostponeDate::CheckIsPostPoneByDateCenterAll($date) || PostponeDate::CheckIsPostPoneByDateRouteAll($date)) {
                    $start->modify($modify_range);
                } else {

                    $last_od_amount = (float) end($od_amount_all_array);
                    $ins_total += $amount;
                    $total_paid += $paid_amount;

                    $balance = $paid_all_od_before_ins_date + $paid_all_amount_before_ins_date - $ins_total - $last_od_amount;

                    $OD = new OD(NULL);
                    $OD->loan = $this->id;
                    $od = $OD->allOdByLoanAndDate($date, $balance);

                    if (strtotime(date("Y/m/d")) < strtotime($date) || PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center) || PostponeDate::CheckIsPostPoneByDateAndAll($date) || PostponeDate::CheckIsPostPoneByDateCenterAll($date) || PostponeDate::CheckIsPostPoneByDateRouteAll($date) || $ALl_AMOUNT[0] >= $ins_total) {
                        
                    } else {
                        if ($od !== false) {
                            $y = 0;
                            //get how many dates in month
                            $dateValue = strtotime($date);
                            $year = date("Y", $dateValue);
                            $month = date("m", $dateValue);

                            $daysOfMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

                            $od_date_start = new DateTime($date);
                            $defult_val = $daysOfMonth - 1;
                            $od_interest = $this->getOdIntereset(-$ins_total + $paid_all_amount_before_ins_date, $od['od_interest_limit']);

                            while ($y <= $defult_val) {

                                if ($defult_val <= $daysOfMonth - 1 && $this->od_date <= $od_date_start) {
                                    $od_dates = '+1 day';
                                }

                                $od_date = $od_date_start->format('Y-m-d');

                                if ((strtotime(date("Y/m/d")) <= strtotime($od_date))) {
                                    break;
                                }

                                $ODDATES = new DateTime($od_date);
                                $ODDATES->modify($od_dates);

                                $od_date_remove = '-1 day -23 hours -59 minutes -58 seconds';

                                $ODDATES->modify($od_date_remove);

                                $od_night = $ODDATES->format('Y-m-d H:i:s');

                                $od_array[] = $od_interest;
                                $od_amount_all = json_encode(round(array_sum($od_array), 2));

                                array_push($od_amount_all_array, $od_amount_all);

                                $od_date_start->modify($od_dates);
                                $y++;
                            }
                        }
                    }
                }

                if (strtotime(date("Y/m/d")) <= strtotime($date)) {
                    break;
                }
                $total_installment_amount += $installment_amount;

                $start->modify($modify_range);
                $x++;

                if ($numOfInstallments == $x) {

                    //get installment end date
                    $INSTALLMENT_END = new DateTime($date);
                    $INSTALLMENT_END->modify('+' . $daysOfMonth . ' day');
                    $installment_end = $INSTALLMENT_END->format('Y-m-d H:i:s');

                    //get 5 years ahead date from installment end date
                    $INSTALLMENT_UNLIMITED_END = new DateTime($date);
                    $INSTALLMENT_UNLIMITED_END->modify('+1725 day');
                    $installment_unlimited_end = $INSTALLMENT_UNLIMITED_END->format('Y-m-d H:i:s');


                    $start = strtotime($date);
                    $end = strtotime(date("Y/m/d"));

                    $days_between = floor(abs($end - $start) / 86400) - 1;

                    $z = 0;

                    $od_date_start1 = new DateTime($od_night);
                    $od_date_start1->modify('+1 day +23 hours +59 minutes +58 seconds');

                    $defult_val = $days_between;

                    //if having od after installment end
                    if ($od !== false) {

                        $last_od_date = date('D/M/Y', strtotime($od_night));
                        $last_installment_date = date('D/M/Y', strtotime($date));

                        $od_amount_all_array_1 = array();
                        while ($z <= $defult_val) {

                            if ($od['od_date_start'] <= $od_date_start1) {
                                $od_dates = '+1 day';
                            }

                            $od_date1 = $od_date_start1->format('Y-m-d');

                            if ((strtotime(date("Y/m/d")) <= strtotime($od_date1) || strtotime($od['od_date_end'] . $time) <= strtotime($od_date1 . $time))) {
                                break;
                            }
                            //getting brfore of date from current od date
                            $OLDODDATE = new DateTime($od_date1);

                            $od_date_remove1 = '-23 hours -59 minutes -58 seconds';

                            $OLDODDATE->modify($od_date_remove1);

                            $old_od_date = $OLDODDATE->format('Y-m-d H:i:s');

                            $od_array[] = $od_interest;
                            $od_amount_all = json_encode(round(array_sum($od_array), 2));

                            if ($od_amount_all > 0 || $paid_all_od_before_ins_date == $last_od_amount) {

                                array_push($od_amount_all_array_1, $od_amount_all);
                            }

                            $od_date_start1->modify($od_dates);
                            $z++;

                            $last_od_amount = (float) end($od_amount_all_array_1);
                        }
                    }
                }
            }
        }

        $Installment = new Installment(NULL);
        $total_paid_installment = 0;

        foreach ($Installment->getInstallmentByLoan($this->id) as $installment) {
            $paid_aditional_interrest += $installment["additional_interest"];
            $total_paid_installment = $total_paid_installment + $installment["paid_amount"];
        }

        $loan_amount = $numOfInstallments * $this->installment_amount;
        $system_due = $loan_amount - $total_installment_amount;
        $system_due_num_of_ins = $system_due / $this->installment_amount;
        $actual_due = $loan_amount - $total_paid_installment;
        $actual_due_num_of_ins = $actual_due / $this->installment_amount;



        $all_arress = ($paid_aditional_interrest + $total_paid_installment) - ($total_installment_amount + $last_od_amount);


        return [
            'od_amount' => $last_od_amount - $paid_aditional_interrest,
            'all_arress' => $all_arress,
            'all_amount' => $balance,
            'system-due-num-of-ins' => $system_due_num_of_ins,
            'system-due' => $system_due,
            'actual-due-num-of-ins' => $actual_due_num_of_ins,
            'actual-due' => $actual_due,
            'receipt-num-of-ins' => $total_paid_installment / $this->installment_amount,
            'receipt' => $total_paid_installment + $paid_aditional_interrest,
            'arrears-excess-num-of-ins' => ($total_installment_amount - $total_paid_installment) / $this->installment_amount,
            'arrears-excess' => $total_installment_amount - $total_paid_installment,
            'installment_amount' => $amount,
        ];
    }