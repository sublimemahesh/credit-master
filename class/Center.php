<?php

/**
 * Description of Customer
 *
 * @author Sublime Holdings
 */
class Center {

    public $id;
    public $center_name;
    public $address;
    public $center_leader_name;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT * FROM `center` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->center_name = $result['center_name'];
            $this->address = $result['address'];
            $this->center_leader_name = $result['center_leader_name'];


            return $this;
        }
    }

    public function create() {


        $query = "INSERT INTO `center` (`center_name`,`address`,`center_leader_name`) VALUES  ('"
                . $this->center_name . "','"
                . $this->address . "', '"
                . $this->center_leader_name . "')";


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
    
    
    
     public function update() {

        $query = "UPDATE  `center` SET "
                . "`center_name` ='" . $this->center_name . "', "
                . "`address` ='" . $this->address . "', "
                . "`center_leader_name` ='" . $this->center_leader_name . "' "
                . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();
        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);

        } else {

            return FALSE;

        }

    }


}
