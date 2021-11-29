<?php
include 'dbh-inc.php';
if(isset($_POST["submit"])){
    $assetCode = $_POST["assetCodeUpdate"];
    $assetType = $_POST["assetListSelected"];
    $lifetime = $_POST["lifetime"];
    $manu = $_POST["manu"];
    $service_interval = $_POST["service_interval"];
    $state = $_POST["state"];
    $warranty_code = $_POST["warranty_code"];
    if(empty($assetCode) || empty($assetType) || $lifetime == "" || empty($manu) || $service_interval == "" || empty($state) || empty($warranty_code)){
        echo "<script>alert(\"All information are requried!\")</script>";
        header("location: ../nonCurrentAssetInfo.php");
        exit();
    }

    $sql_update = "UPDATE noncurrentasset SET assetType = '$assetType', lifetime = '$lifetime', manufacturer = '$manu', serviceInterval = $service_interval, state = '$state', warrantyCode = '$warranty_code' WHERE asset_id = '$assetCode';";
    $run_update = mysqli_query($conn, $sql_update);
    if(!$run_update){
        echo "<script>alert(\"Failed to update information! This is probably due to a conflict in the warranty code. If the issue persists, please contact the administrator.\")</script>";
        header("location: ../nonCurrentAssetInfo.php");
        exit();
    }
    else{
        echo "<script>alert(\"Updated information successfully!\")</script>";
        header("location: ../nonCurrentAssetInfo.php");
        exit();
    }
}
else{
    header("location: ../nonCurrentAssetInfo.php");
    exit();
}