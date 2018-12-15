<?php

/**
 * Description of Customer
 *
 * @author Sublime Holdings
 */
class Center {

    public $id;
    public $name;
    public $address;
    public $leader;
    public $collector;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT * FROM `center` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->name = $result['name'];
            $this->address = $result['address'];
            $this->leader = $result['leader'];
            $this->collector = $result['collector'];


            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `center` (`name`,`address`,`leader`,`collector`) VALUES  ('"
                . $this->name . "','"
                . $this->address . "', '"
                . $this->leader . "', '"
                . $this->collector . "')";


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


        $query = "SELECT * FROM `center` ";
        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function getCenterIdByCustomer() {


        $query = "SELECT * FROM `center` ";
        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `center` SET "
                . "`name` ='" . $this->name . "', "
                . "`address` ='" . $this->address . "', "
                . "`leader` ='" . $this->leader . "', "
                . "`collector` ='" . $this->collector . "' "
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

        $query = 'DELETE FROM `center` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function getCentersByCollector($uid) {


        $query = "SELECT * FROM `center` WHERE `collector`= $uid "; 
        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

}
