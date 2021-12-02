<?php include 'includes/verifier-inc.php'; ?>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
      <title>Disposal</title>
      <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
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
                  //echo "<script>alert(\"$method $rate $yearDiff \")</script>";
                  $carryingVal = 0;
                  switch ($method) {
                     case 'straight-line':
                        $perYearDepre = ($rate / 100) * $costOfPurchase;
                        $depreciation = $yearDiff * $perYearDepre;
                        $carryingVal = $costOfPurchase - $depreciation;
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
               
               $get_pro = "SELECT noncurrentasset.asset_id, assetType, lifetime, costOfPurchase, depreciationMethod, depreciationRate, date_format(now() , '%Y') - date_format(purchaseDate , '%Y') as 'yearDiff', TIMESTAMPDIFF(MONTH, purchaseDate, disposedDate) as utilizationMonths, manufacturer FROM NonCurrentAsset INNER JOIN disposal ON noncurrentasset.asset_id = disposal.asset_id WHERE disposed = 1;";
               
               $run_pro = mysqli_query($Con,$get_pro);
               echo "<script>";
               echo "var records = [";
               while($row_pro = mysqli_fetch_array($run_pro)) {
                  $asset_id = $row_pro['asset_id'];
                  $asset_type = $row_pro['assetType'];
                  $lifetime = $row_pro['lifetime'];
                  //$service_interval = $row_pro['serviceInterval'];
                  $depreciationMethod = $row_pro['depreciationMethod'];
                  $depreciationRate = $row_pro['depreciationRate'];
                  $yearDiff = $row_pro['yearDiff'];
                  $costOfPurchase = $row_pro['costOfPurchase'];
                  $manu = $row_pro['manufacturer'];
                  $utilizationMonths = $row_pro['utilizationMonths'];
                  $carryingValue = calculateCarryingValue($depreciationMethod, floatval($depreciationRate), floatval($yearDiff), floatval($costOfPurchase));
                  
                  echo "{'asset_id': '$asset_id', 'asset_type': '$asset_type', 'life_time': '$lifetime', 'manu': '$manu', 'carrying_value': '$carryingValue', 'utilizationMonths': '$utilizationMonths', 'cost': '$costOfPurchase'},";
                  
               }
               echo "];";                  
               echo "</script>";                                
                                 
            ?>
            <div class="container-fluid">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 fw-bold">Disposed Assets</p>
                    </div>
                    <div class="card-body" style="margin-left: auto; margin-right: auto;">
                    <canvas style=" height: 300px;" id="myChart" style="width:100%;max-width:1000px"></canvas>
                        <script>
                            var xValues = [];
                            var yValues = [];
                            for (let i = 0; i < records.length; i++) {
                                xValues[i] = records[i].asset_id;
                                yValues[i] = records[i].utilizationMonths;
                            }

                            var barColors = ["red", "green","blue","orange","brown"];

                            new Chart("myChart", {
                            type: "bar",
                            data: {
                                labels: xValues,
                                datasets: [{
                                backgroundColor: barColors,
                                data: yValues
                                }]
                            },
                            options: {
                                legend: {display: false},
                                title: {
                                display: true,
                                text: "Utilization by Asset Code"
                                }
                            }
                            });
                        </script>
                    </div>
                </div>
            </div>
            <br>
               <div class="container-fluid">
                  <h3 class="text-dark mb-4">Disposal</h3>
                  <div class="card shadow">
                     <div class="card-header py-3">
                        <p class="text-primary m-0 fw-bold">Disposed Assets</p>
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
                                    <th>Asset ID</th>
                                    <th>Asset Type</th>
                                    <th>Life-time</th>
                                    <th>Manufacturer</th>
                                    <th>Cost of Purchase</th>
                                    <th>Disposal Value</th>
                                    <th>Utilization (Months)</th>
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
                                    <td><strong>Cost of Purchase</strong></td>
                                    <td><strong>Disposal Value</strong></td>
                                    <td><strong>Utilization (Months)</strong></td>
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
                        <td> ${records[i].cost} </td>
                        <td> ${records[i].carrying_value} </td>
                        <td> ${records[i].utilizationMonths} </td>                        
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
                  <h5 class="modal-title" id="disposalModalHead">Dispose Asset</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
                  </div>                  

                  <!-- disposal asset form start -->
                  <div class="modal-body">
                     <form action="includes/dispose-inc.php" method="POST">
                        <div class="form-group">
                           <label for="assetCode" class="col-form-label">Asset Code:</label>
                           <input type="text" class="form-control" id="assetCode" value="" name="assetCode" readonly="readonly">
                        </div>
                        <div class="form-group">
                           <label for="disposedDate" class="col-form-label">Disposed Date:</label>
                           <input data-format="YYYY-MM-DD" type="date" class="form-control" name="disposedDate" id="disposedDate"></input>
                        </div>
                        <div class="form-group">
                           <label for="disposedAmount" class="col-form-label">Disposed Amount:</label>
                           <input type="text" class="form-control" id="disposedAmount" name="disposedAmount">
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="submit">Dispose</button>
                        </div>
                     </form>
                  </div>
                  <!-- disposal asset form end -->                  
                  
                  <script>
                     $('#disposalModal').on('show.bs.modal', function (event) {
                        var button = $(event.relatedTarget) // Button that triggered the modal
                        var recipient = button.data('code') // Extract info from data-* attributes
                        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                        var modal = $(this)
                        modal.find('.modal-title').text('Disposal of Asset: ' + recipient)
                        modal.find('.modal-body #assetCode').val(recipient)
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