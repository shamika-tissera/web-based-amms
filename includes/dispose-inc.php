<?php
include 'dbh-inc.php';
if(isset($_POST["submit"])){
    $assetCode = $_POST["assetCode"];
    $diposedDate = $_POST["disposedDate"];
    $disposedAmount = $_POST["disposedAmount"];    

    if(empty($assetCode) || empty($disposedDate) || empty($disposedAmount)){
        // echo "<script>alert(\"When disposing asset, all information is required. Failed to record disposal!\")</script>";
        // exit();
    }
    
    //Remove record from non current asset
    $remove_asset_record = "UPDATE noncurrentasset SET disposed = 1 WHERE asset_id = '$assetCode';";

    echo "<script>alert(\"$remove_asset_record\")</script>";

    $run_delete = mysqli_query($Con,$remove_asset_record);
    if(!$run_delete){
        echo "<script>alert(\"Failed to record disposal due to internal error!\")</script>";
        exit();
    }

    $get_warranty_code = "SELECT warrantyCode FROM noncurrentasset WHERE asset_id = '$assetCode' LIMIT 1;";
    echo "<script>alert(\"$get_warranty_code\")</script>";
    $result = mysqli_query($conn, $get_warranty_code);
    $warrantyCode = mysqli_fetch_assoc($result);
    if($warrantyCode){
        //warranty asset      

        //Remove record from warranty table
        $remove_warranty_record = "DELETE FROM `warranty` WHERE warrantyCode = '$warrantyCode';";
        echo "<script>alert(\"$remove_warranty_record\")</script>";
        $run_delete = mysqli_query($Con,$remove_warranty_record);
        if(!$run_delete){
            echo "<script>alert(\"Failed to record disposal due to internal error!\")</script>";
            exit();
        }
    }

    //create a record in the disposal table
    $insert_disposal = "INSERT INTO `disposal` (`disposedDate`, `disposedValue`, `asset_id`) VALUES ('$diposedDate', '$disposedAmount', '$assetCode');";
    $run_insert = mysqli_query($Con,$insert_disposal);
    if(!$run_insert){
        echo "<script>alert(\"Failed to record disposal due to internal error!\")</script>";
        exit();
    }

    echo "<script>alert(\"Asset disposal recorded successfully!\")</script>";
    header("location: ../nonCurrentAssetInfo.php");
}
else{
    header("location: ../nonCurrentAssetInfo.php");
    exit(); 
}