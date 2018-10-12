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
    public $loan_amount;
    public $loan_period;
    public $interest_rate;
    public $installment_type;

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
            $this->loan_amount = $result['loan_amount'];
            $this->loan_period = $result['loan_period'];
            $this->interest_rate = $result['interest_rate'];
            $this->installment_type = $result['installment_type'];


            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `loan` (`create_date`,`customer`,`guarantor_1`,`guarantor_2`,`loan_amount`,`loan_period`,`interest_rate`,`installment_type`) VALUES  ('"
                . $this->create_date . "','"
                . $this->customer . "', '"
                . $this->guarantor_1 . "', '"
                . $this->guarantor_2 . "', '"
                . $this->loan_amount . "', '"
                . $this->loan_period . "', '"
                . $this->interest_rate . "', '"
                . $this->installment_type . "')";


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

    public function update() {

        $query = "UPDATE  `loan` SET "
                . "`create_date` ='" . $this->create_date . "', "
                . "`customer` ='" . $this->customer . "', "
                . "`guarantor_1` ='" . $this->guarantor_1 . "', "
                . "`guarantor_2` ='" . $this->guarantor_2 . "', "
                . "`loan_amount` ='" . $this->loan_amount . "', "
                . "`loan_period` ='" . $this->loan_period . "', "
                . "`interest_rate` ='" . $this->interest_rate . "', "
                . "`installment_type` ='" . $this->installment_type . "' "
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

}
