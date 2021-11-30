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
    
    if($message == null){
        $sql_insert = "INSERT INTO workerreports(username, reported_date, asset_id, plant, criticality_machineOperations, criticality_activityConstraints) " .
                    "VALUES (\"$uname\", NOW(), \"$assetCode\", \"$plant\", \"$criticalityOperational\", \"$criticalityActivity\");";
    }
    else{
        $sql_insert = "INSERT INTO workerreports(username, reported_date, asset_id, plant, criticality_machineOperations, criticality_activityConstraints, message) " .
                    "VALUES (\"$uname\", NOW(), \"$assetCode\", \"$plant\", \"$criticalityOperational\", \"$criticalityActivity\", \"$message\");";
    }
    $run_out = mysqli_query($conn, $sql_insert);
    if($run_out){
        echo "<SCRIPT>
            alert('Submitted Successfully!')
            window.location.replace('../Worker/equipmentErrorReporting.php');
            </SCRIPT>";
    }
    else{
        echo "<SCRIPT>
            alert('You have already submitted an error report on this asset today! Please try again tomorrow...')
            window.location.replace('../Worker/equipmentErrorReporting.php');
            </SCRIPT>";
    }
}
else{
    header("location: ../Worker/equipmentErrorReporting.php");
    exit();
}