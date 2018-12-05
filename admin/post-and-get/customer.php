<?php

include_once(dirname(__FILE__) . '/../../class/include.php');
include_once(dirname(__FILE__) . '/../auth.php');


if (isset($_POST['add-customer'])) {

    $CUSTOMER = New Customer(NULL);
    $VALID = new Validator();
    
    $telephone_number = null;
    $telephone_number = $_POST['telephone1'] . $_POST['telephone2'] . $_POST['telephone3'];

    $CUSTOMER->title = $_POST['title'];
    $CUSTOMER->surname = $_POST['surname'];
    $CUSTOMER->first_name = $_POST['first_name'];
    $CUSTOMER->last_name = $_POST['last_name'];
    $CUSTOMER->nic_number = $_POST['nic_number'];
    $CUSTOMER->dob_day = $_POST['day'];
    $CUSTOMER->dob_month = $_POST['month'];
    $CUSTOMER->dob_year = $_POST['year'];
    $CUSTOMER->address_line_1 = $_POST['address_line_1'];
    $CUSTOMER->address_line_2 = $_POST['address_line_2'];
    $CUSTOMER->address_line_3 = $_POST['address_line_3'];
    $CUSTOMER->address_line_4 = $_POST['address_line_4'];
    $CUSTOMER->address_line_5 = $_POST['address_line_5'];
    $CUSTOMER->billing_proof_image = $_POST['billing_proof_image'];
    $CUSTOMER->email = $_POST['email'];
    $CUSTOMER->telephone = $telephone_number;
    $CUSTOMER->mobile = $_POST['mobile'];
    $CUSTOMER->registration_type = $_POST['registration_type'];
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

//////////////////////////////////////////////////
    $dir_dest_p = '../../upload/customer/profile';
    $handle_p = new Upload($_FILES['profile_picture']);
    $img_name_p = null;
    if ($handle_p->uploaded) {
        $handle_p->image_resize = true;
        $handle_p->file_new_name_ext = 'jpg';
        $handle_p->image_ratio_crop = 'C';
        $handle_p->file_new_name_body = Helper::randamId();
        $handle_p->image_x = 250;
        $handle_p->image_y = 250;
        $handle_p->Process($dir_dest_p);
        if ($handle_p->processed) {
            $info = getimagesize($handle_p->file_dst_pathname);
            $img_name_p = $handle_p->file_dst_name;
        }
    }
    $CUSTOMER->profile_picture = $img_name_p;

//////////////////////////////////////////////////////////////////////

    $dir_dest_br = '../../upload/customer/br/';
    $dir_dest_br_thumb = '../../upload/customer/br/thumb/';

    $handle_br = new Upload($_FILES['br_picture']);

    $img_name_br = null;
    $img = Helper::randamId();

    if ($handle_br->uploaded) {
        $handle_br->image_resize = true;
        $handle_br->file_new_name_body = TRUE;
        $handle_br->file_overwrite = TRUE;
        $handle_br->file_new_name_ext = 'jpg';
        $handle_br->image_ratio_crop = 'C';
        $handle_br->file_new_name_body = $img;
        $image_dst_x = $handle_br->image_dst_x;
        $image_dst_y = $handle_br->image_dst_y;
        $newSize = Helper::calImgResize(1200, $image_dst_x, $image_dst_y);

        $image_x = (int) $newSize[0];
        $image_y = (int) $newSize[1];

        $handle_br->image_x = $image_x;
        $handle_br->image_y = $image_y;

        $handle_br->Process($dir_dest_br);
        if ($handle_br->processed) {
            $info = getimagesize($handle_br->file_dst_pathname);
            $img_name_br = $handle_br->file_dst_name;
        }

        $handle_br->image_resize = true;
        $handle_br->file_new_name_body = TRUE;
        $handle_br->file_overwrite = TRUE;
        $handle_br->file_new_name_ext = 'jpg';
        $handle_br->image_ratio_crop = 'C';
        $handle_br->file_new_name_body = $img;
        $handle_br->image_x = 250;
        $handle_br->image_y = 250;

        $handle_br->Process($dir_dest_br_thumb);

        if ($handle_br->processed) {

            $info = getimagesize($handle_br->file_dst_pathname);

            $img_name_br = $handle_br->file_dst_name;
        }
    }


    $CUSTOMER->br_picture = $img_name_br;

//////////////////////////////////////////////////////////////////////

    $dir_dest_nfp = '../../upload/customer/nfp/';
    $dir_dest_nfp_thumb = '../../upload/customer/nfp/thumb/';

    $handle_nfp = new Upload($_FILES['nic_photo_front']);

    $img_name_nfp = null;
    $img = Helper::randamId();

    if ($handle_nfp->uploaded) {
        $handle_nfp->image_resize = true;
        $handle_nfp->file_new_name_body = TRUE;
        $handle_nfp->file_overwrite = TRUE;
        $handle_nfp->file_new_name_ext = 'jpg';
        $handle_nfp->image_ratio_crop = 'C';
        $handle_nfp->file_new_name_body = $img;
        $image_dst_x = $handle_nfp->image_dst_x;
        $image_dst_y = $handle_nfp->image_dst_y;
        $newSize = Helper::calImgResize(1200, $image_dst_x, $image_dst_y);

        $image_x = (int) $newSize[0];
        $image_y = (int) $newSize[1];

        $handle_nfp->image_x = $image_x;
        $handle_nfp->image_y = $image_y;

        $handle_nfp->Process($dir_dest_nfp);
        if ($handle_nfp->processed) {
            $info = getimagesize($handle_nfp->file_dst_pathname);
            $img_name_nfp = $handle_nfp->file_dst_name;
        }

        $handle_nfp->image_resize = true;
        $handle_nfp->file_new_name_body = TRUE;
        $handle_nfp->file_overwrite = TRUE;
        $handle_nfp->file_new_name_ext = 'jpg';
        $handle_nfp->image_ratio_crop = 'C';
        $handle_nfp->file_new_name_body = $img;
        $handle_nfp->image_x = 250;
        $handle_nfp->image_y = 250;

        $handle_nfp->Process($dir_dest_nfp_thumb);

        if ($handle_nfp->processed) {

            $info = getimagesize($handle_nfp->file_dst_pathname);

            $img_name_nfp = $handle_nfp->file_dst_name;
        }
    }

    $CUSTOMER->nic_photo_front = $img_name_nfp;



//////////////////////////////////////////////////////////////////////

    $dir_dest_nbp = '../../upload/customer/nbp/';
    $dir_dest_nbp_thumb = '../../upload/customer/nbp/thumb/';
    $handle_nbp = new Upload($_FILES['nic_photo_back']);
    $img_name_nbp = null;
    $img = Helper::randamId();

    if ($handle_nbp->uploaded) {
        $handle_nbp->image_resize = true;
        $handle_nbp->file_new_name_body = TRUE;
        $handle_nbp->file_overwrite = TRUE;
        $handle_nbp->file_new_name_ext = 'jpg';
        $handle_nbp->image_ratio_crop = 'C';
        $handle_nbp->file_new_name_body = $img;
        $image_dst_x = $handle_nbp->image_dst_x;
        $image_dst_y = $handle_nbp->image_dst_y;
        $newSize = Helper::calImgResize(1200, $image_dst_x, $image_dst_y);

        $image_x = (int) $newSize[0];
        $image_y = (int) $newSize[1];

        $handle_nbp->image_x = $image_x;
        $handle_nbp->image_y = $image_y;

        $handle_nbp->Process($dir_dest_nbp);
        if ($handle_nbp->processed) {
            $info = getimagesize($handle_nbp->file_dst_pathname);
            $img_name_nbp = $handle_nbp->file_dst_name;
        }

        $handle_nbp->image_resize = true;
        $handle_nbp->file_new_name_body = TRUE;
        $handle_nbp->file_overwrite = TRUE;
        $handle_nbp->file_new_name_ext = 'jpg';
        $handle_nbp->image_ratio_crop = 'C';
        $handle_nbp->file_new_name_body = $img;
        $handle_nbp->image_x = 250;
        $handle_nbp->image_y = 250;

        $handle_nbp->Process($dir_dest_nbp_thumb);

        if ($handle_nbp->processed) {

            $info = getimagesize($handle_nbp->file_dst_pathname);

            $img_name_nbp = $handle_nbp->file_dst_name;
        }
    }

    $CUSTOMER->nic_photo_back = $img_name_nbp;


//////////////////////////////////////////////////////////////////////

    $dir_dest_bbp = '../../upload/customer/bbp';
    $dir_dest_bbp_thumb = '../../upload/customer/bbp/thumb/';
    $handle_bbp = new Upload($_FILES['bank_book_picture']);
    $img_name_bbp = null;

    $img = Helper::randamId();

    if ($handle_bbp->uploaded) {
        $handle_bbp->image_resize = true;
        $handle_bbp->file_new_name_body = TRUE;
        $handle_bbp->file_overwrite = TRUE;
        $handle_bbp->file_new_name_ext = 'jpg';
        $handle_bbp->image_ratio_crop = 'C';
        $handle_bbp->file_new_name_body = $img;
        $image_dst_x = $handle_bbp->image_dst_x;
        $image_dst_y = $handle_bbp->image_dst_y;
        $newSize = Helper::calImgResize(1200, $image_dst_x, $image_dst_y);

        $image_x = (int) $newSize[0];
        $image_y = (int) $newSize[1];

        $handle_bbp->image_x = $image_x;
        $handle_bbp->image_y = $image_y;

        $handle_bbp->Process($dir_dest_bbp);
        if ($handle_bbp->processed) {
            $info = getimagesize($handle_bbp->file_dst_pathname);
            $img_name_bbp = $handle_bbp->file_dst_name;
        }

        $handle_bbp->image_resize = true;
        $handle_bbp->file_new_name_body = TRUE;
        $handle_bbp->file_overwrite = TRUE;
        $handle_bbp->file_new_name_ext = 'jpg';
        $handle_bbp->image_ratio_crop = 'C';
        $handle_bbp->file_new_name_body = $img;
        $handle_bbp->image_x = 250;
        $handle_bbp->image_y = 250;

        $handle_bbp->Process($dir_dest_bbp_thumb);

        if ($handle_bbp->processed) {

            $info = getimagesize($handle_bbp->file_dst_pathname);

            $img_name_bbp = $handle_bbp->file_dst_name;
        }
    }

    $CUSTOMER->bank_book_picture = $img_name_bbp;

/////////////////////////////////////////////////////

    $dir_dest_sp = '../../upload/customer/signature/';
    $dir_dest_sp_thumb = '../../upload/customer/signature/thumb/';
    $handle_sp = new Upload($_FILES['signature_image']);
    $img_name_sp = null;

    $img = Helper::randamId();

    if ($handle_sp->uploaded) {
        $handle_sp->image_resize = true;
        $handle_sp->file_new_name_body = TRUE;
        $handle_sp->file_overwrite = TRUE;
        $handle_sp->file_new_name_ext = 'jpg';
        $handle_sp->image_ratio_crop = 'C';
        $handle_sp->file_new_name_body = $img;
        $image_dst_x = $handle_sp->image_dst_x;
        $image_dst_y = $handle_sp->image_dst_y;
        $newSize = Helper::calImgResize(1200, $image_dst_x, $image_dst_y);

        $image_x = (int) $newSize[0];
        $image_y = (int) $newSize[1];

        $handle_sp->image_x = $image_x;
        $handle_sp->image_y = $image_y;

        $handle_sp->Process($dir_dest_sp);
        if ($handle_sp->processed) {
            $info = getimagesize($handle_sp->file_dst_pathname);
            $img_name_sp = $handle_sp->file_dst_name;
        }


        $handle_sp->image_resize = true;
        $handle_sp->file_new_name_body = TRUE;
        $handle_sp->file_overwrite = TRUE;
        $handle_sp->file_new_name_ext = 'jpg';
        $handle_sp->image_ratio_crop = 'C';
        $handle_sp->file_new_name_body = $img;
        $handle_sp->image_x = 250;
        $handle_sp->image_y = 250;

        $handle_sp->Process($dir_dest_sp_thumb);

        if ($handle_sp->processed) {

            $info = getimagesize($handle_sp->file_dst_pathname);

            $img_name_sp = $handle_sp->file_dst_name;
        }
    }

    $CUSTOMER->signature_image = $img_name_sp;
////////////////////////////////////////////////////

    $dir_dest_bi = '../../upload/customer/billing-proof/';
    $dir_dest_bi_thumb = '../../upload/customer/billing-proof/thumb/';
    $handle_bi = new Upload($_FILES['billing_proof_image']);
    $img_name_bi = null;

    $img = Helper::randamId();

    if ($handle_bi->uploaded) {
        $handle_bi->image_resize = true;
        $handle_bi->file_new_name_body = TRUE;
        $handle_bi->file_overwrite = TRUE;
        $handle_bi->file_new_name_ext = 'jpg';
        $handle_bi->image_ratio_crop = 'C';
        $handle_bi->file_new_name_body = $img;
        $image_dst_x = $handle_bi->image_dst_x;
        $image_dst_y = $handle_bi->image_dst_y;
        $newSize = Helper::calImgResize(1200, $image_dst_x, $image_dst_y);

        $image_x = (int) $newSize[0];
        $image_y = (int) $newSize[1];

        $handle_bi->image_x = $image_x;
        $handle_bi->image_y = $image_y;

        $handle_bi->Process($dir_dest_bi);
        if ($handle_bi->processed) {
            $info = getimagesize($handle_bi->file_dst_pathname);
            $img_name_bi = $handle_bi->file_dst_name;
        }


        $handle_bi->image_resize = true;
        $handle_bi->file_new_name_body = TRUE;
        $handle_bi->file_overwrite = TRUE;
        $handle_bi->file_new_name_ext = 'jpg';
        $handle_bi->image_ratio_crop = 'C';
        $handle_bi->file_new_name_body = $img;
        $handle_bi->image_x = 250;
        $handle_bi->image_y = 250;

        $handle_bi->Process($dir_dest_bi_thumb);

        if ($handle_bi->processed) {

            $info = getimagesize($handle_bi->file_dst_pathname);

            $img_name_bi = $handle_bi->file_dst_name;
        }
    }

    $CUSTOMER->billing_proof_image = $img_name_bi;
    ///////////////////////////////////////////////////

    $VALID->check($CUSTOMER, [
        'title' => ['required' => TRUE],
        'surname' => ['required' => TRUE],
        'first_name' => ['required' => TRUE],
        'nic_number' => ['required' => TRUE],
        'address_line_1' => ['required' => TRUE],
        'mobile' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $CUSTOMER->create();

        if (!isset($_SESSION)) {
            session_start();
        }
        $VALID->addError("Your data was saved successfully", 'success');
        $_SESSION['ERRORS'] = $VALID->errors();
        header("location: ../add-new-customer-document.php?id=" . $CUSTOMER->id);
    } else {

        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['ERRORS'] = $VALID->errors();
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}


if (isset($_POST['update_input'])) {
/////////////////////////////////////

    $dir_dest_p = '../../upload/customer/profile';

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

        $handle->Process($dir_dest_p);

        if ($handle->processed) {

            $info = getimagesize($handle->file_dst_pathname);

            $imgName = $handle->file_dst_name;
        }
    }


    //////////////////////////////////////////////////
    $dir_dest_br = '../../upload/customer/br/';
    $dir_dest_br_thumb = '../../upload/customer/br/thumb/';
    $handle_br = new Upload($_FILES['br_picture']);
    $imgName = null;

    if ($handle_br->uploaded) {
        $handle_br->image_resize = true;
        $handle_br->file_new_name_body = TRUE;
        $handle_br->file_overwrite = TRUE;
        $handle_br->file_new_name_ext = FALSE;
        $handle_br->image_ratio_crop = 'C';
        $handle_br->file_new_name_body = $_POST["oldImageNameBank"];
        $image_dst_x = $handle_br->image_dst_x;
        $image_dst_y = $handle_br->image_dst_y;
        $newSize = Helper::calImgResize(1200, $image_dst_x, $image_dst_y);

        $image_x = (int) $newSize[0];
        $image_y = (int) $newSize[1];

        $handle_br->image_x = $image_x;
        $handle_br->image_y = $image_y;

        $handle_br->Process($dir_dest_br);

        if ($handle_br->processed) {
            $info = getimagesize($handle_br->file_dst_pathname);
            $imgName = $handle_br->file_dst_name;
        }

        $handle_br->image_resize = true;
        $handle_br->file_new_name_body = TRUE;
        $handle_br->file_overwrite = TRUE;
        $handle_br->file_new_name_ext = FALSE;
        $handle_br->image_ratio_crop = 'C';
        $handle_br->file_new_name_body = $_POST["oldImageNameBank"];
        $handle_br->image_x = 250;
        $handle_br->image_y = 250;

        $handle_br->Process($dir_dest_br_thumb);



        if ($handle_br->processed) {

            $info = getimagesize($handle_br->file_dst_pathname);

            $imgName = $handle_br->file_dst_name;
        }
    }


    /////////////////////////////////////////////////
    $dir_dest_nfp = '../../upload/customer/nfp/';
    $dir_dest_nfp_thumb = '../../upload/customer/nfp/thumb/';
    $handle = new Upload($_FILES['nic_photo_front']);
    $imgName = null;

    if ($handle->uploaded) {
        $handle->image_resize = true;
        $handle->file_new_name_body = TRUE;
        $handle->file_overwrite = TRUE;
        $handle->file_new_name_ext = FALSE;
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = $_POST ["oldImageNameNfp"];
        $image_dst_x = $handle->image_dst_x;
        $image_dst_y = $handle->image_dst_y;
        $newSize = Helper::calImgResize(1200, $image_dst_x, $image_dst_y);

        $image_x = (int) $newSize[0];
        $image_y = (int) $newSize[1];

        $handle->image_x = $image_x;
        $handle->image_y = $image_y;

        $handle->Process($dir_dest_nfp);

        if ($handle->processed) {
            $info = getimagesize($handle->file_dst_pathname);
            $imgName = $handle->file_dst_name;
        }

        $handle->image_resize = true;
        $handle->file_new_name_body = TRUE;
        $handle->file_overwrite = TRUE;
        $handle->file_new_name_ext = FALSE;
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = $imgName;
        $handle->image_x = 250;
        $handle->image_y = 250;

        $handle->Process($dir_dest_nfp_thumb);



        if ($handle->processed) {

            $info = getimagesize($handle->file_dst_pathname);

            $imgName = $handle->file_dst_name;
        }
    }

    /////////////////////////////////////////////////////
    $dir_dest_nbp = '../../upload/customer/nbp/';
    $dir_dest_nbp_thumb = '../../upload/customer/nbp/thumb/';
    $handle = new Upload($_FILES['nic_photo_back']);
    $imgName = null;

    if ($handle->uploaded) {
        $handle->image_resize = true;
        $handle->file_new_name_body = TRUE;
        $handle->file_overwrite = TRUE;
        $handle->file_new_name_ext = FALSE;
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = $_POST ["oldImageNameNbp"];
        $image_dst_x = $handle->image_dst_x;
        $image_dst_y = $handle->image_dst_y;
        $newSize = Helper::calImgResize(1200, $image_dst_x, $image_dst_y);

        $image_x = (int) $newSize[0];
        $image_y = (int) $newSize[1];

        $handle->image_x = $image_x;
        $handle->image_y = $image_y;

        $handle->Process($dir_dest_nbp);

        if ($handle->processed) {
            $info = getimagesize($handle->file_dst_pathname);
            $imgName = $handle->file_dst_name;
        }

        $handle->image_resize = true;
        $handle->file_new_name_body = TRUE;
        $handle->file_overwrite = TRUE;
        $handle->file_new_name_ext = FALSE;
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = $imgName;
        $handle->image_x = 250;
        $handle->image_y = 250;

        $handle->Process($dir_dest_nbp_thumb);



        if ($handle->processed) {

            $info = getimagesize($handle->file_dst_pathname);

            $imgName = $handle->file_dst_name;
        }
    }


    ////////////////////////////////////////////////////
    $dir_dest_bbp = '../../upload/customer/bbp/';
    $dir_dest_bbp_thumb = '../../upload/customer/bbp/thumb/';
    $handle = new Upload($_FILES['bank_book_picture']);
    $imgName = null;

    if ($handle->uploaded) {
        $handle->image_resize = true;
        $handle->file_new_name_body = TRUE;
        $handle->file_overwrite = TRUE;
        $handle->file_new_name_ext = FALSE;
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = $_POST ["oldImageNameBBP"];
        $image_dst_x = $handle->image_dst_x;
        $image_dst_y = $handle->image_dst_y;
        $newSize = Helper::calImgResize(1200, $image_dst_x, $image_dst_y);

        $image_x = (int) $newSize[0];
        $image_y = (int) $newSize[1];

        $handle->image_x = $image_x;
        $handle->image_y = $image_y;

        $handle->Process($dir_dest_bbp);

        if ($handle->processed) {
            $info = getimagesize($handle->file_dst_pathname);
            $imgName = $handle->file_dst_name;
        }

        $handle->image_resize = true;
        $handle->file_new_name_body = TRUE;
        $handle->file_overwrite = TRUE;
        $handle->file_new_name_ext = FALSE;
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = $imgName;
        $handle->image_x = 250;
        $handle->image_y = 250;

        $handle->Process($dir_dest_bbp_thumb);
        if ($handle->processed) {

            $info = getimagesize($handle->file_dst_pathname);

            $imgName = $handle->file_dst_name;
        }
    }
    /////////////////////////////////////////////////
    $dir_dest_sp = '../../upload/customer/signature/';
    $dir_dest_sp_thumb = '../../upload/customer/signature/thumb/';
    $handle_sp = new Upload($_FILES['signature_image']);
    $imgName = null;

    if ($handle_sp->uploaded) {
        $handle_sp->image_resize = true;
        $handle_sp->file_new_name_body = TRUE;
        $handle_sp->file_overwrite = TRUE;
        $handle_sp->file_new_name_ext = FALSE;
        $handle_sp->image_ratio_crop = 'C';
        $handle_sp->file_new_name_body = $_POST ["oldImageNameSP"];
        $image_dst_x = $handle_sp->image_dst_x;
        $image_dst_y = $handle_sp->image_dst_y;
        $newSize = Helper::calImgResize(1200, $image_dst_x, $image_dst_y);

        $image_x = (int) $newSize[0];
        $image_y = (int) $newSize[1];

        $handle_sp->image_x = $image_x;
        $handle_sp->image_y = $image_y;

        $handle_sp->Process($dir_dest_sp);

        if ($handle_sp->processed) {
            $info = getimagesize($handle_sp->file_dst_pathname);
            $imgName = $handle_sp->file_dst_name;
        }

        $handle_sp->image_resize = true;
        $handle_sp->file_new_name_body = TRUE;
        $handle_sp->file_overwrite = TRUE;
        $handle_sp->file_new_name_ext = FALSE;
        $handle_sp->image_ratio_crop = 'C';
        $handle_sp->file_new_name_body = $_POST ["oldImageNameSP"];
        $handle_sp->image_x = 250;
        $handle_sp->image_y = 250;

        $handle_sp->Process($dir_dest_sp_thumb);
        if ($handle_sp->processed) {

            $info = getimagesize($handle_sp->file_dst_pathname);

            $imgName = $handle_sp->file_dst_name;
        }
    }

    /////////////////////////////////////////////////

    $dir_dest_bi = '../../upload/customer/billing-proof/';
    $dir_dest_bi_thumb = '../../upload/customer/billing-proof/thumb/';
    $handle_bi = new Upload($_FILES['billing_proof_image']);
    $imgName = null;

    if ($handle_bi->uploaded) {
        $handle_bi->image_resize = true;
        $handle_bi->file_new_name_body = TRUE;
        $handle_bi->file_overwrite = TRUE;
        $handle_bi->file_new_name_ext = FALSE;
        $handle_bi->image_ratio_crop = 'C';
        $handle_bi->file_new_name_body = $_POST ["oldImageNameBI"];
        $image_dst_x = $handle_bi->image_dst_x;
        $image_dst_y = $handle_bi->image_dst_y;
        $newSize = Helper::calImgResize(1200, $image_dst_x, $image_dst_y);

        $image_x = (int) $newSize[0];
        $image_y = (int) $newSize[1];

        $handle_bi->image_x = $image_x;
        $handle_bi->image_y = $image_y;

        $handle_bi->Process($dir_dest_bi);

        if ($handle_bi->processed) {
            $info = getimagesize($handle_bi->file_dst_pathname);
            $imgName = $handle_bi->file_dst_name;
        }

        $handle_bi->image_resize = true;
        $handle_bi->file_new_name_body = TRUE;
        $handle_bi->file_overwrite = TRUE;
        $handle_bi->file_new_name_ext = FALSE;
        $handle_bi->image_ratio_crop = 'C';
        $handle_bi->file_new_name_body = $_POST ["oldImageNameBI"];
        $handle_bi->image_x = 250;
        $handle_bi->image_y = 250;

        $handle_bi->Process($dir_dest_bi_thumb);
        if ($handle_bi->processed) {

            $info = getimagesize($handle_bi->file_dst_pathname);

            $imgName = $handle_bi->file_dst_name;
        }
    }
    /////////////////////////////


    $CUSTOMER = new Customer($_POST['id']);



    $CUSTOMER->title = $_POST['title'];
    $CUSTOMER->surname = $_POST['surname'];
    $CUSTOMER->first_name = $_POST['first_name'];
    $CUSTOMER->last_name = $_POST['last_name'];
    $CUSTOMER->nic_number = $_POST['nic_number'];
    $CUSTOMER->dob_day = $_POST['day'];
    $CUSTOMER->dob_month = $_POST['month'];
    $CUSTOMER->dob_year = $_POST['year'];
    $CUSTOMER->address_line_1 = $_POST['address_line_1'];
    $CUSTOMER->address_line_2 = $_POST['address_line_2'];
    $CUSTOMER->address_line_3 = $_POST['address_line_3'];
    $CUSTOMER->address_line_4 = $_POST['address_line_4'];
    $CUSTOMER->address_line_5 = $_POST['address_line_5'];
    $CUSTOMER->email = $_POST['email'];
    $CUSTOMER->telephone = $_POST['telephone'];
    $CUSTOMER->mobile = $_POST['mobile'];
    $CUSTOMER->registration_type = $_POST['registration_type'];
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

        header('Location: ../view-active-customer.php');
    } else {

        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['ERRORS'] = $VALID->errors();
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}