<?php

/*
 * To change this license header, choose License Headers type Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template type the editor.
 */

/**
 * Description of PettyCash
 *
 * @author sublime
 */
class PettyCash {

    public $id;
    public $date;
    public $amount;
    public $user;
    public $type;
    public $reason;

    public function __construct($id = NULL) {
        if ($id) {

            $query = "SELECT `id`,`date`,`amount`,`user`,`type`,`reason` FROM `petty_cash` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->date = $result['date'];
            $this->amount = $result['amount'];
            $this->user = $result['user'];
            $this->type = $result['type'];
            $this->reason = $result['reason'];

            return $this;
        }
    }

    public function create() {


        $query = "INSERT INTO `petty_cash` (`date`,`amount`,`user`,`type`,`reason`) VALUES  ('"
                . $this->date . "','"
                . $this->amount . "','"
                . $this->user . "','"
                . $this->type . "','"
                . $this->reason . "')";


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

        $query = "SELECT * FROM `petty_cash` ";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `petty_cash` SET "
                . "`date` ='" . $this->date . "', "
                . "`amount` ='" . $this->amount . "', "
                . "`type` ='" . $this->type . "', "
                . "`reason` ='" . $this->reason . "' "
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

        $query = 'DELETE FROM `petty_cash` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function getPettyCashAmountByDate($date) {


        $query = "SELECT sum(`amount`)  FROM `petty_cash` WHERE `date` ='" . $date . "'";


        $db = new Database();

        $result = $db->readQuery($query);

        $row = mysql_fetch_row($result);
         
        return $row;
    }

}
