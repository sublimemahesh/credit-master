<?php

include_once(dirname(__FILE__) . '/../../class/include.php');
include_once(dirname(__FILE__) . '/../auth.php');


if (isset($_POST['add-vehicle'])) {

    $VEHICLE = New Vehicle(NULL);
    $VALID = new Validator();


    $VEHICLE->type = $_POST['type'];
    $VEHICLE->model_and_brand = $_POST['model_and_brand'];
    $VEHICLE->reg_number = $_POST['reg_number'];
    $VEHICLE->email = $_POST['email'];
    $VEHICLE->contact_number = $_POST['contact_number'];
    $VEHICLE->city = $_POST['city'];


    $dir_dest = '../../upload/vehicle/';

    $handle = new Upload($_FILES['image']);

    $imgName = null;

    if ($handle->uploaded) {
        $handle->image_resize = true;
        $handle->file_new_name_ext = 'jpg';
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = Helper::randamId();
        $handle->image_x = 900;
        $handle->image_y = 600;

        $handle->Process($dir_dest);

        if ($handle->processed) {
            $info = getimagesize($handle->file_dst_pathname);
            $imgName = $handle->file_dst_name;
        }
    }

    $VEHICLE->image_name = $imgName;

    $VALID->check($VEHICLE, [
        'type' => ['required' => TRUE],
    ]);

    if ($VALID->passed()) {
        $VEHICLE->create();

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
if (isset($_POST['edit-vehicle'])) {
    
    $dir_dest = '../../upload/vehicle/';

    $handle = new Upload($_FILES['image_name']);

    $img = $_POST ["oldImageName"];

    if ($handle->uploaded) {
        $handle->image_resize = true;
        $handle->file_new_name_body = TRUE;
        $handle->file_overwrite = TRUE;
        $handle->file_new_name_ext = FALSE;
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = $img;
        $handle->image_x = 900;
        $handle->image_y = 600;

        $handle->Process($dir_dest);

        if ($handle->processed) {
            $info = getimagesize($handle->file_dst_pathname);
            $img = $handle->file_dst_name;
        }
    }


        $VEHICLE = New Vehicle($_POST['id']);
        $VALID = new Validator();

        $VEHICLE->type = $_POST['type'];
        $VEHICLE->contact_number = $_POST['contact_number'];
        $VEHICLE->email = $_POST['email'];
        $VEHICLE->model_and_brand = $_POST['model_and_brand'];
        $VEHICLE->reg_number = $_POST['reg_number'];
        $VEHICLE->city = $_POST['city'];
        $VEHICLE->image_name = $_POST['oldImageName'];
       

        $VALID->check($VEHICLE, [
            'type' => ['required' => TRUE],
        ]);

        if ($VALID->passed()) {
            $VEHICLE->update();

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
?>