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
               function calculateCarryingValue($method, float $rate, float $yearDiff, float $costOfPurchase){
                  $carryingVal = 0;
                  switch ($method) {
                     case 'straight-line':
                        $perYearDepre = ($rate / 100) * $costOfPurchase;
                        $carryingVal = $yearDiff * $perYearDepre;
                        if($carryingVal > $costOfPurchase){
                           $carryingVal = 'EOL';
                        }
                        break;
                     
                     case 'reducing-balance':
                        $carryingVal = $costOfPurchase;
                        for ($i=0; $i < $yearDiff; $i++) { 
                           $carryingVal = $carryingVal - (($rate/100) * $carryingVal);
                        }
                        break;
                  }
                  return $carryingVal;
               }
               $i = 0;
               
               $get_pro = "SELECT asset_id, assetType, lifetime, costOfPurchase, depreciationMethod, depreciationRate, date_format(now() , '%Y') - date_format(purchaseDate , '%Y') as 'yearDiff', manufacturer, serviceInterval FROM NonCurrentAsset where state != 'Disposed'";
               
               $run_pro = mysqli_query($Con,$get_pro);
               echo "<script>";
               echo "var records = [";
               while($row_pro = mysqli_fetch_array($run_pro)) {
                  $asset_id = $row_pro['asset_id'];
                  $asset_type = $row_pro['assetType'];
                  $lifetime = $row_pro['lifetime'];
                  $service_interval = $row_pro['serviceInterval'];
                  $depreciationMethod = $row_pro['depreciationMethod'];
                  $depreciationRate = $row_pro['depreciationRate'];
                  $yearDiff = $row_pro['yearDiff'];
                  $costOfPurchase = $row_pro['costOfPurchase'];
                  $manu = $row_pro['manufacturer'];
                  $carryingValue = calculateCarryingValue($depreciationMethod, floatval($depreciationRate), floatval($yearDiff), floatval($costOfPurchase));
                  
                  echo "{'asset_id': '$asset_id', 'asset_type': '$asset_type', 'life_time': '$lifetime', 'manu': '$manu', 'service_interval': '$service_interval', 'carrying_value': '$carryingValue'},";
                  
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
                                    <th>Life-time</th>
                                    <th>Manufacturer</th>
                                    <th>Service Interval</th>
                                    <th>Carrying Value</th>
                                    <th>Dispose</th>
                                 </tr>
                              </thead>                
                              
                              <tbody id="tableBody">
                              
                              </tbody>
                              <tfoot>
                                 <tr>
                                    <td><strong>Asset ID</strong></td>
                                    <td><strong>Asset Type</strong></td>
                                    <td><strong>Life-time</strong></td>
                                    <td><strong>Manufacturer</strong></td>
                                    <td><strong>Service Interval</strong></td>
                                    <td><strong>Carrying Value</strong></td>
                                    <td><strong>Dispose</strong></td>
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
            var lifeTime = records[i].life_time;
            var manu = records[i].manu.toLowerCase();
            var serviceInterval = records[i].service_interval;
            var lifeTime = records[i].carrying_value;

            if(assetId.includes(value) || assetType.includes(value) || manu.includes(value)){
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
                        <td> ${records[i].life_time} </td>
                        <td> ${records[i].manu} </td>
                        <td> ${records[i].service_interval} </td>
                        <td> ${records[i].carrying_value} </td>
                        <td> <a href="nonCurrentAssetInfo.php?dispose=${records[i].asset_id}" type="button" class="btn btn-default" data-toggle="modal" data-target="#disposalModal">Dispose</a></td>
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
                  <h5 class="modal-title" id="disposalModal">Dispose Asset</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
                  </div>
                  <div class="modal-body">

                  <!-- disposal asset form start -->
                  <form action="includes/dispose-inc.php" method="POST">
                     <div class="form-group">
                        <label for="assetCode" class="col-form-label">Asset Code:</label>
                        <input type="text" class="form-control" id="assetCode" value="assetCode" name="assetCode" disabled>
                     </div>
                     <div class="form-group">
                        <label for="disposedDate" class="col-form-label">Disposed Date:</label>
                        <input type="text" class="form-control" id="disposedDate" name="disposedDate">
                     </div>
                     <div class="form-group">
                        <label for="disposedAmount" class="col-form-label">Disposed Amount:</label>
                        <input type="text" class="form-control" id="disposedAmount" name="disposedAmount">
                     </div>
                  </form>
                  <!-- disposal asset form end -->

                  </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" name="dispose">Dispose</button>
                  </div>
                  <script>
                     $('#exampleModal').on('show.bs.modal', function (event) {
                        var button = $(event.relatedTarget) // Button that triggered the modal
                        var recipient = button.data('whatever') // Extract info from data-* attributes
                        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                        var modal = $(this)
                        modal.find('.modal-title').text('New message to ' + recipient)
                        modal.find('.modal-body input').val(recipient)
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