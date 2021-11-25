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
                        <p class="text-primary m-0 fw-bold">Report</p>
                     </div>
                     <div class="card-body">
                        <div class="col-6 mx-auto">
                           <form id="mainForm" method="POST">
                              <div class="row justify-content-center">
                                 <div class="form-group">
                                    <label for="assetCode">Asset Code<span class="text-danger">*</span></label><br>
                                    <select class="browser-default custom-select" id="assetCode" name="assetCode" onchange="changeItems();">
                                       <option selected="">Select the asset code...</option>
                                       <?php
                                          include '../includes/dbh-inc.php';
                                          $sql_getCodes = "SELECT DISTINCT asset_id FROM `noncurrentasset` WHERE disposed = 0;";
                                          $run_pro = mysqli_query($Con,$sql_getCodes);
                                          while($row_pro = mysqli_fetch_array($run_pro)) {
                                             $asset_id = $row_pro['asset_id'];
                                             echo "<option value=\"$asset_id\">$asset_id</option>";
                                          }
                                       ?>                                       
                                    </select>
                                 </div>
                              </div>
                              <div class="row justify-content-center">
                                 <div class="form-group">
                                    <label for="assetType">Asset Type<span class="text-danger">*</span></label><br>
                                    <input style="cursor:not-allowed;" type="text" class="form-control" id="assetType" name="assetType" readonly="readonly">
                                    <?php
                                          $get_pro = "SELECT asset_id, assetType, plant FROM NonCurrentAsset WHERE disposed = 0";
               
                                          $run_pro = mysqli_query($Con,$get_pro);
                                          echo "<script>";
                                          echo "var records = [";
                                          while($row_pro = mysqli_fetch_array($run_pro)) {
                                             $asset_id = $row_pro['asset_id'];
                                             $assetType = $row_pro['assetType'];
                                             $plant = $row_pro['plant'];
                                             
                                             echo "{'asset_id': '$asset_id', 'assetType': '$assetType', 'plant': '$plant'},";
                                             
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
                                    <label for="criticalityOperational">Criticality(Operational)<span class="text-danger">*</span></label><br>
                                    <select class="browser-default custom-select" id="criticalityOperational" name="criticalityOperational">
                                       <option selected="Low">Low</option>
                                       <option value="Moderate">Moderate</option>
                                       <option value="High">High</option>
                                       <option value="Extreme">Extreme</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="row justify-content-center">
                                 <div class="form-group">
                                    <label for="criticalityActivity">Criticality(Activity Constraint)<span class="text-danger">*</span></label><br>
                                    <select class="browser-default custom-select" id="criticalityActivity" name="criticalityActivity">
                                       <option selected="Low">Low</option>
                                       <option value="Moderate">Moderate</option>
                                       <option value="High">High</option>
                                       <option value="Extreme">Extreme</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="row justify-content-center">
                                 <div class="form-group">
                                    <label for="message">Message</label>
                                    <textarea class="form-control" id="message" rows="3" name="message"></textarea>
                                 </div>
                              </div>
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
            //let assetCode = $('#assetCode').val();
            //let usage = $("#usage").val();
            $("#mainForm").attr('action', '../includes/worker_equipmentErrorReporting-inc.php');
            let isValid = true;
            if (assetCode === 'Select the asset code...'){
                event.preventDefault(); //stops the default form action from occuring
                //$("#assetCodeError").show();
                //$("#assetCodeError").html("Please select an inventory item from the list...");
                isValid = false;
            }         
            if(usage === "" || isNaN(usage)){
                event.preventDefault();
                //$("#usageError").show();
                //$("#usageError").html("Please provide a valid value for usage...");
                isValid = false;
            }            
            if(isValid){
                $("#mainForm").attr('action', '../includes/worker_equipmentErrorReporting-inc.php');
            }
          })

         function changeItems(){            
            let assetCode = document.getElementById("assetCode").value;
            let assetType = document.getElementById("assetType");
            let plant = document.getElementById("plant");
            assetType.value = "";
            for (let i = 0; i < records.length; i++) {
               if(records[i].asset_id == assetCode){
                  assetType.value = records[i].assetType;  
                  plant.value =  records[i].plant;                 
                  break;
               }            
               debugger;   
            }
         }
      </script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script><script src="../assets/js/script.min.js"></script>
   </body>
</html>