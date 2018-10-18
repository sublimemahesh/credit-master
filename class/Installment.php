<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Installment
 *
 * @author sublime
 */
class Installment {

    public $id;
    public $loan;
    public $paid_date;
    public $paid_amount;
    public $additional_interest;
    public $paid_by;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT * FROM `installment` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->loan = $result['loan'];
            $this->paid_date = $result['paid_date'];
            $this->paid_amount = $result['paid_amount'];
            $this->additional_interest = $result['additional_interest'];
            $this->paid_by = $result['paid_by'];


            return $this;
        }
    }

    public function create() {


        $query = "INSERT INTO `installment` (`loan`,`paid_date`,`paid_amount`,`additional_interest`,`paid_by`) VALUES  ('"
                . $this->loan . "','"
                . $this->paid_date . "', '"
                . $this->paid_amount . "', '"
                . $this->additional_interest . "', '"
                . $this->paid_by . "')";


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


        $query = "SELECT * FROM `installment` ";
        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function getInstallmentByLoan($loan) {

        $query = "SELECT * FROM `installment` WHERE `loan`= $loan ";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {

            array_push($array_res, $row);
        }

        return $array_res;
    }

}
