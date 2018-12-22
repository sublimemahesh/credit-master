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
class Account {

    public $id;
    public $account_type;
    public $user;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT * FROM `account` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->account_type = $result['account_type'];
            $this->user = $result['user'];



            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `account` (`account_type`,`user`) VALUES  ('"
                . $this->account_type . "', '"
                . $this->user . "')";

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


        $query = "SELECT * FROM `account` ";
        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function getAccountByAccountType($account_type) {


        $query = "SELECT * FROM `account` WHERE `account_type` = $account_type";
        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `account` SET "
                . "`account_type` ='" . $this->accont_type . "', "
                . "`user` ='" . $this->user . "' "
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

        $query = 'DELETE FROM `account` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

}
