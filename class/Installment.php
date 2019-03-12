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
    public $installment_date;
    public $paid_date;
    public $time;
    public $paid_amount;
    public $additional_interest;
    public $collector;
    public $receipt_no;
    public $status;
    public $type;
    public $history;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT * FROM `installment` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->loan = $result['loan'];
            $this->installment_date = $result['installment_date'];
            $this->paid_date = $result['paid_date'];
            $this->time = $result['time'];
            $this->paid_amount = $result['paid_amount'];
            $this->additional_interest = $result['additional_interest'];
            $this->collector = $result['collector'];
            $this->receipt_no = $result['receipt_no'];
            $this->status = $result['status'];
            $this->type = $result['type'];
            $this->history = $result['history'];

            return $this;
        }
    }

    public function create() {


        $query = "INSERT INTO `installment` (`loan`,`installment_date`,`paid_date`,`time`,`paid_amount`,`additional_interest`,`collector`,`type`,`receipt_no`,`history`) VALUES  ('"
                . $this->loan . "','"
                . $this->installment_date . "','"
                . $this->paid_date . "', '"
                . $this->time . "', '"
                . $this->paid_amount . "', '"
                . $this->additional_interest . "', '"
                . $this->collector . "', '"
                . $this->type . "', '"
                . $this->receipt_no . "', '"
                . $this->history . "')";


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

        $query = "SELECT * FROM `installment` WHERE `loan`= $loan  AND `type` = 'installment'";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {

            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getOtherPaymentByLoan($loan) {

        $query = "SELECT * FROM `installment` WHERE `loan`= $loan ";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {

            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `installment` SET "
                . "`installment_date` ='" . $this->installment_date . "', "
                . "`paid_date` ='" . $this->paid_date . "', "
                . "`paid_amount` ='" . $this->paid_amount . "', "
                . "`additional_interest` ='" . $this->additional_interest . "', "
                . "`collector` ='" . $this->collector . "', "
                . "`receipt_no` ='" . $this->receipt_no . "', "
                . "`history` ='" . $this->history . "', "
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

        $query = 'DELETE FROM `installment` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function getInstallmentByLoanAndDate($loan, $date) {

        $query = "SELECT * FROM `installment` WHERE `loan`= '" . $loan . "' AND `paid_date`= '" . $date . "' LIMIT 1";

        $db = new Database();

        $result = $db->readQuery($query);

        $row = mysql_fetch_array($result);

        return $row;
    }

    public function getModifiedInstallmentByCollector() {

        $query = "SELECT * FROM `installment` WHERE `collector`= '" . $this->collector . "' AND `status`= 'modified'";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {

            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function CheckInstallmetByPaidDate($date, $loan_id) {

        $query = "SELECT * FROM `installment` WHERE `paid_date`= '" . $date . "' AND    `loan`= '" . $loan_id . "' ";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function CheckInstallmetDateByLoanId($date, $loan_id) {

        $query = "SELECT * FROM `installment` WHERE `paid_date`< '" . $date . "' AND `type` = 'installment' AND `loan`= '" . $loan_id . "'";


        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function CheckInstallmetBeetwenTwoDateByLoanId($first_date, $second_date, $loan_id) {


        $query = "SELECT * FROM `installment` WHERE  `paid_date`  BETWEEN '" . $first_date . "' AND '" . $second_date . "'  AND `type` = 'installment' AND `loan` ='" . $loan_id . "'";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function CheckInstallmetBeetwenTwoDateByLoan($first_date, $second_date, $loan_id) {

        $query = "SELECT * FROM `installment` WHERE  `paid_date`  BETWEEN '" . $first_date . "' AND '" . $second_date . "' AND `paid_date`>= '" . $first_date . "' AND `paid_date`< '" . $second_date . "' AND `type` = 'installment' ";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function CheckInstallmetBeetwenTwoDateByLoanIdAllAmount($first_date, $second_date, $loan_id, $today) {

        $query = "SELECT  sum(`paid_amount`) FROM `installment` WHERE  `paid_date`  BETWEEN '" . $first_date . "' AND '" . $second_date . "' AND `loan` ='" . $loan_id . "' AND `paid_date`>= '" . $first_date . "' || `paid_date`= '" . $today . "' AND `type` = 'installment'";

        $db = new Database();

        $result = $db->readQuery($query);

        $row = mysql_fetch_row($result);

        return $row;
    }

    public function getAllAmountByPaidDate($date) {

        $query = "SELECT sum(`paid_amount`)  FROM `installment` WHERE `paid_date` ='" . $date . "' AND `type` = 'installment'";

        $db = new Database();

        $result = $db->readQuery($query);

        $row = mysql_fetch_row($result);

        return $row;
    }

    public function getPaidAmountByBeforeDate($date,$loan_id) {

        $query = "SELECT  * FROM `installment` WHERE `paid_date` <'" . $date . "' AND `loan`='" . $loan_id . "' AND `type` = 'installment'";


      $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function getAmountByLoanId($loan_id) {


        $query = "SELECT sum(`paid_amount`)  FROM `installment` WHERE `loan` ='" . $loan_id . "' AND `type`= 'installment'";

        $db = new Database();

        $result = $db->readQuery($query);

        $row = mysql_fetch_row($result);

        return $row;
    }

    public function getPaidNumberOfInstallment($installment_amount, $loan_id) {

        $paid_amount = $this->getAmountByLoanId($loan_id);

        $number_of_installment = $paid_amount[0] / $installment_amount;

        return $number_of_installment;
    }

    public function getPaidNumberOfInstallments($loan_id) {


        $query = "SELECT count(`loan`)  FROM `installment` WHERE `loan` ='" . $loan_id . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        $row = mysql_fetch_row($result);

        return $row;
    }

    public function getAllPaymentsByPaidDate($date) {


        $query = "SELECT *  FROM `installment` WHERE `paid_date` ='" . $date . "'";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {

            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getPaybleNumberOfInstallments($number_of_installments, $paid_numbers_of_installments) {

        $payble_of_installments = ($number_of_installments - round($paid_numbers_of_installments, 1));

        return $payble_of_installments;
    }

    public function getPaybleInstallmentAmount($loan_id, $loan_amount, $rate, $ins_type) {

        $Paid_amount = $this->getAmountByLoanId($loan_id);

        $loan_amount += (($loan_amount * $rate) / 100) * ($ins_type / 30);

        $payble_amount = $loan_amount - $Paid_amount[0];

        return $payble_amount;
    }

    public function getSystemDue($loan_amount, $rate, $ins_type) {

        $loan_amount += (($loan_amount * $rate) / 100) * ($ins_type / 30);

        return $loan_amount;
    }

    public function CheckPaidOdAmount($selectedDate, $od_date, $loan_id) {

        $query = "SELECT * FROM `installment` WHERE  `paid_date`  BETWEEN '" . $od_date . "' AND '" . $selectedDate . "' AND `loan` = '" . $loan_id . "'";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

}
