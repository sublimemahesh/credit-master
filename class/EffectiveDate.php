<?php

/**
 * Description of Product
 *
 * @author sublime holdings
 * @web www.sublime.lk
 */
class EffectiveDate {

    public $id;
    public $loan;
    public $date;
    public $loan_period;
    public $installment_type;
    public $installment_amount;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT * FROM `effective_date` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            return $result;
        }
    }

    public function create() {

        $query = "INSERT INTO `effective_date` "
                . "(`loan`,"
                . "`date`,"
                . "`loan_period`,"
                . "`installment_type`,"
                . "`installment_amount`"
                . ") VALUES  ('"
                . $this->loan . "','"
                . $this->date . "', '"
                . $this->loan_period . "', '"
                . $this->installment_type . "', '"
                . $this->installment_amount . "')";

        $db = new Database();
        $result = $db->readQuery($query);

        if ($result) {

            $last_id = mysql_insert_id();

            return $this->__construct($last_id);
        } else {

            return FALSE;
        }
    }

}
