<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');


$USERS = new User(NULL);
 
$USERS->name = $_POST['name'];
$USERS->username = $_POST['user_name'];
$USERS->email = $_POST['email'];
$USERS->user_level = $_POST['user_level'];
$USERS->isActive = $_POST['is_active'];

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

$result = $USERS->create($_POST['name'], $_POST['email'], $_POST['user_name'], $_POST['user_level'], $imgName, $_POST['password']);
$VALID = new Validator();

if ($result) {

    $VALID->addError("User was successfully verified!...", 'success');
    $_SESSION['ERRORS'] = $VALID->errors();
  
} else {
    
}
 
    
    