<?php

include_once(dirname(__FILE__) . '/../../class/include.php');


if (isset($_POST['add-user'])) {

    ///////////////////////// NIC PROFILE
    $PROPIC = new Upload($_FILES['profile_picture']);
    $profile_picture = null;

    if ($PROPIC->uploaded) {
        $PROPIC->image_resize = true;
        $PROPIC->file_new_name_ext = 'jpg';
        $PROPIC->image_ratio_crop = 'C';
        $PROPIC->file_new_name_body = Helper::randamId();
        $PROPIC->image_x = 250;
        $PROPIC->image_y = 250;

        $PROPIC->Process('../../upload/users/');

        if ($PROPIC->processed) {
            $info = getimagesize($PROPIC->file_dst_pathname);
            $profile_picture = $PROPIC->file_dst_name;
        }
    }

    ///////////////////////// NIC FRONT
    $NICF = new Upload($_FILES['nic_photo_front']);
    $nic_photo_front = null;

    if ($NICF->uploaded) {
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

        $NICF->Process('../../upload/users/nic/');

        if ($NICF->processed) {
            $info = getimagesize($NICF->file_dst_pathname);
            $nic_photo_front = $NICF->file_dst_name;
        }
    }

    ///////////////////////// NIC BACK
    $NICB = new Upload($_FILES['nic_photo_back']);
    $nic_photo_back = null;

    if ($NICB->uploaded) {
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

        $NICB->Process('../../upload/users/nic/');

        if ($NICB->processed) {
            $info = getimagesize($NICB->file_dst_pathname);
            $nic_photo_back = $NICB->file_dst_name;
        }
    }

    $USERS = new User(NULL);
    $VALID = new Validator();

    $USERS->name = $_POST['name'];
    $USERS->nic_number = $_POST['nic_number'];
    $USERS->address = $_POST['address'];
    $USERS->phone = $_POST['phone'];
    $USERS->email = $_POST['email'];
    $USERS->username = $_POST['username'];
    $USERS->user_level = $_POST['user_level'];
    $USERS->password = $_POST['password'];
    $USERS->isActive = $_POST['isActive'];
    $USERS->image_name = $profile_picture;
    $USERS->nic_photo_front = $nic_photo_front;
    $USERS->nic_photo_back = $nic_photo_back;

    $USERS->create();

    if (!isset($_SESSION)) {
        session_start();
    }

    $VALID->addError("Your data was saved successfully", 'success');
    $_SESSION['ERRORS'] = $VALID->errors();

    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

if (isset($_POST['update'])) {

    $handle = new Upload($_FILES['profile_picture']);

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

        $handle->Process('../../upload/users/');

        if ($handle->processed) {

            $info = getimagesize($handle->file_dst_pathname);

            $imgName = $handle->file_dst_name;
        }
    }

    $USERS = new User($_POST['user_id']);
    $USERS->name = ucfirst($_POST['name']);
    $USERS->nic_number = $_POST['nic_number'];
    $USERS->address = $_POST['address'];
    $USERS->phone = $_POST['phone'];
    $USERS->email = $_POST['email'];
    $USERS->username = $_POST['username'];
    if (!empty($_POST['password'])) {
        $USERS->password = $_POST['password'];
    }
    $USERS->isActive = $_POST['isActive'];
 
    $VALID = new Validator();

    $VALID->check($USERS, [
        'name' => ['required' => TRUE],
        'username' => ['required' => TRUE]
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

if (isset($_POST['edit-profile'])) {

    $dir_dest = '../../upload/users/';

    $handle = new Upload($_FILES['image_name']);
    $USERS = new User($_POST['id']);

    $imgName = $_POST ["oldImageName"];

    if ($handle->file_src_size) {

        if ($handle->uploaded) {
            $handle->image_resize = true;

            if ($_POST ["oldImageName"]) {
                $handle->file_new_name_ext = FALSE;
                $handle->file_new_name_body = $_POST ["oldImageName"];
                $handle->file_overwrite = TRUE;
            } else {
                $handle->file_new_name_body = Helper::randamId();
                $handle->file_new_name_ext = 'jpg';
            }

            $handle->image_ratio_crop = 'C';
            $handle->image_x = 250;
            $handle->image_y = 250;

            $handle->Process($dir_dest);

            if ($handle->processed) {

                $info = getimagesize($handle->file_dst_pathname);

                $imgName = $handle->file_dst_name;
            }
        }
    }

    $USERS->name = $_POST['name'];
    $USERS->image_name = $imgName;
    $USERS->username = $_POST['username'];
    $USERS->email = $_POST['email'];


    $VALID = new Validator();
    $VALID->check($USERS, [
        'name' => ['required' => TRUE],
        'username' => ['required' => TRUE],
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
 