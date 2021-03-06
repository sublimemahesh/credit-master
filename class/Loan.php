<?php

/**
 * Description of Customer
 *
 * @author Sublime Holdings
 */
class Loan {

    public $id;
    public $create_date;
    public $customer;
    public $guarantor_1;
    public $guarantor_2;
    public $guarantor_3;
    public $loan_amount;
    public $interest_rate;
    public $loan_period;
    public $loan_processing_pre;
    public $installment_type;
    public $installment_amount;
    public $number_of_installments;
    public $issue_mode;
    public $effective_date;
    public $verify_comments;
    public $balance_of_last_loan;
    public $issued_date;
    public $issue_note;
    public $create_by;
    public $verify_by;
    public $approved_by;
    public $collector;
    public $issue_by;
    public $release_by;
    public $status;
    public $transaction_id;
    public $transaction_document;
    public $history;
    public $od_interest_limit;
    public $od_date;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT * FROM `loan` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->create_date = $result['create_date'];
            $this->customer = $result['customer'];
            $this->guarantor_1 = $result['guarantor_1'];
            $this->guarantor_2 = $result['guarantor_2'];
            $this->guarantor_3 = $result['guarantor_3'];
            $this->loan_amount = $result['loan_amount'];
            $this->loan_processing_pre = $result['loan_processing_pre'];
            $this->interest_rate = $result['interest_rate'];
            $this->loan_period = $result['loan_period'];
            $this->installment_type = $result['installment_type'];
            $this->installment_amount = $result['installment_amount'];
            $this->number_of_installments = $result['number_of_installments'];
            $this->issue_mode = $result['issue_mode'];
            $this->effective_date = $result['effective_date'];
            $this->issued_date = $result['issued_date'];
            $this->issue_note = $result['issue_note'];
            $this->verify_comments = $result['verify_comments'];
            $this->balance_of_last_loan = $result['balance_of_last_loan'];
            $this->create_by = $result['create_by'];
            $this->verify_by = $result['verify_by'];
            $this->approved_by = $result['approved_by'];
            $this->collector = $result['collector'];
            $this->issue_by = $result['issue_by'];
            $this->release_by = $result['release_by'];
            $this->status = $result['status'];
            $this->transaction_id = $result['transaction_id'];
            $this->transaction_document = $result['transaction_document'];
            $this->history = $result['history'];
            $this->od_interest_limit = $result['od_interest_limit'];
            $this->od_date = $result['od_date'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `loan` ("
                . "`create_date`,"
                . "`customer`,"
                . "`guarantor_1`,"
                . "`guarantor_2`,"
                . "`guarantor_3`,"
                . "`loan_amount`,"
                . "`issue_mode`,"
                . "`loan_processing_pre`,"
                . "`loan_period`,"
                . "`interest_rate`,"
                . "`installment_type`,"
                . "`installment_amount`,"
                . "`number_of_installments`,"
                . "`effective_date`,"
                . "`create_by`,"
                . "`collector`,"
                . "`od_interest_limit`,"
                . "`od_date`,"
                . "`status`"
                . ") VALUES  ('"
                . $this->create_date . "','"
                . $this->customer . "', '"
                . $this->guarantor_1 . "', '"
                . $this->guarantor_2 . "', '"
                . $this->guarantor_3 . "', '"
                . $this->loan_amount . "', '"
                . $this->issue_mode . "', '"
                . $this->loan_processing_pre . "', '"
                . $this->loan_period . "', '"
                . $this->interest_rate . "', '"
                . $this->installment_type . "', '"
                . $this->installment_amount . "', '"
                . $this->number_of_installments . "', '"
                . $this->effective_date . "', '"
                . $this->create_by . "', '"
                . $this->collector . "', '"
                . $this->od_interest_limit . "', '"
                . $this->od_date . "', '"
                . "pending')";


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

        $query = "SELECT * FROM `loan` ";
        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function allByStatus() {

        $query = "SELECT * FROM `loan` WHERE `status` = '" . $this->status . "'";
        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function getloanByCustomer($customer) {

        $query = "SELECT * FROM `loan` WHERE `customer` ='" . $customer . "'";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `loan` SET "
                . "`create_date` ='" . $this->create_date . "', "
                . "`customer` ='" . $this->customer . "', "
                . "`guarantor_1` ='" . $this->guarantor_1 . "', "
                . "`guarantor_2` ='" . $this->guarantor_2 . "', "
                . "`guarantor_3` ='" . $this->guarantor_3 . "', "
                . "`loan_amount` ='" . $this->loan_amount . "', "
                . "`interest_rate` ='" . $this->interest_rate . "', "
                . "`loan_period` ='" . $this->loan_period . "', "
                . "`loan_processing_pre` ='" . $this->loan_processing_pre . "', "
                . "`installment_type` ='" . $this->installment_type . "', "
                . "`installment_amount` ='" . $this->installment_amount . "', "
                . "`number_of_installments` ='" . $this->number_of_installments . "', "
                . "`issue_mode` ='" . $this->issue_mode . "', "
                . "`effective_date` ='" . $this->effective_date . "', "
                . "`verify_by` ='" . $this->verify_by . "', "
                . "`collector` ='" . $this->collector . "', "
                . "`approved_by` ='" . $this->approved_by . "', "
                . "`issue_by` ='" . $this->issue_by . "', "
                . "`release_by` ='" . $this->release_by . "', "
                . "`issued_date` ='" . $this->issued_date . "', "
                . "`issue_note` ='" . $this->issue_note . "', "
                . "`verify_comments` ='" . $this->verify_comments . "', "
                . "`balance_of_last_loan` ='" . $this->balance_of_last_loan . "', "
                . "`status` ='" . $this->status . "', "
                . "`transaction_id` ='" . $this->transaction_id . "', "
                . "`transaction_document` ='" . $this->transaction_document . "', "
                . "`history` ='" . $this->history . "', "
                . "`od_interest_limit` ='" . $this->od_interest_limit . "', "
                . "`od_date` ='" . $this->od_date . "' "
                . "WHERE `id` = '" . $this->id . "'";



        $db = new Database();
        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    public function updateOd() {

        $query = "UPDATE  `loan` SET "
                . "`od_interest_limit` ='" . $this->od_interest_limit . "', "
                . "`od_date` ='" . $this->od_date . "' "
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

        $query = 'DELETE FROM `loan` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function CheckGuarantor_2($guarantor_2) {

        $query = "SELECT count(`guarantor_2`)>=2 as count FROM `loan` WHERE `guarantor_2` = '" . $guarantor_2 . "'";

        $db = new Database();
        $res = $db->readQuery($query);
        $result = mysql_fetch_assoc($res);

        if ($result['count'] == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function CheckGuarantor_3($guarantor_3) {

        $query = "SELECT count(`guarantor_3`)>=2 as count FROM `loan` WHERE `guarantor_3` = '" . $guarantor_3 . "'";

        $db = new Database();
        $res = $db->readQuery($query);
        $result = mysql_fetch_assoc($res);

        if ($result['count'] == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function CheckCustomerHasLoan($customer) {

        $query = "SELECT * FROM `loan` WHERE `customer` = '" . $customer . "' OR `guarantor_1` = '" . $customer . "' OR `guarantor_2` = '" . $customer . "' OR `guarantor_3` = '" . $customer . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if (mysql_num_rows($result) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function CheckCustomerLoan($customer) {

        $query = "SELECT * FROM `loan` WHERE  customer='" . $customer . "'   AND  (`status` ='pending' OR `status` ='verified' OR `status` ='approve' ) ";

        $db = new Database();

        $result = $db->readQuery($query);

        if (mysql_num_rows($result) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function CheckCustomerHasActiveLoan($customer) {

        $query = "SELECT * FROM `loan` WHERE `customer` = '" . $customer . "' OR  `guarantor_1` ='" . $customer . "' OR  `guarantor_2` ='" . $customer . "' OR  `guarantor_3` ='" . $customer . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if (mysql_num_rows($result) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getLoanDetailsByCustomer($customer) {

        $query = "SELECT `id`,`loan_amount`,`interest_rate` FROM loan WHERE (customer='" . $customer . "') AND  (`status` ='issued' OR `status` ='released') ";

        $db = new Database();
        $result = $db->readQuery($query);
        $row = mysql_fetch_row($result);

        return $row;
    }

    public function getDetailsByCustomer($customer) {

        $query = "SELECT `id`,`loan_amount`,`interest_rate` FROM loan WHERE (customer='" . $customer . "')   ";

        $db = new Database();
        $result = $db->readQuery($query);
        $row = mysql_fetch_row($result);

        return $row;
    }

    public function getAllApprovedLoansByCollector() {

        $query = "SELECT * FROM `loan` WHERE `collector` ='" . $this->collector . "' AND  `status` = '" . $this->status . "'";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function approveLoan() {

        $query = "UPDATE  `loan` SET "
                . "`issued_date` ='" . $this->issued_date . "', "
                . "`status` ='issued'"
                . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();
        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    public function getCustomersHistoryByloanId($id) {

        $LOAN = new Loan($id);

        $CUSTOMER = new Customer($LOAN->customer);
        $GUARANTOR_01 = new Customer($LOAN->guarantor_1);
        $GUARANTOR_02 = new Customer($LOAN->guarantor_2);
        $GUARANTOR_03 = new Customer($LOAN->guarantor_3);


        $CUSTOMER_BANK = new Bank($CUSTOMER->bank);
        $GUARANTOR_01_BANK = new Bank($GUARANTOR_01->bank);
        $GUARANTOR_02_BANK = new Bank($GUARANTOR_02->bank);
        $GUARANTOR_03_BANK = new Bank($GUARANTOR_03->bank);

        $CUSTOMER_BRANCH = new Branch($CUSTOMER->branch);
        $GUARANTOR_01_BRANCH = new Branch($GUARANTOR_01->branch);
        $GUARANTOR_02_BRANCH = new Branch($GUARANTOR_02->branch);
        $GUARANTOR_03_BRANCH = new Branch($GUARANTOR_03->branch);

        $CUSTOMER_CITY = new City($CUSTOMER->city);
        $GUARANTOR_01_CITY = new City($GUARANTOR_01->city);
        $GUARANTOR_02_CITY = new City($GUARANTOR_01->city);
        $GUARANTOR_03_CITY = new City($GUARANTOR_01->city);

///---Customer table---///

        $html = '<html>';
        $html .= '<head>';
        $html .= '</head>';
        $html .= '<style>
                   table {
                   font-family: arial, sans-serif;
                   border-collapse: collapse;
                   width: 100%;
                  }

                    td, th {
                    border: 1px solid #dddddd;
                    text-align: left;
                    padding: 8px;
                  }

                    tr:nth-child(even) {
                    background-color: #dddddd;
                    }
                </style>';
        $html .= '<body>';
        $html .= '<table style=" font-family: arial, sans-serif; border-collapse: collapse;widtd: 100%;">';
        $html .= '<tr>';
        $html .= '<td>----</td>';
        $html .= '<td>Customer</td>';
        $html .= '<td>Gurantor_1</td>';
        $html .= '<td>Gurantor_2</td>';
        $html .= '<td>Gurantor_3</td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<tr>';
        $html .= '<td>Title:</td>';
        $html .= '<td>' . $CUSTOMER->title . '</td>';
        $html .= '<td>' . $GUARANTOR_01->title . '</td>';
        $html .= '<td>' . $GUARANTOR_02->title . '</td>';
        $html .= '<td>' . $GUARANTOR_03->title . '</td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td>First Name:</td>';
        $html .= '<td>' . $CUSTOMER->first_name . '</td>';
        $html .= '<td>' . $GUARANTOR_01->first_name . '</td>';
        $html .= '<td>' . $GUARANTOR_02->first_name . '</td>';
        $html .= '<td>' . $GUARANTOR_03->first_name . '</td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td>Last Name:</td>';
        $html .= '<td>' . $CUSTOMER->last_name . '</td>';
        $html .= '<td>' . $GUARANTOR_01->last_name . '</td>';
        $html .= '<td>' . $GUARANTOR_02->last_name . '</td>';
        $html .= '<td>' . $GUARANTOR_03->last_name . '</td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td>Surname:</td>';
        $html .= '<td>' . $CUSTOMER->surname . '</td>';
        $html .= '<td>' . $GUARANTOR_01->surname . '</td>';
        $html .= '<td>' . $GUARANTOR_02->surname . '</td>';
        $html .= '<td>' . $GUARANTOR_03->surname . '</td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td>NIC:</td>';
        $html .= '<td>' . $CUSTOMER->nic_number . '</td>';
        $html .= '<td>' . $GUARANTOR_01->nic_number . '</td>';
        $html .= '<td>' . $GUARANTOR_02->nic_number . '</td>';
        $html .= '<td>' . $GUARANTOR_03->nic_number . '</td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td>Birthday  Day:</td>';
        $html .= '<td>' . $CUSTOMER->dob_day . '-' . $CUSTOMER->dob_month . '-' . $CUSTOMER->dob_year . '</td>';
        $html .= '<td>' . $GUARANTOR_01->dob_day . '-' . $GUARANTOR_01->dob_month . '-' . $GUARANTOR_01->dob_year . '</td>';
        $html .= '<td>' . $GUARANTOR_02->dob_day . '-' . $GUARANTOR_02->dob_month . '-' . $GUARANTOR_02->dob_year . '</td>';
        $html .= '<td>' . $GUARANTOR_03->dob_day . '-' . $GUARANTOR_03->dob_month . '-' . $GUARANTOR_03->dob_year . '</td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td>Address:</td>';
        $html .= '<td>' . $CUSTOMER->address_line_1 . '-' . $CUSTOMER->address_line_2 . '-' . $CUSTOMER->address_line_3 . '-' . $CUSTOMER->address_line_4 . '-' . $CUSTOMER->address_line_5 . '</td>';
        $html .= '<td>' . $GUARANTOR_01->address_line_1 . '-' . $GUARANTOR_01->address_line_2 . '-' . $GUARANTOR_01->address_line_3 . '-' . $GUARANTOR_01->address_line_4 . '-' . $GUARANTOR_01->address_line_5 . '</td>';
        $html .= '<td>' . $GUARANTOR_02->address_line_1 . '-' . $GUARANTOR_02->address_line_2 . '-' . $GUARANTOR_02->address_line_3 . '-' . $GUARANTOR_02->address_line_4 . '-' . $GUARANTOR_02->address_line_5 . '</td>';
        $html .= '<td>' . $GUARANTOR_03->address_line_1 . '-' . $GUARANTOR_03->address_line_2 . '-' . $GUARANTOR_03->address_line_3 . '-' . $GUARANTOR_03->address_line_4 . '-' . $GUARANTOR_03->address_line_5 . '</td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td>City:</td>';
        $html .= '<td>' . $CUSTOMER_CITY->name . '</td>';
        $html .= '<td>' . $GUARANTOR_01_CITY->name . '</td>';
        $html .= '<td>' . $GUARANTOR_02_CITY->name . '</td>';
        $html .= '<td>' . $GUARANTOR_03_CITY->name . '</td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td>Email:</td>';
        $html .= '<td>' . $CUSTOMER->email . '</td>';
        $html .= '<td>' . $GUARANTOR_01->email . '</td>';
        $html .= '<td>' . $GUARANTOR_02->email . '</td>';
        $html .= '<td>' . $GUARANTOR_03->email . '</td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td>Mobile:</td>';
        $html .= '<td>' . $CUSTOMER->mobile . '</td>';
        $html .= '<td>' . $GUARANTOR_01->mobile . '</td>';
        $html .= '<td>' . $GUARANTOR_02->mobile . '</td>';
        $html .= '<td>' . $GUARANTOR_03->mobile . '</td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td>Telephone Num:</td>';
        $html .= '<td>' . $CUSTOMER->telephone . '</td>';
        $html .= '<td>' . $GUARANTOR_01->telephone . '</td>';
        $html .= '<td>' . $GUARANTOR_02->telephone . '</td>';
        $html .= '<td>' . $GUARANTOR_03->telephone . '</td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td>Registration Type:</td>';
        $html .= '<td>' . $CUSTOMER->registration_type . '</td>';
        $html .= '<td>' . $GUARANTOR_01->registration_type . '</td>';
        $html .= '<td>' . $GUARANTOR_02->registration_type . '</td>';
        $html .= '<td>' . $GUARANTOR_03->registration_type . '</td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td>Credit Limit</td>';
        $html .= '<td>' . $CUSTOMER->credit_limit . '</td>';
        $html .= '<td>' . $GUARANTOR_01->credit_limit . '</td>';
        $html .= '<td>' . $GUARANTOR_02->credit_limit . '</td>';
        $html .= '<td>' . $GUARANTOR_03->credit_limit . '</td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td>Bank Name:</td>';
        $html .= '<td>' . $CUSTOMER_BANK->name . '</td>';
        $html .= '<td>' . $GUARANTOR_01_BANK->name . '</td>';
        $html .= '<td>' . $GUARANTOR_02_BANK->name . '</td>';
        $html .= '<td>' . $GUARANTOR_03_BANK->name . '</td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td>Branch Name:</td>';
        $html .= '<td>' . $CUSTOMER_BRANCH->name . '</td>';
        $html .= '<td>' . $GUARANTOR_01_BRANCH->name . '</td>';
        $html .= '<td>' . $GUARANTOR_02_BRANCH->name . '</td>';
        $html .= '<td>' . $GUARANTOR_03_BRANCH->name . '</td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td>Branch Code:</td>';
        $html .= '<td>' . $CUSTOMER->branch_code . '</td>';
        $html .= '<td>' . $GUARANTOR_01->branch_code . '</td>';
        $html .= '<td>' . $GUARANTOR_02->branch_code . '</td>';
        $html .= '<td>' . $GUARANTOR_03->branch_code . '</td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td>Account Number</td>';
        $html .= '<td>' . $CUSTOMER->account_number . '</td>';
        $html .= '<td>' . $GUARANTOR_01->account_number . '</td>';
        $html .= '<td>' . $GUARANTOR_02->account_number . '</td>';
        $html .= '<td>' . $GUARANTOR_03->account_number . '</td>';
        $html .= '<tr>';
        $html .= '<td>Holder Name</td>';
        $html .= '<td>' . $CUSTOMER->holder_name . '</td>';
        $html .= '<td>' . $GUARANTOR_01->holder_name . '</td>';
        $html .= '<td>' . $GUARANTOR_02->holder_name . '</td>';
        $html .= '<td>' . $GUARANTOR_03->holder_name . '</td>';
        $html .= '</tr>';
        $html .= '</table>';
        $html .= '</body>';
        $html .= '</html>';

        return $html;
    }

    public function getOdIntereset($due_amount, $od_interest_limit) {

        $due = explode("-", $due_amount);
        $DUE = (float) $due[1];

        if ($DUE >= (float) $od_interest_limit) {

            $interest_amount_per_month = ($DUE * 10) / 100;

            $interest_amount = ($interest_amount_per_month / 30);

            return $interest_amount;
        }
    }

    public function getOdIntereset1($due_amount, $od_interest_limit) {

        $due = explode("-", $due_amount);
        $DUE = (float) $due[1];

        if ($DUE >= (float) $od_interest_limit) {

            $interest_amount_per_month = ($DUE * 10) / 100;
            $interest_amount = ($interest_amount_per_month / 30);
            return $interest_amount;
        }
    }

    public function getOdInteresetByInstallment($due_amount) {

        $interest_amount_per_month = ($due_amount * 10) / 100;
        $interest_amount = ($interest_amount_per_month / 30);

        return $interest_amount;
    }

    //paid select date in get od,due,all amount
    public function getSelectedDayLoanStatus($selectedDate) {

        date_default_timezone_set("Asia/Calcutta");
        $time = date('H:i:s');
        $today = date('Y-m-d H:i:s');

        $numOfInstallments = DefaultData::getNumOfInstlByPeriodAndType($this->loan_period, $this->installment_type);
        $first_installment_date = '';
        $paid_aditional_interrest = 0;

        $INSTALLMENT = new Installment(NULL);
        $total_paid_installment = 0;

        foreach ($INSTALLMENT->getInstallmentByLoan($this->id) as $installment) {
            $paid_aditional_interrest += $installment["additional_interest"];
            $total_paid_installment = $total_paid_installment + $installment["paid_amount"];
        }

        $loan_amount = $numOfInstallments * $this->installment_amount;
        $actual_due = $loan_amount - $total_paid_installment;

        //daily installment
        if ($this->installment_type == 30) {

            $FID = new DateTime($this->effective_date . " 00:00:01");
            $FID->modify('+1 day');
            $first_installment_date = $FID->format('Y-m-d H:i:s');

            $start = new DateTime($first_installment_date);

            $x = 0;
            $total_installment_amount = 0;
            $ins_total = 0;
            $total_paid = 0;
            $od_amount_all_array = array();
            $last_od = array();
            $od_total = array();
            $last_od_balance = array();
            $od_balance_amount = array();

            while ($x < $numOfInstallments) {
                if ($numOfInstallments == 4) {
                    $modify_range = '+7 day';
                } elseif ($numOfInstallments == 30) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 8) {
                    $modify_range = '+7 day';
                } elseif ($numOfInstallments == 60) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 2) {
                    $modify_range = '+1 months';
                } elseif ($numOfInstallments == 1) {
                    $modify_range = '+1 months';
                } elseif ($numOfInstallments == 90) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 12) {
                    $modify_range = '+7 day';
                } elseif ($numOfInstallments == 3) {
                    $modify_range = '+1 months';
                } elseif ($numOfInstallments == 100) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 13) {
                    $modify_range = '+7 day';
                }

                $date = $start->format('Y-m-d ' . $time);

                $paid_amount = 0;
                $od_amount = 0;
                $od_amount_all = 0;
                $balance = 0;
                $loan_proccesign_fee_paid = 0;
                $total_od_paid = 0;
                $paid_all_amount_before_ins_date = 0;
                $paid_all_od_before_ins_date = 0;
                $last_od_amount = 0;
                $od_interest = 0;

                $customer = $this->customer;
                $CUSTOMER = new Customer($customer);
                $route = $CUSTOMER->route;
                $center = $CUSTOMER->center;
                $installment_amount = $this->installment_amount;

                $FID = new DateTime($date);
                $FID->modify($modify_range);
                $day_remove = '-1 day';
                $FID->modify($day_remove);
                $second_installment_date = $FID->format('Y-m-d ' . $time);
                $amount = $this->installment_amount;

                $INSTALLMENT = new Installment(NULL);
                $ALl_AMOUNT = $INSTALLMENT->getAmountByLoanId($this->id);

                foreach ($INSTALLMENT->CheckInstallmetByPaidDate($date, $this->id) as $paid) {
                    $paid_amount += $paid['paid_amount'];
                }

                foreach ($INSTALLMENT->getPaidAmountByBeforeDate($date, $this->id) as $before_payment_amount) {
                    $paid_all_amount_before_ins_date += $before_payment_amount['paid_amount'];
                    $paid_all_od_before_ins_date += $before_payment_amount['additional_interest'];
                }

                if (PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center) || PostponeDate::CheckIsPostPoneByDateAndAll($date) || PostponeDate::CheckIsPostPoneByDateCenterAll($date) || PostponeDate::CheckIsPostPoneByDateRouteAll($date)) {
                    $start->modify($modify_range);
                } else {

                    $last_od_amount = (float) end($od_amount_all_array);
                    $od_total_amount = (float) end($od_total);

                    $ins_total += $amount;
                    $total_paid += $paid_amount;

//                    $balance = $paid_all_od_before_ins_date + $paid_all_amount_before_ins_date - $ins_total - $od_total_amount;

                    $balance = $paid_all_amount_before_ins_date - $ins_total;

                    $OD = new OD(NULL);
                    $OD->loan = $this->id;
                    $AllOd = $OD->allOdByLoan();
                    $od = $OD->allOdByLoanAndDate($date, $balance);

                    //get daily loan od amount  
                    if (!$AllOd || PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center) || PostponeDate::CheckIsPostPoneByDateAndAll($date) || PostponeDate::CheckIsPostPoneByDateCenterAll($date) || PostponeDate::CheckIsPostPoneByDateRouteAll($date) || $ALl_AMOUNT[0] >= $ins_total) {
                        
                    } else {
                        if ($AllOd) {
                            foreach ($AllOd as $key => $allod) {
                                if (strtotime($allod['od_date_start']) <= strtotime($date) && strtotime($date) <= strtotime($allod['od_date_end']) && (-1 * ($allod['od_interest_limit'])) > $balance) {

                                    $ODDATES = new DateTime($date);
                                    $ODDATES->modify(' +23 hours +59 minutes +58 seconds');

                                    $od_date_morning = $ODDATES->format('Y-m-d H:i:s');

                                    $paid_all_amount_before_ins_date1 = 0;
                                    $before_payment_amounts1 = $INSTALLMENT->getPaidAmountByBeforeDate($od_date_morning, $this->id);

                                    foreach ($before_payment_amounts1 as $before_payment_amount1) {
                                        $paid_all_amount_before_ins_date1 += $before_payment_amount1['paid_amount'];
                                    }

                                    $od_interest = $this->getOdIntereset1(-$ins_total + $paid_all_amount_before_ins_date1, $allod['od_interest_limit']);

                                    $od_array[] = $od_interest;
                                    $od_amount_all = json_encode(round(array_sum($od_array), 2));

                                    if (strtotime($date) >= strtotime($selectedDate)) {
                                        break;
                                    }
                                    array_push($od_amount_all_array, $od_interest);
                                    array_push($od_total, $od_amount_all);
                                }
                            }
                        }
                    }
                    $total_installment_amount += $installment_amount;

                    if (strtotime($selectedDate) <= strtotime($date)) {
                        break;
                    }

                    $start->modify($modify_range);
                    $x++;

                    //end of the installment 
                    if ($numOfInstallments == $x) {

                        $ODDATES = new DateTime($date);
                        $ODDATES->modify('+23 hours +59 minutes +58 seconds');
                        $od_date_morning = $ODDATES->format('Y-m-d H:i:s');

                        //check log ends with od or installment
                        $last_od_date = date('D/M/Y', strtotime($od_date_morning));
                        $last_installment_date = date('D/M/Y', strtotime($date));

                        if ($last_od_date == $last_installment_date) {
                            $last_loop_od = $od_interest;
                        } else {
                            $last_loop_od = 0;
                        }

                        //get installment end date
                        $INSTALLMENT_END = new DateTime($date);
                        $INSTALLMENT_END->modify('+1 day');
                        $installment_end = $INSTALLMENT_END->format('Y-m-d H:i:s');

                        //get 5 years ahead date from installment end date
                        $INSTALLMENT_UNLIMITED_END = new DateTime($date);
                        $INSTALLMENT_UNLIMITED_END->modify('+1725 day');
                        $installment_unlimited_end = $INSTALLMENT_UNLIMITED_END->format('Y-m-d H:i:s');

                        $start = strtotime($date);
                        $end = strtotime(date("Y/m/d"));
                        $days_between = floor(abs($end - $start) / 86400) - 1;
                        $od = $OD->allOdByLoanAndDate($date, $balance);
                        $y = 0;

                        $od_date_start1 = new DateTime($date);
                        $od_date_start1->modify('+47 hours +59 minutes +58 seconds');

                        $defult_val = $days_between;

                        while ($y <= $defult_val) {

                            if ($od['od_date_start'] <= $od_date_start1) {
                                $od_dates = '+1 day';
                            }

                            $od_date = $od_date_start1->format('Y-m-d H:i:s');
                            //getting echo $od_date; before of date from current od date
                            $OLDODDATE = new DateTime($od_date);
                            $od_date_remove1 = '-23 hours -59 minutes -58 seconds';

                            $OLDODDATE->modify($od_date_remove1);
                            $old_od_date = $OLDODDATE->format('Y-m-d H:i:s');

                            if (strtotime($selectedDate) < strtotime($old_od_date) || strtotime($od['od_date_end'] . $time) < strtotime($old_od_date)) {
                                break;
                            }

                            $od_array[] = $od_interest;
                            $od_amount_all = json_encode(round(array_sum($od_array), 2));

                            array_push($od_amount_all_array, $od_interest);
                            array_push($od_total, $od_amount_all);

                            $od_total_amount = (float) end($od_total);

                            $od_date_start1->modify($od_dates);
                            $y++;
                        }
                    }
                }
            }
            //weekly installment
        } else if ($this->installment_type == 4) {

            $FID = new DateTime($this->effective_date . " 00:00:01");
            $FID->modify('+7 day');
            $first_installment_date = $FID->format('Y-m-d H:i:s');


            $start = new DateTime($first_installment_date);
            $first_date = $start->format('Y-m-d ' . $time);

            $x = 0;
            $total_installment_amount = 0;
            $ins_total = 0;
            $total_paid = 0;
            $od_amount_all_array = array();
            $od_array = array();
            $last_od = array();
            $od_total = array();
            $last_od_balance = array();
            $od_balance_amount = array();

            while ($x < $numOfInstallments) {
                if ($numOfInstallments == 4) {
                    $modify_range = '+7 day';
                } elseif ($numOfInstallments == 30) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 8) {
                    $modify_range = '+7 day';
                } elseif ($numOfInstallments == 60) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 2) {
                    $modify_range = '+1 months';
                } elseif ($numOfInstallments == 1) {
                    $modify_range = '+1 months';
                } elseif ($numOfInstallments == 90) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 12) {
                    $modify_range = '+7 day';
                } elseif ($numOfInstallments == 3) {
                    $modify_range = '+1 months';
                } elseif ($numOfInstallments == 100) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 13) {
                    $modify_range = '+7 day';
                }

                $date = $start->format('Y-m-d ' . " 00:00:01");

                $paid_amount = 0;
                $od_amount = 0;
                $od_amount_all = 0;
                $balance = 0;
                $loan_proccesign_fee_paid = 0;
                $total_od_paid = 0;
                $paid_all_amount_before_ins_date = 0;
                $paid_all_od_before_ins_date = 0;
                $last_od_amount = 0;


                $customer = $this->customer;
                $CUSTOMER = new Customer($customer);
                $route = $CUSTOMER->route;
                $center = $CUSTOMER->center;
                $installment_amount = $this->installment_amount;

                $FIDS = new DateTime($date);
                $FIDS->modify($modify_range);
                $day_remove = '-2 seconds';

                $FIDS->modify($day_remove);
                $second_installment_date = $FIDS->format('Y-m-d H:i:s');


                $amount = $this->installment_amount;
                $od_night = date("Y/m/d");

                $INSTALLMENT = new Installment(NULL);
                $ALl_AMOUNT = $INSTALLMENT->getAmountByLoanId($this->id);

                foreach ($INSTALLMENT->CheckInstallmetByPaidDate($date, $this->id) as $paid) {
                    $paid_amount += $paid['paid_amount'];
                }

                $before_payment_amounts = $INSTALLMENT->getPaidAmountByBeforeDate($date, $this->id);

                foreach ($before_payment_amounts as $before_payment_amount) {
                    $paid_all_amount_before_ins_date += $before_payment_amount['paid_amount'];
                    $paid_all_od_before_ins_date += $before_payment_amount['additional_interest'];
                }

                if (PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center) || PostponeDate::CheckIsPostPoneByDateAndAll($date) || PostponeDate::CheckIsPostPoneByDateCenterAll($date) || PostponeDate::CheckIsPostPoneByDateRouteAll($date)) {
                    $start->modify($modify_range);
                } else {

                    $last_od_amount = (float) end($od_amount_all_array);
                    $od_total_amount = (float) end($od_total);

                    $ins_total += $amount;
                    $total_paid += $paid_amount;

                    // $balance = $paid_all_od_before_ins_date + $paid_all_amount_before_ins_date - $ins_total - $od_total_amount;

                    $balance = $paid_all_amount_before_ins_date - $ins_total;

                    $OD = new OD(NULL);
                    $OD->loan = $this->id;
                    $od = $OD->allOdByLoanAndDate($date, $balance);

                    if (strtotime(date("Y/m/d")) < strtotime($date) || PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center) || PostponeDate::CheckIsPostPoneByDateAndAll($date) || PostponeDate::CheckIsPostPoneByDateCenterAll($date) || PostponeDate::CheckIsPostPoneByDateRouteAll($date) || $ALl_AMOUNT[0] >= $ins_total) {
                        
                    } else {
                        if ($od !== false) {

                            // Declare and define two dates 
                            $ins_date1 = strtotime($date);
                            $ins_date2 = strtotime($second_installment_date);

                            // Formulate the Difference between two dates 
                            $diff = abs($ins_date2 - $ins_date1);

                            $daysbetween = floor(($diff - (floor($diff / (365 * 60 * 60 * 24))) * 365 * 60 * 60 * 24 -
                                    (floor(($diff - (floor($diff / (365 * 60 * 60 * 24))) * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24))) * 30 * 60 * 60 * 24) / (60 * 60 * 24));

                            $od_interest = $this->getOdIntereset(-$ins_total + $paid_all_amount_before_ins_date, $od['od_interest_limit']);

                            $y = 0;
                            $od_date_start = new DateTime($date);
                            $od_date_start->modify('+23 hours +59 minutes +58 seconds');
                            $defult_val = $daysbetween;

                            while ($y <= $defult_val) {

                                if ($defult_val <= $daysbetween && $od['od_date_start'] <= $od_date_start) {
                                    $od_dates = '+1 day';
                                }

                                $od_date = $od_date_start->format('Y-m-d H:i:s');

                                //// od dates range
                                $ODDATES = new DateTime($od_date);
                                $ODDATES->modify($od_dates);

                                $od_date_remove = '-1 day -23 hours -59 minutes -58 seconds';

                                $ODDATES->modify($od_date_remove);
                                $od_night = $ODDATES->format('Y-m-d H:i:s');

                                if (strtotime($od_date) >= strtotime($selectedDate)) {
                                    break;
                                }

                                $od_array[] = $od_interest;
                                $od_amount_all = json_encode(round(array_sum($od_array)));

                                array_push($od_amount_all_array, $od_amount_all);
                                array_push($od_total, $od_amount_all);

                                $od_date_start->modify($od_dates);
                                $y++;
                            }
                        }
                    }
                }

                if ($selectedDate . " " . $time == $date) {

                    if (strtotime(date("Y/m/d")) < strtotime($date) || strtotime($selectedDate) < strtotime($date)) {
                        break;
                    }
                    $total_installment_amount += $installment_amount;
                } else {
                    if (strtotime(date("Y/m/d")) < strtotime($date) || strtotime($selectedDate) < strtotime($date)) {
                        break;
                    }
                    $total_installment_amount += $installment_amount;
                }

                $start->modify($modify_range);
                $x++;

                if ($numOfInstallments == $x) {

                    //get installment end date
                    $INSTALLMENT_END = new DateTime($date);
                    $INSTALLMENT_END->modify('+7 day');
                    $installment_end = $INSTALLMENT_END->format('Y-m-d H:i:s');

                    //get 5 years ahead date from installment end date
                    $INSTALLMENT_UNLIMITED_END = new DateTime($date);
                    $INSTALLMENT_UNLIMITED_END->modify('+1725 day');
                    $installment_unlimited_end = $INSTALLMENT_UNLIMITED_END->format('Y-m-d H:i:s');


                    $start = strtotime($date);
                    $end = strtotime(date("Y/m/d"));

                    $days_between = floor(abs($end - $start) / 86400) - 1;

                    $z = 0;

                    $od_date_start1 = new DateTime($od_night);
                    $od_date_start1->modify('+1 day +23 hours +59 minutes +58 seconds');
                    $defult_val = $days_between;


                    //if having od after installment end
                    if ($od !== false) {

                        $last_od_date = date('D/M/Y', strtotime($od_night));
                        $last_installment_date = date('D/M/Y', strtotime($date));

                        if ($last_od_date == $last_installment_date) {
                            $last_loop_od = $od_interest;
                        } else {
                            $last_loop_od = 0;
                        }

                        while ($z <= $defult_val) {

                            if ($od['od_date_start'] <= $od_date_start1) {
                                $od_dates = '+1 day';
                            }

                            $od_date1 = $od_date_start1->format('Y-m-d H:i:s');

                            //getting brfore of date from current od date
                            $OLDODDATE = new DateTime($od_date1);
                            $od_date_remove1 = '-23 hours -59 minutes -58 seconds';

                            $OLDODDATE->modify($od_date_remove1);
                            $old_od_date = $OLDODDATE->format('Y-m-d H:i:s');

                            if (strtotime($selectedDate) <= strtotime($od_date1)) {
                                break;
                            }

                            $od_array[] = $od_interest;
                            $od_amount_all = json_encode(round(array_sum($od_array)));

                            array_push($od_amount_all_array, $od_interest);
                            array_push($od_total, $od_amount_all);

                            $od_total_amount = (float) end($od_total);
                            $od_date_start1->modify($od_dates);
                            $z++;
                        }
                    }
                }
            }
        } else if ($this->installment_type == 1) {

            $FID = new DateTime($this->effective_date . " 00:00:01");
            $FID->modify('+1 months');
            $first_installment_date = $FID->format('Y-m-d H:i:s');

            $start = new DateTime($first_installment_date);
            $first_date = $start->format('Y-m-d H:i:s');

            $x = 0;
            $no_of_installments = 0;
            $total_installment_amount = 0;
            $ins_total = 0;
            $total_paid = 0;
            $od_amount_all_array = array();
            $od_array = array();
            $last_od = array();
            $od_total = array();
            $last_od_balance = array();
            $od_balance_amount = array();

            while ($x < $numOfInstallments) {
                if ($numOfInstallments == 4) {
                    $modify_range = '+7 day';
                } elseif ($numOfInstallments == 30) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 8) {
                    $modify_range = '+7 day';
                } elseif ($numOfInstallments == 60) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 2) {
                    $modify_range = '+1 months';
                } elseif ($numOfInstallments == 1) {
                    $modify_range = '+1 months';
                } elseif ($numOfInstallments == 90) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 12) {
                    $modify_range = '+7 day';
                } elseif ($numOfInstallments == 3) {
                    $modify_range = '+1 months';
                } elseif ($numOfInstallments == 100) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 13) {
                    $modify_range = '+7 day';
                }

                $date = $start->format('Y-m-d H:i:s');

                $paid_amount = 0;
                $last_od_amount = 0;
                $od_amount = 0;
                $od_amount_all = 0;
                $balance = 0;
                $loan_proccesign_fee_paid = 0;
                $total_od_paid = 0;
                $paid_all_amount_before_ins_date = 0;
                $paid_all_od_before_ins_date = 0;

                $customer = $this->customer;
                $CUSTOMER = new Customer($customer);
                $route = $CUSTOMER->route;
                $center = $CUSTOMER->center;
                $installment_amount = $this->installment_amount;
                $amount = $this->installment_amount;

                $FIDS = new DateTime($date);
                $FIDS->modify($modify_range);
                $day_remove = '-2 seconds';

                $FIDS->modify($day_remove);
                $second_installment_date = $FIDS->format('Y-m-d H:i:s');

                $ALl_AMOUNT = $INSTALLMENT->getAmountByLoanId($this->id);

                $od_night = date("Y/m/d");

                $INSTALLMENT = new Installment(NULL);
                $ALl_AMOUNT = $INSTALLMENT->getAmountByLoanId($this->id);

                foreach ($INSTALLMENT->CheckInstallmetByPaidDate($date, $this->id) as $paid) {
                    $paid_amount += $paid['paid_amount'];
                }

                $before_payment_amounts = $INSTALLMENT->getPaidAmountByBeforeDate($date, $this->id);

                foreach ($before_payment_amounts as $before_payment_amount) {
                    $paid_all_amount_before_ins_date += $before_payment_amount['paid_amount'];
                    $paid_all_od_before_ins_date += $before_payment_amount['additional_interest'];
                }

                if (PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center) || PostponeDate::CheckIsPostPoneByDateAndAll($date) || PostponeDate::CheckIsPostPoneByDateCenterAll($date) || PostponeDate::CheckIsPostPoneByDateRouteAll($date)) {
                    $start->modify($modify_range);
                } else {

                    $last_od_amount = (float) end($od_amount_all_array);
                    $od_total_amount = (float) end($od_total);

                    $ins_total += $amount;
                    $total_paid += $paid_amount;

//                    $balance = $paid_all_od_before_ins_date + $paid_all_amount_before_ins_date - $ins_total - $od_total_amount;

                    $balance = $paid_all_amount_before_ins_date - $ins_total;

                    $OD = new OD(NULL);
                    $OD->loan = $this->id;
                    $od = $OD->allOdByLoanAndDate($date, $balance);

                    if (strtotime(date("Y/m/d")) < strtotime($date) || PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center) || PostponeDate::CheckIsPostPoneByDateAndAll($date) || PostponeDate::CheckIsPostPoneByDateCenterAll($date) || PostponeDate::CheckIsPostPoneByDateRouteAll($date) || $ALl_AMOUNT[0] >= $ins_total) {
                        
                    } else {
                        if ($od !== false) {
                            $od_interest = $this->getOdIntereset(-$ins_total + $paid_all_amount_before_ins_date, $od['od_interest_limit']);

                            $y = 0;
                            //get month and year from inst date
                            $dateValue = strtotime($date);

                            $year = date("Y", $dateValue);
                            $month = date("m", $dateValue);

                            $daysOfMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

                            $od_date_start = new DateTime($date);

                            $od_date_start->modify('+23 hours +59 minutes +58 seconds');

                            $defult_val = $daysOfMonth - 1;

                            while ($y <= $defult_val) {

                                if ($defult_val <= $daysOfMonth - 1 && $this->od_date <= $od_date_start) {
                                    $od_dates = '+1 day';
                                }
                                $od_date = $od_date_start->format('Y-m-d H:i:s');

                                if ((strtotime($od_date) >= strtotime($selectedDate))) {
                                    break;
                                }

                                $ODDATES = new DateTime($od_date);
                                $ODDATES->modify($od_dates);
                                $od_date_remove = '-1 day -23 hours -59 minutes -58 seconds';
                                $ODDATES->modify($od_date_remove);
                                $od_night = $ODDATES->format('Y-m-d H:i:s');

                                $od_array[] = $od_interest;
                                $od_amount_all = json_encode(round(array_sum($od_array)));


                                array_push($od_total, $od_amount_all);
                                array_push($od_amount_all_array, $od_interest);

                                $od_date_start->modify($od_dates);
                                $y++;
                            }
                        }
                    }
                }

                if ($selectedDate . " " . $time == $date) {
                    $total_installment_amount += $installment_amount;
                    if (strtotime(date("Y/m/d")) < strtotime($date) || strtotime($selectedDate) < strtotime($date)) {
                        break;
                    }
                } else {
                    if (strtotime(date("Y/m/d")) < strtotime($date) || strtotime($selectedDate) < strtotime($date)) {
                        break;
                    }
                    $total_installment_amount += $installment_amount;
                }

                $start->modify($modify_range);
                $x++;

                if ($numOfInstallments == $x) {

                    //get installment end date
                    $INSTALLMENT_END = new DateTime($date);
                    $INSTALLMENT_END->modify('+' . $daysOfMonth . ' day');
                    $installment_end = $INSTALLMENT_END->format('Y-m-d H:i:s');

                    //get 5 years ahead date from installment end date
                    $INSTALLMENT_UNLIMITED_END = new DateTime($date);
                    $INSTALLMENT_UNLIMITED_END->modify('+1725 day');
                    $installment_unlimited_end = $INSTALLMENT_UNLIMITED_END->format('Y-m-d H:i:s');

                    $start = strtotime($date);
                    $end = strtotime(date("Y/m/d"));

                    $days_between = floor(abs($end - $start) / 86400) - 1;

                    $z = 0;

                    $od_date_start1 = new DateTime($od_night);
                    $od_date_start1->modify('+1 day +23 hours +59 minutes +58 seconds');

                    $defult_val = $days_between;

                    //if having od after installment end
                    if ($od !== false) {

                        $last_od_date = date('D/M/Y', strtotime($od_night));
                        $last_installment_date = date('D/M/Y', strtotime($date));

                        while ($z <= $defult_val) {

                            if ($od['od_date_start'] <= $od_date_start1) {
                                $od_dates = '+1 day';
                            }

                            $od_date1 = $od_date_start1->format('Y-m-d');

                            if ((strtotime($od_date1) >= strtotime($selectedDate))) {
                                break;
                            }
                            //getting brfore of date from current od date
                            $OLDODDATE = new DateTime($od_date1);

                            $od_date_remove1 = '-23 hours -59 minutes -58 seconds';

                            $OLDODDATE->modify($od_date_remove1);
                            $old_od_date = $OLDODDATE->format('Y-m-d H:i:s');

                            $od_array[] = $od_interest;
                            $od_amount_all = json_encode(round(array_sum($od_array)));

                            array_push($od_amount_all_array, $od_interest);
                            array_push($od_total, $od_amount_all);

                            $od_date_start1->modify($od_dates);
                            $z++;
                        }
                    }
                }
            }
        }

        $INSTALLMENT = new Installment(NULL);
        $total_paid_installment = 0;
        $paid_aditional_interrest = 0;

        foreach ($INSTALLMENT->getInstallmentByLoan($this->id) as $installment) {
            $paid_aditional_interrest += $installment["additional_interest"];
            $total_paid_installment = $total_paid_installment + $installment["paid_amount"];
        }


        $last_od_amount_balance = $od_total_amount - $paid_aditional_interrest;

        $all_arress = ($total_paid_installment) - ($total_installment_amount) - $od_total_amount;
        $system_due = $loan_amount - $total_installment_amount;
        $system_due_num_of_ins = $system_due / $this->installment_amount;
        $actual_due_num_of_ins = $actual_due / $this->installment_amount;



        return [
            'od_amount' => $od_total_amount,
            'all_arress' => $all_arress,
            'all_amount' => $balance,
            'system-due-num-of-ins' => $system_due_num_of_ins,
            'system-due' => $system_due,
            'actual-due-num-of-ins' => $actual_due_num_of_ins,
            'actual-due' => ($total_paid_installment) - ($total_installment_amount),
            'receipt-num-of-ins' => $total_paid_installment / $this->installment_amount,
            'receipt' => $total_paid_installment + $paid_aditional_interrest,
            'arrears-excess-num-of-ins' => ($total_installment_amount - $total_paid_installment) / $this->installment_amount,
            'arrears-excess' => $total_installment_amount - $total_paid_installment,
            'installment_amount' => $amount,
        ];
    }

    ///slected day view daily,weelky,monthly  ins 
    public function getSelectedDayLoanDetails($selectedDate) {


        date_default_timezone_set("Asia/Calcutta");
        $time = date('H:i:s');
        $today = date('Y-m-d H:i:s');

        $numOfInstallments = DefaultData::getNumOfInstlByPeriodAndType($this->loan_period, $this->installment_type);
        $first_installment_date = '';
        $paid_aditional_interrest = 0;
        $INSTALLMENT = new Installment(NULL);
        $total_paid_installment = 0;

        foreach ($INSTALLMENT->getInstallmentByLoan($this->id) as $installment) {
            $paid_aditional_interrest += $installment["additional_interest"];
            $total_paid_installment = $total_paid_installment + $installment["paid_amount"];
        }

        $loan_amount = $numOfInstallments * $this->installment_amount;
        $actual_due = $loan_amount - $total_paid_installment;

        //daily installment
        if ($this->installment_type == 30) {

            $FID = new DateTime($this->effective_date);
            $FID->modify('+1 day');
            $first_installment_date = $FID->format('Y-m-d ' . $time);


            $start = new DateTime($first_installment_date);
            $first_date = $start->format('Y-m-d ' . $time);

            $x = 0;
            $total_installment_amount = 0;
            $ins_total = 0;
            $total_paid = 0;
            $od_amount_all_array = array();

            $od_array = array();
            $last_od = array();
            $od_total = array();
            $last_od_balance = array();
            $od_balance_amount = array();

            while ($x < $numOfInstallments) {
                if ($numOfInstallments == 4) {
                    $modify_range = '+7 day';
                } elseif ($numOfInstallments == 30) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 8) {
                    $modify_range = '+7 day';
                } elseif ($numOfInstallments == 60) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 2) {
                    $modify_range = '+1 months';
                } elseif ($numOfInstallments == 1) {
                    $modify_range = '+1 months';
                } elseif ($numOfInstallments == 90) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 12) {
                    $modify_range = '+7 day';
                } elseif ($numOfInstallments == 3) {
                    $modify_range = '+1 months';
                } elseif ($numOfInstallments == 100) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 13) {
                    $modify_range = '+7 day';
                }

                $date = $start->format('Y-m-d ' . $time);

                $paid_amount = 0;
                $od_amount = 0;
                $od_amount_all = 0;
                $balance = 0;
                $loan_proccesign_fee_paid = 0;
                $total_od_paid = 0;
                $paid_all_amount_before_ins_date = 0;
                $paid_all_od_before_ins_date = 0;
                $last_od_amount = 0;
                $od_interest = 0;

                $customer = $this->customer;
                $CUSTOMER = new Customer($customer);
                $route = $CUSTOMER->route;
                $center = $CUSTOMER->center;
                $installment_amount = $this->installment_amount;

                $FID = new DateTime($date);
                $FID->modify($modify_range);
                $day_remove = '-1 day';
                $FID->modify($day_remove);
                $second_installment_date = $FID->format('Y-m-d ' . $time);
                $amount = $this->installment_amount;

                $INSTALLMENT = new Installment(NULL);
                $ALl_AMOUNT = $INSTALLMENT->getAmountByLoanId($this->id);

                foreach ($INSTALLMENT->CheckInstallmetByPaidDate($date, $this->id) as $paid) {
                    $paid_amount += $paid['paid_amount'];
                }

                foreach ($INSTALLMENT->getPaidAmountByBeforeDate($date, $this->id) as $before_payment_amount) {
                    $paid_all_amount_before_ins_date += $before_payment_amount['paid_amount'];
                    $paid_all_od_before_ins_date += $before_payment_amount['additional_interest'];
                }

                if (PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center) || PostponeDate::CheckIsPostPoneByDateAndAll($date) || PostponeDate::CheckIsPostPoneByDateCenterAll($date) || PostponeDate::CheckIsPostPoneByDateRouteAll($date)) {
                    $start->modify($modify_range);
                } else {


                    $ins_total += $amount;
                    $total_paid += $paid_amount;
                    $last_od_amount = (float) end($od_amount_all_array);

                    $balance = $actual_due;

                    $OD = new OD(NULL);
                    $OD->loan = $this->id;
                    $AllOd = $OD->allOdByLoan();


                    //get daily loan od amount  
                    if (!$AllOd || PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center) || PostponeDate::CheckIsPostPoneByDateAndAll($date) || PostponeDate::CheckIsPostPoneByDateCenterAll($date) || PostponeDate::CheckIsPostPoneByDateRouteAll($date) || $ALl_AMOUNT[0] >= $ins_total) {
                        
                    } else {
                        if ($AllOd) {
                            foreach ($AllOd as $key => $allod) {

                                if (strtotime($allod['od_date_start']) <= strtotime($date) && strtotime($date) <= strtotime($allod['od_date_end']) && (-1 * ($allod['od_interest_limit'])) > $balance) {

                                    if (strtotime($date) >= strtotime($selectedDate)) {
                                        break;
                                    }

                                    $ODDATES = new DateTime($date);
                                    $ODDATES->modify(' +23 hours +59 minutes +58 seconds');

                                    $od_date_morning = $ODDATES->format('Y-m-d H:i:s');

                                    $paid_all_amount_before_ins_date1 = 0;
                                    $before_payment_amounts1 = $INSTALLMENT->getPaidAmountByBeforeDate($od_date_morning, $this->id);

                                    foreach ($before_payment_amounts1 as $before_payment_amount1) {
                                        $paid_all_amount_before_ins_date1 += $before_payment_amount1['paid_amount'];
                                    }

                                    $od_interest = $this->getOdIntereset1(-$ins_total + $paid_all_amount_before_ins_date1, $allod['od_interest_limit']);

                                    $od_array[] = $od_interest;
                                    $od_amount_all = json_encode(round(array_sum($od_array), 2));

                                    if ($od_amount_all > 0 || $paid_all_od_before_ins_date == $last_od_amount) {

                                        array_push($od_amount_all_array, $od_amount_all);
                                    }
                                }
                            }
                        }
                    }

                    $total_installment_amount += $installment_amount;

                    if (strtotime($selectedDate) <= strtotime($date)) {
                        break;
                    }

                    $start->modify($modify_range);
                    $x++;

                    //end of the installment
                    if ($numOfInstallments == $x) {

                        $ODDATES = new DateTime($date);
                        $ODDATES->modify('+23 hours +59 minutes +58 seconds');
                        $od_date_morning = $ODDATES->format('Y-m-d H:i:s');

                        //check log ends with od or installment
                        $last_od_date = date('D/M/Y', strtotime($od_date_morning));
                        $last_installment_date = date('D/M/Y', strtotime($date));

                        if ($last_od_date == $last_installment_date) {
                            $last_loop_od = $od_interest;
                        } else {
                            $last_loop_od = 0;
                        }

                        //get installment end date
                        $INSTALLMENT_END = new DateTime($date);
                        $INSTALLMENT_END->modify('+1 day');
                        $installment_end = $INSTALLMENT_END->format('Y-m-d H:i:s');

                        //get 5 years ahead date from installment end date
                        $INSTALLMENT_UNLIMITED_END = new DateTime($date);
                        $INSTALLMENT_UNLIMITED_END->modify('+1725 day');
                        $installment_unlimited_end = $INSTALLMENT_UNLIMITED_END->format('Y-m-d H:i:s');


                        $start = strtotime($date);
                        $end = strtotime(date("Y/m/d"));
                        $days_between = floor(abs($end - $start) / 86400) - 1;
                        $od = $OD->allOdByLoanAndDate($date, $balance);
                        $y = 0;

                        $od_date_start1 = new DateTime($date);
                        $od_date_start1->modify('+47 hours +59 minutes +58 seconds');

                        $defult_val = $days_between;
                        $od_amount_all_array_1 = array();

                        while ($y <= $defult_val) {

                            if ($od['od_date_start'] <= $od_date_start1) {
                                $od_dates = '+1 day';
                            }

                            $od_date = $od_date_start1->format('Y-m-d H:i:s');

                            //getting echo $od_date; before of date from current od date
                            $OLDODDATE = new DateTime($od_date);
                            $od_date_remove1 = '-23 hours -59 minutes -58 seconds';

                            $OLDODDATE->modify($od_date_remove1);
                            $old_od_date = $OLDODDATE->format('Y-m-d H:i:s');

                            if (strtotime($selectedDate) < strtotime($old_od_date) || strtotime($selectedDate) < strtotime($od_date) || strtotime($od['od_date_end'] . $time) < strtotime($old_od_date)) {
                                break;
                            }

                            $od_array[] = $od_interest;
                            $od_amount_all = json_encode(round(array_sum($od_array), 2));

                            if ($od_amount_all > 0 || $paid_all_od_before_ins_date == $last_od_amount) {

                                array_push($od_amount_all_array_1, $od_amount_all);
                            }

                            $od_date_start1->modify($od_dates);

                            $y++;
                        }

                        $last_od_amount = (float) end($od_amount_all_array_1);
                    }
                }
            }
            //weekly installment
        } else if ($this->installment_type == 4) {

            $FID = new DateTime($this->effective_date);
            $FID->modify('+7 day');
            $first_installment_date = $FID->format('Y-m-d ' . $time);


            $start = new DateTime($first_installment_date);
            $first_date = $start->format('Y-m-d ' . $time);

            $x = 0;
            $total_installment_amount = 0;
            $ins_total = 0;
            $total_paid = 0;
            $od_amount_all_array = array();
            $od_array = array();
            $last_od = array();
            $od_total = array();
            $last_od_balance = array();
            $od_balance_amount = array();

            while ($x < $numOfInstallments) {
                if ($numOfInstallments == 4) {
                    $modify_range = '+7 day';
                } elseif ($numOfInstallments == 30) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 8) {
                    $modify_range = '+7 day';
                } elseif ($numOfInstallments == 60) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 2) {
                    $modify_range = '+1 months';
                } elseif ($numOfInstallments == 1) {
                    $modify_range = '+1 months';
                } elseif ($numOfInstallments == 90) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 12) {
                    $modify_range = '+7 day';
                } elseif ($numOfInstallments == 3) {
                    $modify_range = '+1 months';
                } elseif ($numOfInstallments == 100) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 13) {
                    $modify_range = '+7 day';
                }

                $date = $start->format('Y-m-d ' . $time);

                $paid_amount = 0;
                $od_amount = 0;
                $od_amount_all = 0;
                $balance = 0;
                $loan_proccesign_fee_paid = 0;
                $total_od_paid = 0;
                $paid_all_amount_before_ins_date = 0;
                $paid_all_od_before_ins_date = 0;


                $customer = $this->customer;
                $CUSTOMER = new Customer($customer);
                $route = $CUSTOMER->route;
                $center = $CUSTOMER->center;
                $installment_amount = $this->installment_amount;

                $FID = new DateTime($date);
                $FID->modify($modify_range);
                $day_remove = '-1 day';
                $FID->modify($day_remove);
                $second_installment_date = $FID->format('Y-m-d ' . $time);
                $amount = $this->installment_amount;
                $od_night = date("Y/m/d");

                $INSTALLMENT = new Installment(NULL);
                $ALl_AMOUNT = $INSTALLMENT->getAmountByLoanId($this->id);

                foreach ($INSTALLMENT->CheckInstallmetByPaidDate($date, $this->id) as $paid) {
                    $paid_amount += $paid['paid_amount'];
                }

                if (PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center) || PostponeDate::CheckIsPostPoneByDateAndAll($date) || PostponeDate::CheckIsPostPoneByDateCenterAll($date) || PostponeDate::CheckIsPostPoneByDateRouteAll($date)) {
                    $start->modify($modify_range);
                } else {

                    $last_od_amount = (float) end($od_amount_all_array);
                    $ins_total += $amount;
                    $total_paid += $paid_amount;

                    $balance = $total_paid_installment - $ins_total;


                    $OD = new OD(NULL);
                    $OD->loan = $this->id;
                    $od = $OD->allOdByLoanAndDate($date, $balance);

                    if (strtotime(date("Y/m/d")) < strtotime($date) || PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center) || PostponeDate::CheckIsPostPoneByDateAndAll($date) || PostponeDate::CheckIsPostPoneByDateCenterAll($date) || PostponeDate::CheckIsPostPoneByDateRouteAll($date) || $ALl_AMOUNT[0] >= $ins_total) {
                        
                    } else {
                        if ($od !== false) {

                            $od_interest = $this->getOdIntereset(-$ins_total + $paid_all_amount_before_ins_date, $od['od_interest_limit']);

                            $y = 0;
                            $od_date_start = new DateTime($date);
                            $defult_val = 6;

                            while ($y <= $defult_val) {

                                if ($defult_val <= 6 && $this->od_date <= $od_date_start) {
                                    $od_dates = '+1 day';
                                }

                                $od_date = $od_date_start->format('Y-m-d H:i:s');

                                //// od dates range
                                $ODDATES = new DateTime($od_date);
                                $ODDATES->modify($od_dates);

                                $od_date_remove = '-1 day -23 hours -59 minutes -58 seconds';

                                $ODDATES->modify($od_date_remove);
                                $od_night = $ODDATES->format('Y-m-d H:i:s');

                                $od_array[] = $od_interest;
                                $od_amount_all = json_encode(round(array_sum($od_array)));


                                if (strtotime($od_date) >= strtotime($selectedDate)) {
                                    break;
                                }
                                array_push($od_amount_all_array, $od_interest);


                                $od_date_start->modify($od_dates);
                                $y++;
                            }
                            $last_od_amount = (float) end($od_amount_all_array);
                        }
                    }
                }

                if ($selectedDate . " " . $time == $date) {
                    $total_installment_amount += $installment_amount;
                    if (strtotime(date("Y/m/d")) < strtotime($date) || strtotime($selectedDate) < strtotime($date)) {
                        break;
                    }
                } else {
                    if (strtotime(date("Y/m/d")) < strtotime($date) || strtotime($selectedDate) < strtotime($date)) {
                        break;
                    }
                    $total_installment_amount += $installment_amount;
                }


                $start->modify($modify_range);
                $x++;

                if ($numOfInstallments == $x) {
                    //get installment end date
                    $INSTALLMENT_END = new DateTime($date);
                    $INSTALLMENT_END->modify('+7 day');
                    $installment_end = $INSTALLMENT_END->format('Y-m-d H:i:s');

                    //get 5 years ahead date from installment end date
                    $INSTALLMENT_UNLIMITED_END = new DateTime($date);
                    $INSTALLMENT_UNLIMITED_END->modify('+1725 day');
                    $installment_unlimited_end = $INSTALLMENT_UNLIMITED_END->format('Y-m-d H:i:s');


                    $start = strtotime($date);
                    $end = strtotime(date("Y/m/d"));

                    $days_between = floor(abs($end - $start) / 86400) - 1;

                    $z = 0;

                    $od_date_start1 = new DateTime($od_night);
                    $od_date_start1->modify('+1 day +23 hours +59 minutes +58 seconds');
                    $defult_val = $days_between;

                    //if having od after installment end
                    if ($od !== false) {

                        $last_od_date = date('D/M/Y', strtotime($od_night));
                        $last_installment_date = date('D/M/Y', strtotime($date));

                        if ($last_od_date == $last_installment_date) {
                            $last_loop_od = $od_interest;
                        } else {
                            $last_loop_od = 0;
                        }

//                        $od_amount_all_array_1 = array();

                        while ($z <= $defult_val) {

                            if ($od['od_date_start'] <= $od_date_start1) {
                                $od_dates = '+1 day';
                            }


                            $od_date1 = $od_date_start1->format('Y-m-d H:i:s');

                            //getting brfore of date from current od date
                            $OLDODDATE = new DateTime($od_date1);
                            $od_date_remove1 = '-23 hours -59 minutes -58 seconds';

                            $OLDODDATE->modify($od_date_remove1);
                            $old_od_date = $OLDODDATE->format('Y-m-d H:i:s');

                            if (strtotime($selectedDate) <= strtotime($od_date1)) {
                                break;
                            }


                            $od_array[] = $od_interest;
                            $od_amount_all = json_encode(round(array_sum($od_array)));

//                            if ($od_amount_all > 0 || $paid_all_od_before_ins_date == $last_od_amount) {
//
//                                array_push($od_amount_all_array_1, $od_amount_all);
//                            }
                            array_push($od_amount_all_array, $od_interest);

//                            $last_od_amount = (float) end($od_amount_all_array_1);
                            $od_date_start1->modify($od_dates);
                            $z++;
                        }
                    }
                }
            }
        } else if ($this->installment_type == 1) {

            $FID = new DateTime($this->effective_date);
            $FID->modify('+1 months');
            $first_installment_date = $FID->format('Y-m-d ' . $time);


            $start = new DateTime($first_installment_date);
            $first_date = $start->format('Y-m-d ' . $time);

            $x = 0;
            $no_of_installments = 0;
            $total_installment_amount = 0;
            $ins_total = 0;
            $total_paid = 0;
            $od_amount_all_array = array();
            $od_array = array();
            $last_od = array();
            $od_total = array();
            $last_od_balance = array();
            $od_balance_amount = array();

            while ($x < $numOfInstallments) {
                if ($numOfInstallments == 4) {
                    $modify_range = '+7 day';
                } elseif ($numOfInstallments == 30) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 8) {
                    $modify_range = '+7 day';
                } elseif ($numOfInstallments == 60) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 2) {
                    $modify_range = '+1 months';
                } elseif ($numOfInstallments == 1) {
                    $modify_range = '+1 months';
                } elseif ($numOfInstallments == 90) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 12) {
                    $modify_range = '+7 day';
                } elseif ($numOfInstallments == 3) {
                    $modify_range = '+1 months';
                } elseif ($numOfInstallments == 100) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 13) {
                    $modify_range = '+7 day';
                }

                $date = $start->format('Y-m-d ' . $time);

                $paid_amount = 0;
                $od_amount = 0;
                $od_amount_all = 0;
                $balance = 0;
                $loan_proccesign_fee_paid = 0;
                $total_od_paid = 0;
                $paid_all_amount_before_ins_date = 0;
                $paid_all_od_before_ins_date = 0;

                $customer = $this->customer;
                $CUSTOMER = new Customer($customer);
                $route = $CUSTOMER->route;
                $center = $CUSTOMER->center;
                $installment_amount = $this->installment_amount;

                $FID = new DateTime($date);
                $FID->modify($modify_range);
                $day_remove = '-1 day';
                $FID->modify($day_remove);
                $second_installment_date = $FID->format('Y-m-d ' . $time);
                $amount = $this->installment_amount;

                $INSTALLMENT = new Installment(NULL);
                $ALl_AMOUNT = $INSTALLMENT->getAmountByLoanId($this->id);

                foreach ($INSTALLMENT->CheckInstallmetByPaidDate($date, $this->id) as $paid) {
                    $paid_amount += $paid['paid_amount'];
                }

                $before_payment_amounts = $INSTALLMENT->getPaidAmountByBeforeDate($date, $this->id);

                foreach ($before_payment_amounts as $before_payment_amount) {
                    $paid_all_amount_before_ins_date += $before_payment_amount['paid_amount'];
                    $paid_all_od_before_ins_date += $before_payment_amount['additional_interest'];
                }

                if (PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center) || PostponeDate::CheckIsPostPoneByDateAndAll($date) || PostponeDate::CheckIsPostPoneByDateCenterAll($date) || PostponeDate::CheckIsPostPoneByDateRouteAll($date)) {
                    $start->modify($modify_range);
                } else {

                    $last_od_amount = (float) end($od_amount_all_array);
                    $ins_total += $amount;
                    $total_paid += $paid_amount;

                    $balance = $paid_all_od_before_ins_date + $paid_all_amount_before_ins_date - $ins_total - $last_od_amount;

                    $OD = new OD(NULL);
                    $OD->loan = $this->id;
                    $od = $OD->allOdByLoanAndDate($date, $balance);

                    if (PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center) || PostponeDate::CheckIsPostPoneByDateAndAll($date) || PostponeDate::CheckIsPostPoneByDateCenterAll($date) || PostponeDate::CheckIsPostPoneByDateRouteAll($date) || $ALl_AMOUNT[0] >= $ins_total) {
                        
                    } else {
                        if ($od !== false) {
                            $y = 0;
                            //get how many dates in month
                            $dateValue = strtotime($date);
                            $year = date("Y", $dateValue);
                            $month = date("m", $dateValue);

                            $daysOfMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

                            $od_date_start = new DateTime($date);
                            $defult_val = $daysOfMonth - 1;
                            $od_interest = $this->getOdIntereset(-$ins_total + $paid_all_amount_before_ins_date, $od['od_interest_limit']);

                            while ($y <= $defult_val) {

                                if ($defult_val <= $daysOfMonth - 1 && $this->od_date <= $od_date_start) {
                                    $od_dates = '+1 day';
                                }

                                $od_date = $od_date_start->format('Y-m-d');


                                if (strtotime($date) >= strtotime($selectedDate) || strtotime($od_date) >= strtotime($selectedDate)) {
                                    break;
                                }
                                $ODDATES = new DateTime($od_date);
                                $ODDATES->modify($od_dates);

                                $od_date_remove = '-1 day -23 hours -59 minutes -58 seconds';

                                $ODDATES->modify($od_date_remove);

                                $od_night = $ODDATES->format('Y-m-d H:i:s');

                                $od_array[] = $od_interest;
                                $od_amount_all = json_encode(round(array_sum($od_array), 2));

                                array_push($od_amount_all_array, $od_amount_all);

                                $od_date_start->modify($od_dates);
                                $y++;
                            }
                        }
                    }
                }

                if ($selectedDate . " " . $time == $date) {
                    $total_installment_amount += $installment_amount;
                    if (strtotime(date("Y/m/d")) < strtotime($date) || strtotime($selectedDate) < strtotime($date)) {
                        break;
                    }
                } else {
                    if (strtotime(date("Y/m/d")) < strtotime($date) || strtotime($selectedDate) < strtotime($date)) {
                        break;
                    }
                    $total_installment_amount += $installment_amount;
                }

                $start->modify($modify_range);
                $x++;

                if ($numOfInstallments == $x) {

                    //get installment end date
                    $INSTALLMENT_END = new DateTime($date);
                    $INSTALLMENT_END->modify('+' . $daysOfMonth . ' day');
                    $installment_end = $INSTALLMENT_END->format('Y-m-d H:i:s');

                    //get 5 years ahead date from installment end date
                    $INSTALLMENT_UNLIMITED_END = new DateTime($date);
                    $INSTALLMENT_UNLIMITED_END->modify('+1725 day');
                    $installment_unlimited_end = $INSTALLMENT_UNLIMITED_END->format('Y-m-d H:i:s');


                    $start = strtotime($date);
                    $end = strtotime(date("Y/m/d"));

                    $days_between = floor(abs($end - $start) / 86400) - 1;

                    $z = 0;

                    $od_date_start1 = new DateTime($od_night);
                    $od_date_start1->modify('+1 day +23 hours +59 minutes +58 seconds');

                    $defult_val = $days_between;

                    //if having od after installment end
                    if ($od !== false) {

                        $last_od_date = date('D/M/Y', strtotime($od_night));
                        $last_installment_date = date('D/M/Y', strtotime($date));

                        $od_amount_all_array_1 = array();
                        while ($z <= $defult_val) {

                            if ($od['od_date_start'] <= $od_date_start1) {
                                $od_dates = '+1 day';
                            }

                            $od_date1 = $od_date_start1->format('Y-m-d');

                            //getting brfore of date from current od date
                            $OLDODDATE = new DateTime($od_date1);

                            $od_date_remove1 = '-23 hours -59 minutes -58 seconds';

                            $OLDODDATE->modify($od_date_remove1);

                            $old_od_date = $OLDODDATE->format('Y-m-d H:i:s');
                            if (strtotime($selectedDate) <= strtotime($old_od_date) || strtotime($od['od_date_end'] . $time) < strtotime($old_od_date)) {
                                break;
                            }
                            $last_od_amount = (float) end($od_amount_all_array_1);

                            $od_array[] = $od_interest;
                            $od_amount_all = json_encode(round(array_sum($od_array), 2));

                            if ($od_amount_all > 0 || $paid_all_od_before_ins_date == $last_od_amount) {

                                array_push($od_amount_all_array_1, $od_amount_all);
                            }

                            $od_date_start1->modify($od_dates);
                            $z++;
                        }
                    }
                }
            }
        }

        $last_od_amount_balance = $last_od_amount - $paid_aditional_interrest;

        if ($last_od_amount_balance > 0) {
            $last_od_amount_balance = $last_od_amount_balance;
        } else {
            $last_od_amount_balance = 0;
        }

        $all_arress = ($total_paid_installment) - ($total_installment_amount );
        $system_due = $loan_amount - $total_installment_amount;
        $system_due_num_of_ins = $system_due / $this->installment_amount;
        $actual_due_num_of_ins = $actual_due / $this->installment_amount;


        if ($this->installment_type == 4 || $this->installment_type == 1) {
            $actual_due = $all_arress + ($last_od_amount - $paid_aditional_interrest);
        }
        return [
            'date' => $date,
            'od_amount' => $last_od_amount_balance,
            'all_arress' => $all_arress,
            'all_amount' => $balance,
            'system-due-num-of-ins' => $system_due_num_of_ins,
            'system-due' => $system_due,
            'actual-due-num-of-ins' => $actual_due_num_of_ins,
            'actual-due' => $actual_due,
            'receipt-num-of-ins' => $total_paid_installment / $this->installment_amount,
            'receipt' => $total_paid_installment + $paid_aditional_interrest,
            'arrears-excess-num-of-ins' => ($total_installment_amount - $total_paid_installment) / $this->installment_amount,
            'arrears-excess' => $total_installment_amount - $total_paid_installment,
            'installment_amount' => $amount,
        ];
    }

    //view manage active loan details
    public function getCurrentStatus() {

        date_default_timezone_set("Asia/Calcutta");
        $time = date('H:i:s');
        $today = date('Y-m-d H:i:s');
        $numOfInstallments = DefaultData::getNumOfInstlByPeriodAndType($this->loan_period, $this->installment_type);
        $first_installment_date = '';
        $paid_aditional_interrest = 0;
        $total_paid_installment = 0;

        $INSTALLMENT = new Installment(NULL);

        foreach ($INSTALLMENT->getInstallmentByLoan($this->id) as $installment) {
            $paid_aditional_interrest += $installment["additional_interest"];
            $total_paid_installment = $total_paid_installment + $installment["paid_amount"];
        }

        $loan_amount = $numOfInstallments * $this->installment_amount;
        $actual_due = $loan_amount - $total_paid_installment;

        //daily installment
        if ($this->installment_type == 30) {

            $FID = new DateTime($this->effective_date . " 00:00:01");
            $FID->modify('+1 day');
            $first_installment_date = $FID->format('Y-m-d H:i:s');


            $start = new DateTime($first_installment_date);
            $first_date = $start->format('Y-m-d ' . $time);

            $x = 0;
            $total_installment_amount = 0;
            $ins_total = 0;
            $total_paid = 0;
            $od_amount_all_array = array();
            $last_od = array();
            $od_total = array();
            $last_od_balance = array();
            $od_balance_amount = array();

            while ($x < $numOfInstallments) {
                if ($numOfInstallments == 4) {
                    $modify_range = '+7 day';
                } elseif ($numOfInstallments == 30) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 8) {
                    $modify_range = '+7 day';
                } elseif ($numOfInstallments == 60) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 2) {
                    $modify_range = '+1 months';
                } elseif ($numOfInstallments == 1) {
                    $modify_range = '+1 months';
                } elseif ($numOfInstallments == 90) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 12) {
                    $modify_range = '+7 day';
                } elseif ($numOfInstallments == 3) {
                    $modify_range = '+1 months';
                } elseif ($numOfInstallments == 100) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 13) {
                    $modify_range = '+7 day';
                }

                $date = $start->format('Y-m-d ' . $time);

                $paid_amount = 0;
                $od_amount = 0;
                $od_amount_all = 0;
                $balance = 0;
                $loan_proccesign_fee_paid = 0;
                $total_od_paid = 0;
                $paid_all_amount_before_ins_date = 0;
                $paid_all_od_before_ins_date = 0;
                $last_od_amount = 0;
                $od_interest = 0;
                $allod = 0;

                $customer = $this->customer;
                $CUSTOMER = new Customer($customer);
                $route = $CUSTOMER->route;
                $center = $CUSTOMER->center;
                $installment_amount = $this->installment_amount;

                $FID = new DateTime($date);
                $FID->modify($modify_range);
                $day_remove = '-1 day';
                $FID->modify($day_remove);
                $second_installment_date = $FID->format('Y-m-d ' . $time);
                $amount = $this->installment_amount;
                $od_night = date("Y/m/d");


                $INSTALLMENT = new Installment(NULL);
                $ALl_AMOUNT = $INSTALLMENT->getAmountByLoanId($this->id);

                foreach ($INSTALLMENT->CheckInstallmetByPaidDate($date, $this->id) as $paid) {
                    $paid_amount += $paid['paid_amount'];
                }

                $before_payment_amounts = $INSTALLMENT->getPaidAmountByBeforeDate($date, $this->id);

                foreach ($before_payment_amounts as $before_payment_amount) {
                    $paid_all_amount_before_ins_date += $before_payment_amount['paid_amount'];
                    $paid_all_od_before_ins_date += $before_payment_amount['additional_interest'];
                }

                if (PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center) || PostponeDate::CheckIsPostPoneByDateAndAll($date) || PostponeDate::CheckIsPostPoneByDateCenterAll($date) || PostponeDate::CheckIsPostPoneByDateRouteAll($date)) {
                    $start->modify($modify_range);
                } else {

                    $last_od_amount = (float) end($od_amount_all_array);
                    $od_total_amount = (float) end($od_total);

                    $ins_total += $amount;
                    $total_paid += $paid_amount;

                    //                   $balance = $paid_all_od_before_ins_date + $paid_all_amount_before_ins_date - $ins_total - $od_total_amount;

                    $balance = $paid_all_amount_before_ins_date - $ins_total;

                    $OD = new OD(NULL);
                    $OD->loan = $this->id;
                    $AllOd = $OD->allOdByLoan();
                    $od = $OD->allOdByLoanAndDate($date, $balance);

                    //get daily loan od amount  
                    if (!$AllOd || PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center) || PostponeDate::CheckIsPostPoneByDateAndAll($date) || PostponeDate::CheckIsPostPoneByDateCenterAll($date) || PostponeDate::CheckIsPostPoneByDateRouteAll($date) || $ALl_AMOUNT[0] >= $ins_total) {
                        
                    } else {
                        if ($AllOd) {
                            foreach ($AllOd as $key => $allod) {
                                if (strtotime($allod['od_date_start']) <= strtotime($date) && strtotime($date) <= strtotime($allod['od_date_end']) && (-1 * ($allod['od_interest_limit'])) > $balance && $allod['od_interest_limit'] < $actual_due) {

                                    $ODDATES = new DateTime($date);
                                    $ODDATES->modify(' +23 hours +59 minutes +58 seconds');

                                    $od_date_morning = $ODDATES->format('Y-m-d H:i:s');

                                    $paid_all_amount_before_ins_date1 = 0;
                                    $before_payment_amounts1 = $INSTALLMENT->getPaidAmountByBeforeDate($od_date_morning, $this->id);

                                    foreach ($before_payment_amounts1 as $before_payment_amount1) {
                                        $paid_all_amount_before_ins_date1 += $before_payment_amount1['paid_amount'];
                                    }

                                    $od_interest = $this->getOdIntereset1(-$ins_total + $paid_all_amount_before_ins_date1, $allod['od_interest_limit']);

                                    $od_array[] = $od_interest;
                                    $od_amount_all = json_encode(round(array_sum($od_array), 2));

                                    if (strtotime(date("Y/m/d")) <= strtotime($date)) {
                                        break;
                                    }
                                    array_push($od_amount_all_array, $od_interest);
                                    array_push($od_total, $od_amount_all);
                                }
                            }
                        }
                    }
                    $total_installment_amount += $installment_amount;

                    if (strtotime(date("Y/m/d")) <= strtotime($date)) {
                        break;
                    }

                    $start->modify($modify_range);
                    $x++;

                    //end of the installment 
                    if ($numOfInstallments == $x) {

                        $ODDATES = new DateTime($date);
                        $ODDATES->modify('+23 hours +59 minutes +58 seconds');
                        $od_date_morning = $ODDATES->format('Y-m-d H:i:s');

                        //check log ends with od or installment
                        $last_od_date = date('D/M/Y', strtotime($od_date_morning));
                        $last_installment_date = date('D/M/Y', strtotime($date));

                        if ($last_od_date == $last_installment_date) {
                            $last_loop_od = $od_interest;
                        } else {
                            $last_loop_od = 0;
                        }

                        //get installment end date
                        $INSTALLMENT_END = new DateTime($date);
                        $INSTALLMENT_END->modify('+1 day');
                        $installment_end = $INSTALLMENT_END->format('Y-m-d H:i:s');

                        //get 5 years ahead date from installment end date
                        $INSTALLMENT_UNLIMITED_END = new DateTime($date);
                        $INSTALLMENT_UNLIMITED_END->modify('+1725 day');
                        $installment_unlimited_end = $INSTALLMENT_UNLIMITED_END->format('Y-m-d H:i:s');

                        $start = strtotime($date);
                        $end = strtotime(date("Y/m/d"));
                        $days_between = floor(abs($end - $start) / 86400) - 1;
                        $od = $OD->allOdByLoanAndDate($date, $balance);
                        $y = 0;

                        $od_date_start1 = new DateTime($date);
                        $od_date_start1->modify('+47 hours +59 minutes +58 seconds');

                        $defult_val = $days_between;

                        while ($y <= $defult_val) {

                            if ($od['od_date_start'] <= $od_date_start1) {
                                $od_dates = '+1 day';
                            }

                            $od_date = $od_date_start1->format('Y-m-d H:i:s');
                            //getting echo $od_date; before of date from current od date
                            $OLDODDATE = new DateTime($od_date);
                            $od_date_remove1 = '-23 hours -59 minutes -58 seconds';

                            $OLDODDATE->modify($od_date_remove1);
                            $old_od_date = $OLDODDATE->format('Y-m-d H:i:s');

                            if (strtotime(date("Y/m/d")) <= strtotime($date)) {
                                break;
                            }

                            $od_array[] = $od_interest;
                            $od_amount_all = json_encode(round(array_sum($od_array), 2));

                            array_push($od_amount_all_array, $od_interest);
                            array_push($od_total, $od_amount_all);

                            $od_total_amount = (float) end($od_total);

                            $od_date_start1->modify($od_dates);
                            $y++;
                        }
                    }
                }
            }
            //weekly installment
        } else if ($this->installment_type == 4) {

            $FID = new DateTime($this->effective_date . " 00:00:01");
            $FID->modify('+7 day');
            $first_installment_date = $FID->format('Y-m-d H:i:s');


            $start = new DateTime($first_installment_date);
            $first_date = $start->format('Y-m-d ' . $time);

            $x = 0;
            $total_installment_amount = 0;
            $ins_total = 0;
            $total_paid = 0;
            $od_amount_all_array = array();
            $od_array = array();
            $last_od = array();
            $od_total = array();
            $last_od_balance = array();
            $od_balance_amount = array();

            while ($x < $numOfInstallments) {
                if ($numOfInstallments == 4) {
                    $modify_range = '+7 day';
                } elseif ($numOfInstallments == 30) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 8) {
                    $modify_range = '+7 day';
                } elseif ($numOfInstallments == 60) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 2) {
                    $modify_range = '+1 months';
                } elseif ($numOfInstallments == 1) {
                    $modify_range = '+1 months';
                } elseif ($numOfInstallments == 90) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 12) {
                    $modify_range = '+7 day';
                } elseif ($numOfInstallments == 3) {
                    $modify_range = '+1 months';
                } elseif ($numOfInstallments == 100) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 13) {
                    $modify_range = '+7 day';
                }


                $date = $start->format('Y-m-d ' . " 00:00:01");

                $paid_amount = 0;
                $od_amount = 0;
                $od_amount_all = 0;
                $balance = 0;
                $loan_proccesign_fee_paid = 0;
                $total_od_paid = 0;
                $paid_all_amount_before_ins_date = 0;
                $paid_all_od_before_ins_date = 0;


                $customer = $this->customer;
                $CUSTOMER = new Customer($customer);
                $route = $CUSTOMER->route;
                $center = $CUSTOMER->center;
                $installment_amount = $this->installment_amount;

                $FIDS = new DateTime($date);
                $FIDS->modify($modify_range);
                $day_remove = '-2 seconds';

                $FIDS->modify($day_remove);
                $second_installment_date = $FIDS->format('Y-m-d H:i:s');


                $amount = $this->installment_amount;
                $od_night = date("Y/m/d");

                $INSTALLMENT = new Installment(NULL);
                $ALl_AMOUNT = $INSTALLMENT->getAmountByLoanId($this->id);

                foreach ($INSTALLMENT->CheckInstallmetByPaidDate($date, $this->id) as $paid) {
                    $paid_amount += $paid['paid_amount'];
                }

                $before_payment_amounts = $INSTALLMENT->getPaidAmountByBeforeDate($date, $this->id);

                foreach ($before_payment_amounts as $before_payment_amount) {
                    $paid_all_amount_before_ins_date += $before_payment_amount['paid_amount'];
                    $paid_all_od_before_ins_date += $before_payment_amount['additional_interest'];
                }

                if (PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center) || PostponeDate::CheckIsPostPoneByDateAndAll($date) || PostponeDate::CheckIsPostPoneByDateCenterAll($date) || PostponeDate::CheckIsPostPoneByDateRouteAll($date)) {
                    $start->modify($modify_range);
                } else {

                    $last_od_amount = (float) end($od_amount_all_array);
                    $od_total_amount = (float) end($od_total);

                    $ins_total += $amount;
                    $total_paid += $paid_amount;

                    $balance = $paid_all_amount_before_ins_date - $ins_total;

                    $OD = new OD(NULL);
                    $OD->loan = $this->id;
                    $od = $OD->allOdByLoanAndDate($date, $balance);

                    if (strtotime(date("Y/m/d")) < strtotime($date) || PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center) || PostponeDate::CheckIsPostPoneByDateAndAll($date) || PostponeDate::CheckIsPostPoneByDateCenterAll($date) || PostponeDate::CheckIsPostPoneByDateRouteAll($date) || $ALl_AMOUNT[0] >= $ins_total || $actual_due < $od['od_interest_limit']) {
                        
                    } else {
                        if ($od !== false) {

                            // Declare and define two dates 
                            $ins_date1 = strtotime($date);
                            $ins_date2 = strtotime($second_installment_date);

                            // Formulate the Difference between two dates 
                            $diff = abs($ins_date2 - $ins_date1);

                            $daysbetween = floor(($diff - (floor($diff / (365 * 60 * 60 * 24))) * 365 * 60 * 60 * 24 -
                                    (floor(($diff - (floor($diff / (365 * 60 * 60 * 24))) * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24))) * 30 * 60 * 60 * 24) / (60 * 60 * 24));

                            $od_interest = $this->getOdIntereset(-$ins_total + $paid_all_amount_before_ins_date, $od['od_interest_limit']);

                            $y = 0;
                            $od_date_start = new DateTime($date);
                            $od_date_start->modify('+23 hours +59 minutes +58 seconds');
                            $defult_val = $daysbetween;

                            while ($y <= $defult_val) {

                                if ($defult_val <= $daysbetween && $od['od_date_start'] <= $od_date_start) {
                                    $od_dates = '+1 day';
                                }

                                $od_date = $od_date_start->format('Y-m-d H:i:s');

                                //// od dates range
                                $ODDATES = new DateTime($od_date);
                                $ODDATES->modify($od_dates);

                                $od_date_remove = '-1 day -23 hours -59 minutes -58 seconds';

                                $ODDATES->modify($od_date_remove);
                                $od_night = $ODDATES->format('Y-m-d H:i:s');


                                if ((strtotime(date("Y/m/d")) <= strtotime($od_date)) || strtotime($od['od_date_end'] . $time) <= strtotime($od_date)) {
                                    break;
                                }
                                $od_array[] = $od_interest;
                                $od_amount_all = json_encode(round(array_sum($od_array)));

                               
                                array_push($od_amount_all_array, $od_interest);
                                array_push($od_total, $od_amount_all);

                                $od_date_start->modify($od_dates);
                                $y++;
                            }
                        }
                    }
                }

                if (strtotime(date("Y/m/d")) . " " . $time == $date) {

                    if (strtotime(date("Y/m/d")) < strtotime($date)) {
                        break;
                    }
                    $total_installment_amount += $installment_amount;
                } else {
                    if (strtotime(date("Y/m/d")) < strtotime($date)) {
                        break;
                    }
                    $total_installment_amount += $installment_amount;
                }


                $start->modify($modify_range);
                $x++;

                if ($numOfInstallments == $x) {
                    //get installment end date
                    $INSTALLMENT_END = new DateTime($date);
                    $INSTALLMENT_END->modify('+7 day');
                    $installment_end = $INSTALLMENT_END->format('Y-m-d H:i:s');

                    //get 5 years ahead date from installment end date
                    $INSTALLMENT_UNLIMITED_END = new DateTime($date);
                    $INSTALLMENT_UNLIMITED_END->modify('+1725 day');
                    $installment_unlimited_end = $INSTALLMENT_UNLIMITED_END->format('Y-m-d H:i:s');


                    $start = strtotime($date);
                    $end = strtotime(date("Y/m/d"));

                    $days_between = floor(abs($end - $start) / 86400) - 1;

                    $z = 0;

                    $od_date_start1 = new DateTime($od_night);
                    $od_date_start1->modify('+1 day +23 hours +59 minutes +58 seconds');
                    $defult_val = $days_between;


                    //if having od after installment end
                    if ($od !== false) {

                        $last_od_date = date('D/M/Y', strtotime($od_night));
                        $last_installment_date = date('D/M/Y', strtotime($date));

                        if ($last_od_date == $last_installment_date) {
                            $last_loop_od = $od_interest;
                        } else {
                            $last_loop_od = 0;
                        }

                        while ($z <= $defult_val) {

                            if ($od['od_date_start'] <= $od_date_start1) {
                                $od_dates = '+1 day';
                            }

                            $od_date1 = $od_date_start1->format('Y-m-d H:i:s');

                            //getting brfore of date from current od date
                            $OLDODDATE = new DateTime($od_date1);
                            $od_date_remove1 = '-23 hours -59 minutes -58 seconds';

                            $OLDODDATE->modify($od_date_remove1);
                            $old_od_date = $OLDODDATE->format('Y-m-d H:i:s');

                            if (strtotime(date("Y/m/d")) <= strtotime($old_od_date) || strtotime(date("Y/m/d")) <= strtotime($od_date1)) {
                                break;
                            }

                            $od_array[] = $od_interest;
                            $od_amount_all = json_encode(round(array_sum($od_array)));

                            array_push($od_amount_all_array, $od_interest);
                            array_push($od_total, $od_amount_all);

                            $od_total_amount = (float) end($od_total);

                            $od_date_start1->modify($od_dates);
                            $z++;
                        }
                    }
                }
            }
        } else if ($this->installment_type == 1) {

            $FID = new DateTime($this->effective_date . " 00:00:01");
            $FID->modify('+1 months');
            $first_installment_date = $FID->format('Y-m-d H:i:s');


            $start = new DateTime($first_installment_date);
            $first_date = $start->format('Y-m-d ' . $time);

            $x = 0;
            $no_of_installments = 0;
            $total_installment_amount = 0;
            $ins_total = 0;
            $total_paid = 0;
            $od_amount_all_array = array();
            $od_array = array();
            $last_od = array();
            $od_total = array();
            $last_od_balance = array();
            $od_balance_amount = array();

            while ($x < $numOfInstallments) {
                if ($numOfInstallments == 4) {
                    $modify_range = '+7 day';
                } elseif ($numOfInstallments == 30) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 8) {
                    $modify_range = '+7 day';
                } elseif ($numOfInstallments == 60) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 2) {
                    $modify_range = '+1 months';
                } elseif ($numOfInstallments == 1) {
                    $modify_range = '+1 months';
                } elseif ($numOfInstallments == 90) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 12) {
                    $modify_range = '+7 day';
                } elseif ($numOfInstallments == 3) {
                    $modify_range = '+1 months';
                } elseif ($numOfInstallments == 100) {
                    $modify_range = '+1 day';
                } elseif ($numOfInstallments == 13) {
                    $modify_range = '+7 day';
                }

                $date = $start->format('Y-m-d H:i:s');

                $paid_amount = 0;
                $last_od_amount = 0;
                $od_amount = 0;
                $od_amount_all = 0;
                $balance = 0;
                $loan_proccesign_fee_paid = 0;
                $total_od_paid = 0;
                $paid_all_amount_before_ins_date = 0;
                $paid_all_od_before_ins_date = 0;

                $customer = $this->customer;
                $CUSTOMER = new Customer($customer);
                $route = $CUSTOMER->route;
                $center = $CUSTOMER->center;
                $installment_amount = $this->installment_amount;
                $amount = $this->installment_amount;

                $FIDS = new DateTime($date);
                $FIDS->modify($modify_range);
                $day_remove = '-2 seconds';

                $FIDS->modify($day_remove);
                $second_installment_date = $FIDS->format('Y-m-d H:i:s');
                $ALl_AMOUNT = $INSTALLMENT->getAmountByLoanId($this->id);

                $od_night = date("Y/m/d");

                $INSTALLMENT = new Installment(NULL);
                $ALl_AMOUNT = $INSTALLMENT->getAmountByLoanId($this->id);

                foreach ($INSTALLMENT->CheckInstallmetByPaidDate($date, $this->id) as $paid) {
                    $paid_amount += $paid['paid_amount'];
                }

                $before_payment_amounts = $INSTALLMENT->getPaidAmountByBeforeDate($date, $this->id);

                foreach ($before_payment_amounts as $before_payment_amount) {
                    $paid_all_amount_before_ins_date += $before_payment_amount['paid_amount'];
                    $paid_all_od_before_ins_date += $before_payment_amount['additional_interest'];
                }

                if (PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center) || PostponeDate::CheckIsPostPoneByDateAndAll($date) || PostponeDate::CheckIsPostPoneByDateCenterAll($date) || PostponeDate::CheckIsPostPoneByDateRouteAll($date)) {
                    $start->modify($modify_range);
                } else {

                    $last_od_amount = (float) end($od_amount_all_array);
                    $od_total_amount = (float) end($od_total);

                    $ins_total += $amount;
                    $total_paid += $paid_amount;

                    $balance = $paid_all_od_before_ins_date + $paid_all_amount_before_ins_date - $ins_total - $od_total_amount;

                    $OD = new OD(NULL);
                    $OD->loan = $this->id;
                    $od = $OD->allOdByLoanAndDate($date, $balance);

                    if (strtotime(date("Y/m/d")) < strtotime($date) || PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center) || PostponeDate::CheckIsPostPoneByDateAndAll($date) || PostponeDate::CheckIsPostPoneByDateCenterAll($date) || PostponeDate::CheckIsPostPoneByDateRouteAll($date) || $ALl_AMOUNT[0] >= $ins_total) {
                        
                    } else {
                        if ($od !== false) {
                            $od_interest = $this->getOdIntereset(-$ins_total + $paid_all_amount_before_ins_date, $od['od_interest_limit']);

                            $y = 0;
                            //get month and year from inst date
                            $dateValue = strtotime($date);
                            $year = date("Y", $dateValue);
                            $month = date("m", $dateValue);

                            $daysOfMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

                            $od_date_start = new DateTime($date);

                            $od_date_start->modify('+23 hours +59 minutes +58 seconds');

                            $defult_val = $daysOfMonth - 1;

                            while ($y <= $defult_val) {

                                if ($defult_val <= $daysOfMonth - 1 && $this->od_date <= $od_date_start) {
                                    $od_dates = '+1 day';
                                }

                                $od_date = $od_date_start->format('Y-m-d H:i:s');

                                if ((strtotime(date("Y/m/d")) <= strtotime($od_date))) {
                                    break;
                                }

                                $ODDATES = new DateTime($od_date);
                                $ODDATES->modify($od_dates);

                                $od_date_remove = '-1 day -23 hours -59 minutes -58 seconds';

                                $ODDATES->modify($od_date_remove);

                                $od_night = $ODDATES->format('Y-m-d H:i:s');

                                $od_array[] = $od_interest;
                                $od_amount_all = json_encode(round(array_sum($od_array)));

                                array_push($od_total, $od_amount_all);
                                array_push($od_amount_all_array, $od_interest);

                                $od_date_start->modify($od_dates);
                                $y++;
                            }
                        }
                    }
                }


                if (strtotime(date("Y/m/d")) <= strtotime($date)) {
                    break;
                }
                $total_installment_amount += $installment_amount;

                $start->modify($modify_range);
                $x++;


                if ($numOfInstallments == $x) {

                    //get installment end date
                    $INSTALLMENT_END = new DateTime($date);
                    $INSTALLMENT_END->modify('+' . $daysOfMonth . ' day');
                    $installment_end = $INSTALLMENT_END->format('Y-m-d H:i:s');

                    //get 5 years ahead date from installment end date
                    $INSTALLMENT_UNLIMITED_END = new DateTime($date);
                    $INSTALLMENT_UNLIMITED_END->modify('+1725 day');
                    $installment_unlimited_end = $INSTALLMENT_UNLIMITED_END->format('Y-m-d H:i:s');


                    $start = strtotime($date);
                    $end = strtotime(date("Y/m/d"));

                    $days_between = floor(abs($end - $start) / 86400) - 1;

                    $z = 0;

                    $od_date_start1 = new DateTime($od_night);
                    $od_date_start1->modify('+1 day +23 hours +59 minutes +58 seconds');

                    $defult_val = $days_between;

                    //if having od after installment end
                    if ($od !== false) {

                        $last_od_date = date('D/M/Y', strtotime($od_night));
                        $last_installment_date = date('D/M/Y', strtotime($date));

//                        $od_amount_all_array_1 = array();
                        while ($z <= $defult_val) {

                            if ($od['od_date_start'] <= $od_date_start1) {
                                $od_dates = '+1 day';
                            }

                            $od_date1 = $od_date_start1->format('Y-m-d');

                            if ((strtotime(date("Y/m/d")) <= strtotime($od_date1))) {
                                break;
                            }
                            //getting brfore of date from current od date
                            $OLDODDATE = new DateTime($od_date1);

                            $od_date_remove1 = '-23 hours -59 minutes -58 seconds';

                            $OLDODDATE->modify($od_date_remove1);
                            $old_od_date = $OLDODDATE->format('Y-m-d H:i:s');

                            $od_array[] = $od_interest;

                            $od_amount_all = json_encode(round(array_sum($od_array), 2));


                            array_push($od_amount_all_array, $od_interest);
                            array_push($od_total, $od_amount_all);

                            $od_date_start1->modify($od_dates);
                            $z++;
                        }
                    }
                }
            }
        }

        $INSTALLMENT = new Installment(NULL);
        $total_paid_installment = 0;
        $paid_aditional_interrest = 0;

        foreach ($INSTALLMENT->getInstallmentByLoan($this->id) as $installment) {
            $paid_aditional_interrest += $installment["additional_interest"];
            $total_paid_installment = $total_paid_installment + $installment["paid_amount"];
        }

        $last_od_amount_balance = $od_total_amount - $paid_aditional_interrest;

        $all_arress = ($total_paid_installment ) - ($total_installment_amount) - $od_total_amount;
        $system_due = $loan_amount - $total_installment_amount;
        $system_due_num_of_ins = $system_due / $this->installment_amount;
        $actual_due_num_of_ins = $actual_due / $this->installment_amount;



        return [
            'od_amount' => $od_total_amount,
            'all_arress' => $all_arress,
            'all_amount' => $balance,
            'system-due-num-of-ins' => $system_due_num_of_ins,
            'system-due' => $system_due,
            'actual-due-num-of-ins' => $actual_due_num_of_ins,
            'actual-due' => $actual_due,
            'receipt-num-of-ins' => $total_paid_installment / $this->installment_amount,
            'receipt' => $total_paid_installment + $paid_aditional_interrest,
            'arrears-excess-num-of-ins' => ($total_installment_amount - $total_paid_installment) / $this->installment_amount,
            'arrears-excess' => ($total_installment_amount) - ($total_paid_installment),
            'installment_amount' => $amount,
        ];
    }

    public function getStatusbyDate($selectedDate) {

        date_default_timezone_set("Asia/Calcutta");
        $time = date('H:i:s');
        $today = date('Y-m-d');
        $numOfInstallments = DefaultData::getNumOfInstlByPeriodAndType($this->loan_period, $this->installment_type);

        $first_installment_date = '';

        if ($this->installment_type == 4) {
            $FID = new DateTime($this->effective_date);
            $FID->modify('+7 day');
            $first_installment_date = $FID->format('Y-m-d ' . $time);
        } elseif ($this->installment_type == 30) {

            $FID = new DateTime($this->effective_date);
            $FID->modify('+1 day');
            $first_installment_date = $FID->format('Y-m-d ' . $time);
        } elseif ($this->installment_type == 1) {
            $FID = new DateTime($this->effective_date);
            $FID->modify('+1 months');
            $first_installment_date = $FID->format('Y-m-d ' . $time);
        }

        $start = new DateTime($first_installment_date);

        $first_date = $start->format('Y-m-d ' . $time);
        $installments = 0;
        $INSTALLMENT = new Installment(NULL);
        foreach ($INSTALLMENT->CheckInstallmetDateByLoanId($first_date, $this->id) as $installments) {
            
        }

        $x = 0;
        $total_installment_amount = 0;

        $ins_total = 0;
        $total_paid = 0;
        $od_array = array();
        $array_value = 0;
        while ($x < $numOfInstallments) {
            if ($numOfInstallments == 4) {
                $modify_range = '+7 day';
            } elseif ($numOfInstallments == 30) {
                $modify_range = '+1 day';
            } elseif ($numOfInstallments == 8) {
                $modify_range = '+7 day';
            } elseif ($numOfInstallments == 60) {
                $modify_range = '+1 day';
            } elseif ($numOfInstallments == 2) {
                $modify_range = '+1 months';
            } elseif ($numOfInstallments == 1) {
                $modify_range = '+1 months';
            } elseif ($numOfInstallments == 90) {
                $modify_range = '+1 day';
            } elseif ($numOfInstallments == 12) {
                $modify_range = '+7 day';
            } elseif ($numOfInstallments == 3) {
                $modify_range = '+1 months';
            } elseif ($numOfInstallments == 100) {
                $modify_range = '+1 day';
            } elseif ($numOfInstallments == 13) {
                $modify_range = '+7 day';
            }

            $date = $start->format('Y-m-d ' . $time);

            $paid_amount = 0;
            $od_amount = 0;
            $interest_amount = 0;
            $previus_amount = 0;
            $total_paid_od = 0;

            $customer = $this->customer;
            $CUSTOMER = new Customer($customer);
            $route = $CUSTOMER->route;
            $center = $CUSTOMER->center;
            $installment_amount = $this->installment_amount;

            $FID = new DateTime($date);
            $FID->modify($modify_range);
            $day_remove = '-1 day';
            $FID->modify($day_remove);
            $second_installment_date = $FID->format('Y-m-d ' . $time);
            $amount = $this->installment_amount;
            $previus_amount += $installments['paid_amount'];
            $today = date('Y-m-d');

            $INSTALLMENT = new Installment(NULL);
            $ALl_AMOUNT = $INSTALLMENT->getAmountByLoanId($this->id);

            foreach ($INSTALLMENT->CheckInstallmetBeetwenTwoDateByLoanId($date, $second_installment_date, $this->id, $today) as $paid) {
                $paid_amount += $paid['paid_amount'];
            }

            foreach ($INSTALLMENT->CheckPaidOdAmount($selectedDate, $this->od_date, $this->id) as $paid_od) {
                $total_paid_od += $paid_od['additional_interest'];
            }

            if (PostponeDate::CheckIsPostPoneByDateAndCustomer($date, $customer) || PostponeDate::CheckIsPostPoneByDateAndRoute($date, $route) || PostponeDate::CheckIsPostPoneByDateAndCenter($date, $center) || PostponeDate::CheckIsPostPoneByDateAndAll($date) || PostponeDate::CheckIsPostPoneByDateCenterAll($date) || PostponeDate::CheckIsPostPoneByDateRouteAll($date)) {
                $start->modify($modify_range);
            } else {

                $ins_total += $amount;
                $total_paid += $paid_amount;
                $due_and_excess = $total_paid - $ins_total;
                $due_and_excess = $due_and_excess + $previus_amount;

                if (strtotime($selectedDate) <= strtotime($date) || $this->od_interest_limit == "NOT") {
                    
                } else if (strtotime($this->od_date) <= strtotime($date) && $due_and_excess < 0 && $this->installment_type == 4) {

                    $od_interest = $this->getOdIntereset($due_and_excess, $this->od_interest_limit);

                    $y = 0;
                    $od_date_start = new DateTime($date);
                    $defult_val = 6;

                    while ($y <= $defult_val) {

                        if ($defult_val <= 6 && $this->od_date <= $od_date_start) {
                            $od_dates = '+1 day';
                        }

                        $od_date = $od_date_start->format('Y-m-d');

                        if (strtotime($selectedDate) <= strtotime($od_date)) {
                            break;
                        }

                        $od_array[] = $od_interest;
                        $od_amount = json_encode(round(array_sum($od_array), 2));

                        $array_value = array($od_amount);
                        array_push($array_value, 1);
                        $od_date_start->modify($od_dates);
                        $y++;
                    }
                } else if (strtotime($this->od_date) <= strtotime($date) && $due_and_excess < 0 && $this->installment_type == 1) {

                    $od_interest = $this->getOdIntereset($due_and_excess, $this->od_interest_limit);

                    $y = 0;
                    $od_date_start = new DateTime($date);
                    $defult_val = 30;

                    while ($y <= $defult_val) {

                        if ($defult_val <= 30 && $this->od_date <= $od_date_start) {
                            $od_dates = '+1 day';
                        }

                        $od_date = $od_date_start->format('Y-m-d');

                        if (strtotime($selectedDate) <= strtotime($od_date)) {
                            break;
                        }

                        $od_array[] = $od_interest;
                        $od_amount = json_encode(round(array_sum($od_array), 2));

                        $array_value = array($od_amount);
                        array_push($array_value, 1);
                        $od_date_start->modify($od_dates);
                        $y++;
                    }
                } else if (strtotime($this->od_date) <= strtotime($date) && $due_and_excess < 0) {

                    $od_interest = $this->getOdIntereset($due_and_excess, $this->od_interest_limit);
                    $od_array[] = $od_interest;
                    $od_amount = json_encode(round(array_sum($od_array), 2));

                    $array_value = array($od_amount);
                    array_push($array_value, 1);
                }
                $total_installment_amount += $installment_amount;

                if (strtotime($selectedDate) <= strtotime($date)) {
                    break;
                }

                $start->modify($modify_range);
                $x++;
            }
        }


        $Installment = new Installment(NULL);
        $total_paid_installment = 0;
        foreach ($Installment->getInstallmentByLoan($this->id) as $installment) {
            $total_paid_installment = $total_paid_installment + $installment["paid_amount"];
        }

        $loan_amount = $numOfInstallments * $this->installment_amount;
        $system_due = $loan_amount - $total_installment_amount;
        $system_due_num_of_ins = $system_due / $this->installment_amount;
        $actual_due = $loan_amount - $total_paid_installment;
        $actual_due_num_of_ins = $actual_due / $this->installment_amount;

        $all_arress = ($array_value[0]) + ($total_installment_amount - $total_paid_installment);

        return [
            'od_amount' => $array_value[0] - $total_paid_od,
            'all_arress' => $all_arress,
            'system-due-num-of-ins' => $system_due_num_of_ins,
            'system-due' => $system_due,
            'actual-due-num-of-ins' => $actual_due_num_of_ins,
            'actual-due' => $actual_due,
            'due_and_excess' => $due_and_excess,
            'all_amount' => $due_and_excess - $array_value[0],
            'receipt-num-of-ins' => $total_paid_installment / $this->installment_amount,
            'receipt' => $total_paid_installment,
            'first_installment_date' => $first_installment_date,
            'total_installment_amount' => $total_installment_amount,
            'arrears-excess-num-of-ins' => ($total_installment_amount - $total_paid_installment) / $this->installment_amount,
            'arrears-excess' => $total_installment_amount - $total_paid_installment,
        ];
    }

    public function updateLoanCompleted() {

        $query = "UPDATE  `loan` SET "
                . "`status` ='" . $this->status . "' "
                . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();
        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    public function allLoanByKeyword($search_key) {

        $query = "select loan.id as loan_id,customer.id as customer_id from customer join loan on loan.customer = customer.id WHERE `surname` like '%" . $search_key . "%' OR `first_name` like '%" . $search_key . "%' OR `last_name` like '%" . $search_key . "%' OR loan.id =  '" . $search_key . "'";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

}
