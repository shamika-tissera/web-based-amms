<?php include '../includes/verfier_worker-inc.php'; ?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
      <title>Corrective Maintenance Reports </title>
      <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
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
                  include '../includes/dbh-inc.php';               
                  $i = 0;
                  $uname = $_SESSION["username"];
                  $get_pro = "SELECT reported_date, workerreports.asset_id, assetType, message, managerRespoded, performed FROM `workerreports` INNER JOIN noncurrentasset ON workerreports.asset_id = noncurrentasset.asset_id WHERE username = '$uname';";
                  
                  $run_pro = mysqli_query($Con,$get_pro);
                  echo "<script>";
                  echo "var records = [";
                  while($row_pro = mysqli_fetch_array($run_pro)){
                    $asset_id = $row_pro['asset_id'];
                    $reported_date = $row_pro['reported_date'];
                    $assetType = $row_pro['assetType'];                  
                    $message = $row_pro['message'];  
                    $managerRespoded = $row_pro['managerRespoded'];
                    $performed = $row_pro['performed'];   
                    
                    echo "{'asset_id': '$asset_id', 'asset_type': '$assetType', 'reported_date': '$reported_date', 'message': '$message', 'managerRespoded': '$managerRespoded', 'performed': '$performed'},";

                  }     
                  echo "];";                  
                  echo "</script>";                                
                  ?>
               <div class="container-fluid">
                  <h3 class="text-dark mb-4">Corrective Maintenance Reports</h3>
                  <div class="card shadow">
                     <div class="card-header py-3">
                        <p class="text-primary m-0 fw-bold">Reports</p>
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
                                    <th>Asset Code</th>
                                    <th>Asset Type</th>
                                    <th>Reported Date</th>
                                    <th>Message</th>
                                    <th>Manager Response</th>
                                    <th>Performed</th>
                                 </tr>
                              </thead>
                              <tbody id="tableBody">
                              </tbody>
                              <tfoot>
                                 <tr>
                                    <td><strong>Asset Code</strong></td>
                                    <td><strong>Asset Type</strong></td>
                                    <td><strong>Reported Date</strong></td>
                                    <td><strong>Message</strong></td>
                                    <td><strong>Manager Response</strong></td>
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

            if(assetId.includes(value) || assetType.includes(value)){
                filteredInfo.push(records[i]);
            }
            
        }
        return filteredInfo;
    }

    function buildTable(records){
        let tableBody = document.getElementById("tableBody");
        tableBody.innerHTML = '';
        for (let i = 0; i < records.length; i++) {
            if(records[i].managerResponded === '1' && records[i].performed === '1'){
                var row = `<tr>
                        <td> ${records[i].asset_id} </td>
                        <td> ${records[i].asset_type} </td>
                        <td> ${records[i].reported_date} </td>
                        <td> ${records[i].message} </td>
                        <td> Approved </td>
                        <td> Performed </td>
                        </tr>`;
            }      
            else if(records[i].managerResponded === '1' && records[i].performed === '0'){
                var row = `<tr>
                        <td> ${records[i].asset_id} </td>
                        <td> ${records[i].asset_type} </td>
                        <td> ${records[i].reported_date} </td>
                        <td> ${records[i].message} </td>
                        <td> Approved </td>
                        <td> Not Performed </td>
                        </tr>`;
            }
            else if(records[i].performed === '1'){
                var row = `<tr>
                        <td> ${records[i].asset_id} </td>
                        <td> ${records[i].asset_type} </td>
                        <td> ${records[i].reported_date} </td>
                        <td> ${records[i].message} </td>
                        <td> Not approved </td>
                        <td> Performed </td>
                        </tr>`;
            }      
            else{
                var row = `<tr>
                        <td> ${records[i].asset_id} </td>
                        <td> ${records[i].asset_type} </td>
                        <td> ${records[i].reported_date} </td>
                        <td> ${records[i].message} </td>
                        <td> Approval Pending </td>
                        <td> Not Performed </td>
                        </tr>`;
            } 
            tableBody.innerHTML += row;
        }    
    }
            </script>
         </div>
         <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script><script src="../assets/js/script.min.js"></script>
   </body>
</html>