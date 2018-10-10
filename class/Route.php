<?php

/**
 * Description of Customer
 *
 * @author Sublime Holdings
 */
class Route {

    public $id;
    public $route_name;
    public $route_code;
    public $start_location;
    public $end_location;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT * FROM `route` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->route_name = $result['route_name'];
            $this->route_code = $result['route_code'];
            $this->start_location = $result['start_location'];
            $this->end_location = $result['end_location'];


            return $this;
        }
    }

    public function create() {


        $query = "INSERT INTO `route` (`route_name`,`route_code`,`start_location`,`end_location`) VALUES  ('"
                . $this->route_name . "','"
                . $this->route_code . "', '"
                . $this->start_location . "', '"
                . $this->end_location . "')";


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


        $query = "SELECT * FROM `route` ";
        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `route` SET "
                . "`route_name` ='" . $this->route_name . "', "
                . "`route_code` ='" . $this->route_code . "', "
                . "`start_location` ='" . $this->start_location . "', "
                . "`end_location` ='" . $this->end_location . "' "
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

        $query = 'DELETE FROM `route` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

}
