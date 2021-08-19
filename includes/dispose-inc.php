<?php
include 'dbh-inc.php';
if(isset($_POST["dispose"])){
    $assetCode = $_POST["assetCode"];
    $diposedDate = $_POST["disposedDate"];
    $disposedAmount = $_POST["disposedAmount"];

    if(empty($assetCode) || empty($disposedDate) || empty($disposedAmount)){
        echo "<script>alert(\"When disposing asset, all information is required. Failed to record disposal!\")</script>";
        exit();
    }
    
    $get_warranty_code = "SELECT warrantyCode FROM noncurrentasset WHERE asset_id = '$assetCode' LIMIT 1;";
    $result = mysqli_query($conn, $get_warranty_code);
    $warrantyCode = mysqli_fetch_assoc($result);
    if($warrantyCode){
        //warranty asset

        //Remove record from

        //Remove record from warranty table
        $remove_warranty_record = "DELETE FROM `warranty` WHERE warrantyCode = '$warrantyCode';";
        $run_delete = mysqli_query($Con,$remove_warranty_record);
        if(!$run_delete){
            echo "<script>alert(\"Failed to record disposal due to internal error!\")</script>";
            exit();
        }

    }
}
else{
    header("location: ../nonCurrentAssetInfo.php");
    exit(); 
}