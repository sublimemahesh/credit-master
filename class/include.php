<?php

date_default_timezone_set('Asia/Colombo');

include_once(dirname(__FILE__) . '/Setting.php');
include_once(dirname(__FILE__) . '/Helper.php');
include_once(dirname(__FILE__) . '/Upload.php');
include_once(dirname(__FILE__) . '/Database.php');
include_once(dirname(__FILE__) . '/User.php');
include_once(dirname(__FILE__) . '/Message.php');
include_once(dirname(__FILE__) . '/Validator.php');
include_once(dirname(__FILE__) . '/City.php');
include_once(dirname(__FILE__) . '/District.php');
include_once(dirname(__FILE__) . '/Customer.php');
include_once(dirname(__FILE__) . '/Center.php');
include_once(dirname(__FILE__) . '/Route.php'); 
include_once(dirname(__FILE__) . '/Loan.php');
include_once(dirname(__FILE__) . '/Installment.php');
include_once(dirname(__FILE__) . '/PostponeDate.php');
include_once(dirname(__FILE__) . '/EffectiveDate.php');
include_once(dirname(__FILE__) . '/DefaultData.php');
include_once(dirname(__FILE__) . '/CustomerDocument.php');
include_once(dirname(__FILE__) . '/PettyCash.php');
include_once(dirname(__FILE__) . '/Bank.php');
include_once(dirname(__FILE__) . '/Branch.php');
include_once(dirname(__FILE__) . '/Expenses.php');
include_once(dirname(__FILE__) . '/CollectorPaymentDetail.php');
include_once(dirname(__FILE__) . '/GeneralAccounts.php');
include_once(dirname(__FILE__) . '/LoanDocument.php');
include_once(dirname(__FILE__) . '/AccountType.php');
include_once(dirname(__FILE__) . '/Account.php');
include_once(dirname(__FILE__) . '/TransferFee.php');
include_once(dirname(__FILE__) . '/GnDivision.php');

function dd($data) {
    var_dump($data);
    exit();
}

function redirect($url) {
    $string = '<script type="text/javascript">';
    $string .= 'window.location = "' . $url . '"';
    $string .= '</script>';

    echo $string;
    exit();
}
