<?php

if (!isset($_SESSION)) {
    session_start();
} 

if (!User::authenticate()) {
    redirect('login.php'); 
}