<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if (isset($_POST['create'])) {

    $LOAN_DETAILS = new LoanDocument(NULL);
    $VALID = new Validator();

    $LOAN_DETAILS->loan = $_POST['id'];
    $LOAN_DETAILS->caption = filter_input(INPUT_POST, 'caption');

    $dir_dest = '../../upload/loan/document/';
    $dir_dest_thumb = '../../upload/loan/document/thumb/';
    $handle = new Upload($_FILES['image_name']);
    $imgName = null;


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
            $img_name = $handle->file_dst_name;
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

            $img_name = $handle->file_dst_name;
        }
    }


    $LOAN_DETAILS->image_name = $img_name;


    $VALID->check($LOAN_DETAILS, [
        'caption' => ['required' => TRUE],
        'image_name' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $LOAN_DETAILS->create();

        if (!isset($_SESSION)) {
            session_start();
        }
        $VALID->addError("Your data was saved successfully", 'success');
        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {

        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

if (isset($_POST['update'])) {

    $dir_dest = '../../upload/customer/gallery/';


    $handle = new Upload($_FILES['image']);

    $img = $_POST ["oldImageName"];

    if ($handle->uploaded) {
        $handle->image_resize = true;
        $handle->file_new_name_body = TRUE;
        $handle->file_overwrite = TRUE;
        $handle->file_new_name_ext = FALSE;
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = $img;
        $handle->image_x = 500;
        $handle->image_y = 500;

        $handle->Process($dir_dest);

        if ($handle->processed) {
            $info = getimagesize($handle->file_dst_pathname);
            $img = $handle->file_dst_name;
        }
    }

    $LOAN_DETAILS = new CustomerDocument($_POST['id']);

    $LOAN_DETAILS->image_name = $_POST['oldImageName'];
    $LOAN_DETAILS->caption = filter_input(INPUT_POST, 'caption');

    $VALID = new Validator();
    $VALID->check($LOAN_DETAILS, [
        'caption' => ['required' => TRUE],
        'image_name' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $LOAN_DETAILS->update();

        if (!isset($_SESSION)) {
            session_start();
        }
        $VALID->addError("Your changes saved successfully", 'success');
        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {

        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
 