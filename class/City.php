<?php

/**
 * Description of Product
 *
 * @author sublime holdings
 * @web www.sublime.lk
 */
class City {

    //put your code here
    public $id;
    public $name;
    public $postal_code;
    public $sort;

    public function __construct($id = NULL) {
        if ($id) {

            $query = "SELECT * FROM `city` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->name = $result['name'];
            $this->postal_code = $result['postal_code'];
            $this->sort = $result['sort'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `city` "
                . "(`name`,`postal_code`)"
                . " VALUES "
                . "('" . $this->name . "','" . $this->postal_code . "')";

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

        $query = "SELECT * FROM `city` ORDER BY `sort` ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = 'UPDATE `city` SET `name`= "' . $this->name . '", `postal_code`= "' . $this->postal_code . '" WHERE id="' . $this->id . '"';

        $db = new Database();
        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    public function delete() {

        $query = 'DELETE FROM `city` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

}
