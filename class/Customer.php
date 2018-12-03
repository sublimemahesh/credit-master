<?php

/**
 * Description of Customer
 *
 * @author Sublime Holdings
 */
class Customer {

/////////////
    public $id;
    public $title;
    public $surname;
    public $first_name;
    public $last_name;
    public $profile_picture;
    public $nic_number;
    public $nic_photo_front;
    public $nic_photo_back;
    public $dob_day;
    public $dob_month;
    public $dob_year;
    public $address_line_1;
    public $address_line_2;
    public $address_line_3;
    public $address_line_4;
    public $address_line_5;
    public $billing_proof_image;
    public $email;
    public $telephone;
    public $mobile;
    public $registration_type;
    public $route;
    public $center;
    public $city;
    public $credit_limit;
    public $signature_image;
    public $rank;
/////////////
    public $business_name;
    public $br_number;
    public $nature_of_business;
    public $br_picture;
/////////////
    public $bank;
    public $branch;
    public $branch_code;
    public $account_number;
    public $holder_name;
    public $bank_book_picture;
    public $is_active;
    public $queue;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT * FROM `customer` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->title = $result['title'];
            $this->surname = $result['surname'];
            $this->first_name = $result['first_name'];
            $this->last_name = $result['last_name'];
            $this->profile_picture = $result['profile_picture'];
            $this->nic_number = $result['nic_number'];
            $this->nic_photo_front = $result['nic_photo_front'];
            $this->nic_photo_back = $result['nic_photo_back'];
            $this->dob_day = $result['dob_day'];
            $this->dob_month = $result['dob_month'];
            $this->dob_year = $result['dob_year'];
            $this->address_line_1 = $result['address_line_1'];
            $this->address_line_2 = $result['address_line_2'];
            $this->address_line_3 = $result['address_line_3'];
            $this->address_line_4 = $result['address_line_4'];
            $this->address_line_5 = $result['address_line_5'];
            $this->billing_proof_image = $result['billing_proof_image'];
            $this->email = $result['email'];
            $this->telephone = $result['telephone'];
            $this->mobile = $result['mobile'];
            $this->registration_type = $result['registration_type'];
            $this->route = $result['route'];
            $this->center = $result['center'];
            $this->city = $result['city'];
            $this->credit_limit = $result['credit_limit'];
            $this->signature_image = $result['signature_image'];
            $this->rank = $result['rank'];
            $this->business_name = $result['business_name'];
            $this->br_number = $result['br_number'];
            $this->nature_of_business = $result['nature_of_business'];
            $this->br_picture = $result['br_picture'];
            $this->bank = $result['bank'];
            $this->branch = $result['branch'];
            $this->branch_code = $result['branch_code'];
            $this->account_number = $result['account_number'];
            $this->holder_name = $result['holder_name'];
            $this->bank_book_picture = $result['bank_book_picture'];
            $this->is_active = $result['is_active'];
            $this->queue = $result['queue'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `customer` "
                . "(`title`,"
                . "`surname`,"
                . "`first_name`,"
                . "`last_name`,"
                . "`profile_picture`,"
                . "`nic_number`,"
                . "`nic_photo_front`,"
                . "`nic_photo_back`,"
                . "`dob_day`,"
                . "`dob_month`,"
                . "`dob_year`,"
                . "`address_line_1`,"
                . "`address_line_2`,"
                . "`address_line_3`,"
                . "`address_line_4`,"
                . "`address_line_5`,"
                . "`billing_proof_image`,"
                . "`email`,"
                . "`telephone`,"
                . "`mobile`,"
                . "`registration_type`,"
                . "`route`,"
                . "`center`,"
                . "`city`,"
                . "`credit_limit`,"
                . "`signature_image`,"
                . "`rank`,"
                . "`business_name`,"
                . "`br_number`,"
                . "`nature_of_business`,"
                . "`br_picture`,"
                . "`bank`,"
                . "`branch`,"
                . "`branch_code`,"
                . "`account_number`,"
                . "`holder_name`,"
                . "`bank_book_picture`,"
                . "`is_active`"
                . ") VALUES  ('"
                . $this->title . "','"
                . $this->surname . "','"
                . $this->first_name . "','"
                . $this->last_name . "','"
                . $this->profile_picture . "','"
                . $this->nic_number . "','"
                . $this->nic_photo_front . "','"
                . $this->nic_photo_back . "','"
                . $this->dob_day . "','"
                . $this->dob_month . "','"
                . $this->dob_year . "','"
                . $this->address_line_1 . "','"
                . $this->address_line_2 . "','"
                . $this->address_line_3 . "','"
                . $this->address_line_4 . "','"
                . $this->address_line_5 . "','"
                . $this->billing_proof_image . "','"
                . $this->email . "','"
                . $this->telephone . "','"
                . $this->mobile . "','"
                . $this->registration_type . "','"
                . $this->route . "','"
                . $this->center . "','"
                . $this->city . "','"
                . $this->credit_limit . "','"
                . $this->signature_image . "','"
                . $this->rank . "','"
                . $this->business_name . "','"
                . $this->br_number . "','"
                . $this->nature_of_business . "','"
                . $this->br_picture . "','"
                . $this->bank . "','"
                . $this->branch . "','"
                . $this->branch_code . "','"
                . $this->account_number . "','"
                . $this->holder_name . "','"
                . $this->bank_book_picture . "','"
                . $this->is_active . "')";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            $last_id = mysql_insert_id();

            return $this->__construct($last_id);
        } else {
            return FALSE;
        }
    }

    public function all() {

        $query = "SELECT * FROM `customer` ORDER BY `first_name` ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function activeCustomer() {

        $query = "SELECT * FROM `customer` WHERE `is_active` = 1";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function inactiveCustomer() {

        $query = "SELECT * FROM `customer` WHERE `is_active` = 0";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getCustomrByCenter($center) {

        $query = "SELECT * FROM `customer` WHERE `center` ='" . $center . "'  AND `is_active`=1";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getCustomerByRoute($route) {

        $query = "SELECT * FROM `customer` WHERE `route` ='" . $route . "' AND `is_active`=1";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getCustomerByCenterLeader() {

        $query = "SELECT * FROM `customer`WHERE `registration_type` = 1";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `customer` SET "
                . "`title` ='" . $this->title . "', "
                . "`first_name` ='" . $this->first_name . "', "
                . "`last_name` ='" . $this->last_name . "', "
                . "`surname` ='" . $this->surname . "', "
                . "`nic_number` ='" . $this->nic_number . "', "
                . "`dob_day` ='" . $this->dob_day . "', "
                . "`dob_month` ='" . $this->dob_month . "', "
                . "`dob_year` ='" . $this->dob_year . "', "
                . "`address_line_1` ='" . $this->address_line_1 . "', "
                . "`address_line_2` ='" . $this->address_line_2 . "', "
                . "`address_line_3` ='" . $this->address_line_3 . "', "
                . "`address_line_4` ='" . $this->address_line_4 . "', "
                . "`address_line_5` ='" . $this->address_line_5 . "', "
                . "`billing_proof_image` ='" . $this->billing_proof_image . "', "
                . "`email` ='" . $this->email . "', "
                . "`telephone` ='" . $this->telephone . "', "
                . "`mobile` ='" . $this->mobile . "', "
                . "`registration_type` ='" . $this->registration_type . "', "
                . "`route` ='" . $this->route . "', "
                . "`center` ='" . $this->center . "', "
                . "`city` ='" . $this->city . "', "
                . "`credit_limit` ='" . $this->credit_limit . "', "
                . "`signature_image` ='" . $this->signature_image . "', "
                . "`business_name` ='" . $this->business_name . "', "
                . "`br_picture` ='" . $this->br_picture . "', "
                . "`br_number` ='" . $this->br_number . "', "
                . "`nature_of_business` ='" . $this->nature_of_business . "', "
                . "`bank` ='" . $this->bank . "', "
                . "`branch` ='" . $this->branch . "', "
                . "`branch_code` ='" . $this->branch_code . "', "
                . "`account_number` ='" . $this->account_number . "', "
                . "`holder_name` ='" . $this->holder_name . "', "
                . "`is_active` ='" . $this->is_active . "' "
                . "WHERE `id` = '" . $this->id . "'";


        $db = new Database();
        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {

            return FALSE;
        }
    }

    public function delete() {

        unlink(Helper::getSitePath() . "upload/customer/profile/" . $this->profile_picture);
        unlink(Helper::getSitePath() . "upload/customer/nfp/" . $this->nic_photo_front);
        unlink(Helper::getSitePath() . "upload/customer/nbp/" . $this->nic_photo_back);
        unlink(Helper::getSitePath() . "upload/customer/br/" . $this->br_picture);
        unlink(Helper::getSitePath() . "upload/customer/signature/" . $this->signature_image);

        $query = 'DELETE FROM `customer` WHERE id="' . $this->id . '"';

        $db = new Database();
        return $db->readQuery($query);
    }

    public function CheckNicNumberInCustomer($nic) {

        $query = "SELECT * FROM `customer` WHERE `nic_number` = '" . $nic . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if (mysql_num_rows($result) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function CheckMobileNumberInCustomer($mobile) {


        $query = "SELECT * FROM `customer` WHERE `mobile` = '" . $mobile . "'";

        $db = new Database();
        $result = $db->readQuery($query);

        if (mysql_num_rows($result) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function CheckNicNumberInCustomerExist($nic, $id) {

        $query = "SELECT * FROM `customer` WHERE `nic_number` = '" . $nic . "'  AND `id` <> '" . $id . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if (mysql_num_rows($result) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function CheckMobileNumberInCustomerExist($mobile, $id) {


        $query = "SELECT * FROM `customer` WHERE `mobile` = '" . $mobile . "' AND `id` <> '" . $id . "'";

        $db = new Database();
        $result = $db->readQuery($query);

        if (mysql_num_rows($result) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function updateCustomerCenter($center, $customer) {
        $query = "UPDATE `customer` SET `center` ='" . $center . "' WHERE `id` = '" . $customer . "'";

        $db = new Database();
        $result = $db->readQuery($query);

        if ($result) {
            return TRUE;
        } else {

            return FALSE;
        }
    }

}
