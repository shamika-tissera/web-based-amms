<?php
include "./verifier-inc.php";
$inst = $_SESSION['username'];
include 'dbh-inc.php';
if(isset($_POST["submit"])){
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $uname = $_POST["uname"];
    $occu = $_POST["occu"];
    $pass = $_POST["password"];
    $r_pass = $_POST["r_password"];

    if(($fname == null) || ($lname == null) || ($uname == null) || ($pass == null) || ($r_pass == null)){
        header("location: ../register.php?error=incomplete");
        exit();
    }
    if($pass != $r_pass){
        header("location: ../register.php?error=pass_match");
        exit();
    }
    $pass = password_hash($pass, PASSWORD_DEFAULT); 
    $sql_insert = "INSERT INTO userinfo(FirstName, LastName, Username, Password, EmpCategory, registered_by) 
                    VALUES (\"$fname\", \"$lname\", \"$uname\", \"$pass\", \"$occu\", \"$inst\");";
    $run_out = mysqli_query($conn, $sql_insert);
    if($run_out){
        echo "<script> alert('Submitted Successfully!')</script>";
        header("location: ../register.php");
    }
    else{
        echo "<script> alert('An internal error was encountered during submission... Please try again later.')</script>";
        header("location: ../register.php");
    }
}
else{
    header("location: ../register.php");
    exit();
}