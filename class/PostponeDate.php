<?php

/**
 * Description of Customer
 *
 * @author Sublime Holdings
 */
class PostponeDate {

    public $id;
    public $date;
    public $reason;
    public $all;
    public $route;
    public $center;
    public $customer;
    public $by;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT * FROM `postpone_date` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->date = $result['date'];
            $this->reason = $result['reason'];
            $this->all = $result['all'];
            $this->route = $result['route'];
            $this->center = $result['center'];
            $this->customer = $result['customer'];
            $this->by = $result['by'];


            return $this;
        }
    }

    public function create() {


        $query = "INSERT INTO `postpone_date` (`date`,`reason`,`all`,`route`,`center`,`customer`,`by`) VALUES  ('"
                . $this->date . "','"
                . $this->reason . "', '"
                . $this->all . "', '"
                . $this->route . "', '"
                . $this->center . "', '"
                . $this->customer . "', '"
                . $this->by . "')";

       
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


        $query = "SELECT * FROM `postpone_date`  ";
        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function getPostPoneDateByDate($date) {


        $query = "SELECT * FROM `postpone_date` WHERE `date`='$date' ";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `postpone_date` SET "
                . "`date` ='" . $this->date . "', "
                . "`reason` ='" . $this->reason . "', "
                . "`all` ='" . $this->all . "', "
                . "`route` ='" . $this->route . "', "
                . "`center` ='" . $this->center . "', "
                . "`customer` ='" . $this->customer . "', "
                . "`by` ='" . $this->by . "' "
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

        $query = 'DELETE FROM `postpone_date` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function draw_calendar($year, $month, $col) {

        /* draw table */
        $calendar = '<div class="col-sm-12' . $col . '">';
        $calendar .= '<table cellpadding="1" cellspacing="1"border="1" class="table-cal">';


        /* table headings */
        $headings = array('Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa');
        $calendar .= '<tr>';
        $calendar .= '<td  align="center">';
        $calendar .= implode('</td><td align="center">', $headings) . '</td>';
        $calendar .= '</tr>';

        /* days and weeks vars now ... */
        $running_day = date('w', mktime(0, 0, 0, $month, 1, $year));
        $days_in_month = date('t', mktime(0, 0, 0, $month, 1, $year));
        $days_in_this_week = 1;
        $day_counter = 0;
        $dates_array = array();

        /* row for week one */
        $calendar .= '<tr>';


        /* print "blank" days until the first of the current week */
        for ($x = 0; $x < $running_day; $x++):
            $calendar .= '<td> </td>';
            $days_in_this_week++;


        endfor;

        $post_pone_date = PostponeDate::getPostPoneDateByMonth($month, $year);

        /* keep going with days.... */
        for ($list_day = 1; $list_day <= $days_in_month; $list_day++):
            //concate date
            $date = $year . "-" . $month . "-" . $list_day;
            /* add in the day number */

            if (in_array($list_day, $post_pone_date)) {

                $calendar .= '<td class="date-td booking">';

                $calendar .= '<b>';
                $calendar .= $list_day;
                $calendar .= '</b>';

                $calendar .= '<div class="row">';
                $calendar .= '<div class="col-md-6">';
                $calendar .= '<a href="manage-postpone-dates.php?date=' . $date . '" >';
                $calendar .= '<button class="calendar-btn-view glyphicon glyphicon-info-sign"></button>';
                $calendar .= '</a>';
                $calendar .= '</div>';
                $calendar .= '<div class="col-md-6">';
                $calendar .= '<a href="add-new-postpone-date.php?date=' . $date . '" >';
                $calendar .= ' <button class="glyphicon glyphicon-plus-sign calendar-btn "></button>';
                $calendar .= '</a>';
                $calendar .= '</div>';
                $calendar .= '</div>';

                $calendar .= '</td>';
            } else {

                $calendar .= '<td class="date-td">';

                $calendar .= '<b>';
                $calendar .= $list_day;
                $calendar .= '</b>';

                $calendar .= '<div class="row">';
                $calendar .= '<div class="col-md-6">';
                $calendar .= '</div>';
                $calendar .= '<div class="col-md-6">';
                $calendar .= '<a href="add-new-postpone-date.php?date=' . $date . '" >';
                $calendar .= ' <button class="glyphicon glyphicon-plus-sign calendar-btn "></button>';
                $calendar .= '</a>';
                $calendar .= '</div>';
                $calendar .= '</div>';



                $calendar .= '</td>';
            }

            if ($running_day == 6):
                $calendar .= '</tr>';
                if (($day_counter + 1) != $days_in_month):
                    $calendar .= '<tr> ';
                endif;
                $running_day = -1;
                $days_in_this_week = 0;
            endif;
            $days_in_this_week++;
            $running_day++;
            $day_counter++;
        endfor;

        /* finish the rest of the days in the week */
        if ($days_in_this_week < 8):
            for ($x = 1; $x <= (8 - $days_in_this_week); $x++):
                $calendar .= '<td class="calendar-day-np"> </td>';
            endfor;
        endif;

        /* final row */
        $calendar .= '</tr>';

        /* end the table */
        $calendar .= '</table>';

        $calendar .= '</div>';


        /* all done, return result */
        return $calendar;
    }

    public function getPostPoneDateByMonth($m, $y) {


        $db = new Database();

        $sql = "SELECT `id`as id,DAY(`date`)as date FROM `postpone_date` WHERE `date` BETWEEN '" . $y . "-" . $m . "-01" . "' AND '" . $y . "-" . $m . "-31" . "'";

        $result = $db->readQuery($sql);

        $post_pone_date = array();

        while ($row = mysql_fetch_assoc($result)) {

            $row['date'] . '<br>';

            array_push($post_pone_date, $row['date']);
        }

        return $post_pone_date;
    }

    public function CheckIsPostPoneByDateAndCustomer($date, $customer) {

        $query = "SELECT * FROM `postpone_date` WHERE `date`= '" . $date . "' AND `customer`= '" . $customer . "'";
  
        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function CheckIsPostPoneByDateAndRoute($date, $route) {

        $query = "SELECT * FROM `postpone_date` WHERE `date`= '" . $date . "' AND `route`= '" . $route . "' AND `route` !=0";
       
        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function CheckIsPostPoneByDateAndCenter($date, $center) {

        $query = "SELECT * FROM `postpone_date` WHERE `date`= '" . $date . "' AND `center`= '" . $center . "' AND `center` !=0";
       
        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function CheckIsPostPoneByDateAndAll($date) {

        $query = "SELECT * FROM `postpone_date` WHERE `date`= '" . $date . "' AND `all`= '1'";

        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function CheckIsPostPoneByDateCenterAll($date) {

        $query = "SELECT * FROM `postpone_date` WHERE `date`= '" . $date . "' AND `center`= '99999' AND `route` = '0'";

        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    public function CheckIsPostPoneByDateRouteAll($date) {

        $query = "SELECT * FROM `postpone_date` WHERE `date`= '" . $date . "' AND `route`= '88888' AND `center`= '0' ";
       
        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
