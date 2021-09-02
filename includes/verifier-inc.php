<?php 
    session_start();
    if(isset($_SESSION["category"]) && $_SESSION["category"] != 'manager'){
        header("location:login.php");
        exit();
    }
    if ((!isset($_SESSION["username"])) || isset($_POST["submit"])) {
        header("location:login.php");
    }
?>