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
                . "`history` ='" . $this->history . "' "
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

    public function CheckCustomerHasActiveLoan($customer) {

        $query = "SELECT * FROM `loan` WHERE `customer` = '" . $customer . "' OR  `guarantor_1` ='" . $customer . "' OR  `guarantor_2` ='" . $customer . "' OR  `guarantor_3` ='" . $customer . "'  ";

        $db = new Database();

        $result = $db->readQuery($query);

        if (mysql_num_rows($result) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function approveLoan() {

        $query = "UPDATE  `loan` SET "
                . "`issued_date` ='" . $this->issued_date . "', "
                . "`status` ='issued'"
                . "WHERE `id` = '" . $this->id . "'";
    }

    public function getLoanDetailsByCustomer($customer) {

        $query = "SELECT `id`,`loan_amount`,`interest_rate` FROM `loan` WHERE `customer` ='" . $customer . "' AND `status` ='issued' ";

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

        $row = mysql_fetch_row($result);

        return $row;
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

    public function getOdIntereset($customer, $due_amount, $installment_type) {

        $CUSTOMER = new Customer(NULL);
        $od_interest_limite = $CUSTOMER->getOdInteresetLimiteByCustomer($customer);

        if ($od_interest_limite[0] >= $due_amount && (int) $installment_type == 30) {

            $interest_amount_per_month = ($due_amount * 10) / 100;
            $interest_amount = ($interest_amount_per_month / 30);

            if ((int) $od_interest_limite[0] == 0) {
                return 0;
            } else {
                return $interest_amount;
            }
        } else if ($od_interest_limite[0] <= $due_amount && (int) $installment_type == 4) {

            $interest_amount_per_month = ($due_amount * 10) / 100;
            $interest_amount_per_day = ($interest_amount_per_month / 30);
            $interest_amount = ($interest_amount_per_day * 7);

            if ((int) $od_interest_limite[0] == 0) {
                return 0;
            } else {
                return $interest_amount;
            }
        } else {
            $interest_amount_per_month = ($due_amount * 10) / 100;
            $interest_amount = $interest_amount_per_month;

            if ((int) $od_interest_limite[0] == 0) {
                return 0;
            } else {
                return $interest_amount;
            }
        }
    }

}
