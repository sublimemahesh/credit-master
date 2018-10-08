<?php

include_once(dirname(__FILE__) . '/../../class/include.php');



$MEMBER = new Member(NULL);

if ($MEMBER->logOut()) {
    header('location: ../login-or-register.php');
} else {
    header('location: ../?error=2');
}
 