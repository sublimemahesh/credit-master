  ///monthly and weekly
                                                    if ($LOAN->installment_type == 4 || $LOAN->installment_type == 1) {

                                                        $end = new DateTime($date);
                                                        $end->modify('+6 day');
                                                        $end = $end->format('Y-m-d H:i:s');

                                                        $date = new DateTime($date);
                                                        $date->modify('+1 day');
                                                        $date = $date->format('Y-m-d H:i:s');

                                                        $begin = new DateTime($date);
                                                        $end = new DateTime($end);

                                                        for ($i = $begin; $i <= $end; $i->modify('+1 day')) {


                                                            if (PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center) || PostponeDate::CheckIsPostPoneByDateAndAll($date) || PostponeDate::CheckIsPostPoneByDateCenterAll($date) || PostponeDate::CheckIsPostPoneByDateRouteAll($date)) {
                                                                $row_count++;

                                                                echo '<tr>';
                                                                echo '<td class"tr-color font-color-2"  id="back-color">';
                                                                echo $row_count;
                                                                echo '</td>';
                                                                echo '<td class="padd-td f-style tr-color font-color-2" id="back-color">';
                                                                echo $date;
                                                                echo '</td>';
                                                                echo '<td class="padd-td f-style tr-color font-color-2" id="back-color">';

                                                                echo '</td>';
                                                                echo '<td class="f-style tr-color font-color-2" id="back-color">';
                                                                echo 'Installment';
                                                                echo '</td>';

                                                                echo '<td class="f-style tr-color font-color-2" id="back-color">';
                                                                echo '<p style="color:red">' . number_format($amount, 2) . '</p>  ';
                                                                echo '</td>';

                                                                echo '<td class="f-style tr-color font-color-2" id="back-color">';
                                                                echo '</td>';

                                                                echo '<td class="f-style tr-color font-color-2" id="back-color">';
                                                                //installment balance
//                                                        $installment_balance = $balance - $ins_total;
//
//                                                        $balance = $paid_all_amount_before_ins_date - $ins_total;
//
//                                                        echo number_format($balance, 2);

                                                                $ins_total += $amount;
                                                                $total_paid += $paid_amount;
                                                                $due_and_excess = $total_paid - $ins_total;

                                                                $before_balance_amount = $paid_all_amount_before_ins_date - $ins_total;
                                                                $last_od_amount = (float) end($last_od);
                                                                $od_total_amount = (float) end($od_total);


                                                                //dsw
                                                                $last_pay_total = (float) end($payment_arr);

//                                                    echo $before_balance_amount - $last_od;
                                                                //installment last balance
//                                                    $before_installment = (-1 * ($amount)) + $last_od_total - $paid_all_amount_before_ins_date;
                                                                //installment balance daily
                                                                $balance = $paid_all_od_before_ins_date + $paid_all_amount_before_ins_date - $ins_total - $od_total_amount;

                                                                echo number_format($balance, 2);

                                                                echo '</td>';
                                                                echo '</tr>';

                                                                $repeat = strtotime("+1 day", strtotime($date));
                                                                $date = date('Y-m-d H:i:s', $repeat);
                                                                
                                                            } else {

                                                                echo '<tr>';
                                                                echo '<td class"tr-color font-color-2"  id="back-color">';
                                                                echo $row_count;
                                                                echo '</td>';
                                                                echo '<td class="padd-td f-style tr-color font-color-2" id="back-color">';
                                                                echo $date;
                                                                echo '</td>';
                                                                echo '<td class="padd-td f-style tr-color font-color-2" id="back-color">';

                                                                echo '</td>';
                                                                echo '<td class="f-style tr-color font-color-2" id="back-color">';
                                                                echo 'Installment';
                                                                echo '</td>';

                                                                echo '<td class="f-style tr-color font-color-2" id="back-color">';
                                                                echo '<p style="color:red">' . number_format($amount, 2) . '</p>  ';
                                                                echo '</td>';

                                                                echo '<td class="f-style tr-color font-color-2" id="back-color">';
                                                                echo '</td>';

                                                                echo '<td class="f-style tr-color font-color-2" id="back-color">';
                                                                $ins_total += $amount;
                                                                $total_paid += $paid_amount;
                                                                $due_and_excess = $total_paid - $ins_total;

                                                                $before_balance_amount = $paid_all_amount_before_ins_date - $ins_total;
                                                                $last_od_amount = (float) end($last_od);
                                                                $od_total_amount = (float) end($od_total);





//                                                    echo $before_balance_od_total - $paid_all_amount_before_ins_date;
                                                                //installment balance dailyamount - $last_od;
                                                                //installment last balance
//                                                    $before_installment = (-1 * ($amount)) + $last_od_total - $paid_all_amount_before_ins_date;
                                                                //installment balance daily

                                                                $balance = $paid_all_od_before_ins_date + $paid_all_amount_before_ins_date - $ins_total - $od_total_amount;

                                                                echo number_format($balance, 2);
//                                                    echo (-1 * ($amount)) - $last_pay_total + $last_pay_total;

                                                                echo '</td>';

                                                                $end = strtotime("+1 day", strtotime($date));
                                                                $end = date('Y-m-d H:i:s', $repeat);
                                                            }
                                                        }
                                                    }