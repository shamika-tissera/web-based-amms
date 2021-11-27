<?php include 'includes/verifier-inc.php'; ?>
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
               <div class="container">
                  <div class="card shadow-lg o-hidden border-0 my-5">
                     <div class="card-body p-0">
                        <div class="row">
                           <div class="col-lg-7 col-xl-10 offset-xl-1">
                              <div class="p-5">
                                 <div class="text-left">
                                    <h4 class="text-dark mb-4">Create an Account</h4>
                                 </div>
                                 <form class="user">
                                    <div class="row mb-3">
                                       <div class="col-sm-6 mb-3 mb-sm-0"><input type="text" class="form-control" id="fname" placeholder="First Name" name="fname" spellcheck="false" data-ms-editor="true"></div>
                                       <div class="col-sm-6"><input type="text" class="form-control" id="lname" placeholder="Last Name" name="lname" spellcheck="false" data-ms-editor="true"></div>
                                    </div>
                                    <br/>
                                    <div class="row">
                                       <div class="col"><input type="text" class="form-control" id="uname" placeholder="Username" name="uname" spellcheck="false" data-ms-editor="true"></div>
                                       <div class="col">
                                          <select class="browser-default custom-select" id="state" name="state">
                                             <option selected="In use">Manager</option>
                                             <option value="In Stock">Worker</option>
                                             <option value="Under Maintenance">Accountant</option>
                                          </select></div>
                                    </div>
                                    <br/>
                                    <div class="w-100"></div>
                                    <div class="mb-3"></div>
                                    <div class="row mb-3">
                                       <div class="col-sm-6 mb-3 mb-sm-0"><input type="text" class="form-control" id="password" placeholder="Password" name="password" spellcheck="false" data-ms-editor="true"></div>
                                       <div class="col-sm-6"><input type="password" class="form-control" id="r_password" placeholder="Repeat Password" name="r_password" spellcheck="false" data-ms-editor="true"></div>
                                    </div><br/>
                                    <button class="btn btn-primary d-block btn-user w-100" type="submit">Register Account</button>
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
   </body>
</html>