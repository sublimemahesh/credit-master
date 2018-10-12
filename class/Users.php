<?php

/**
 * Description of Customer
 *
 * @author Sublime Holdings
 */
class Users {

    public $id;
    public $name;
    public $user_name;
    public $email;
    public $image_name;
    public $is_active;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT * FROM `users` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->name = $result['name'];
            $this->user_name = $result['user_name'];
            $this->email = $result['email'];
            $this->image_name = $result['image_name'];
            $this->is_active = $result['is_active'];


            return $this;
        }
    }

    public function create() {


        $query = "INSERT INTO `users` (`name`,`user_name`,`email`,`image_name`,`is_active`) VALUES  ('"
                . $this->name . "','"
                . $this->user_name . "', '"
                . $this->email . "', '"
                . $this->image_name . "', '"
                . $this->is_active . "')";


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


        $query = "SELECT * FROM `users` ";
        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    
    public function update() {

        $query = "UPDATE  `users` SET "
                . "`name` ='" . $this->name . "', "
                . "`user_name` ='" . $this->user_name . "', "
                . "`email` ='" . $this->email . "', "
                . "`image_name` ='" . $this->image_name . "', "
                . "`is_active` ='" . $this->is_active . "' "
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


        unlink(Helper::getSitePath() . "upload/users/" . $this->image_name);

        $query = 'DELETE FROM `users` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

}
