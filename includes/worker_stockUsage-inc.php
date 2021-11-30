<?php
include 'dbh-inc.php';

if(isset($_POST["submit"])){
    $inventoryItem = $_POST["assetCode"];
    $usage = $_POST["usage"];
    if(empty($inventoryItem) || empty($usage)){
        header("location: ../Worker/index.php?error=incomplete");
        exit();
    }
    $sql_getCurrentLevel = "SELECT currentQuantity FROM inventoryitem WHERE inventoryName = '$inventoryItem'"; 
    $retrieved = mysqli_query($conn, $sql_getCurrentLevel);
    $currentLevel = (int)mysqli_fetch_array($retrieved)['currentQuantity'];

    if($usage > $currentLevel){
        $currentLevel = 0;
    }
    else{
        $currentLevel = $currentLevel - $usage;
    }

    $sql_update = "UPDATE inventoryitem SET currentQuantity = $currentLevel WHERE inventoryName = '$inventoryItem'";
    $run_update_table = mysqli_query($Con,$sql_update);
        if(!$run_update_table){
            echo "<script>alert(\"Failed to record usage due to an internal error!\")</script>";
            header("location: ../Worker/stockUsage.php");
            exit();
        }
        else{            
            header("location: ../Worker/index.php?status=success");
            exit();
        }
}
else{
    header("location: ../Worker/index.php");
    exit(); 
}