<?php include 'includes/verifier-inc.php'; ?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
      <title>Dashboard - Brand</title>
      <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
   </head>
   <body id="page-top">
      <div id="wrapper">

      <?php include 'sideNav.php' ?>

         <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">

            <?php include 'headerNav.php' ?>
            <?php include 'includes/dbh-inc.php' ?>

               <div class="container-fluid">
                  <div class="d-sm-flex justify-content-between align-items-center mb-4">
                     <h3 class="text-dark mb-0">Dashboard</h3>
                     <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="#"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generate Report</a>
                  </div>
                  <div class="row">
                     <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-start-primary py-2">
                           <div class="card-body">
                              <div class="row align-items-center no-gutters">
                                 <div class="col me-2">
                                    <?php
                                       $sql = "SELECT COUNT(*) FROM inventoryorder WHERE received = 0;";
                                       $res = mysqli_query($conn, $sql);
                                       $pendingOrders = mysqli_fetch_array($res)[0];
                                    ?>
                                    <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Orders pending</span></div>
                                    <div class="text-dark fw-bold h5 mb-0"><span><?php echo "$pendingOrders"; ?></span></div>
                                 </div>
                                 <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                              </div>
                              <br>
                              <div class="row align-items-center no-gutters">
                                 <div class="text-dark"><span><a href="inventoryOrders.php" class="link-secondary">More details...</a></span></div> 
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-start-primary py-2">
                           <div class="card-body">
                              <div class="row align-items-center no-gutters">
                                 <div class="col me-2">
                                    <?php
                                       $sql = "SELECT COUNT(*) FROM NonCurrentAsset WHERE DATEDIFF(NOW(), serviceDue) > 0 AND DATEDIFF(NOW(), serviceDue) <= 90;";
                                       $res = mysqli_query($conn, $sql);
                                       $backlog = mysqli_fetch_array($res)[0];
                                    ?>
                                    <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Backlog</span></div>
                                    <div class="text-dark fw-bold h5 mb-0"><span><?php echo "$backlog"; ?></span></div>
                                 </div>
                                 <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                              </div>
                              <br>
                              <div class="row align-items-center no-gutters">
                                 <div class="text-dark"><span><a href="backlog.php" class="link-secondary">More details...</a></span></div> 
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-start-success py-2">
                           <div class="card-body">
                              <div class="row align-items-center no-gutters">
                                 <div class="col me-2">
                                    <?php
                                       $sql = "SELECT COUNT(*) FROM InventoryItem WHERE currentQuantity < threshold;";
                                       $res = mysqli_query($conn, $sql);
                                       $lowStocks = mysqli_fetch_array($res)[0];
                                    ?>
                                    <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Low stocks</span></div>
                                    <div class="text-dark fw-bold h5 mb-0"><span><?php echo "$lowStocks"; ?></span></div>
                                 </div>
                                 <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                              </div>
                              <br>
                              <div class="row align-items-center no-gutters">
                                 <div class="text-dark"><span><a href="inventoryLow.php" class="link-secondary">More details...</a></span></div> 
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-start-info py-2">
                           <div class="card-body">
                              <div class="row align-items-center no-gutters">
                                 <div class="col me-2">
                                    <div class="text-uppercase text-info fw-bold text-xs mb-1"><span>Corrective maintenance</span></div>
                                    <div class="row g-0 align-items-center">
                                       <div class="col-auto">
                                          <?php
                                             $sql = "SELECT COUNT(*) FROM workerreports WHERE performed = 0;";
                                             $res = mysqli_query($conn, $sql);
                                             $correctiveMaint = mysqli_fetch_array($res)[0];
                                          ?>
                                          <div class="text-dark fw-bold h5 mb-0 me-3"><span><?php echo "$correctiveMaint"; ?></span></div>
                                       </div>
                                       <div class="col">
                                          <div class="progress progress-sm">
                                             <div class="progress-bar bg-info" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"><span class="visually-hidden">50%</span></div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-auto"><i class="fas fa-clipboard-list fa-2x text-gray-300"></i></div>
                              </div>
                              <br>
                              <div class="row align-items-center no-gutters">
                                 <div class="text-dark"><span><a href="#" class="link-secondary">More details...</a></span></div> 
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-start-warning py-2">
                           <div class="card-body">
                              <div class="row align-items-center no-gutters">
                                 <div class="col me-2">
                                    <?php
                                       $sql = "SELECT COUNT(*) FROM NonCurrentAsset WHERE serviceDue <= DATE_ADD(NOW(), INTERVAL 2 MONTH) AND serviceDue >= DATE_ADD(NOW(), INTERVAL -3 MONTH) AND disposed = 0;";
                                       $res = mysqli_query($conn, $sql);
                                       $preventiveMaint = mysqli_fetch_array($res)[0];
                                    ?>
                                    <div class="text-uppercase text-warning fw-bold text-xs mb-1"><span>Preventive maintenance</span></div>
                                    <div class="text-dark fw-bold h5 mb-0"><span><?php echo "$preventiveMaint"; ?></span></div>
                                 </div>
                                 <div class="col-auto"><i class="fas fa-comments fa-2x text-gray-300"></i></div>
                              </div>
                              <br>
                              <div class="row align-items-center no-gutters">
                                 <div class="text-dark"><span><a href="#" class="link-secondary">More details...</a></span></div> 
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-start-warning py-2">
                           <div class="card-body">
                              <div class="row align-items-center no-gutters">
                                 <div class="col me-2">
                                    <div class="text-uppercase text-warning fw-bold text-xs mb-1"><span>***Pending Orders</span></div>
                                    <div class="text-dark fw-bold h5 mb-0"><span>18</span></div>
                                 </div>
                                 <div class="col-auto"><i class="fas fa-comments fa-2x text-gray-300"></i></div>
                              </div>
                              <br>
                              <div class="row align-items-center no-gutters">
                                 <div class="text-dark"><span><a href="#" class="link-secondary">More details...</a></span></div> 
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- Start: Chart -->
                  <div class="row">
                     <div class="col-lg-7 col-xl-8">
                        <div class="card shadow mb-4">
                        <div class="card-header py-3">
                              <h6 class="text-primary fw-bold m-0">Stock Requests & Supplier Contacts</h6>
                           </div>
                           <div class="card-body">
                              <div class="row">

                                 <!-- Chart column for 'Most Contacted Suppliers' -->
                                 <div class="col">
                                    <p class="text-secondary m-0"><small>Top 3 Most Contacted Suppliers</small></p>
                                    <br/>
                                    <?php
                                       $sql_most_contacted = "SELECT Supplier.supplierName as 'Supplier Name', count(supplierName) as 'Count' from InventoryOrder inner join Supplier on InventoryOrder.supplierID = Supplier.supplierID group by supplierName order by count(supplierName) desc limit 3;";
                                       $run_pro = mysqli_query($Con,$sql_most_contacted);
                                       $supplier; $count; $i = 0;
                                       while($row_pro = mysqli_fetch_array($run_pro)) {
                                          $supplier[$i] = $row_pro['Supplier Name'];
                                          $count[$i] = $row_pro['Count'];
                                          $i = $i + 1;
                                       }
                                    ?>
                                    <div class="chart-area">
                                       <canvas data-bss-chart="{&quot;type&quot;:&quot;bar&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;<?php if(isset($supplier[0])){echo "$supplier[0]";} else{echo "";}  ?>&quot;,&quot;<?php if(isset($supplier[1])){echo "$supplier[1]";} else{echo "";} ?>&quot;,&quot;<?php if(isset($supplier[2])){echo "$supplier[2]";} else{echo "";} ?>&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;&quot;,&quot;backgroundColor&quot;:[&quot;#4e73df&quot;,&quot;#1cc88a&quot;,&quot;#36b9cc&quot;],&quot;borderColor&quot;:[&quot;#ffffff&quot;,&quot;#ffffff&quot;,&quot;#ffffff&quot;],&quot;data&quot;:[&quot;<?php if(isset($count[0])){echo "$count[0]";} else{echo "";} ?>&quot;,&quot;<?php if(isset($count[1])){echo "$count[1]";} else{echo "";} ?>&quot;,&quot;<?php if(isset($count[2])){echo "$count[2]";} else{echo "";} ?>&quot;]}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:false,&quot;legend&quot;:{&quot;display&quot;:false,&quot;labels&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;}},&quot;title&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;}}}"></canvas>
                                    </div>
                                 </div>

                                 <!-- Chart column for 'Most Requested Stocks' -->
                                 <div class="col">
                                    <p class="text-secondary m-0"><small>Top 3 Most Requested Stocks</small></p>
                                    <br/>
                                    <?php
                                       $sql_most_requested = "SELECT InventoryItem.inventoryName as 'Stock Name', count(InventoryItem.inventoryName) as 'Count' from InventoryOrder inner join InventoryItem on InventoryOrder.inventoryCode = InventoryItem.inventoryCode group by InventoryItem.inventoryName order by count(InventoryItem.inventoryName) desc limit 3";
                                       $run_pro = mysqli_query($Con,$sql_most_requested);
                                       $stock; $count; $i = 0;
                                       while($row_pro = mysqli_fetch_array($run_pro)) {
                                          $stock[$i] = $row_pro['Stock Name'];
                                          $count[$i] = $row_pro['Count'];
                                          $i = $i + 1;
                                       }
                                    ?>
                                    <div class="chart-area">
                                       <canvas data-bss-chart="{&quot;type&quot;:&quot;bar&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;<?php if(isset($stock[0])){echo "$stock[0]";} else{echo "";}  ?>&quot;,&quot;<?php if(isset($stock[1])){echo "$stock[1]";} else{echo "";}  ?>&quot;,&quot;<?php if(isset($stock[2])){echo "$stock[2]";} else{echo "";}  ?>&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;&quot;,&quot;backgroundColor&quot;:[&quot;#4e73df&quot;,&quot;#1cc88a&quot;,&quot;#36b9cc&quot;],&quot;borderColor&quot;:[&quot;#ffffff&quot;,&quot;#ffffff&quot;,&quot;#ffffff&quot;],&quot;data&quot;:[&quot;<?php if(isset($count[0])){echo "$count[0]";} else{echo "";}  ?>&quot;,&quot;<?php if(isset($count[1])){echo "$count[1]";} else{echo "";}  ?>&quot;,&quot;<?php if(isset($count[2])){echo "$count[2]";} else{echo "";}  ?>&quot;]}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:false,&quot;legend&quot;:{&quot;display&quot;:false,&quot;labels&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;}},&quot;title&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;}}}"></canvas>
                                    </div>
                                 </div>
                              </div>                              
                           </div>
                        </div>
                     </div>

                     <!-- Item Warranty Chart -->
                     <div class="col-lg-5 col-xl-4">
                        <div class="card shadow mb-4">
                        <div class="card-header py-3">
                              <h6 class="text-primary fw-bold m-0">Warranty</h6>
                           </div>
                           <div class="card-body">
                              <div class="chart-area">
                                 <?php
                                    $sql_active = "SELECT COUNT(*) FROM NonCurrentAsset INNER JOIN Warranty ON NonCurrentAsset.warrantyCode = Warranty.warrantyCode WHERE endDate > Now();";
                                    $sql_notProvided = "SELECT COUNT(*) as 'COUNT' FROM NonCurrentAsset WHERE warrantyCode IS NULL;";
                                    $sql_expired = "SELECT (SELECT COUNT(*) as 'COUNT' FROM NonCurrentAsset) - (SELECT COUNT(*) FROM NonCurrentAsset INNER JOIN Warranty ON NonCurrentAsset.warrantyCode = Warranty.warrantyCode WHERE endDate > Now());";
                                    $res = mysqli_query($conn, $sql_active);
                                    $active = mysqli_fetch_array($res)[0];
                                    $res = mysqli_query($conn, $sql_notProvided);
                                    $notProvided = mysqli_fetch_array($res)[0];
                                    $res = mysqli_query($conn, $sql_expired);
                                    $expired = mysqli_fetch_array($res)[0];
                                 ?>
                                 <canvas data-bss-chart="{&quot;type&quot;:&quot;doughnut&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;Active&quot;,&quot;Inactive&quot;,&quot;Not Provided&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;&quot;,&quot;backgroundColor&quot;:[&quot;#4e73df&quot;,&quot;#1cc88a&quot;,&quot;#36b9cc&quot;],&quot;borderColor&quot;:[&quot;#ffffff&quot;,&quot;#ffffff&quot;,&quot;#ffffff&quot;],&quot;data&quot;:[&quot;<?php echo "$active" ?>&quot;,&quot;<?php echo "$expired" ?>&quot;,&quot;<?php echo "$notProvided" ?>&quot;]}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:false,&quot;legend&quot;:{&quot;display&quot;:false,&quot;labels&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;}},&quot;title&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;}}}"></canvas>
                              </div>
                              <div class="text-center small mt-4"><span class="me-2"><i class="fas fa-circle text-primary"></i>&nbsp;Active</span><span class="me-2"><i class="fas fa-circle text-success"></i>&nbsp;Inactive</span><span class="me-2"><i class="fas fa-circle text-info"></i>&nbsp;Not Provided</span></div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- End: Chart -->
                  <div class="row">
                     <div class="col-lg-6 mb-4">
                        <div class="card shadow mb-4">
                           <div class="card-header py-3">
                              <h6 class="text-primary fw-bold m-0">Projects</h6>
                           </div>
                           <div class="card-body">
                              <h4 class="small fw-bold">Server migration<span class="float-end">20%</span></h4>
                              <div class="progress mb-4">
                                 <div class="progress-bar bg-danger" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"><span class="visually-hidden">20%</span></div>
                              </div>
                              <h4 class="small fw-bold">Sales tracking<span class="float-end">40%</span></h4>
                              <div class="progress mb-4">
                                 <div class="progress-bar bg-warning" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;"><span class="visually-hidden">40%</span></div>
                              </div>
                              <h4 class="small fw-bold">Customer Database<span class="float-end">60%</span></h4>
                              <div class="progress mb-4">
                                 <div class="progress-bar bg-primary" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"><span class="visually-hidden">60%</span></div>
                              </div>
                              <h4 class="small fw-bold">Payout Details<span class="float-end">80%</span></h4>
                              <div class="progress mb-4">
                                 <div class="progress-bar bg-info" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"><span class="visually-hidden">80%</span></div>
                              </div>
                              <h4 class="small fw-bold">Account setup<span class="float-end">Complete!</span></h4>
                              <div class="progress mb-4">
                                 <div class="progress-bar bg-success" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"><span class="visually-hidden">100%</span></div>
                              </div>
                           </div>
                        </div>
                        <div class="card shadow mb-4">
                           <div class="card-header py-3">
                              <h6 class="text-primary fw-bold m-0">Todo List</h6>
                           </div>
                           <ul class="list-group list-group-flush">
                              <li class="list-group-item">
                                 <div class="row align-items-center no-gutters">
                                    <div class="col me-2">
                                       <h6 class="mb-0"><strong>Lunch meeting</strong></h6>
                                       <span class="text-xs">10:30 AM</span>
                                    </div>
                                    <div class="col-auto">
                                       <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-1"><label class="form-check-label" for="formCheck-1"></label></div>
                                    </div>
                                 </div>
                              </li>
                              <li class="list-group-item">
                                 <div class="row align-items-center no-gutters">
                                    <div class="col me-2">
                                       <h6 class="mb-0"><strong>Lunch meeting</strong></h6>
                                       <span class="text-xs">11:30 AM</span>
                                    </div>
                                    <div class="col-auto">
                                       <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-2"><label class="form-check-label" for="formCheck-2"></label></div>
                                    </div>
                                 </div>
                              </li>
                              <li class="list-group-item">
                                 <div class="row align-items-center no-gutters">
                                    <div class="col me-2">
                                       <h6 class="mb-0"><strong>Lunch meeting</strong></h6>
                                       <span class="text-xs">12:30 AM</span>
                                    </div>
                                    <div class="col-auto">
                                       <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-3"><label class="form-check-label" for="formCheck-3"></label></div>
                                    </div>
                                 </div>
                              </li>
                           </ul>
                        </div>
                     </div>
                     <div class="col">
                        <div class="row">
                           <div class="col-lg-6 mb-4">
                              <div class="card textwhite bg-primary text-white shadow">
                                 <div class="card-body">
                                    <p class="m-0">Primary</p>
                                    <p class="text-white-50 small m-0">#4e73df</p>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-6 mb-4">
                              <div class="card textwhite bg-success text-white shadow">
                                 <div class="card-body">
                                    <p class="m-0">Success</p>
                                    <p class="text-white-50 small m-0">#1cc88a</p>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-6 mb-4">
                              <div class="card textwhite bg-info text-white shadow">
                                 <div class="card-body">
                                    <p class="m-0">Info</p>
                                    <p class="text-white-50 small m-0">#36b9cc</p>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-6 mb-4">
                              <div class="card textwhite bg-warning text-white shadow">
                                 <div class="card-body">
                                    <p class="m-0">Warning</p>
                                    <p class="text-white-50 small m-0">#f6c23e</p>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-6 mb-4">
                              <div class="card textwhite bg-danger text-white shadow">
                                 <div class="card-body">
                                    <p class="m-0">Danger</p>
                                    <p class="text-white-50 small m-0">#e74a3b</p>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-6 mb-4">
                              <div class="card textwhite bg-secondary text-white shadow">
                                 <div class="card-body">
                                    <p class="m-0">Secondary</p>
                                    <p class="text-white-50 small m-0">#858796</p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            
            <?php include 'footer.php' ?>

         </div>
         <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script><script src="assets/js/script.min.js"></script>
   </body>
</html>