<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CustomerDetails
 *
 * @author sublime
 */
class LoanDocument {

    public $id;
    public $loan;
    public $caption;
    public $image_name;

    public function __construct($id = NULL) {
        if ($id) {

            $query = "SELECT `id`,`loan`,`caption`,`image_name` FROM `loan_document` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->loan = $result['loan'];
            $this->caption = $result['caption'];
            $this->image_name = $result['image_name'];

            return $this;
        }
    }

    public function create() {


        $query = "INSERT INTO `loan_document` (`loan`,`caption`,`image_name`) VALUES  ('"
                . $this->loan . "','"
                . $this->caption . "','"
                . $this->image_name . "')";


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

        $query = "SELECT * FROM `loan_document` ";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getDocumentByLoan($id) {

        $query = "SELECT * FROM `loan_document` WHERE `loan` ='" . $id . "'";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function delete() { 

        $query = 'DELETE FROM `loan_document` WHERE id="' . $this->id . '"';
       
        $db = new Database();
        return $db->readQuery($query);
    }

}
