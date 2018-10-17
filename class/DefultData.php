<?php

class DefultData {

    //put your code here
    public function getLoanPeriod() {

        return array("30" => "One Month", "60" => "Two Months", "90" => "Three Months", "100" => "100 Days");
    }

    public function getInstallmentType() {

        return array("30" => "Day", "4" => "Week", "1" => "Month");
    }

}
