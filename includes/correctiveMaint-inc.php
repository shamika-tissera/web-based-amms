<?php
include 'dbh-inc.php';
if(isset($_POST["submit"])){
    $assetCode = $_POST["assetCode"];
    

    if(empty($assetCode)){
        // echo "<script>alert(\"When disposing asset, all information is required. Failed to record disposal!\")</script>";
        // exit();
    }
    
    $update = "UPDATE workerreports SET performed = 1 WHERE asset_id = '$assetCode';";

    $run_query = mysqli_query($Con,$update);
    if(!$run_query){
        echo "<script>alert(\"Failed to record disposal due to an internal error!\")</script>";
        exit();
    }

    echo "<script>alert(\"Asset disposal recorded successfully!\")</script>";
    header("location: ../correctiveMaint.php");
}
else{
    header("location: ../correctiveMaint.php");
    exit(); 
}