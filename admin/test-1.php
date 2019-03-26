<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
            $count++;
            echo '<tr>';
            echo '<td class="tr-color font-color-2">';
            echo $count;
            echo '</td>';
            echo '<td class="padd-td f-style tr-color font-color-2">';
            echo $date;
            echo '</td>';

            echo '<td class="f-style tr-color font-color-2">';
            if ($paid_amount) {
                echo 'Paid';
            } elseif ($date <= $today) {
                echo 'Posted';
            } elseif ($date > $today) {
                echo 'Unpaid';
            } else {
                echo 'Payble';
            }
            echo '</td>';

            echo '<td class="f-style">';
            if ($paid_amount) {
                echo 'Rs: ' . number_format($paid_amount + $previus_amount, 2);
            } else {
                echo '-';
            }
            echo '</td>';

            echo '<td class="f-style">';

            $ins_total += $amount;
            $total_paid += $paid_amount;
            $due_and_excess = $total_paid - $ins_total;

            if ($due_and_excess > 0) {
                echo '<span style="color:green">' . number_format($due_and_excess, 2) . '</span>';
            } else if ($due_and_excess < 0) {
                if ($ALl_AMOUNT[0] >= $ins_total) {
                    echo '00.0';
                } else {
                    $due_and_excess = $due_and_excess + $previus_amount;
                    echo '<span style="color:red">' . number_format($due_and_excess, 2) . '</span>';
                }
            }
            echo '</td>';

            echo '<td class="f-style font-color-2 text-right">';
            if (strtotime(date("Y/m/d")) < strtotime($date) || $LOAN->od_interest_limit == "NOT") {
                
            } else if (strtotime($LOAN->od_date) <= strtotime($date) && $due_and_excess < 0 && $LOAN->installment_type == 4) {

                $od_interest = $LOAN->getOdIntereset($due_and_excess, $LOAN->od_interest_limit);

                $y = 0;
                $od_date_start = new DateTime($date);
                $defult_val = 6;

                while ($y <= $defult_val) {

                    if ($defult_val <= 6 && $LOAN->od_date <= $od_date_start) {
                        $od_dates = '+1 day';
                    }

                    $od_date = $od_date_start->format('Y-m-d');

                    if (strtotime(date("Y/m/d")) <= strtotime($od_date)) {
                        break;
                    }

                    $od_array[] = $od_interest;
                    $od_amount = json_encode(round(array_sum($od_array), 2));

                    $od_date_start->modify($od_dates);
                    $y++;
                }

                echo number_format($od_amount, 2);
            } else if (strtotime($LOAN->od_date) <= strtotime($date) && $due_and_excess < 0 && $LOAN->installment_type == 1) {

                $od_interest = $LOAN->getOdIntereset($due_and_excess, $LOAN->od_interest_limit);

                $y = 0;
                $od_date_start = new DateTime($date);
                $defult_val = 30;

                while ($y <= $defult_val) {

                    if ($defult_val <= 30 && $LOAN->od_date <= $od_date_start) {
                        $od_dates = '+1 day';
                    }

                    $od_date = $od_date_start->format('Y-m-d');

                    if (strtotime(date("Y/m/d")) <= strtotime($od_date)) {
                        break;
                    }

                    $od_array[] = $od_interest;
                    $od_amount = json_encode(round(array_sum($od_array), 2));

                    $od_date_start->modify($od_dates);
                    $y++;
                }
                echo number_format($od_amount, 2);
            } else if (strtotime($LOAN->od_date) <= strtotime($date) && $due_and_excess < 0) {

                $od_interest = $LOAN->getOdIntereset($due_and_excess, $LOAN->od_interest_limit);
                $od_array[] = $od_interest;
                $od_amount = json_encode(round(array_sum($od_array), 2));
                echo $od_amount;
            }
            echo '</td>';

            echo '<td class="text-center tr-color font-color-2">';

            //check payment button 
            if ($date <= $today || $due_and_excess < 0) {
                echo '<a href="add-new-installment.php?date=' . $date . '&loan=' . $loan_id . '&amount=' . $due_and_excess . '&od_amount=' . $od_amount . ' ">
                                                        <button class="glyphicon glyphicon-send btn btn-info" title="Payment"></button> 
                                                        </a>';

                //show week payment button
            } elseif ($LOAN->installment_type == 4 && ($date <= $today || $due_and_excess < 0)) {

                echo '<a href="add-new-installment.php?date = ' . $date . '&loan = ' . $loan_id . '&amount = ' . $due_and_excess . '&od_amount=' . $od_amount . ' ">
                                                             <button class="glyphicon glyphicon-send btn btn-info" title="Payment"></button> 
                                                        </a>';
            } elseif ($LOAN->installment_type == 1 && ($date <= $today || $due_and_excess < 0)) {
                echo '<a href="add-new-installment.php?date = ' . $date . '&loan = ' . $loan_id . '&amount = ' . $due_and_excess . '&od_amount=' . $od_amount . ' ">
                                                             <button class="glyphicon glyphicon-send btn btn-info" title="Payment"></button> 
                                                        </a>';
            } else {
                echo '<a href="add-new-installment.php?date = ' . $date . '&loan = ' . $loan_id . '&amount = ' . $amount . '&od_amount=' . $od_amount . ' ">
                                                             <button class="glyphicon glyphicon-send btn btn-info" title="Payment"  disabled></button> 
                                                        </a>';
            }
            echo '</td>';
            echo '</tr>';
        }
        ?>
    </body>
</html>
