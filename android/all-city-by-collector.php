<?php
include_once(dirname(__FILE__) . '/../class/include.php');
$CENTER_OBJ = new Center(NULL);
$uid = $_POST['uid'];
$CENTERS = $CENTER_OBJ->getCentersByCollector($uid);
echo json_encode($CENTERS);
?>