<?php

/**
 * Description of Customer
 *
 * @author Sublime Holdings
 */
class CollectorPaymentDetail {

    public $id;
    public $collector_id;
    public $ammount;
    public $is_recived;
    public $is_issuied;
    public $is_settle;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT * FROM `collector_payment_detail` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->collector_id = $result['collector_id'];
            $this->ammount = $result['ammount'];
            $this->is_recived = $result['is_recived'];
            $this->is_issuied = $result['is_issuied'];
            $this->is_settle = $result['is_settle'];


            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `collector_payment_detail` (`collector_id`,`ammount`,`is_recived`,`is_issuied`,`is_settle`) VALUES  ('"
                . $this->collector_id . "', '"
                . $this->ammount . "', '"
                . $this->is_recived . "', '"
                . $this->is_issuied . "', '"
                . $this->is_settle . "')";


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


        $query = "SELECT * FROM `collector_payment_detail` ";
        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

  

    public function update() {

        $query = "UPDATE  `collector_payment_detail` SET "
                . "`collector_id` ='" . $this->collector_id . "' , "
                . "`ammount` ='" . $this->ammount . "',  "
                . "`is_recived` ='" . $this->is_recived . "',  "
                . "`is_issuied` ='" . $this->is_issuied . "',  "
                . "`is_settle` ='" . $this->is_settle . "'  "
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

        $query = 'DELETE FROM `collector_payment_detail` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

}
