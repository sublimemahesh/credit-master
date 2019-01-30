<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if (isset($_POST['create'])) {

    $LOAN = new Loan($_POST['id']);
    $COLLECTOR = new CollectorPaymentDetail($_POST['create_by']);

    $dir_dest = '../../upload/loan/transaction_document/';
    $dir_dest_thumb = '../../upload/loan/transaction_document/thumb/';

    $handle = new Upload($_FILES['transaction_document']);


    $img = Helper::randamId();

    if ($handle->uploaded) {
        $handle->image_resize = true;
        $handle->file_new_name_body = TRUE;
        $handle->file_overwrite = TRUE;
        $handle->file_new_name_ext = 'jpg';
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = $img;
        $image_dst_x = $handle->image_dst_x;
        $image_dst_y = $handle->image_dst_y;
        $newSize = Helper::calImgResize(1200, $image_dst_x, $image_dst_y);

        $image_x = (int) $newSize[0];
        $image_y = (int) $newSize[1];

        $handle->image_x = $image_x;
        $handle->image_y = $image_y;

        $handle->Process($dir_dest);
        if ($handle->processed) {
            $info = getimagesize($handle->file_dst_pathname);
            $img = $handle->file_dst_name;
        }

        $handle->image_resize = true;
        $handle->file_new_name_body = TRUE;
        $handle->file_overwrite = TRUE;
        $handle->file_new_name_ext = 'jpg';
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = $img;
        $handle->image_x = 250;
        $handle->image_y = 250;

        $handle->Process($dir_dest_thumb);

        if ($handle->processed) {

            $info = getimagesize($handle->file_dst_pathname);

            $img = $handle->file_dst_name;
        }
    }

    $LOAN->transaction_document = $img;
    /////////////////////////////////////////////////

    $LOAN->transaction_id = $_POST['transaction_id'];
    $COLLECTOR->ammount = $_POST['balance_pay'];
    $VALID = new Validator();
    $VALID->check($LOAN, [
        'transaction_id' => ['required' => TRUE],
    ]);

    if ($VALID->passed()) {
        $LOAN->update();
        $COLLECTOR->updateAmountBycollector();

        if (!isset($_SESSION)) {
            session_start();
        }

        $VALID->addError("Your changes saved successfully", 'success');

        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ../manage-active-loans.php');
    } else {

        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['ERRORS'] = $VALID->errors();
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}