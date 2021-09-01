<?php
include 'dbh-inc.php';

if(isset($_POST["submit"])){
    
    $inventoryItem = $_POST["inventoryCode"];
    $due = $_POST["due"];
    $quantity = $_POST["quantity"];  
    $receivedDate = $_POST["receivedDate"]; 
    $receivedQuantity = $_POST["receivedQuantity"];  
    $inCharge = $_POST["inCharge"];  
    $supplier = $_POST["supplier"];   

    if(empty($inventoryItem) || empty($quantity) || empty($receivedDate) || empty($receivedQuantity) || empty($supplier)){
        // echo "<script>alert(\"When disposing asset, all information is required. Failed to record disposal!\")</script>";
        // exit();
    }
    $get_data = "SELECT inventoryCode FROM inventoryItem WHERE inventoryName = '$inventoryItem';";
    $retrieved = mysqli_query($conn, $get_data);
    $inventoryItem = mysqli_fetch_array($retrieved)['inventoryCode'];

    
    $get_supplier = "SELECT supplierID FROM supplier WHERE supplierName = '$supplier';";
    $retrieved = mysqli_query($conn, $get_supplier);
    $supplierID = mysqli_fetch_array($retrieved)['supplierID'];
    

    $dueDate = date_create(str_replace("/","-",$due));  
    $due = date_format($dueDate,"Y-m-d");
    //Remove record from non current asset
    $update_table = "UPDATE `inventoryorder` SET received = 1 " . 
                    "WHERE supplierID = '$supplierID' AND plant = 'Minuwangoda' AND dueDate = '$due' AND inventoryCode = '$inventoryItem' AND responsiblePerson = '$inCharge' AND orderedQuantity = $quantity;";    
    //echo "<script>alert(\"$update_table\")</script>";
    $run_update_table = mysqli_query($Con,$update_table);
    if(!$run_update_table){
        echo "<script>alert(\"Failed to record disposal due to internal error!\")</script>";
        header("location: ../inventoryOrders.php");
        exit();
    }
    else{
        $sql_update = "UPDATE inventoryitem SET currentQuantity = currentQuantity + $receivedQuantity WHERE inventoryCode = '$inventoryItem';";
        $run_update_table = mysqli_query($Con,$sql_update);
        if(!$run_update_table){
            echo "<script>alert(\"Failed to record disposal due to internal error!\")</script>";
            header("location: ../inventoryOrders.php");
            exit();
        }
        else{            
            header("location: ../inventoryOrders.php");
            echo "<script>alert(\"Recorded Successfully!\")</script>";
        }        
    }
}
else{
    header("location: ../inventoryOrders.php");
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