<?php
include 'dbh-inc.php';
if(isset($_POST["submit"])){
    $code = $_POST["assetCode"];
    $manu = $_POST["manufacturer"];
    $serial = $_POST["serialNo"];
    $supplier = $_POST["supplier"];
    $state = $_POST["state"];
    $invoice = $_POST["invoice"];
    $price = $_POST["price"];
    $depreBegin = $_POST["depreBegin"];
    $lifetime = $_POST["lifetime"];
    $depreRate = $_POST["depreRate"];
    $depreMethod = $_POST["depreMethod"];
    $warrantyCode = $_POST["warrantyCode"];
    $warrantyType = $_POST["warrantyType"];
    $warrantyStart = $_POST["warrantyStart"];
    $warrantyEnd = $_POST["warrantyEnd"];
    $installationDate = $_POST["installationDate"];
    $plant = $_POST["plant"];
    $condition = $_POST["condition"];
    $criticality = $_POST["criticality"];
    $serviceInterval = $_POST["serviceInterval"];
    $asset_type = $_POST["asset_type"];

    if(empty($code) || empty($manu) || empty($supplier) || empty($state) ||
        empty($price) || empty($depreBegin) || empty($lifetime) || empty($depreRate)
        || empty($depreMethod) || empty($plant) || empty($condition) || empty($criticality)
        || empty($serviceInterval)){
            header("location: ../nonCurrentAssetForm.php?error=empty");
            exit();  
    }
    else{
        if(!(is_float($price) || is_int($price) || is_float($lifetime) || is_int($lifetime) || is_float($serviceInterval) || is_int($serviceInterval))){
            header("location: ../nonCurrentAssetForm.php?error=invalid_input");
            exit(); 
        }
        else{
            if(empty($warrantyCode) || empty($warrantyStart) || empty($warrantyType)){
                //Non-warranty item
                $sql = "INSERT INTO noncurrentasset(asset_id, lifetime, depreciationRate, condition, manufacturer, plant, serialNumber, depreciationMethod, costOfPurchase, serviceInterval, state, assetType, purchaseDate)" . 
                    "VALUES('$code', '$lifetime', '$depreRate', '$condition', '$manu', '$plant', '$serial', '$depreMethod', '$price', '$serviceInterval', '$state', '$asset_type', '$installationDate');";
            
                $run_out = mysqli_query($conn, $sql);

                if ($run_out) {
                    echo "<script> alert('Asset Added Successfully!')</script>";
                    echo "<script> window.open('nonCurrentAssetForm.php','_self')</script>";
                }
                else{
                    echo "<script> alert('Asset not recorded!')</script>";
                }
            }
            else{
                //warranty item
                $sql_warranty = "INSERT INTO warranty(warrantyCode, invoiceNum, type, startDate, endDate)" . 
                    "VALUES('$warrantyCode', '$invoice', '$warrantyType', '$warrantyStart', '$warrantyEnd');";
                $sql_asset = "INSERT INTO noncurrentasset(asset_id, lifetime, depreciationRate, condition, manufacturer, plant, serialNumber, depreciationMethod, costOfPurchase, serviceInterval, state, assetType, purchaseDate, warrantyCode)" . 
                    "VALUES('$code', '$lifetime', '$depreRate', '$condition', '$manu', '$plant', '$serial', '$depreMethod', '$price', '$serviceInterval', '$state', '$asset_type', '$installationDate', '$warrantyCode');";
            }
        }
    }
}
else{
    header("location: ../nonCurrentAssetForm.php");
    exit();
}