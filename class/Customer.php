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
    public $dob;
    public $address;
    public $email;
    public $telephone;
    public $mobile;
    public $route;
    public $center;
    public $city;
    public $credit_limit;
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
            $this->dob = $result['dob'];
            $this->address = $result['address'];
            $this->email = $result['email'];
            $this->telephone = $result['telephone'];
            $this->mobile = $result['mobile'];
            $this->route = $result['route'];
            $this->center = $result['center'];
            $this->city = $result['city'];
            $this->credit_limit = $result['credit_limit'];
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
                . "`dob`,"
                . "`address`,"
                . "`email`,"
                . "`telephone`,"
                . "`mobile`,"
                . "`route`,"
                . "`center`,"
                . "`city`,"
                . "`credit_limit`,"
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
                . $this->dob . "','"
                . $this->address . "','"
                . $this->email . "','"
                . $this->telephone . "','"
                . $this->mobile . "','"
                . $this->route . "','"
                . $this->center . "','"
                . $this->city . "','"
                . $this->credit_limit . "','"
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

    public function update() {

        $query = "UPDATE  `customer` SET "
                . "`title` ='" . $this->title . "', "
                . "`first_name` ='" . $this->first_name . "', "
                . "`last_name` ='" . $this->last_name . "', "
                . "`surname` ='" . $this->surname . "', "
                . "`nic_number` ='" . $this->nic_number . "', "
                . "`dob` ='" . $this->dob . "', "
                . "`address` ='" . $this->address . "', "
                . "`email` ='" . $this->email . "', "
                . "`telephone` ='" . $this->telephone . "', "
                . "`mobile` ='" . $this->mobile . "', "
                . "`route` ='" . $this->route . "', "
                . "`center` ='" . $this->center . "', "
                . "`city` ='" . $this->city . "', "
                . "`credit_limit` ='" . $this->credit_limit . "', "
                . "`business_name` ='" . $this->business_name . "', "
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

        $query = 'DELETE FROM `customer` WHERE id="' . $this->id . '"';

        $db = new Database();
        return $db->readQuery($query);
    }

}
