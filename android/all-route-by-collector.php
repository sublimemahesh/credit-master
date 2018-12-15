<?php
include_once(dirname(__FILE__) . '/../class/include.php');
$ROUTE_OBJ = new Route(NULL);
$uid = $_POST['uid'];
$ROUTES = $ROUTE_OBJ->getRouteByCollector($uid); 
echo json_encode($ROUTES);
?>