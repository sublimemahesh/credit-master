<?php

/**
 * Description of Customer
 *
 * @author Sublime Holdings
 */
class PostponeDate {

    public $id;
    public $date;
    public $reason;
    public $by;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT * FROM `postpone_date` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->date = $result['date'];
            $this->reason = $result['reason'];
            $this->by = $result['by'];


            return $this;
        }
    }

    public function create() {


        $query = "INSERT INTO `postpone_date` (`date`,`reason`,`by`) VALUES  ('"
                . $this->date . "','"
                . $this->reason . "', '"
                . $this->by . "')";


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


        $query = "SELECT * FROM `postpone_date` ";
        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `postpone_date` SET "
                . "`date` ='" . $this->date . "', "
                . "`reason` ='" . $this->reason . "', "
                . "`by` ='" . $this->by . "' "
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

        $query = 'DELETE FROM `postpone_date` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

}
