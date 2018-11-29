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

        return 100000;
    }

    public function getFirstLetterName($string) {
        return preg_replace('/(\B.|\s+)/', '', $string);
    }

    public function loanProcessingPreCash($amount) {

        $document_free = 50;
        $total = ($amount * 0.1 / 100) + $document_free;
        return $total;
    }

    public function loanProcessingPreBank($amount) {

        $document_free = 50;
        $count = $amount / 100000;
        $full_document_charge = $count * $document_free;
        $total = ($amount * 0.1 / 100) + $full_document_charge;

        return $total;
    }

    public function loanProcessingPreCheque($amount) {
        
        $document_free = 50;
        $cheque_free = 30;
        $full_document_charge = $cheque_free + $document_free;
        $total = ($amount * 0.1 / 100) + $full_document_charge;

        return $total;
    }

}
