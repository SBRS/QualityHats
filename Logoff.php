<?php
session_start();
// remove all session variables
session_unset(); 

// destroy the session 
session_destroy(); 
$redirect_page = "http://dochyper.unitec.ac.nz/lia15/PHPAssignment/index.php";
header("Location: ".$redirect_page);
?>