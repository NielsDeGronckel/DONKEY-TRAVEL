<?php 
session_start();
if (!isset($_SESSION['username'])){ 
    $msg = "You're not logged in. Please login first.";
    header("Location: loginForm?message=" . urlencode($msg));
    } else {
        session_abort();
    }
?>