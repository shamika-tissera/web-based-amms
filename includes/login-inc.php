<?php

//determines if the user has accessed this page in the proper way (via the submission form)
if(!isset($_POST["submit"])){
    header("location: ../login.php");
    exit();
}

$uname = $_POST["uname"];
$pwd = $_POST["pwd"];

require_once 'dbh-inc.php';
function emptyInputLogin($uname, $pwd){
    $result = false;
    if(empty($uname) || empty($pwd)){
        $result = true;
    }
    return $result;
}
function checkUnameExists($uname, $conn){
    $sql = "SELECT * FROM userinfo WHERE Username = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
    }
    else{
        mysqli_stmt_bind_param($stmt, "s", $uname);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($resultData)) {
            return $row;
        }
        else{
            return false;
        }        
    }
    mysqli_stmt_close($stmt);
}
function loginUser($conn, $uname, $pwd){
    $userExists = checkUnameExists($uname, $conn);
    if($userExists === false){
        header("location: ../login.php?error=invalid_login");
        exit();
    }

    $pwdHashed = $userExists["password"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if($checkPwd === false){
        header("location: ../login.php?error=invalid_login");
        exit();
    }
    if($checkPwd === true){
        session_start();
        $_SESSION['username'] = $userExists["username"];
        $_SESSION['firstname'] = $userExists["firstname"];
        $_SESSION['lastname'] = $userExists["lastname"];
        header('location: ../index.php');
        exit();
    }
}

if(emptyInputLogin($uname, $pwd) !== false){
    header("location: ../login.php?error=emptyinput");
    exit();
}

loginUser($conn, $uname, $pwd);