<?php
include 'dbh-inc.php';
if(isset($_POST["submitInfo"])){
    $username = $_POST["username"];
    $occu = $_POST["occu"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    if(empty($username) || empty($occu) || empty($first_name) || empty($last_name)){
        echo "<script>alert(\"All information are requried!\")</script>";
        header("location: ../profile.php?error=empty");
        exit();
    }
    $sql_update = "UPDATE userinfo SET FirstName = \"$first_name\", LastName = \"$last_name\", EmpCategory = \"$occu\" WHERE Username = \"$username\";";
    $run_update = mysqli_query($conn, $sql_update);
    if(!$run_update){
        echo "<script>alert(\"Failed to update information due to an internal error!\")</script>";
        header("location: ../profile.php");
        exit();
    }
}
else if(isset($_POST["submitPass"])){
    $username = $_POST["username"];
    $pass = $_POST["pass"];
    $r_pass = $_POST["r_pass"];
    if(empty($username) || empty($pass) || empty($r_pass) || $pass != $r_pass){
        echo "<script>alert(\"All information are requried!\")</script>";
        header("location: ../profile.php?error=pass");
    }
    $pass = password_hash($pass, PASSWORD_DEFAULT);
    $sql_update = "UPDATE userinfo SET Password = \"$pass\" WHERE Username = \"$username\";";
    $run_update = mysqli_query($conn, $sql_update);
    if(!$run_update){
        echo "<script>alert(\"Failed to update information due to an internal error!\")</script>";
        header("location: ../profile.php");
        exit();
    }
}
else{
    header("location: ../nonCurrentAssetInfo.php");
    exit();
}