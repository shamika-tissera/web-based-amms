<?php require 'includes/verifier-inc.php'; 
$avatar = $_SESSION['avatar'];?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
      <title>Dashboard</title>
      <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
   </head>
   <body id="page-top">
      <div id="wrapper">

      <?php require 'sideNav.php' ?>

         <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">

            <?php require 'headerNav.php' ?>
            <?php require 'includes/dbh-inc.php' ?>

               <div class="container-fluid">
                  <div class="d-sm-flex justify-content-between align-items-center mb-4">
                     <h3 class="text-dark mb-0">Dashboard</h3>
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
                                 <div class="text-dark"><span><a href="lowInventoryNotif" class="link-secondary">More details...</a></span></div> 
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
                                          
                                       </div>
                                    </div>
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
                                    <?php
                                       $sql = "SELECT COUNT(*) FROM NonCurrentAsset WHERE serviceDue <= DATE_ADD(NOW(), INTERVAL 2 MONTH) AND serviceDue >= DATE_ADD(NOW(), INTERVAL -3 MONTH) AND disposed = 0;";
                                       $res = mysqli_query($conn, $sql);
                                       $preventiveMaint = mysqli_fetch_array($res)[0];
                                    ?>
                                    <div class="text-uppercase text-warning fw-bold text-xs mb-1"><span>Preventive maintenance</span></div>
                                    <div class="text-dark fw-bold h5 mb-0"><span><?php echo "$preventiveMaint"; ?></span></div>
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
                                    $sql = "SELECT COUNT(*) FROM inventoryorder INNER JOIN inventoryitem ON inventoryorder.inventoryCode = inventoryitem.inventoryCode INNER JOIN supplier ON inventoryorder.supplierID = supplier.supplierID WHERE received = 0;";
                                    $res = mysqli_query($conn, $sql);
                                    $orderCount = mysqli_fetch_array($res)[0];
                                 ?>
                                    <div class="text-uppercase text-warning fw-bold text-xs mb-1"><span>Pending Orders</span></div>
                                    <div class="text-dark fw-bold h5 mb-0"><span><?php echo "$orderCount"; ?></span></div>
                                 </div>
                                 <div class="col-auto"><i class="fas fa-business-time fa-2x text-gray-300"></i></div>
                              </div>
                              <br>
                              <div class="row align-items-center no-gutters">
                                 <div class="text-dark"><span><a href="inventoryOrders.php" class="link-secondary">More details...</a></span></div> 
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
                                       $supplier = array(); $count = array(); $i = 0;
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
               </div>
            </div>
            
            <?php include 'footer.php' ?>

         </div>
         <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script><script src="assets/js/script.min.js"></script>
   </body>
</html>