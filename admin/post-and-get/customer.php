<?php

include_once(dirname(__FILE__) . '/../../class/include.php');
include_once(dirname(__FILE__) . '/../auth.php');


if (isset($_POST['add-customer'])) {

    $CUSTOMER = New Customer(NULL);
    $VALID = new Validator();


    $CUSTOMER->title = $_POST['title'];
    $CUSTOMER->surname = $_POST['surname'];
    $CUSTOMER->first_name = $_POST['first_name'];
    $CUSTOMER->last_name = $_POST['last_name'];
    $CUSTOMER->nic_number = $_POST['nic_number'];
    $CUSTOMER->dob = $_POST['dob'];
    $CUSTOMER->address = $_POST['address'];
    $CUSTOMER->email = $_POST['email'];
    $CUSTOMER->telephone = $_POST['telephone'];
    $CUSTOMER->mobile = $_POST['mobile'];
    $CUSTOMER->route = $_POST['route'];
    $CUSTOMER->center = $_POST['center'];
    $CUSTOMER->city = $_POST['city'];
    $CUSTOMER->credit_limit = $_POST['credit_limit'];
    $CUSTOMER->business_name = $_POST['business_name'];
    $CUSTOMER->br_number = $_POST['br_number'];
    $CUSTOMER->nature_of_business = $_POST['nature_of_business'];
    $CUSTOMER->bank = $_POST['bank'];
    $CUSTOMER->branch = $_POST['branch'];
    $CUSTOMER->branch_code = $_POST['branch_code'];
    $CUSTOMER->account_number = $_POST['account_number'];
    $CUSTOMER->holder_name = $_POST['holder_name'];
    $CUSTOMER->is_active = $_POST['is_active'];


    $dir_dest_p = '../../upload/customer/profile';
    $handle_p = new Upload($_FILES['profile_picture']);
    $img_name_p = null;
    if ($handle_p->uploaded) {
        $handle_p->image_resize = true;
        $handle_p->file_new_name_ext = 'jpg';
        $handle_p->image_ratio_crop = 'C';
        $handle_p->file_new_name_body = Helper::randamId();
        $handle_p->image_x = 600;
        $handle_p->image_y = 600;
        $handle_p->Process($dir_dest_p);
        if ($handle_p->processed) {
            $info = getimagesize($handle_p->file_dst_pathname);
            $img_name_p = $handle_p->file_dst_name;
        }
    }
    $CUSTOMER->profile_picture = $img_name_p;

//////////////////////////////////////////////////////////////////////

    $dir_dest_br = '../../upload/customer/br';
    $handle_br = new Upload($_FILES['br_picture']);
    $img_name_br = null;
    if ($handle_br->uploaded) {
        $handle_br->image_resize = true;
        $handle_br->file_new_name_ext = 'jpg';
        $handle_br->image_ratio_crop = 'C';
        $handle_br->file_new_name_body = Helper::randamId();
        $handle_br->image_x = 900;
        $handle_br->image_y = 600;
        $handle_br->Process($dir_dest_br);
        if ($handle_br->processed) {
            $info = getimagesize($handle_br->file_dst_pathname);
            $img_name_br = $handle_br->file_dst_name;
        }
    }
    $CUSTOMER->br_picture = $img_name_br;

//////////////////////////////////////////////////////////////////////

    $dir_dest_nfp = '../../upload/customer/nfp';
    $handle_nfp = new Upload($_FILES['nic_photo_front']);
    $img_name_nfp = null;
    if ($handle_nfp->uploaded) {
        $handle_nfp->image_resize = true;
        $handle_nfp->file_new_name_ext = 'jpg';
        $handle_nfp->image_ratio_crop = 'C';
        $handle_nfp->file_new_name_body = Helper::randamId();
        $handle_nfp->image_x = 900;
        $handle_nfp->image_y = 600;
        $handle_nfp->Process($dir_dest_nfp);
        if ($handle_nfp->processed) {
            $info = getimagesize($handle_nfp->file_dst_pathname);
            $img_name_nfp = $handle_nfp->file_dst_name;
        }
    }
    $CUSTOMER->nic_photo_front = $img_name_nfp;

//////////////////////////////////////////////////////////////////////

    $dir_dest_nbp = '../../upload/customer/nbp';
    $handle_nbp = new Upload($_FILES['nic_photo_back']);
    $img_name_nbp = null;
    if ($handle_nbp->uploaded) {
        $handle_nbp->image_resize = true;
        $handle_nbp->file_new_name_ext = 'jpg';
        $handle_nbp->image_ratio_crop = 'C';
        $handle_nbp->file_new_name_body = Helper::randamId();
        $handle_nbp->image_x = 900;
        $handle_nbp->image_y = 600;
        $handle_nbp->Process($dir_dest_nbp);
        if ($handle_nbp->processed) {
            $info = getimagesize($handle_nbp->file_dst_pathname);
            $img_name_nbp = $handle_nbp->file_dst_name;
        }
    }
    $CUSTOMER->nic_photo_back = $img_name_nbp;

//////////////////////////////////////////////////////////////////////

    $dir_dest_bbp = '../../upload/customer/bbp';
    $handle_nbp = new Upload($_FILES['bank_book_picture']);
    $img_name_bbp = null;
    if ($handle_bbp->uploaded) {
        $handle_bbp->image_resize = true;
        $handle_bbp->file_new_name_ext = 'jpg';
        $handle_bbp->image_ratio_crop = 'C';
        $handle_bbp->file_new_name_body = Helper::randamId();
        $handle_bbp->image_x = 900;
        $handle_bbp->image_y = 600;
        $handle_bbp->Process($dir_dest_bbp);
        if ($handle_bbp->processed) {
            $info = getimagesize($handle_bbp->file_dst_pathname);
            $img_name_bbp = $handle_bbp->file_dst_name;
        }
    }
    $CUSTOMER->bank_book_picture = $img_name_bbp;

    $VALID->check($CUSTOMER, [
        'title' => ['required' => TRUE],
        'surname' => ['required' => TRUE],
        'first_name' => ['required' => TRUE],
        'nic_number' => ['required' => TRUE],
        'address' => ['required' => TRUE],
        'mobile' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $CUSTOMER->create();

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


    $CUSTOMER = new Customer($_POST['id']);

    $CUSTOMER->title = $_POST['title'];
    $CUSTOMER->surname = $_POST['surname'];
    $CUSTOMER->first_name = $_POST['first_name'];
    $CUSTOMER->last_name = $_POST['last_name'];
    $CUSTOMER->nic_number = $_POST['nic_number'];
    $CUSTOMER->dob = $_POST['dob'];
    $CUSTOMER->address = $_POST['address'];
    $CUSTOMER->email = $_POST['email'];
    $CUSTOMER->telephone = $_POST['telephone'];
    $CUSTOMER->mobile = $_POST['mobile'];
    $CUSTOMER->route = $_POST['route'];
    $CUSTOMER->center = $_POST['center'];
    $CUSTOMER->city = $_POST['city'];
    $CUSTOMER->credit_limit = $_POST['credit_limit'];
    $CUSTOMER->business_name = $_POST['business_name'];
    $CUSTOMER->br_number = $_POST['br_number'];
    $CUSTOMER->nature_of_business = $_POST['nature_of_business'];
    $CUSTOMER->bank = $_POST['bank'];
    $CUSTOMER->branch = $_POST['branch'];
    $CUSTOMER->branch_code = $_POST['branch_code'];
    $CUSTOMER->account_number = $_POST['account_number'];
    $CUSTOMER->holder_name = $_POST['holder_name'];
    $CUSTOMER->is_active = $_POST['is_active'];


    $VALID = new Validator();
    $VALID->check($CUSTOMER, [
        'title' => ['required' => TRUE],
       
    ]);



    if ($VALID->passed()) {
        $CUSTOMER->update();

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