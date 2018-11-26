<?php

/**
 * Description of Customer
 *
 * @author Sublime Holdings
 */
class Bank {

    public $id;
    public $name;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT * FROM `bank` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->name = $result['name'];


            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `bank` (`name`) VALUES  ('"
                . $this->name . "')";


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


        $query = "SELECT * FROM `bank` ";
        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    

    public function update() {

        $query = "UPDATE  `bank` SET "
                . "`name` ='" . $this->name . "'  "
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

        $query = 'DELETE FROM `bank` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

}
