<?php include 'includes/verifier-inc.php'; ?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
      <title>Register</title>
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
               <div class="container">
                  <div class="card shadow-lg o-hidden border-0 my-5">
                     <div class="card-body p-0">
                        <div class="row">
                           <div class="col-lg-7 col-xl-10 offset-xl-1">
                              <div class="p-5">
                                 <div class="text-left">
                                    <h4 class="text-dark mb-4">Create an Account</h4>
                                 </div>
                                 <form id="regUser">
                                    <div class="row mb-3">                                       
                                       <div class="col-sm-6 mb-3 mb-sm-0"><label for="fname">First Name<span class="text-danger">*</span></label><br><input type="text" class="form-control" id="fname" placeholder="First Name" name="fname" spellcheck="false" data-ms-editor="true"><p style="color:red; display: none;" id="fnameErr">*Please complete this field!</p></div>                                       
                                       <div class="col-sm-6"><label for="lname">Last Name<span class="text-danger">*</span></label><br><input type="text" class="form-control" id="lname" placeholder="Last Name" name="lname" spellcheck="false" data-ms-editor="true"><p style="color:red; display: none;" id="lnameErr">*Please complete this field!</p></div>
                                    </div>
                                    <div class="row">
                                       <div class="col"><label for="uname">Username<span class="text-danger">*</span></label><input type="text" class="form-control" id="uname" placeholder="Username" name="uname" spellcheck="false" data-ms-editor="true"><p style="color:red; display: none;" id="unameErr">*Please complete this field!</p></div>
                                       <div class="col"><label for="occu">Occupation<span class="text-danger">*</span></label>
                                          <select class="browser-default custom-select" id="occu" name="occu">
                                             <option selected="manager">Manager</option>
                                             <option value="worker">Worker</option>
                                             <option value="accountant">Accountant</option>
                                          </select><p style="color:red; display: none;" id="supplierErr">*Please complete this field!</p></div>
                                    </div>
                                    <div class="w-100"></div>
                                    <div class="mb-3"></div>
                                    <div class="row mb-3">
                                       <div class="col-sm-6 mb-3 mb-sm-0"><label for="password">Password<span class="text-danger">*</span></label><input type="password" class="form-control" id="password" placeholder="Password" name="password" spellcheck="false" data-ms-editor="true"><p style="color:red; display: none;" id="passwordErr">*Please complete this field!</p></div>
                                       <div class="col-sm-6"><label for="r_password">Repeat Password<span class="text-danger">*</span></label><input type="password" class="form-control" id="r_password" placeholder="Repeat Password" name="r_password" spellcheck="false" data-ms-editor="true"><p style="color:red; display: none;" id="r_passwordErr">*Please complete this field!</p></div>
                                    </div><br/>
                                    <button class="btn btn-primary d-block btn-user w-100" type="submit" name="submit">Register</button>
                                    <hr>
                                 </form>
                                 <div class="text-center"></div>
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
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script><script src="assets/js/script.min.js"></script>
      <script src="assets/js/validationRegister.js"></script>
   </body>
</html>