<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

$INSTALLMENT = new Installment(NULL);
$VALID = new Validator();

$INSTALLMENT->loan = $_POST['loan'];
$INSTALLMENT->installment_date = $_POST['installment_date'];
$INSTALLMENT->paid_date = $_POST['paid_date'];
$INSTALLMENT->time = $_POST['time'];
$INSTALLMENT->paid_amount = $_POST['paid_amount'];
$INSTALLMENT->additional_interest = $_POST['additional_interest'];
$INSTALLMENT->collector = $_POST['user_id'];

$INSTALLMENT->create();
$result = ["status" => 'success'];
echo json_encode($result);
exit();
