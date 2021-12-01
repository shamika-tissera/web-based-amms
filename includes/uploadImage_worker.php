<?php
require 'dbh-inc.php';
if(isset($_POST['submit'])){
    $file = $_FILES['image'];
    $uname = $_POST["username"];
    $fileName = $file['name'];
    $uploadedSuccess = $file['error'];
    $tempName = $file['tmp_name'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($fileActualExt, $allowed)) {
        if ($uploadedSuccess === 0) {
            if ($file['size'] < 5000000) {
                $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                $fileDestination = '../assets/img/avatars/' . $fileNameNew;
                move_uploaded_file($tempName, $fileDestination);
                $fileDestination = './assets/img/avatars/' . $fileNameNew; //set the relative path with respect to 'headerNav.php'
                $sql_insert = "UPDATE userinfo SET avatarPath = \"$fileDestination\" WHERE Username = \"$uname\";";
                $run_out = mysqli_query($conn, $sql_insert);
                if ($run_out) {
                    echo "<script> alert('Image uploaded successfully! Change will take effect after next login.')</script>";
                    echo "<script> window.open('../Worker/profile.php','_self')</script>";
                } else {
                    echo "<script> alert('Image not uploaded due to an internal error!')</script>";
                }
            }
            else {
                echo "<script> alert('Image not uploaded due to large file size! Please select another image.')</script>";
                echo "<script> window.open('../Worker/profile.php','_self')</script>";
            }
        }
        else{
            echo "<script> alert('Error while uploading! Please try again.')</script>";
            echo "<script> window.open('../Worker/profile.php','_self')</script>";
        }
    }
    else {
        echo "<script> alert('File not uploaded... Please select an image!')</script>";
        echo "<script> window.open('../Worker/profile.php','_self')</script>";
    }
}