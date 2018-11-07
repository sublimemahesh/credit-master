<?php

class DefaultData {

    //put your code here
    public function getLoanPeriod() {
        return array("30" => "One Month", "60" => "Two Months", "90" => "Three Months", "100" => "100 Days");
    }

    public function getInstallmentType() {
        return array("30" => "Daily", "4" => "Weekly ", "1" => "Monthly");
    }

    public function getDefaultInstallmentRate() {
        return 10;
    }

    public function getNumOfInstlByPeriodAndType($period, $type) {

        return $type * ($period / 30);
    }

    public function getLoanIssueMode() {

        return array("cash" => "Cash", "bank" => "Bank", "cheque" => "Cheque ");
    }

    public function getCreditLimit() {

        return 100000;
    }

}
