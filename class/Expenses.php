<?php

/**
 * Description of Customer
 *
 * @author Sublime Holdings
 */
class Expenses {

    public $id;
    public $date;
    public $time;
    public $amount;
    public $reason;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT * FROM `expenses` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->date = $result['date'];
            $this->time = $result['time'];
            $this->amount = $result['amount'];
            $this->reason = $result['reason'];


            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `expenses` (`date`,`time`,`amount`,`reason`) VALUES  ('"
                . $this->date . "','"
                . $this->time . "', '"
                . $this->amount . "', '"
                . $this->reason . "')";


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


        $query = "SELECT * FROM `expenses` ";
        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

 

    public function update() {

        $query = "UPDATE  `expenses` SET "
                . "`date` ='" . $this->date . "', "
                . "`time` ='" . $this->time . "', "
                . "`amount` ='" . $this->amount . "', "
                . "`reason` ='" . $this->reason . "' "
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

        $query = 'DELETE FROM `expenses` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

}
