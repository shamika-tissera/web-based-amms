<?php include 'includes/verifier-inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Add Asset</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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

               <div class="container-fluid">
                  <h3 class="text-dark mb-1">Add Asset</h3>
                  <div style="margin-top: 25px;" class="card shadow">
                     <div class="card-header py-3">
                        <p class="text-primary m-0 fw-bold">Add Asset</p>
                     </div>
                     <div class="card-body">
                     <form id="assetForm">
        <div class="row">

        

            <div class="col-6">
                <div class="form-group">
                    <label for="asset_type" class="col-form-label">Asset Type:</label>
                    <select class="form-select" id="asset_type" name="asset_type"></select>
                    <?php
                        $sql_select = "SELECT type FROM assetType;";
                        $run_query = mysqli_query($conn, $sql_select);
                        echo "<script>var assetTypes = [";
                            while($row = mysqli_fetch_array($run_query)){
                            $ins = $row['type'];
                            echo "\"$ins\", ";
                            }
                        echo "];</script>";
                    ?>
                    <script>
                        assetTypes.forEach(element => {
                            $("#asset_type").append(`<option class="clearExit" value="${element}">${element}</option>`);
                        });
                    </script>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="assetCode">Asset Code<span class="text-danger">*</span></label><br>
                    <input type="text" class="form-control" id="assetCode" placeholder="Enter asset code" name="assetCode">
                    <p style="color:red; display: none;" id="assetCodeErr">*Please complete this field!</p>
                </div>
            </div>
        </div>   
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="manufacturer">Manufacturer<span class="text-danger">*</span></label><br>
                    <input type="text" class="form-control" id="manufacturer" placeholder="Manuafacturer" name="manufacturer">
                    <p style="color:red; display: none;" id="manufacturerErr">*Please complete this field!</p>
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
                    <input type="text" class="form-control" id="supplier" placeholder="Supplier" name="supplier">
                    <p style="color:red; display: none;" id="supplierErr">*Please complete this field!</p>
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
                    <input type="number" class="form-control" id="price" placeholder="Enter the current value" name="price" min="1">
                    <p style="color:red; display: none;" id="priceErr">*Please complete this field!</p>
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
                    <p style="color:red; display: none;" id="depreBeginErr">*Please complete this field!</p>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="lifetime">Lifetime (Years)<span class="text-danger">*</span></label><br>
                    <input type="number" class="form-control" id="lifetime" placeholder="Enter lifetime in years" name="lifetime" min="0">
                    <p style="color:red; display: none;" id="lifetimeErr">*Please complete this field!</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="depreRate">Depreciation Rate<span class="text-danger">*</span></label><br>
                    <input type="number" class="form-control" id="depreRate" placeholder="Enter the depreciation rate as a percentage" name="depreRate" min="0" max="100">
                    <p style="color:red; display: none;" id="depreRateErr">*Please complete this field!</p>
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
                            <option value="None">None</option>
                        </select>
                    </div>
                    <script>
                $("#warrantyType").change(function(){
                    let selectedItem = $("#warrantyType").val();
                    //disables all warranty related input fields
                    if(selectedItem === "Lifetime"){
                        $("#warrantyStart").attr("readonly", true);
                        $("#warrantyEnd").attr("readonly", true);
                        $("#warrantyCode").attr("readonly", false);
                        $('#warrantyStart').val('');
                        $('#warrantyEnd').val('');
                    }
                    else if(selectedItem === "None"){
                        $('#warrantyCode').val('');
                        $("#warrantyCode").attr("readonly", true);
                        $("#warrantyStart").attr("readonly", true);
                        $("#warrantyEnd").attr("readonly", true);
                        $('#warrantyStart').val('');
                        $('#warrantyEnd').val('');
                        //$("#warrantyCode").attr("placeholder", "");
                    }else{
                        $("#warrantyCode").attr("readonly", false);
                        $("#warrantyStart").attr("readonly", false);
                        $("#warrantyEnd").attr("readonly", false);
                    }
                });
            </script>
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
                        <label for="installationDate">Installation Date&nbsp;/&nbsp;Acceptance Date<span class="text-danger">*</span></label><br>
                        <div class="input-group date">
                            <input type="date" class="form-control" id="installationDate" name="installationDate">
                        </div>
                        <p style="color:red; display: none;" id="installationDateErr">*Please complete this field!</p>
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
                        <input type="number" class="form-control" id="serviceInterval" placeholder="Enter the asset service interval" name="serviceInterval" min="0">
                        <p style="color:red; display: none;" id="serviceIntervalErr">*Please complete this field!</p>
                    </div>
                </div>                
            </div>
            <br>
            <div class="row">
                <div class="d-flex col-12 justify-content-center">
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
                <br>
                <?php
                if(isset($_GET["error"])){
                    if($_GET["error"] == "empty"){
                        echo '<p style="color:red">*Please complete all required fields!</p>';
                    }
                }
            ?>              
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
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script><script src="assets/js/script.min.js"></script><script src="assets/js/validationAsset.js"></script>
   </body>
</html>