<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

///loan details update///  

$LOAN = new Loan($_POST['loan_id']);
$LOAN->issued_date = $_POST['issued_date'];
$LOAN->effective_date = $_POST['effective_date'];
$LOAN->issue_mode = $_POST['issue_mode'];
$LOAN->issue_note = $_POST['issue_note'];
$LOAN->loan_processing_pre = $_POST['loan_processing_pre_amount'];
$LOAN->release_by = $_POST['release_by'];
$LOAN->status = 'released';
$LOAN->transaction_id = $_POST['transaction_id'];

$result = $LOAN->update();

///effective date details update///

$EffectiveDate = New EffectiveDate(NULL);

$EffectiveDate->loan = $LOAN->id;
$EffectiveDate->date = $LOAN->effective_date;
$EffectiveDate->loan_period = $LOAN->loan_period;
$EffectiveDate->installment_type = $LOAN->installment_type;
$EffectiveDate->installment_amount = $LOAN->installment_amount;

$EffectiveDate->create();

///transactiopn Document image///
$dir_dest = '../../upload/loan/transaction_document/';
$dir_dest_thumb = '../../upload/loan/transaction_document/thumb/';

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
