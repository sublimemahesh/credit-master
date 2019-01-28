<?php

/**
 * Description of Customer
 *
 * @author Sublime Holdings
 */
class Branch {

    public $id;
    public $name;
    public $code;
    public $bank_id;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT * FROM `branch` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->name = $result['name'];
            $this->code = $result['code'];
            $this->bank_id = $result['bank_id'];


            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `branch` (`name`,`code`,`bank_id`) VALUES  ('"
                . $this->name . "', '"
                . $this->code . "', '"
                . $this->bank_id . "')";


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


        $query = "SELECT * FROM `branch` ";
        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function getBrachByBank($bank_id) {


        $query = "SELECT * FROM `branch` WHERE `bank_id` = $bank_id";
        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function getBrachCode($branch) {


        $query = "SELECT * FROM `branch` WHERE `id` = $branch LIMIT 1";
        $db = new Database();


        $result = $db->readQuery($query);

        $row = mysql_fetch_array($result);

        return $row;
    }

    public function update() {

        $query = "UPDATE  `branch` SET "
                . "`name` ='" . $this->name . "', "
                . "`code` ='" . $this->code . "' "
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

        $query = 'DELETE FROM `branch` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

}
