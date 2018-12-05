<?php

class DefaultData {

    public $id;
    public $name;
    public $data;

    public function __construct($id = NULL) {
        if ($id) {

            $query = "SELECT * FROM `default_data` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->name = $result['name'];
            $this->data = $result['data'];

            return $this;
        }
    }

    //put your code here
    public function getLoanPeriod() {
        return array("30" => "One Month", "60" => "Two Months", "90" => "Three Months", "100" => "100 Days");
    }

    public function getInstallmentType() {
        return array("30" => "Daily", "4" => "Weekly ", "1" => "Monthly");
    }

    public function getDefaultInterestRate() {

        $data = $this->__construct(1);

        return $data->data;
    }

    public function getNumOfInstlByPeriodAndType($period, $type) {

        return intval($type * ($period / 30));
    }

    public function getLoanIssueMode() {

        return array("cash" => "Cash", "bank" => "Bank", "cheque" => "Cheque ");
    }

    public function getCreditLimit() {

        return 40000;
    }

    public function getFirstLetterName($string) {
        $words = explode(" ", $string);
        $result = '';
        foreach ($words as $word) {
            $result .= $word[0] . '. ';
        }

        return $result;
    }

    public function loanProcessingPreCash($amount) {

        $document_free = 50;
        $stamp_fee = ($amount * 0.1 / 100);
        $total = $stamp_fee + $document_free;
        $loan_free = array("document_free" => $document_free, "total" => $total, "stamp_fee" => $stamp_fee);

        return $loan_free;
    }

    public function loanProcessingPreBank($amount) {

        $document_free = 50;

        $count = $amount / 100000;

        $stamp_fee = ($amount * 0.1 / 100);       
        $full_document_charge = $count * $document_free;
       
        $total = $stamp_fee + $full_document_charge;
        
        $loan_free = array("document_free" => $document_free, "total" => $total, "stamp_fee" => $stamp_fee);

        return $loan_free;
    }

    public function loanProcessingPreCheque($amount) {

        $document_free = 50;
        $cheque_free = 30;
        $stamp_fee = ($amount * 0.1 / 100);
        $full_document_charge = $cheque_free + $document_free;
        $total = $stamp_fee + $full_document_charge;
        
        $loan_free = array("document_free" => $document_free, "total" => $total, "stamp_fee" => $stamp_fee,"cheque_free" => $cheque_free);

        return $loan_free;
    }

}
