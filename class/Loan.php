<?php

/**
 * Description of Customer
 *
 * @author Sublime Holdings
 */
class Loan {

    public $id;
    public $create_date;
    public $customer;
    public $guarantor_1;
    public $guarantor_2;
    public $guarantor_3;
    public $loan_amount;
    public $interest_rate;
    public $loan_period;
    public $installment_type;
    public $installment_amount;
    public $number_of_installments;
    public $issue_mode;
    public $effective_date;
    public $verify_comments;
    public $issued_date;
    public $issue_note;
    public $status;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT * FROM `loan` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->create_date = $result['create_date'];
            $this->customer = $result['customer'];
            $this->guarantor_1 = $result['guarantor_1'];
            $this->guarantor_2 = $result['guarantor_2'];
            $this->guarantor_3 = $result['guarantor_3'];
            $this->loan_amount = $result['loan_amount'];
            $this->interest_rate = $result['interest_rate'];
            $this->loan_period = $result['loan_period'];
            $this->installment_type = $result['installment_type'];
            $this->installment_amount = $result['installment_amount'];
            $this->number_of_installments = $result['number_of_installments'];
            $this->issue_mode = $result['issue_mode'];
            $this->effective_date = $result['effective_date'];
            $this->issued_date = $result['issued_date'];
            $this->issue_note = $result['issue_note'];
            $this->verify_comments = $result['verify_comments'];
            $this->status = $result['status'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `loan` ("
                . "`create_date`,"
                . "`customer`,"
                . "`guarantor_1`,"
                . "`guarantor_2`,"
                . "`guarantor_3`,"
                . "`loan_amount`,"
                . "`issue_mode`,"
                . "`loan_period`,"
                . "`interest_rate`,"
                . "`installment_type`,"
                . "`installment_amount`,"
                . "`number_of_installments`,"
                . "`effective_date`,"
                . "`status`"
                . ") VALUES  ('"
                . $this->create_date . "','"
                . $this->customer . "', '"
                . $this->guarantor_1 . "', '"
                . $this->guarantor_2 . "', '"
                . $this->guarantor_3 . "', '"
                . $this->loan_amount . "', '"
                . $this->issue_mode . "', '"
                . $this->loan_period . "', '"
                . $this->interest_rate . "', '"
                . $this->installment_type . "', '"
                . $this->installment_amount . "', '"
                . $this->number_of_installments . "', '"
                . $this->effective_date . "', '"
                . "pending')";


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

        $query = "SELECT * FROM `loan` ";
        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function allByStatus() {

        $query = "SELECT * FROM `loan` WHERE `status` = '" . $this->status . "'";
        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `loan` SET "
                . "`create_date` ='" . $this->create_date . "', "
                . "`customer` ='" . $this->customer . "', "
                . "`guarantor_1` ='" . $this->guarantor_1 . "', "
                . "`guarantor_2` ='" . $this->guarantor_2 . "', "
                . "`guarantor_3` ='" . $this->guarantor_3 . "', "
                . "`loan_amount` ='" . $this->loan_amount . "', "
                . "`interest_rate` ='" . $this->interest_rate . "', "
                . "`loan_period` ='" . $this->loan_period . "', "
                . "`installment_type` ='" . $this->installment_type . "', "
                . "`installment_amount` ='" . $this->installment_amount . "', "
                . "`number_of_installments` ='" . $this->number_of_installments . "', "
                . "`issue_mode` ='" . $this->issue_mode . "', "
                . "`effective_date` ='" . $this->effective_date . "', "
                . "`issued_date` ='" . $this->issued_date . "', "
                . "`issue_note` ='" . $this->issue_note . "', "
                . "`verify_comments` ='" . $this->verify_comments . "', "
                . "`status` ='" . $this->status . "' "
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

        $query = 'DELETE FROM `loan` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function CheckGuarantor($guarantor) {


        $query = "SELECT count(`guarantor_2`)>=2 as count FROM `loan` WHERE `guarantor_2` = '" . $guarantor . "'";

        $db = new Database();
        $res = $db->readQuery($query);
        $result = mysql_fetch_assoc($res);
        
        if ($result['count']== 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
