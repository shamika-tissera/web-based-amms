<?php include 'includes/verifier-inc.php'; ?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
      <title>Table - Brand</title>
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
               $i = 0;
               
               $get_pro = "SELECT asset_id, assetType, manufacturer, plant, serviceDue FROM NonCurrentAsset WHERE serviceDue <= DATE_ADD(NOW(), INTERVAL 2 MONTH) AND serviceDue >= DATE_ADD(NOW(), INTERVAL -3 MONTH) AND disposed = 0;";
               
               $run_pro = mysqli_query($Con,$get_pro);
               echo "<script>";
               echo "var records = [";
               while($row_pro = mysqli_fetch_array($run_pro)) {
                  $asset_id = $row_pro['asset_id'];
                  $asset_type = $row_pro['assetType'];
                  $manu = $row_pro['manufacturer'];
                  $plant = $row_pro['plant'];
                  $serviceDue = $row_pro['serviceDue'];
                  
                  echo "{'asset_id': '$asset_id', 'asset_type': '$asset_type', 'manu': '$manu', 'plant': '$plant', 'serviceDue': '$serviceDue'},";
                  
               }
               echo "];";                  
               echo "</script>";                                
                                 
            ?>
               <div class="container-fluid">
                  <h3 class="text-dark mb-4">Assets</h3>
                  <div class="card shadow">
                     <div class="card-header py-3">
                        <p class="text-primary m-0 fw-bold">Employee Info</p>
                     </div>
                     <div class="card-body">
                        <div class="row">
                           <div class="col-md-6 text-nowrap">
                              <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable">
                                 <label class="form-label">
                                    Show&nbsp;
                                    <select class="d-inline-block form-select form-select-sm">
                                       <option value="10" selected="">10</option>
                                       <option value="25">25</option>
                                       <option value="50">50</option>
                                       <option value="100">100</option>
                                    </select>
                                    &nbsp;
                                 </label>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="text-md-end dataTables_filter" id="dataTable_filter"><label class="form-label"><input type="search" class="form-control form-control-sm" id="searchInput" aria-controls="dataTable" placeholder="Search"></label></div>
                           </div>
                        </div>
                        <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                           <table class="table my-0" id="dataTable">
                              <thead>
                                 <tr>
                                    <th>Asset ID</th>
                                    <th>Asset Type</th>
                                    <th>Manufacturer</th>
                                    <th>Plant</th>
                                    <th>Service Due</th>
                                    <th>Performed</th>
                                 </tr>
                              </thead>                
                              
                              <tbody id="tableBody">
                              
                              </tbody>
                              <tfoot>
                                 <tr>
                                    <td><strong>Asset ID</strong></td>
                                    <td><strong>Asset Type</strong></td>
                                    <td><strong>Manufacturer</strong></td>
                                    <td><strong>Plant</strong></td>
                                    <td><strong>Service Due</strong></td>
                                    <td><strong>Performed</strong></td>
                                 </tr>
                              </tfoot>
                           </table>
                        </div>
                        <div class="row">
                           <div class="col-md-6 align-self-center">
                              <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing 1 to 10 of 27</p>
                           </div>
                           <div class="col-md-6">
                              <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                 <ul class="pagination">
                                    <li class="page-item disabled"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                                 </ul>
                              </nav>
                           </div>
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
            var assetId = records[i].asset_id.toLowerCase();
            var assetType = records[i].asset_type.toLowerCase();
            var manu = records[i].manu.toLowerCase();
            var plant = records[i].plant.toLowerCase();

            if(assetId.includes(value) || assetType.includes(value) || manu.includes(value) || plant.includes(value)){
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
                        <td> ${records[i].asset_id} </td>
                        <td> ${records[i].asset_type} </td>
                        <td> ${records[i].manu} </td>
                        <td> ${records[i].plant} </td>
                        <td> ${records[i].serviceDue} </td>
                        <td> <a href="nonCurrentAssetInfo.php?dispose=${records[i].asset_id}" type="button" class="btn btn-default" data-toggle="modal" data-target="#disposalModal" data-code="${records[i].asset_id}" data-type="${records[i].asset_type}" data-manu="${records[i].manu}" data-due="${records[i].serviceDue}">Performed</a></td>
                        </tr>`;
            tableBody.innerHTML += row;
        }    
    }
            </script>

            <!-- Modal Start -->
            <div class="modal fade" id="disposalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                  <h5 class="modal-title" id="disposalModalHead">Perform Preventive Maintenance</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
                  </div>                  

                  <!-- disposal asset form start -->
                  <div class="modal-body">
                     <form action="includes/preventiveMaint-inc.php" method="POST">
                        <div class="form-group">
                           <label for="assetCode" class="col-form-label">Asset Code:</label>
                           <input type="text" class="form-control" id="assetCode" value="" name="assetCode" readonly="readonly">
                        </div>
                        <div class="form-group">
                           <label for="assetType" class="col-form-label">Asset Type:</label>
                           <input type="text" class="form-control" name="assetType" id="assetType" readonly="readonly"></input>
                        </div>
                        <div class="form-group">
                           <label for="manufacturer" class="col-form-label">Manufacturer:</label>
                           <input type="text" class="form-control" id="manufacturer" name="manufacturer" readonly="readonly">
                        </div>
                        <div class="form-group">
                           <label for="serviceDue" class="col-form-label">Service Due:</label>
                           <input type="text" class="form-control" id="serviceDue" name="serviceDue" readonly="readonly">
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="submit">Confirm</button>
                        </div>
                     </form>
                  </div>
                  <!-- disposal asset form end -->                  
                  
                  <script>
                     $('#disposalModal').on('show.bs.modal', function (event) {
                        var button = $(event.relatedTarget) // Button that triggered the modal
                        var recipient = button.data('code') // Extract info from data-* attributes
                        var type = button.data('type') // Extract info from data-* attributes
                        var manu = button.data('manu') // Extract info from data-* attributes
                        var due = button.data('due') // Extract info from data-* attributes
                        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                        var modal = $(this)
                        modal.find('.modal-title').text('Preventive Maintenance on ' + recipient)
                        modal.find('.modal-body #assetCode').val(recipient)
                        modal.find('.modal-body #assetType').val(type)
                        modal.find('.modal-body #manufacturer').val(manu)
                        modal.find('.modal-body #serviceDue').val(due)
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