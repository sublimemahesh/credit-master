   <?php
                                            $defultdata = DefaultData::getNumOfInstlByPeriodAndType($LOAN->loan_period, $LOAN->installment_type);

                                            $start_date = $LOAN->effective_date;
                                            $start = new DateTime("$start_date");

                                            $x = 0;
                                            $ins_total = 0;
                                            $total_paid = 0;

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
                                                $customer = $LOAN->customer;

                                                $CUSTOMER = new Customer($customer);
                                                $route = $CUSTOMER->route;
                                                $center = $CUSTOMER->center;
                                                $amount = $LOAN->installment_amount;

                                                $Installment = new Installment(NULL);
                                                $paid_amount = 0;

                                                foreach ($Installment->CheckInstallmetByPaidDate($date, $loan_id) as $paid) {
                                                    $paid_amount += $paid['paid_amount'];
                                                }

                                                echo '<tr>';
                                                if (PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center) || PostponeDate::CheckIsPostPoneByDateAndAll($date)) {

                                                    echo '<td class="padd-td red">';
                                                    echo $date;
                                                    echo '</td>';
                                                    echo '<td class="padd-td gray text-center" colspan=5>';
                                                    echo '-- Postponed --';
                                                    echo '</td>';

                                                    $start->modify($add_dates);
                                                } else {
                                                    echo '<td class="padd-td f-style">';
                                                    echo $date;
                                                    echo '</td>';
                                                    echo '<td class="f-style">';
                                                    echo 'Rs: ' . number_format($amount, 2);
                                                    echo '</td>';

                                                    echo '<td class="f-style">';
                                                    if ($paid_amount) {
                                                        echo 'Paid';
                                                    } elseif ($date < $today) {
                                                        echo 'Unpaid';
                                                    } else {
                                                        echo 'Payble';
                                                    }
                                                    echo '</td>';

                                                    echo '<td class="f-style">';
                                                    if ($paid_amount) {
                                                        echo 'Rs: ' . number_format($paid_amount, 2);
                                                    } else {
                                                        echo '-';
                                                    }

                                                    echo '</td>';
                                                    echo '<td class="f-style">';
                                                    $ins_total += $amount;
                                                    $total_paid += $paid_amount;
                                                     
                                                    $due_and_excess = $total_paid - $ins_total;

                                                    if ($due_and_excess < 0) {
                                                        echo '<span style="color:red">' . number_format($due_and_excess, 2) . '</span>';
                                                    } elseif ($due_and_excess > 0) {
                                                        echo '<span style="color:green">' . number_format($due_and_excess, 2) . '</span>';
                                                    } else {
                                                        echo number_format($due_and_excess, 2);
                                                    }
                                                    echo '</td>';
                                                    echo '<td class="text-center">';


                                                    //check payment button 

                                                    if ($date == $today) {
                                                        echo '<a href="add-new-installment.php?date=' . $date . '&loan=' . $loan_id . '&amount=' . $amount . '">
                                                    <button class="glyphicon glyphicon-send btn btn-info" title="Payment"></button> 
                                                    </a>';

                                                        //show week payment button

                                                        $start = new DateTime("$today");
                                                        $date = '+7 day';
                                                        $start->modify($date);
                                                        $date = $start->format('Y-m-d');
                                                    } elseif ($LOAN->installment_type == 4 && ($date == $today)) {

                                                        echo '<a href="add-new-installment.php?date=' . $date . '&loan=' .'&amount=' . $amount . '">
                                                         <button class="glyphicon glyphicon-send btn btn-info" title="Payment"></button> 
                                                    </a>';


                                                        //show month payment button  
                                                        $start = new DateTime("$today");
                                                        $date = '+1 months';
                                                        $start->modify($date);
                                                        $date = $start->format('Y-m-d');
                                                    } elseif ($LOAN->installment_type == 1 && ($date == $today)) {
                                                        echo '<a href="add-new-installment.php?date=' . $date . '&loan=' . $loan_id . '&amount=' . $amount . '">
                                                    <button class="glyphicon glyphicon-send btn btn-info" title="Payment"></button> 
                                                    </a>';
                                                    } else {
                                                        echo ' <button class="glyphicon glyphicon-send btn btn-info disabled" title="Payment"></button>    ';
                                                    }
                                                    echo '</td>';
                                                    $start->modify($add_dates);
                                                    $x++;
                                                }
                                                echo '</tr>';
                                            }
                                            ?>