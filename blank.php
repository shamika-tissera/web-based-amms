<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
      <title>Blank Page - Brand</title>
      <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
   </head>
   <body id="page-top">
      <div id="wrapper">
         
         <?php include 'sideNav.php' ?>

         <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
            
               <?php include 'headerNav.php' ?>

               <div class="container-fluid">
                  <h3 class="text-dark mb-1">Add Asset</h3>
                  <div style="margin-top: 25px;" class="card shadow">
                     <div class="card-header py-3">
                        <p class="text-primary m-0 fw-bold">Add Asset</p>
                     </div>
                     <div class="card-body">
                     <form action="includes/nonCurrentAssetForm-inc.php" method="POST">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="asset_type">Asset Type<span class="text-danger">*</span></label><br>
                    <select class="browser-default custom-select" id="asset_type" name="asset_type">
                        <option selected="">Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="assetCode">Asset Code<span class="text-danger">*</span></label><br>
                    <input type="text" class="form-control" id="assetCode" placeholder="Enter asset code" name="assetCode">
                </div>
            </div>
        </div>   
        
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="manufacturer">Manufacturer<span class="text-danger">*</span></label><br>
                    <select class="browser-default custom-select" id="manufacturer" name="manufacturer">
                        <option selected="">Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="serialNo">Serial Number</label><br>
                    <input type="text" class="form-control" id="serialNo" placeholder="Enter serial number" name="serialNo">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="supplier">Supplier<span class="text-danger">*</span></label><br>
                    <select class="browser-default custom-select" id="supplier" name="supplier">
                        <option selected="">Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="state">State<span class="text-danger">*</span></label><br>
                    <select class="browser-default custom-select" id="state" name="state">
                        <option selected="In use">In use</option>
                        <option value="In Stock">In Stock</option>
                        <option value="Under Maintenance">Under Maintenance</option>
                        <option value="Disposed">Disposed</option>
                    </select>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="invoice">Invoice Number</label><br>
                    <input type="text" class="form-control" id="invoice" placeholder="Enter invoice number" name="invoice">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="price">Purchase Price&nbsp;/&nbsp;Current value<span class="text-danger">*</span></label><br>
                    <input type="text" class="form-control" id="price" placeholder="***validation" name="price">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="depreBegin">Depreciation Start<span class="text-danger">*</span></label><br>
                    <div class="input-group date">
                        <input type="date" class="form-control" id="depreBegin" name="depreBegin">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="lifetime">Lifetime (Years)<span class="text-danger">*</span></label><br>
                    <input type="text" class="form-control" id="lifetime" placeholder="***validation" name="lifetime">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="depreRate">Depreciation Rate<span class="text-danger">*</span></label><br>
                    <input type="text" class="form-control" id="depreRate" placeholder="***validation" name="depreRate">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="depreMethod">Depreciation Method<span class="text-danger">*</span></label><br>
                    <div class="row" id="depreMethod">
                        <div class="col-3" style="padding-top: 7px;">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="depreMethod" id="straight_line" value="Straight-Line">
                                <label class="form-check-label" for="straight_line">Straight-Line</label>
                              </div>
                        </div>
                        <div class="col-4" style="padding-top: 7px;">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="depreMethod" id="reducing_balance" value="Reducing-Balance" checked>
                                <label class="form-check-label" for="reducing_balance">Reducing-Balance</label>
                            </div>
                        </div> 
                    </div>              
                </div>
            </div>
        </div>
            <br>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="warrantyCode">Warranty Code</label><br>
                        <input type="text" class="form-control" id="warrantyCode" placeholder="Enter warranty code" name="warrantyCode">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="warrantyType">Warranty Type</label><br>
                        <select class="browser-default custom-select" id="warrantyType" name="warrantyType">
                            <option selected="Limited">Limited</option>
                            <option value="On-Site">On-Site</option>
                            <option value="Lifetime">Lifetime</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="warrantyStart">Warranty Start</label><br>
                        <div class="input-group date">
                            <input type="date" class="form-control" id="warrantyStart" name="warrantyStart">
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="warrantyEnd">Warranty End</label><br>
                        <div class="input-group date">
                            <input type="date" class="form-control" id="warrantyEnd" name="warrantyEnd">
                        </div>
                    </div>
                </div>
            </div>            
            <br>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="installationDate">Installation Date&nbsp;/&nbsp;Acceptance Date</label><br>
                        <div class="input-group date">
                            <input type="date" class="form-control" id="installationDate" name="installationDate">
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="plant">Plant<span class="text-danger">*</span></label><br>
                        <select class="browser-default custom-select" id="plant" name="plant">
                            <option selected="">Minuwangoda</option>
                        </select>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="condition">Condition<span class="text-danger">*</span></label><br>
                        <select class="browser-default custom-select" id="condition" name="condition">
                            <option selected="Working">Working</option>
                            <option value="To inspect">To inspect</option>
                            <option value="Brocken">Brocken</option>
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="criticality">Criticality<span class="text-danger">*</span></label><br>
                        <select class="browser-default custom-select" id="criticality" name="criticality">
                            <option selected="None">None</option>
                            <option value="low">Low</option>
                            <option value="Low">Moderate</option>
                            <option value="High">High</option>
                            <option value="Extreme">Extreme</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="serviceInterval">Service Interval<span class="text-danger">*</span></label><br>
                        <input type="text" class="form-control" id="serviceInterval" placeholder="***validation" name="serviceInterval">
                    </div>
                </div>                
            </div>
            <br>
            <div class="row">
                <div class="d-flex col-5 justify-content-center">
                    <button style="width: 100%;" type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>                
            </div>
            <div class="row">
                <div class="d-flex col-5 justify-content-center">
                    <p class="text-danger">
                        <?php

                        ?>
                    </p>
                </div>                
            </div>
    </form>
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