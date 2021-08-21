<?php
include 'dbh-inc.php';
if(isset($_POST["submit"])){
    $assetCode = $_POST["assetCode"];
    

    if(empty($assetCode)){
        // echo "<script>alert(\"When disposing asset, all information is required. Failed to record disposal!\")</script>";
        // exit();
    }
    
    //Remove record from non current asset
    $initial_update_serviceDue = "UPDATE noncurrentasset SET serviceDue = NOW() WHERE asset_id = '$assetCode'";
    $final_update_serviceDue = "CALL UpdateNextServiceDue('$assetCode');";

    $run_query = mysqli_query($Con,$initial_update_serviceDue);
    if(!$run_query){
        echo "<script>alert(\"Failed to record disposal due to an internal error!\")</script>";
        exit();
    }

    $run_query = mysqli_query($Con,$final_update_serviceDue);
    if(!$run_query){
        echo "<script>alert(\"Failed to record disposal due to an internal error!\")</script>";
        exit();
    }

    echo "<script>alert(\"Asset disposal recorded successfully!\")</script>";
    header("location: ../preventiveMaintenance.php");
}
else{
    header("location: ../preventiveMaintenance.php");
    exit(); 
}