<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

///loan details update///  

$LOAN = new Loan($_POST['loan_id']); 
 
$balance_of_last_loan =  str_replace(',','', $_POST['balance_of_last_loan']);
 
$LOAN->issued_date = $_POST['issued_date'];
$LOAN->effective_date = $_POST['effective_date'];
$LOAN->issue_mode = $_POST['issue_mode'];
$LOAN->issue_note = $_POST['issue_note'];
$LOAN->loan_processing_pre = $_POST['loan_processing_pre_amount'];
$LOAN->release_by = $_POST['release_by'];
$LOAN->status = 'released';
$LOAN->transaction_id = $_POST['transaction_id'];
$LOAN->balance_of_last_loan =$balance_of_last_loan;


///effective date details update///
$EffectiveDate = New EffectiveDate(NULL);

$EffectiveDate->loan = $LOAN->id;
$EffectiveDate->date = $LOAN->effective_date;
$EffectiveDate->loan_period = $LOAN->loan_period;
$EffectiveDate->installment_type = $LOAN->installment_type;
$EffectiveDate->installment_amount = $LOAN->installment_amount;

$EffectiveDate->create();

/// Installment update 
$INSTALLMENT = new Installment(NULL);
$loan_details = $LOAN->getLoanDetailsByCustomer($_POST['customer_id']);
 
date_default_timezone_set('Asia/Colombo');
$create_at = date('Y-m-d');
$change_time = date('h:i:s');

$INSTALLMENT->loan = $loan_details[0];
$INSTALLMENT->paid_date = $create_at;
$INSTALLMENT->installment_date = $create_at;
$INSTALLMENT->time = $change_time;
$INSTALLMENT->paid_amount = $balance_of_last_loan;
$INSTALLMENT->type = 'loanid00' . $loan_details[0];
 


//completed before loan
$LOAN_UPDATE = new Loan($loan_details[0]);
$LOAN_UPDATE->status = 'completed';
$LOAN_UPDATE->update();

//update history colum
$history = $INSTALLMENT->history;
$change_at = $create_at; 
$user_id = $_POST['release_by'];
$amount = $balance_of_last_loan;
$status = 'Paid';

if ($history == NULL) {
    $INSTALLMENT->history = $user_id . ',' . $amount . ',' . $change_at . ',' . $change_time . ',' . $status;
} else {
    $INSTALLMENT->history = $history . "///" . $user_id . ',' . $amount . ',' . $change_at . ',' . $change_time . ',' . $status;
}

$INSTALLMENT->create();
///transactiopn Document image///
$dir_dest = '../../../upload/loan/transaction_document/';
$dir_dest_thumb = '../../../upload/loan/transaction_document/thumb/';

$handle = new Upload($_FILES['transaction_document']);

$imgName = null;
$img = Helper::randamId();

if ($handle->uploaded) {
    $handle->image_resize = true;
    $handle->file_new_name_body = TRUE;
    $handle->file_overwrite = TRUE;
    $handle->file_new_name_ext = 'jpg';
    $handle->image_ratio_crop = 'C';
    $handle->file_new_name_body = $img;
    $handle->image_x = 900;
    $handle->image_y = 500;

    $handle->Process($dir_dest);

    if ($handle->processed) {
        $info = getimagesize($handle->file_dst_pathname);
        $imgName = $handle->file_dst_name;
    }

    $handle->image_resize = true;
    $handle->file_new_name_body = TRUE;
    $handle->file_overwrite = TRUE;
    $handle->file_new_name_ext = 'jpg';
    $handle->image_ratio_crop = 'C';
    $handle->file_new_name_body = $img;
    $handle->image_x = 300;
    $handle->image_y = 175;

    $handle->Process($dir_dest_thumb);

    if ($handle->processed) {
        $info = getimagesize($handle->file_dst_pathname);
        $imgName = $handle->file_dst_name;
    }
}

$LOAN->transaction_document = $imgName;
$result = $LOAN->update();

///transfer amount in Collector///   
$COLLECTOR = new CollectorPaymentDetail($_POST['create_by']);
$COLLECTOR->ammount = $_POST['balance_pay'];
$COLLECTOR->create();

$VALID = new Validator();
$VALID->addError("Loan was successfully issued!...", 'success');
$_SESSION['ERRORS'] = $VALID->errors();

echo json_encode(['status' => 'released', 'data' => $result]);
header('Content-type: application/json');
exit();
