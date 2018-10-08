<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

$USER = new User(NULL);

if ($USER->logOut()) {
    header('Location: ../login.php');
} else {
    header('Location: ./?error=2');
}

