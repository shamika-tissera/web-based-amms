<?php include 'includes/verifier-inc.php'; ?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
      <title>Inventory</title>   
      <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   </head>
   <body id="page-top">
      <div id="wrapper">
         
      <?php include 'sideNav.php' ?>

         <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
               
            <?php include 'headerNav.php' ?>
            <?php
               include 'includes/dbh-inc.php';
            //    function calculateCarryingValue($method, float $rate, float $yearDiff, float $costOfPurchase){
            //       $carryingVal = 0;
            //       switch ($method) {
            //          case 'straight-line':
            //             $perYearDepre = ($rate / 100) * $costOfPurchase;
            //             $carryingVal = $yearDiff * $perYearDepre;
            //             if($carryingVal > $costOfPurchase){
            //                $carryingVal = 'EOL';
            //             }
            //             break;
                     
            //          case 'reducing-balance':
            //             $carryingVal = $costOfPurchase;
            //             for ($i=0; $i < $yearDiff; $i++) { 
            //                $carryingVal = $carryingVal - (($rate/100) * $carryingVal);
            //             }
            //             break;
            //       }
            //       return $carryingVal;
            //    }
               $i = 0;
               
               $get_pro = "SELECT `inventoryCode`, `inventoryName`, `inventoryType`, `threshold`, `currentQuantity` FROM `inventoryitem`";
               
               $run_pro = mysqli_query($Con,$get_pro);
               echo "<script>";
               echo "var records = [";
               while($row_pro = mysqli_fetch_array($run_pro)) {
                  $inventoryCode = $row_pro['inventoryCode'];
                  $inventoryName = $row_pro['inventoryName'];
                  $inventoryType = $row_pro['inventoryType'];
                  $threshold = $row_pro['threshold'];
                  $currentQuantity = $row_pro['currentQuantity'];                           
                  
                  echo "{'inventoryCode': '$inventoryCode', 'inventoryName': '$inventoryName', 'inventoryType': '$inventoryType', 'threshold': '$threshold', 'currentQuantity': '$currentQuantity'},";
                  
               }
               echo "];";                  
               echo "</script>";                                
                                 
            ?>
               <div class="container-fluid">
                  <h3 class="text-dark mb-4">Inventory</h3>
                  <div class="card shadow">
                     <div class="card-header py-3">
                        <p class="text-primary m-0 fw-bold">Inventory Items</p>
                     </div>
                     <div class="card-body">
                        <div class="row">
                           <div class="col-md-6 text-nowrap">
                           </div>
                           <div class="col-md-6">
                              <div class="text-md-end dataTables_filter" id="dataTable_filter"><label class="form-label"><input type="search" class="form-control form-control-sm" id="searchInput" aria-controls="dataTable" placeholder="Search"></label></div>
                           </div>
                        </div>
                        <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                           <table class="table my-0" id="dataTable">
                              <thead>
                                 <tr>
                                    <th>Inventory Code</th>
                                    <th>Inventory Name</th>
                                    <th>Inventory Type</th>
                                    <th>Threshold</th>
                                    <th>Current Quantity</th>  
                                    <th>Place Order</th>                                  
                                 </tr>
                              </thead>                
                              
                              <tbody id="tableBody">
                              
                              </tbody>
                              <tfoot>
                                 <tr>
                                    <td><strong>Inventory Code</strong></td>
                                    <td><strong>Inventory Name</strong></td>
                                    <td><strong>Inventory Type</strong></td>
                                    <td><strong>Threshold</strong></td>
                                    <td><strong>Current Quantity</strong></td>
                                    <td><strong>Place Order</strong></td>
                                 </tr>
                              </tfoot>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            
            <?php include 'footer.php' ?>

            <script>
   buildTable(records);
    $('#searchInput').on('keyup', function(){
        var value = $(this).val();
        console.log('value: ' + value);
        var filteredInfo = filterData(value);
        buildTable(filteredInfo);
    })

    function filterData(value){
        var filteredInfo = [];
        for (let i = 0; i < records.length; i++) {
            value = value.toLowerCase();
            var inventoryCode = records[i].inventoryCode.toLowerCase();
            var inventoryName = records[i].inventoryName.toLowerCase();
            var inventoryType = records[i].inventoryType.toLowerCase();            

            if(inventoryCode.includes(value) || inventoryName.includes(value) || inventoryType.includes(value)){
            filteredInfo.push(records[i]);
            }
            
        }
        return filteredInfo;
    }

    function buildTable(records){
        let tableBody = document.getElementById("tableBody");
        tableBody.innerHTML = '';
        for (let i = 0; i < records.length; i++) {
            var row = `<tr>
                        <td> ${records[i].inventoryCode} </td>
                        <td> ${records[i].inventoryName} </td>
                        <td> ${records[i].inventoryType} </td>
                        <td> ${records[i].threshold} </td>
                        <td> ${records[i].currentQuantity} </td>                        
                        <td> <a href="nonCurrentAssetInfo.php?dispose=${records[i].inventoryCode}" type="button" class="btn btn-default" data-toggle="modal" data-target="#inventoryOrderModal" data-code="${records[i].inventoryCode}">Order</a></td>
                        </tr>`;
            tableBody.innerHTML += row;
        }    
    }
            </script>

            <!-- Modal Start -->
            <div class="modal fade" id="inventoryOrderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                  <h5 class="modal-title" id="inventoryOrderModalHead">Place Order</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
                  </div>                  

                  <!-- Order Inventory form start -->
                  <div class="modal-body">
                     <form id="disposalSubmit">
                        <div class="form-group">
                           <label for="inventoryCode" class="col-form-label">Inventory Code:</label>
                           <input type="text" class="form-control" id="inventoryCode" value="" name="inventoryCode" readonly="readonly">
                        </div>
                        <div class="form-group">
                           <label for="due" class="col-form-label">Due by:</label>
                           <input data-format="YYYY-MM-DD" type="date" class="form-control" name="due" id="due"></input>
                        </div>
                        <div class="form-group">
                           <label for="quantity" class="col-form-label">Quantity:</label>
                           <input type="text" class="form-control" id="quantity" name="quantity">
                        </div>
                        <div class="form-group">
                           <label for="plant" class="col-form-label">Plant:</label>
                           <select class="form-select" id="plant" name="plant">
                              <option value="Minuwangoda">Minuwangoda</option>
                           </select>
                        </div>
                        <div class="form-group">
                           <label for="inCharge" class="col-form-label">In charge:</label>
                           <input type="text" class="form-control" id="inCharge" name="inCharge">
                        </div>
                        <div class="form-group">
                           <label for="supplier" class="col-form-label">Supplier:</label>
                           <div>
                           <select class="form-select" id="supplier" name="supplier">
                           <option selected="">Select supplier...</option>
                           <?php
                                include 'includes/dbh-inc.php';
                                $sql_supplier = "SELECT supplierID, supplierName FROM supplier";
                                $run_pro = mysqli_query($conn,$sql_supplier);
                                while($row_pro = mysqli_fetch_array($run_pro)) {
                                    $supplierID = $row_pro['supplierID'];
                                    $supplierName = $row_pro['supplierName'];
                                    echo "<option value=\"$supplierID\">$supplierName</option>";
                                }
                           ?>
                            </select>
                           </div>
                           <script>
                              $("#disposalSubmit").submit(function(event){
                                 let due = $("#due").val();
                                 let quantity = $("#quantity").val();
                                 let inCharge = $("#inCharge").val();
                                 let supplier = $("#supplier").val();
                                 if (due === "" || quantity === "" || inCharge === "" || supplier === "") {
                                    event.preventDefault();
                                    alert("Please complete all fields!");
                                 }
                                 else{
                                    $("#disposalSubmit").attr("method", "POST");
                                    $("#disposalSubmit").attr("action", "includes/orderInventory-inc.php");
                                 }
                              });
                           </script>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="submit">Order</button>
                        </div>
                     </form>
                  </div>
                  <!-- Order Inventory form end -->                  
                  
                  <script>
                     $('#inventoryOrderModal').on('show.bs.modal', function (event) {
                        var button = $(event.relatedTarget) // Button that triggered the modal
                        var recipient = button.data('code') // Extract info from data-* attributes
                        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                        var modal = $(this)
                        modal.find('.modal-title').text('Disposal of Asset: ' + recipient)
                        modal.find('.modal-body #inventoryCode').val(recipient)
                  })
                  </script>
               </div>
            </div>
         </div>
         <!-- Modal End -->

         </div>
         <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script><script src="assets/js/script.min.js"></script>
   </body>
</html>