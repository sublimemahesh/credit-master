
<div class="row">

    <div class="col-sm-12" align="right">
        <?php
        echo '<h3 style="margin: 0px 20px 9px 0px;" id="month-bar">' . date('F', mktime(0, 0, 0, $_POST['month'], 10)) . ' ' . $_POST['year'] . '</h3>';
        ?>
    </div>
</div>

<?php
include '../../class/include.php';


$CALENDER = new PostponeDate(Null);
echo $CALENDER->draw_calendar($_POST['month'], $_POST['year'], 1, 12);
?>

<div style="float: left; margin: 8px 0px -10px -1px; overflow: hidden;">
    Not available: <div style="width: 10px; height: 10px; background-color: rgb(211, 0, 0) ;display: inline-flex;"></div>
</div>