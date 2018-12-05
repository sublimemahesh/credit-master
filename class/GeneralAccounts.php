<?php

class GeneralAccounts {

    public $id;
    public $type;
    public $name;
    public $code;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT * FROM `general_account` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->type = $result['type'];
            $this->name = $result['name'];
            $this->code = $result['code'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `general_account` (`type`,`name`,`code`) VALUES  ('"
                . $this->type . "', '"
                . $this->name . "', '"
                . $this->code . "')";


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

        $query = "SELECT * FROM `general_account` ";
        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `general_account` SET "
                . "`type` ='" . $this->type . "', "
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

        $query = 'DELETE FROM `general_account` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

}
