<?php
include "../includes/verfier_worker-inc.php";
$uname = $_SESSION['username'];
include 'dbh-inc.php';
if(isset($_POST["submit"])){
    $assetCode = $_POST["assetCode"];
    $assetType = $_POST["assetType"];
    $plant = $_POST["plant"];
    $criticalityOperational = $_POST["criticalityOperational"];
    $criticalityActivity = $_POST["criticalityActivity"];
    $message = $_POST["message"];

    if($assetCode == "Select the asset code..." || $assetType == "Select an asset type..." || $plant == "Select the plant..."){
        //TODO: perform error action
        header("location: ../Worker/equipmentErrorReporting.php?error=incomplete");
        exit();
    }

    $sql_insert = "INSERT INTO workerreports(username, reported_date, asset_id, plant, criticality_machineOperations, criticality_activityConstraints, message) " .
                    "VALUES ($uname, NOW(), $assetCode, $plant, $criticalityOperational, $criticalityActivity, $message);";

    $run_out = mysqli_query($conn, $sql_insert);
    if($run_out){
        echo "<script> alert('Submitted Successfully!')</script>";
        echo "<script> window.open('equipmentErrorReporting.php','_self')</script>";
    }
    else{
        echo "<script> alert('Not submitted due to an internal error!')</script>";
    }
}
else{
    header("location: ../Worker/equipmentErrorReporting.php");
    exit();
}