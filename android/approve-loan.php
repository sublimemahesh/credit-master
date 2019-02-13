<?php
include_once(dirname(__FILE__) . '/../class/include.php');
$LOAN = new Loan(NULL);
$LOAN->id = $_POST['loan'];
$LOAN->issued_date = $_POST['issuedate'];
$RESULT = $LOAN->approveLoan();

if ($RESULT) {
    $response["error"] = FALSE;
    $response["message"] = "success!";
    echo json_encode($response);
} else {
    $response["error"] = TRUE;
    $response["message"] = "Please Try Again!";
    die(json_encode($response));
}
// echo json_encode($RESULT);
?>