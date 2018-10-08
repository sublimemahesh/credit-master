<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VehiclePhotos
 *
 * @author win7
 */
class VehiclePhotos {

    //put your code here


    public $id;
    public $vehicle;
    public $caption;
    public $image_name;
    public $queue;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`vehicle`,`caption`,`image_name`,`queue` FROM `vehicle_photos` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->vehicle = $result['vehicle'];
            $this->caption = $result['caption'];
            $this->image_name = $result['image_name'];
            $this->queue = $result['queue'];
            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `vehicle_photos` (`vehicle`,`caption`,`image_name`,`queue`) VALUES  ('"
                . $this->vehicle . "','"
                . $this->caption . "','"
                . $this->image_name . "','"
                . $this->queue . "')";

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

        $query = "SELECT * FROM `vehicle_photos`  ";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE `vehicle_photos` SET "
                . "`caption` ='" . $this->caption . "', "
                . "`image_name` ='" . $this->image_name . "', "
                . "`queue` ='" . $this->queue . "' "
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

        $query = 'DELETE FROM `vehicle_photos` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function GetVehiclePhotosById($vehicle) {

        $query = "SELECT * FROM `vehicle_photos` WHERE `vehicle`= $vehicle ORDER BY queue ASC";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    
    
        public function arrange($key, $img) {
        $query = "UPDATE `vehicle_photos` SET `queue` = '" . $key . "'  WHERE id = '" . $img . "'";
        $db = new Database();
        $result = $db->readQuery($query);
        return $result;
    }

}
