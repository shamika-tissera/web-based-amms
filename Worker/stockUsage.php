<?php
   include "../includes/verfier_worker-inc.php"
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
      <title>Blank Page - Brand</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="../assets/fonts/fontawesome5-overrides.min.css">
   </head>
   <body id="page-top">
      <div id="wrapper">
         <?php include 'sideNav.php' ?>
         <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
               <?php include 'headerNav.php' ?>
               <div class="container-fluid">
                  <div class="card shadow">
                     <div class="card-header py-3">
                        <p class="text-primary m-0 fw-bold">Usage</p>
                     </div>
                     <div class="card-body">
                        <div class="col-6 mx-auto">
                           <form method="POST" id="mainForm">
                              <div class="row justify-content-center">
                                 <div class="form-group">
                                    <label for="assetCode">Inventory Item<span class="text-danger">*</span></label><br>
                                    <select class="browser-default custom-select" id="assetCode" name="assetCode" onchange="changeItems();">
                                       <option selected="">Select the inventory item...</option>
                                       <?php
                                          include '../includes/dbh-inc.php';
                                          $sql_getCodes = "SELECT inventoryName FROM `inventoryitem`;";
                                          $run_pro = mysqli_query($Con,$sql_getCodes);
                                          while($row_pro = mysqli_fetch_array($run_pro)) {
                                             $inventoryName = $row_pro['inventoryName'];
                                             echo "<option value=\"$inventoryName\">$inventoryName</option>";
                                          }
                                       ?>                                       
                                    </select>                                    
                                 </div>
                                 <p id="assetCodeError" style="display: none; font-style: italic;" class="text-danger"></p>
                              </div>
                              <div class="row justify-content-center">
                                 <div class="form-group">
                                    <label for="assetType">Inventory Type<span class="text-danger">*</span></label><br>
                                    <input style="cursor:not-allowed;" type="text" class="form-control" id="assetType" name="assetType" readonly="readonly">
                                    <?php
                                          $get_pro = "SELECT inventoryName, inventoryType, currentQuantity, threshold FROM `inventoryitem`;";
               
                                          $run_pro = mysqli_query($Con,$get_pro);
                                          echo "<script>";
                                          echo "var records = [";
                                          while($row_pro = mysqli_fetch_array($run_pro)) {
                                             $inventoryName = $row_pro['inventoryName'];
                                             $inventoryType = $row_pro['inventoryType'];
                                             $currentQuantity = $row_pro['currentQuantity'];
                                             $threshold = $row_pro['threshold'];
                                             $plant = "Minuwangoda";
                                             
                                             echo "{'inventoryName': '$inventoryName', 'inventoryType': '$inventoryType', 'plant': '$plant', 'currentQuantity': '$currentQuantity', 'threshold': '$threshold'},";
                                             
                                          }
                                          echo "];";                  
                                          echo "</script>";      
                                       ?>
                                 </div>
                              </div>
                              <div class="row justify-content-center">
                                 <div class="form-group">
                                    <label for="plant">Plant<span class="text-danger">*</span></label><br>
                                    <input style="cursor:not-allowed;" type="text" class="form-control" id="plant" name="plant" readonly="readonly">
                                 </div>
                              </div>                              
                              <div class="row justify-content-center">                              
                              <div class="form-group">
                                    <label for="currentLevel">Current Level</label><br>
                                    <input type="text" class="form-control" id="currentLevel" name="currentLevel" readonly="readonly">
                              </div>
                              <div class="form-group">
                                    <label for="threshold">Threshold</label><br>
                                    <input type="text" class="form-control" id="threshold" name="threshold" readonly="readonly">
                              </div>
                              <div class="form-group">
                                    <label for="usage">Usage<span class="text-danger">*</span></label><br>
                                    <input type="number" class="form-control" id="usage" placeholder="Daily Usage" name="usage" maxlength="6" min="1" required>
                              </div>
                              <p id="usageError" style="display: none; font-style: italic;" class="text-danger"></p> 
                              <br>
                              <div class="row">
                                 <div class="d-flex col-5 justify-content-center">
                                    <button style="width: 100%;" type="submit" name="submit" class="btn btn-primary" id="submitBtn">Submit</button>
                                 </div>                                  
                              </div>
                              <?php
                                    if(isset($_GET["error"])){
                                       echo "<br/>";
                                       if($_GET["error"] == "incomplete"){
                                          echo "<p style=\"color:red\">Please submit all required information!</p>";
                                       }
                                    }
                                    if(isset($_GET["status"]) && $_GET["status"] == "success"){
                                        echo "<script>alert(\"Recorded successfully!\")</script>";
                                    }
                              ?>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <?php include 'footer.php' ?>
         </div>
         <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
      </div>
      <script>              
          
          $("#submitBtn").click(function(event){
            let assetCode = $('#assetCode').val();
            let usage = $("#usage").val();
            let isValid = true;
            if (assetCode === 'Select the inventory item...'){
                event.preventDefault(); //stops the default form action from occuring
                $("#assetCodeError").show();
                $("#assetCodeError").html("Please select an inventory item from the list...");
                isValid = false;
            }         
            if(usage === "" || isNaN(usage)){
                event.preventDefault();
                $("#usageError").show();
                $("#usageError").html("Please provide a valid value for usage...");
                isValid = false;
            }            
            if(isValid){
                $("#mainForm").attr('action', '../includes/worker_stockUsage-inc.php');
            }
          })
          $("#usage").keyup(function(event){
            let usage = $("#usage").val();
            if(usage === "" || isNaN(usage)){
                event.preventDefault();
                $("#usageError").show();
                $("#usageError").html("Please provide a valid value for usage...");
            }    
            else{
                $("#usageError").hide();
            } 
          })
          $("#assetCode").change(function(event){
            let assetCode = $('#assetCode').val();
            if (assetCode === 'Select the inventory item...'){
                $("#assetCodeError").show();
                $("#assetCodeError").html("Please select an inventory item from the list...");
            }
            else{
                $("#assetCodeError").hide();
            }      
          })
        

         function changeItems(){            
            let assetCode = document.getElementById("assetCode").value;
            let assetType = document.getElementById("assetType");
            let currentLevel = document.getElementById("currentLevel");
            let threshold = document.getElementById("threshold");
            let plant = document.getElementById("plant");
            assetType.value = "";
            plant.value = "";
            currentLevel.value = "";
            threshold.value = "";
            for (let i = 0; i < records.length; i++) {
               if(records[i].inventoryName == assetCode){
                  assetType.value = records[i].inventoryType;  
                  plant.value =  records[i].plant;
                  currentLevel.value = records[i].currentQuantity;  
                  threshold.value = records[i].threshold;               
                  break;
               }            
            }
         }
      </script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script><script src="../assets/js/script.min.js"></script>
   </body>
</html>