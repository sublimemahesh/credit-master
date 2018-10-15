<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DefultData
 *
 * @author sublime
 */
class DefultData {

    //put your code here
    public function getloanperiod() {

        $defultdata = array("1" => Day, "2" => week, "3" => Month, "4" => Year);

        while ($row = mysql_fetch_array($defultdata)) {
            array_push($defultdata, $row);
        }
        return $defultdata;
    }

    public function getinstallmenttype() {

        $defultdata = array("1" => Day, "2" => week, "3" => Month, "4" => Year);

        while ($row = mysql_fetch_array($defultdata)) {
            array_push($defultdata, $row);
        }
        return $defultdata;
    }

}
