<?php include 'includes/verifier-inc.php'; ?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
      <title>Corrective Maintenance</title>
      <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script type="text/javascript">
         //Reloads the page after a set time interval in case the user is idle
         var idleTime = 0;
         $(document).ready(function () {
            var idleInterval = setInterval(timerIncrement, 60000); // 1 minute

            // Zero the idle timer on mouse movement.
            $(this).mousemove(function (e) {
                  idleTime = 0;
            });
            $(this).keypress(function (e) {
                  idleTime = 0;
            });
         });

         function timerIncrement() {
            idleTime = idleTime + 1;
            if (idleTime > 5) { // after 5 minutes
                  window.location.reload();
            }
         }
      </script>
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
               
               $get_pro = "SELECT WorkerReports.asset_id as 'Asset Code', NonCurrentAsset.assetType as 'Asset Name', workerreports.username as 'Reporter', WorkerReports.reported_date as 'Reported Date', NonCurrentAsset.plant as 'Plant', WorkerReports.criticality_machineOperations as 'Machine Criticality', WorkerReports.criticality_activityConstraints as 'Operational Bottleneck', WorkerReports.message as 'Description' from WorkerReports inner join NonCurrentAsset on WorkerReports.asset_id = NonCurrentAsset.asset_id inner join UserInfo on UserInfo.Username = WorkerReports.username where managerRespoded = 'true' and (performed = 0 or performed = null);";
               
               $run_pro = mysqli_query($Con,$get_pro);
               echo "<script>";
               echo "var records = [";
               while($row_pro = mysqli_fetch_array($run_pro)) {
                  $asset_id = $row_pro['Asset Code'];
                  $asset_type = $row_pro['Asset Name'];
                  $reporter = $row_pro['Reporter'];
                  $reportDate = $row_pro['Reported Date'];
                  $machineCritical = $row_pro['Machine Criticality'];
                  $operationCritical = $row_pro['Operational Bottleneck'];
                  $description = $row_pro['Description'];
                  
                  echo "{'asset_id': '$asset_id', 'asset_type': '$asset_type', 'reporter': '$reporter', 'reportDate': '$reportDate', 'machineCritical': '$machineCritical', 'operationCritical': '$operationCritical', 'description': '$description'},";
                  
               }
               echo "];";                  
               echo "</script>";                                
                                 
            ?>
               <div class="container-fluid">
                  <h3 class="text-dark mb-4">Corrective Maintenance</h3>
                  <div class="card shadow">
                     <div class="card-header py-3">
                        <p class="text-primary m-0 fw-bold">Corrective Maintenance</p>
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
                                    <th>Reporter</th>
                                    <th>Reported Date</th>
                                    <th>Machine Criticality</th>
                                    <th>Operational Bottleneck</th>
                                    <th>Description</th>
                                    <th>Performed</th>
                                 </tr>
                              </thead>                
                              
                              <tbody id="tableBody">
                              
                              </tbody>
                              <tfoot>
                                 <tr>
                                    <td><strong>Asset ID</strong></td>
                                    <td><strong>Asset Type</strong></td>
                                    <td><strong>Reporter</strong></td>
                                    <td><strong>Reported Date</strong></td>
                                    <td><strong>Machine Criticality</strong></td>
                                    <td><strong>Operational Bottleneck</strong></td>
                                    <td><strong>Description</strong></td>
                                    <td><strong>Performed</strong></td>
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
            var reporter = records[i].reporter.toLowerCase();

            if(assetId.includes(value) || assetType.includes(value) || reporter.includes(value)){
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
                        <td> ${records[i].reporter} </td>
                        <td> ${records[i].reportDate} </td>
                        <td> ${records[i].machineCritical} </td>
                        <td> ${records[i].operationCritical} </td>
                        <td> ${records[i].description} </td>
                        <td> <a href="nonCurrentAssetInfo.php?dispose=${records[i].asset_id}" type="button" class="btn btn-default" data-toggle="modal" data-target="#disposalModal" data-code="${records[i].asset_id}" data-type="${records[i].asset_type}" data-reporter="${records[i].reporter}" data-reportDate="${records[i].reportDate}" data-description="${records[i].description}">Performed</a></td>
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
                     <form action="includes/correctiveMaint-inc.php" method="POST">
                        <div class="form-group">
                           <label for="assetCode" class="col-form-label">Asset Code:</label>
                           <input type="text" class="form-control" id="assetCode" value="" name="assetCode" readonly="readonly">
                        </div>
                        <div class="form-group">
                           <label for="assetType" class="col-form-label">Asset Type:</label>
                           <input type="text" class="form-control" name="assetType" id="assetType" readonly="readonly"></input>
                        </div>
                        <div class="form-group">
                           <label for="reporter" class="col-form-label">Reporter:</label>
                           <input type="text" class="form-control" id="reporter" name="reporter" readonly="readonly">
                        </div>
                        <!-- <div class="form-group">
                           <label for="reportedDate" class="col-form-label">Reported Date:</label>
                           <input type="text" class="form-control" id="reportedDate" name="reportedDate" readonly="readonly">
                        </div> -->
                        <div class="form-group">
                           <label for="description" class="col-form-label">Description:</label>
                           <input type="text" class="form-control" id="description" name="description" readonly="readonly">
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
                        var reporter = button.data('reporter') // Extract info from data-* attributes
                        var reportDate = button.data('reportedDate') // Extract info from data-* attributes
                        var description = button.data('description')
                        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                        var modal = $(this)
                        modal.find('.modal-title').text('Preventive Maintenance on ' + recipient)
                        modal.find('.modal-body #assetCode').val(recipient)
                        modal.find('.modal-body #assetType').val(type)
                        modal.find('.modal-body #reporter').val(reporter)
                        //modal.find('.modal-body #reportedDate').val(reportDate)
                        modal.find('.modal-body #description').val(description)
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