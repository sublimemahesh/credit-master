<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Od
 *
 * @author Sublime
 */
class Od {

    public $id;
    public $loan;
    public $od_date_start;
    public $od_date_end;
    public $od_interest_limit;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT * FROM `od_history` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->loan = $result['loan'];
            $this->od_date_start = $result['od_date_start'];
            $this->od_date_end = $result['od_date_end'];
            $this->od_interest_limit = $result['od_interest_limit'];

            return $this;
        }
    }

    public function create() {


        $query = "INSERT INTO `od_history` (`loan`,`od_date_start`,`od_date_end`,`od_interest_limit`) VALUES  ('"
                . $this->loan . "','"
                . $this->od_date_start . "', '"
                . $this->od_date_end . "', '"
                . $this->od_interest_limit . "')";


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


        $query = "SELECT * FROM `od_history` ";
        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `od_history` SET "
                . "`loan` ='" . $this->loan . "', "
                . "`od_date_start` ='" . $this->od_date_start . "', "
                . "`od_date_end` ='" . $this->od_date_end . "', "
                . "`od_interest_limit` ='" . $this->od_interest_limit . "' "
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

        $query = 'DELETE FROM `od_history` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function allOdByLoan() {

        $query = "SELECT * FROM `od_history` WHERE loan ='" . $this->loan . "'";
        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

}
