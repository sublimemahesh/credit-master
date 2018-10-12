<?php

include_once(dirname(__FILE__) . '/../../class/include.php');


if (isset($_POST['add-user'])) {

    $USERS = new Users(NULL);
    $VALID = new Validator();

    $USERS->name = $_POST['name'];
    $USERS->user_name = $_POST['user_name'];
    $USERS->email = $_POST['email'];

    $dir_dest = '../../upload/users/';

    $handle = new Upload($_FILES['image_name']);
    $imgName = null;



    if ($handle->uploaded) {
        $handle->image_resize = true;
        $handle->file_new_name_ext = 'jpg';
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = Helper::randamId();
        $handle->image_x = 250;
        $handle->image_y = 250;

        $handle->Process($dir_dest);

        if ($handle->processed) {
            $info = getimagesize($handle->file_dst_pathname);
            $imgName = $handle->file_dst_name;
        }
    }



    $USERS->image_name = $imgName;



    $VALID->check($USERS, [
        'name' => ['required' => TRUE],
        'user_name' => ['required' => TRUE],
        'email' => ['required' => TRUE],
    ]);



    if ($VALID->passed()) {
        $USERS->create();

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
    
    $dir_dest = '../../upload/users/';

    $handle = new Upload($_FILES['image_name']);

    $imgName = null;


    if ($handle->uploaded) {
        $handle->image_resize = true;
        $handle->file_new_name_body = TRUE;
        $handle->file_overwrite = TRUE;
        $handle->file_new_name_ext = FALSE;
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = $_POST ["oldImageName"];
        $handle->image_x = 250;
        $handle->image_y = 250;

        $handle->Process($dir_dest);

        if ($handle->processed) {

            $info = getimagesize($handle->file_dst_pathname);

            $imgName = $handle->file_dst_name;
        }
    }

    $USERS = new Users($_POST['id']);

    $USERS->image_name = $_POST['oldImageName'];
    $USERS->name = $_POST['name'];
    $USERS->user_name = $_POST['user_name'];
    $USERS->email = $_POST['email'];


    $VALID = new Validator();
    $VALID->check($USERS, [
        'name' => ['required' => TRUE],
        'user_name' => ['required' => TRUE],
        'email' => ['required' => TRUE]
    ]);



    if ($VALID->passed()) {
        $USERS->update();

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

