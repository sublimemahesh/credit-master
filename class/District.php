<?php

/**
 * Description of Product
 *
 * @author sublime holdings
 * @web www.sublime.lk
 */
class District {

    public $id;
    public $name;
    public $sort = 100;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`name`,`sort` FROM `district` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->name = $result['name'];
            $this->sort = $result['sort'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `district` (`name`, `sort`) VALUES  ('" . $this->name . "', '" . $this->sort . "')";

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

        $query = "SELECT * FROM `district` ORDER BY `sort` ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = 'UPDATE `district` SET `name`= "' . $this->name . '" WHERE id="' . $this->id . '"';

        $db = new Database();
        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    public function arrange($key, $img) {
        $query = "UPDATE `district` SET `sort` = '" . $key . "'  WHERE id = '" . $img . "'";
        $db = new Database();
        $result = $db->readQuery($query);
        return $result;
    }

    public function delete() {

        $CITY = new City(NULL);

        $result = $CITY->deleteCitiesByDistrict($this->id);

        if ($result) {
            $query = 'DELETE FROM `district` WHERE id="' . $this->id . '"';
        }

        $db = new Database();

        return $db->readQuery($query);
//        dd($query);
    }

}