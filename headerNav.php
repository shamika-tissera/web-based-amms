<?php
   if (!isset($_SESSION["username"])) {
      // header("location:login.php");
      // exit();
   }
   if(isset($_SESSION['firstname'])){
      $fname = $_SESSION['firstname'];
   }
   if(isset($_SESSION['lastname'])){
      $lname = $_SESSION['lastname'];
   }
   if(isset($_SESSION['username'])){
      $uname = $_SESSION['username'];
   }
   if(isset($_SESSION['avatar'])){
      $avatar = $_SESSION['avatar'];
   }
?>
<nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                  <div class="container-fluid">
                     <button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                     <form class="d-none d-sm-inline-block me-auto ms-md-1 my-2 my-md-0 mw-100 navbar-search">
                        <h6 class="text-center small text-gray-500">Asset and Maintenance Management System</h6>
                     </form>
                     <ul class="navbar-nav flex-nowrap ms-auto">
                        <li class="nav-item dropdown d-sm-none no-arrow">
                           <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><i class="fas fa-search"></i></a>
                           <div class="dropdown-menu dropdown-menu-end p-3 animated--grow-in" aria-labelledby="searchDropdown">
                              <form class="me-auto navbar-search w-100">
                                 <div class="input-group">
                                    <input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                                    <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                                 </div>
                              </form>
                           </div>
                        </li>

                        <!-- Alerts Start-->
                        <?php
                              /*
                              * PRIORITY
                              * ========
                              * 
                              *  1. Low Inventory
                              *  2. Maintenance Backlog
                              *  3. Upcoming Maintenance Dates
                              */
                              include "includes/dbh-inc.php";
                              $queryInventory = "SELECT inventoryName AS 'Inventory Name', threshold - currentQuantity as 'Varience' FROM InventoryItem WHERE currentQuantity < threshold order by (threshold - currentQuantity) desc;";
                              $queryBacklog = "SELECT asset_id as 'Asset ID', serviceDue as 'Service Due', DATEDIFF(NOW(), serviceDue) as 'Delay' from NonCurrentAsset where DATEDIFF(NOW(), serviceDue) > 0  and DATEDIFF(NOW(), serviceDue) <= 90;";
                              $queryServiceDue = "SELECT asset_id as 'Asset Code', serviceDue as 'Due by' from NonCurrentAsset where serviceDue <= DATE_ADD(NOW(), interval 2 month) and serviceDue > NOW();";
                              
                              $inventory = array();
                              $backlog = array();
                              $serviceDue = array();

                              $run_pro = mysqli_query($Con,$queryInventory);
                              while($row_pro = mysqli_fetch_array($run_pro)) {
                                 array_push($inventory, $row_pro);
                              }

                              $run_pro = mysqli_query($Con,$queryBacklog);
                              while($row_pro = mysqli_fetch_array($run_pro)) {
                                 array_push($backlog, $row_pro);
                              }

                              $run_pro = mysqli_query($Con,$queryServiceDue);
                              while($row_pro = mysqli_fetch_array($run_pro)) {
                                 array_push($serviceDue, $row_pro);
                              }
                              $count = 0;
                              if(sizeof($inventory) > 0){
                                 $count = $count + 1;
                              }  
                              if(sizeof($backlog) > 0){
                                 $count = $count + 1;
                              }
                              if(sizeof($serviceDue) > 0){
                                 $count = $count + 1;
                              }                            
                        ?>
                        <li class="nav-item dropdown no-arrow mx-1">
                           <div class="nav-item dropdown no-arrow">
                              <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="badge bg-danger badge-counter"><?php echo "$count"; ?></span><i class="fas fa-bell fa-fw"></i></a>
                              <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
                                 <h6 class="dropdown-header">alerts center</h6>
                                 <a class="dropdown-item d-flex align-items-center" href="lowInventoryNotif.php">
                                    <div class="me-3">
                                       <div class="bg-primary icon-circle"><i class="fas fa-file-alt text-white"></i></div>
                                    </div>
                                    <div>
                                       <?php
                                          if(sizeof($inventory) > 0){
                                             $num = sizeof($inventory);
                                             echo "<span class=\"small text-gray-500\">Low Inventory</span>";
                                             echo "<p>$num inventory item(s) needs your attention!</p>";
                                          }
                                          else if(sizeof($backlog) > 0){
                                             $num = sizeof($backlog);
                                             echo "<span class=\"small text-gray-500\">Backlog</span>";
                                             echo "<p>Maintenance activities for $num is past due!</p>";
                                          }
                                          else{
                                             $num = sizeof($serviceDue);
                                             echo "<span class=\"small text-gray-500\">Upcoming Service Due</span>";
                                             echo "<p>Service due for $num assets during the next 2 months!</p>";
                                          }                                          
                                       ?>                                       
                                    </div>
                                 </a>
                                 <a class="dropdown-item d-flex align-items-center" href="backlog.php">
                                    <div class="me-3">
                                       <div class="bg-success icon-circle"><i class="fas fa-donate text-white"></i></div>
                                    </div>
                                    <div>
                                    <?php
                                          if(sizeof($backlog) > 0){
                                             $num = sizeof($backlog);
                                             echo "<span class=\"small text-gray-500\">Backlog</span>";
                                             echo "<p>Maintenance activities for $num is past due!</p>";
                                          }
                                          else{
                                             $num = sizeof($serviceDue);
                                             echo "<span class=\"small text-gray-500\">Upcoming Service Due</span>";
                                             echo "<p>Service due for $num assets during the next 2 months!</p>";
                                          }                                                    
                                       ?>  
                                    </div>
                                 </a>
                                 <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="me-3">
                                       <div class="bg-warning icon-circle"><i class="fas fa-exclamation-triangle text-white"></i></div>
                                    </div>
                                    <div>
                                    <?php
                                          if(sizeof($serviceDue) > 0){
                                             $num = sizeof($serviceDue);
                                             echo "<span class=\"small text-gray-500\">Upcoming Service Due</span>";
                                             echo "<p>Service due for $num assets during the next 2 months!</p>";
                                          }                                                 
                                       ?>
                                    </div>
                                 </a>
                                 
                              </div>
                           </div>
                        </li>
                        <!-- Alerts End -->

                        <li class="nav-item dropdown no-arrow mx-1">
                           <div class="nav-item dropdown no-arrow">
                              
                              <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
                                 <h6 class="dropdown-header">alerts center</h6>
                                 <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image me-3">
                                       <img class="rounded-circle" src="assets/img/avatars/avatar4.jpeg">
                                       <div class="bg-success status-indicator"></div>
                                    </div>
                                    <div class="fw-bold">
                                       <div class="text-truncate"><span>Hi there! I am wondering if you can help me with a problem I've been having.</span></div>
                                       <p class="small text-gray-500 mb-0">Emily Fowler - 58m</p>
                                    </div>
                                 </a>
                                 <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image me-3">
                                       <img class="rounded-circle" src="assets/img/avatars/avatar2.jpeg">
                                       <div class="status-indicator"></div>
                                    </div>
                                    <div class="fw-bold">
                                       <div class="text-truncate"><span>I have the photos that you ordered last month!</span></div>
                                       <p class="small text-gray-500 mb-0">Jae Chun - 1d</p>
                                    </div>
                                 </a>
                                 <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image me-3">
                                       <img class="rounded-circle" src="assets/img/avatars/avatar3.jpeg">
                                       <div class="bg-warning status-indicator"></div>
                                    </div>
                                    <div class="fw-bold">
                                       <div class="text-truncate"><span>Last month's report looks great, I am very happy with the progress so far, keep up the good work!</span></div>
                                       <p class="small text-gray-500 mb-0">Morgan Alvarez - 2d</p>
                                    </div>
                                 </a>
                                 <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image me-3">
                                       <img class="rounded-circle" src="assets/img/avatars/avatar5.jpeg">
                                       <div class="bg-success status-indicator"></div>
                                    </div>
                                    <div class="fw-bold">
                                       <div class="text-truncate"><span>Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</span></div>
                                       <p class="small text-gray-500 mb-0">Chicken the Dog · 2w</p>
                                    </div>
                                 </a>
                                 <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                              </div>
                           </div>
                           <div class="shadow dropdown-list dropdown-menu dropdown-menu-end" aria-labelledby="alertsDropdown"></div>
                        </li>
                        <div class="d-none d-sm-block topbar-divider"></div>
                        <li class="nav-item dropdown no-arrow">
                           <div class="nav-item dropdown no-arrow">
                              <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small"><?php echo "$fname" . " " . "$lname" ?></span><img class="border rounded-circle img-profile" <?php echo "src=\"$avatar\"";?>></a>
                              <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in">
                                 <a class="dropdown-item" href="#"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile</a><a class="dropdown-item" href="#"><i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Settings</a><a class="dropdown-item" href="#"><i class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Activity log</a>
                                 <div class="dropdown-divider"></div>
                                 <a class="dropdown-item" href="includes/logout-inc.php"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                              </div>
                           </div>
                        </li>
                     </ul>
                  </div>
               </nav>