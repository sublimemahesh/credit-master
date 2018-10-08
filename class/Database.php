<?php

/**
 * Description of User
 *
 * @author sublime holdings
 * @web www.sublime.lk
 * */
class Database {

    private $host = 'localhost';
    private $name = 'gallnwxt_micro_credit';
    private $user = 'gallnwxt_micro_credit';
    private $password = 'o&nb[hu[}*#K';
    
  
//    private $host = 'localhost';
//    private $name = 'micro-credit';
//    private $user = 'root';
//    private $password = '';

    public function __construct() {
        mysql_connect($this->host, $this->user, $this->password) or die("Invalid host  or user details");
        mysql_select_db($this->name) or die("Unable to select database");
    }

    public function readQuery($query) {

        $result = mysql_query($query) or die(mysql_error());
        return $result;
 
    }

}