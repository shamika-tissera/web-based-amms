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
               
               $get_pro = "SELECT orderTime, inventoryName, orderedQuantity, responsiblePerson,supplierName, DATE_FORMAT(orderTime, '%d/%m/%Y') AS 'orderDate', DATE_FORMAT(dueDate, '%d/%m/%Y') AS 'dueDate' FROM inventoryorder INNER JOIN inventoryitem ON inventoryorder.inventoryCode = inventoryitem.inventoryCode INNER JOIN supplier ON inventoryorder.supplierID = supplier.supplierID WHERE received = 0;";
               
               $run_pro = mysqli_query($Con,$get_pro);
               echo "<script>";
               echo "var records = [";
               while($row_pro = mysqli_fetch_array($run_pro)) {
                  $orderTime = $row_pro['orderTime'];                  
                  $inventoryName = $row_pro['inventoryName'];
                  $orderedQuantity = $row_pro['orderedQuantity'];
                  $responsiblePerson = $row_pro['responsiblePerson'];
                  $supplierName = $row_pro['supplierName'];
                  $orderDate = $row_pro['orderDate'];     
                  $dueDate = $row_pro['dueDate'];                           
                  
                  echo "{'dueDate': '$dueDate', 'orderTime': '$orderTime', 'inventoryName': '$inventoryName', 'orderedQuantity': '$orderedQuantity', 'responsiblePerson': '$responsiblePerson', 'supplierName': '$supplierName', 'orderDate': '$orderDate'},";
                  
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
                           <div class="col-md-6 text-nowrap"></div>
                           <div class="col-md-6">
                              <div class="text-md-end dataTables_filter" id="dataTable_filter"><label class="form-label"><input type="search" class="form-control form-control-sm" id="searchInput" aria-controls="dataTable" placeholder="Search"></label></div>
                           </div>
                        </div>
                        <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                           <table class="table my-0" id="dataTable">
                              <thead>
                                 <tr>
                                    <th>Inventory Name</th>
                                    <th>Ordered Quantity</th>
                                    <th>Responsible Person</th>
                                    <th>Supplier Name</th>
                                    <th>Order Date</th>  
                                    <th>Due Date</th>  
                                    <th>Received</th>                                  
                                 </tr>
                              </thead>                
                              
                              <tbody id="tableBody">
                              
                              </tbody>
                              <tfoot>
                                 <tr>
                                    <td><strong>Inventory Name</strong></td>
                                    <td><strong>Ordered Quantity</strong></td>
                                    <td><strong>Responsible Person</strong></td>
                                    <td><strong>Supplier Name</strong></td>
                                    <td><strong>Order Date</strong></td>
                                    <td><strong>Due Date</strong></td>
                                    <td><strong>Received</strong></td>
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
            var responsiblePerson = records[i].responsiblePerson.toLowerCase();
            var inventoryName = records[i].inventoryName.toLowerCase();
            var inventoryType = records[i].inventoryType.toLowerCase();
            var supplierName = records[i].supplierName.toLowerCase();            

            if(responsiblePerson.includes(value) || supplierName.includes(value) || inventoryName.includes(value) || inventoryType.includes(value)){
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
                        <td> ${records[i].inventoryName} </td>
                        <td> ${records[i].orderedQuantity} </td>
                        <td> ${records[i].responsiblePerson} </td>
                        <td> ${records[i].supplierName} </td>
                        <td> ${records[i].orderDate} </td>  
                        <td> ${records[i].dueDate} </td>                        
                        <td> <a href="nonCurrentAssetInfo.php?dispose=${records[i].orderTime}" type="button" class="btn btn-default" data-toggle="modal" data-target="#inventoryReception" data-code="${records[i].inventoryName}" data-due="${records[i].dueDate}" data-quantity="${records[i].orderedQuantity}" data-person="${records[i].responsiblePerson}" data-supplier="${records[i].supplierName}">Received</a></td>
                        </tr>`;
            tableBody.innerHTML += row;
        }    
    }
            </script>

            <!-- Modal Start -->
            <div class="modal fade" id="inventoryReception" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                  <h5 class="modal-title" id="inventoryReceptionHead">Place Order</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
                  </div>                  

                  <!-- Order Inventory form start -->
                  <div class="modal-body">
                     <form action="includes/receivedInventory-inc.php" method="POST">
                        <div class="form-group">
                           <label for="inventoryCode" class="col-form-label">Inventory Item:</label>
                           <input type="text" class="form-control" id="inventoryCode" value="" name="inventoryCode" readonly="readonly">
                        </div>
                        <div class="form-group">
                           <label for="supplier" class="col-form-label">Supplier:</label>
                           <input type="text" class="form-control" id="supplier" value="" name="supplier" readonly="readonly">
                        </div>
                        <div class="form-group">
                           <label for="due" class="col-form-label">Due by:</label>
                           <input type="text" class="form-control" name="due" id="due" readonly="readonly"></input>
                        </div>
                        <div class="form-group">
                           <label for="quantity" class="col-form-label">Quantity Requested:</label>
                           <input type="text" class="form-control" id="quantity" name="quantity" readonly="readonly">
                        </div>                        
                        <div class="form-group">
                           <label for="inCharge" class="col-form-label">In charge:</label>
                           <input type="text" class="form-control" id="inCharge" name="inCharge" readonly="readonly">
                        </div>
                        <div class="form-group">
                           <label for="receivedDate" class="col-form-label">Received On:</label>
                           <input data-format="YYYY-MM-DD" type="date" class="form-control" name="receivedDate" id="receivedDate"></input>
                        </div>
                        <div class="form-group">
                           <label for="receivedQuantity" class="col-form-label">Quantity Received:</label>
                           <input type="text" class="form-control" id="receivedQuantity" name="receivedQuantity">
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="submit">Received</button>
                        </div>
                     </form>
                  </div>
                  <!-- Order Inventory form end -->                  
                  
                  <script>
                     $('#inventoryReception').on('show.bs.modal', function (event) {
                        var button = $(event.relatedTarget) // Button that triggered the modal
                        var recipient = button.data('code') // Extract info from data-* attributes
                        var due = button.data('due');
                        var quantity = button.data('quantity');
                        var person = button.data('person');
                        var supplier = button.data('supplier');
                        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                        var modal = $(this)
                        modal.find('.modal-title').text('Received items for: ' + recipient)
                        modal.find('.modal-body #inventoryCode').val(recipient)
                        modal.find('.modal-body #inCharge').val(person);
                        modal.find('.modal-body #due').val(due);
                        modal.find('.modal-body #receivedQuantity').val(quantity);
                        modal.find('.modal-body #quantity').val(quantity);
                        modal.find('.modal-body #supplier').val(supplier);
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