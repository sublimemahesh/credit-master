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
class CustomerDocument {

    public $id;
    public $customer_id;
    public $image_name;
    public $caption;

    public function __construct($id = NULL) {
        if ($id) {

            $query = "SELECT `id`,`customer_id`,`image_name`,`caption` FROM `customer_document` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->customer_id = $result['customer_id'];
            $this->image_name = $result['image_name'];
            $this->caption = $result['caption'];

            return $this;
        }
    }

    public function create() {


        $query = "INSERT INTO `customer_document` (`customer_id`,`image_name`,`caption`) VALUES  ('"
                . $this->customer_id . "','"
                . $this->image_name . "','"
                . $this->caption . "')";


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

        $query = "SELECT * FROM `customer_document` ";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getDocumentByCustomer($id) {

        $query = "SELECT * FROM `customer_document` WHERE `customer_id` ='" . $id . "'";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

}
