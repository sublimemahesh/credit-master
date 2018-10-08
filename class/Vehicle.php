<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Vehicle
 *
 * @author win7
 */
class Vehicle {

    public $id;
    public $type;
    public $model_and_brand;
    public $reg_number;
    public $email;
    public $contact_number;
    public $city;
    public $image_name;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`type`,`model_and_brand`,`reg_number`,`email`,`contact_number`,`city`,`image_name` FROM `vehicle` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->type = $result['type'];
            $this->model_and_brand = $result['model_and_brand'];
            $this->reg_number = $result['reg_number'];
            $this->email = $result['email'];
            $this->contact_number = $result['contact_number'];
            $this->city = $result['city'];
            $this->image_name = $result['image_name'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `vehicle` (`type`,`model_and_brand`,`reg_number`,`email`,`contact_number`,`city`,`image_name`) VALUES  ('"
                . $this->type . "','"
                . $this->model_and_brand . "','"
                . $this->reg_number . "','"
                . $this->email . "','"
                . $this->contact_number . "','"
                . $this->city . "','"
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

        $query = "SELECT * FROM `vehicle` ";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE `vehicle` SET "
                . "`type` ='" . $this->type . "', "
                . "`model_and_brand` ='" . $this->model_and_brand . "', "
                . "`reg_number` ='" . $this->reg_number . "', "
                . "`email` ='" . $this->email . "', "
                . "`contact_number` ='" . $this->contact_number . "', "
                . "`city` ='" . $this->city . "', "
                . "`image_name` ='" . $this->image_name . "' "
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

        $query = 'DELETE FROM `vehicle` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

//    public function arrange($key, $vehicle) {
//        $query = "UPDATE `vehicle` SET `sort` = '" . $key . "'  WHERE id = '" . $vehicle . "'";
//        $db = new Database();
//        $result = $db->readQuery($query);
//        return $result;
//    }

}
