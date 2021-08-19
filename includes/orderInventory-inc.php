<?php
include 'dbh-inc.php';
if(isset($_POST["submit"])){
    $inventoryCode = $_POST["inventoryCode"];
    $due = $_POST["due"];
    $quantity = $_POST["quantity"];  
    $plant = $_POST["plant"];  
    $inCharge = $_POST["inCharge"];  
    $supplier = $_POST["supplier"];   

    if(empty($inventoryCode) || empty($quantity) || empty($plant) || empty($supplier)){
        // echo "<script>alert(\"When disposing asset, all information is required. Failed to record disposal!\")</script>";
        // exit();
    }
    
    //Remove record from non current asset
    $insert_order = "INSERT INTO inventoryorder(orderTime, inventoryCode, orderedQuantity, dueDate, supplierID, plant, responsiblePerson) " . 
                    "VALUES (NOW(), '$inventoryCode', $quantity, '$due', '$supplier', '$plant', '$inCharge')";    

    $run_insert_order = mysqli_query($Con,$insert_order);
    if(!$run_insert_order){
        echo "<script>alert(\"Failed to record disposal due to internal error!\")</script>";
        exit();
    }
    else{
        echo "<script>alert(\"Made order successfully!\")</script>";
        header("location: ../manageInventory.php");
    }
}
else{
    header("location: ../manageInventory.php");
    exit(); 
}

//     $get_warranty_code = "SELECT warrantyCode FROM noncurrentasset WHERE asset_id = '$assetCode' LIMIT 1;";
//     echo "<script>alert(\"$get_warranty_code\")</script>";
//     $result = mysqli_query($conn, $get_warranty_code);
//     $warrantyCode = mysqli_fetch_assoc($result);
//     if($warrantyCode){
//         //warranty asset      

//         //Remove record from warranty table
//         $remove_warranty_record = "DELETE FROM `warranty` WHERE warrantyCode = '$warrantyCode';";
//         echo "<script>alert(\"$remove_warranty_record\")</script>";
//         $run_delete = mysqli_query($Con,$remove_warranty_record);
//         if(!$run_delete){
//             echo "<script>alert(\"Failed to record disposal due to internal error!\")</script>";
//             exit();
//         }
//     }

//     //create a record in the disposal table
//     $insert_disposal = "INSERT INTO `disposal` (`disposedDate`, `disposedValue`, `asset_id`) VALUES ('$diposedDate', '$disposedAmount', '$assetCode');";
//     $run_insert = mysqli_query($Con,$insert_disposal);
//     if(!$run_insert){
//         echo "<script>alert(\"Failed to record disposal due to internal error!\")</script>";
//         exit();
//     }

//     echo "<script>alert(\"Asset disposal recorded successfully!\")</script>";
//     header("location: ../nonCurrentAssetInfo.php");
// }
// else{
//     header("location: ../nonCurrentAssetInfo.php");
//     exit(); 
// }