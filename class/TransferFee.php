<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AccountType
 *
 * @author sublime
 */
class TransferFee {

    public $id;
    public $from_account;
    public $to_account;
    public $date;
    public $time;
    public $amount;
    public $purpose;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT * FROM `transfer_fee` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->from_account = $result['from_account'];
            $this->to_account = $result['to_account'];
            $this->date = $result['date'];
            $this->time = $result['time'];
            $this->amount = $result['amount'];
            $this->purpose = $result['purpose'];



            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `transfer_fee` (`from_account`,`to_account`,`date`,`time`,`amount`,`purpose`) VALUES  ('"
                . $this->from_account . "', '"
                . $this->to_account . "', '"
                . $this->date . "', '"
                . $this->time . "', '"
                . $this->amount . "', '"
                . $this->purpose . "')";

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


        $query = "SELECT * FROM `transfer_fee` ";
        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `transfer_fee` SET "
                . "`from_account` ='" . $this->from_account . "', "
                . "`to_account` ='" . $this->to_account . "', "
                . "`date` ='" . $this->date . "' "
                . "`time` ='" . $this->time . "' "
                . "`amount` ='" . $this->amount . "' "
                . "WHERE `purpose` = '" . $this->purpose . "'";

        $db = new Database();
        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {

            return FALSE;
        }
    }

    public function delete() {

        $query = 'DELETE FROM `transfer_fee` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

}
