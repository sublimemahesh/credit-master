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

    public function getLoanPeriod() {
        return array("30" => "One Month", "60" => "Two Months", "90" => "Three Months", "100" => "100 Days");
    }

    public function getInstallmentType() {
        return array("30" => "Daily", "4" => "Weekly", "1" => "Monthly");
    }

    public function getDefaultInterestRate() {

        $data = $this->__construct(1);

        return $data->data;
    }

    public function getNumOfInstlByPeriodAndType($period, $type) {
        if (intval($type * ($period / 30)) == 12) {
            return 1 + intval($type * ($period / 30));
        } else {
            return intval($type * ($period / 30));
        }
    }

    public function getLoanIssueMode() {

        return array("cash" => "Cash", "bank" => "Bank", "cheque" => "Cheque");
    }

    public function getCreditLimit() {

        return 40000;
    }

    public function getFirstLetterName($string) {
        $words = explode(" ", $string);
        $result = '';
        foreach ($words as $word) {
            if (isset($word[0])) {
                $result .= $word[0] . '. ';
            }
        }

        return $result;
    }

    public function getLoanDocumentFee() {
        return 20;
    }

    public function getLoanChequeFee() {
        return 30;
    }

    public function getLoanStampFee($amount) {
        return ($amount * 0.1 / 100);
    }

    public function getLoanBankFee() {
        return 50;
    }

    public function loanProcessingPreCash($amount) {

        $document_fee = $this->getLoanDocumentFee();
        $stamp_fee = $this->getLoanStampFee($amount);
        $total = $stamp_fee + $document_fee;
      
        $loan_free = array(
            "document_free" => number_format($document_fee, 2),
            "total" => number_format($total, 2),
            "stamp_fee" => number_format($stamp_fee, 2)
        );

        return $loan_free;
    }

    public function loanProcessingPreBank($amount) {

        $document_fee = $this->getLoanDocumentFee();

        if ($amount <= 100000) {
            $bank_transaction_free = $this->getLoanBankFee();
        } else {
            $avg = $amount / 100000;
            $bank_transaction_free = ($this->getLoanBankFee() * (int) $avg) + $this->getLoanBankFee();
        }

        $stamp_fee = $this->getLoanStampFee($amount);
        $total = $stamp_fee + $bank_transaction_free + $document_fee;

        $loan_free = array(
            "document_free" => number_format($document_fee, 2),
            "bank_transaction_free" => number_format($bank_transaction_free, 2),
            "total" => number_format($total, 2),
            "stamp_fee" => number_format($stamp_fee, 2)
        );

        return $loan_free;
    }

    public function loanProcessingPreCheque($amount) {

        $document_fee = $this->getLoanDocumentFee();
        $cheque_fee = $this->getLoanChequeFee();
        $stamp_fee = $this->getLoanStampFee($amount);
        $full_document_charge = $cheque_fee + $document_fee;
        $total = $stamp_fee + $full_document_charge;

        $loan_free = array(
            "document_free" => number_format($document_fee, 2),
            "total" => number_format($total, 2),
            "stamp_fee" => number_format($stamp_fee, 2),
            "cheque_fee" => number_format($cheque_fee, 2)
        );

        return $loan_free;
    }

    public function generalLedgerAccounts() {
        return array("1" => "Assets", "2" => "Liabilities", "3" => "Operating Revenues", "4" => "Operating expenses", "5" => "Non-Operating Revenues and Gains", "6" => "Non-Operating Expenses and Losses");
    }

    public function GetUserLevels() {

        return array("1" => "Level One", "2" => "Level Two", "3" => "Level Three");
    }

    public function checkUserLevelAccess($accessLevels, $userlevel) {

        $levels = explode(',', $accessLevels);

        if (!in_array($userlevel, $levels)) {
            header("location: ./error_page.php");
        }
    }

    public function getTotalInstlToCurrentDate($date, $period, $type) {
        $today = date('Y-m-d H:i:s');
        
    }
}
