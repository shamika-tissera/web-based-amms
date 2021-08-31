<?php 
    session_start();
    if ((!isset($_SESSION["username"])) || isset($_POST["submit"])) {
        header("location:../login.php");
    }
?>