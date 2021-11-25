<?php 
    session_start();
    $a = $_SESSION["category"];
    
    if(isset($_SESSION["category"]) && $_SESSION["category"] != 'worker'){
        header("location:../login.php");
        exit();
    }
    if (!isset($_SESSION["username"])) {
        header("location:../login.php");
        exit();
    }
?>