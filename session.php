<?php
session_start();
if(empty($_SESSION['user']) || !in_array($_SESSION['user']["role"], [1,2])) {
    header("Location: http://localhost/some_php/login.php");
}



?>