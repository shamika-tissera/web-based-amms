<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
      <title>Blank Page - Brand</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
               <div class="container-fluid">
                  <div class="card shadow">
                     <div class="card-header py-3">
                        <p class="text-primary m-0 fw-bold">Report</p>
                     </div>
                     <div class="card-body">
                        <div class="col-6 mx-auto">
                           <form action="">
                              <div class="row justify-content-center">
                                 <div class="form-group">
                                    <label for="assetCode">Asset Code<span class="text-danger">*</span></label><br>
                                    <select class="browser-default custom-select" id="assetCode" name="assetCode">
                                       <option selected="">Select an asset code...</option>
                                       <option value="1">One</option>
                                       <option value="2">Two</option>
                                       <option value="3">Three</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="row justify-content-center">
                                 <div class="form-group">
                                    <label for="assetType">Asset Type<span class="text-danger">*</span></label><br>
                                    <select class="browser-default custom-select" id="assetType" name="assetType">
                                       <option selected="">Select an asset type...</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="row justify-content-center">
                                 <div class="form-group">
                                    <label for="plant">Plant<span class="text-danger">*</span></label><br>
                                    <select class="browser-default custom-select" id="plant" name="plant">
                                       <option selected="">Select an asset code...</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="row justify-content-center">
                                 <div class="form-group">
                                    <label for="criticalityOperational">Criticality(Operational)<span class="text-danger">*</span></label><br>
                                    <select class="browser-default custom-select" id="criticalityOperational" name="criticalityOperational">
                                       <option selected="Low">Low</option>
                                       <option value="Moderate">Moderate</option>
                                       <option value="High">High</option>
                                       <option value="Extreme">Extreme</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="row justify-content-center">
                                 <div class="form-group">
                                    <label for="criticalityActivity">Criticality(Activity Constraint)<span class="text-danger">*</span></label><br>
                                    <select class="browser-default custom-select" id="criticalityActivity" name="criticalityActivity">
                                       <option selected="Low">Low</option>
                                       <option value="Moderate">Moderate</option>
                                       <option value="High">High</option>
                                       <option value="Extreme">Extreme</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="row justify-content-center">
                                 <div class="form-group">
                                    <label for="message">Message</label>
                                    <textarea class="form-control" id="message" rows="3"></textarea>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <?php include 'footer.php' ?>
         </div>
         <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script><script src="assets/js/script.min.js"></script>
   </body>
</html>