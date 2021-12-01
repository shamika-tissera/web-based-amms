<?php
require 'includes/verifier-inc.php'; 
$username = $_SESSION['username'];
$first_name = $_SESSION['firstname'];
$last_name = $_SESSION['lastname'];
$occu = $_SESSION['category'];
echo "<script>var occu = \"$occu\";</script>";
?>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
      <title>Profile</title>
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

               <div class="container-fluid">
                  <h3 class="text-dark mb-4">Profile</h3>
                  <div class="row mb-3">
                     <div class="col-lg-4">
                        <form id="changePic">
                        <div class="card mb-3">
                           <div class="card-body text-center shadow">
                              <img class="rounded-circle mb-3 mt-4" <?php echo "src=\"$avatar\"";?> width="160" height="160">
                              <div class="mb-3"><label class="btn btn-default"><input id="photo" type="file" name="image"></label><button class="btn btn-primary btn-sm" type="submit" name="submit">Change</button></div>
                           </div>
                        </div>
                        <input type="hidden" value=<?php echo "\"$username\""?> name="username">
                        </form>                        
                     </div>
                     <div class="col-lg-8">
                        <div class="row">
                           <div class="col">
                              <div class="card shadow mb-3">
                                 <div class="card-header py-3">
                                    <p class="text-primary m-0 fw-bold">User Information</p>
                                 </div>
                                 <div class="card-body">
                                    <form id="userInfo">
                                       <div class="row">
                                          <div class="col">
                                             <div class="mb-3"><label class="form-label" for="username"><strong>Username</strong></label><input class="form-control" type="text" id="username" value=<?php echo "\"$username\""; ?> name="username" readonly></div>
                                          </div>
                                          <div class="col">
                                             <div class="mb-3"><label class="form-label" for="occu"><strong>Occupation</strong></label>
                                             <select class="form-select" id="occu" name="occu"></select>
                                          </div>
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="col">
                                             <div class="mb-3"><label class="form-label" for="first_name"><strong>First Name</strong></label><input class="form-control" type="text" id="first_name" value=<?php echo "\"$first_name\""; ?> name="first_name"><span class="text-danger" id="first_nameError" style="display: none;">*Please fill this field!</span></div>
                                          </div>
                                          <div class="col">
                                             <div class="mb-3"><label class="form-label" for="last_name"><strong>Last Name</strong></label><input class="form-control" type="text" id="last_name" value=<?php echo "\"$last_name\""; ?> name="last_name"><span class="text-danger" id="last_nameError" style="display: none;">*Please fill this field!</span></div>
                                          </div>
                                       </div>
                                       <div class="mb-3"><button class="btn btn-primary btn-sm" type="submit" name="submitInfo">Update Information</button></div>
                                    </form>
                                 </div>
                              </div>
                              <div class="col-lg-8">
                        <div class="row">
                           <div class="col">
                              <div class="card shadow mb-3">
                                 <div class="card-header py-3">
                                    <p class="text-primary m-0 fw-bold">Change Password</p>
                                 </div>
                                 <div class="card-body">
                                    <form id="userPass">
                                       <div class="row">
                                          <div class="col">
                                             <div class="mb-3"><label class="form-label" for="pass"><strong>New password</strong></label><input class="form-control" type="password" id="pass" name="pass"></div>
                                          </div>
                                          <div class="col">
                                             <div class="mb-3"><label class="form-label" for="r_pass"><strong>Repeat password</strong></label><input class="form-control" type="password" id="r_pass" name="r_pass"></div>
                                          </div>
                                          <input class="form-control" type="hidden" id="r_pass" value=<?php echo "\"$username\""; ?> name="username">
                                       </div>
                                    <div class="mb-3"><button class="btn btn-primary btn-sm" type="submit" name="submitPass">Change Password</button></div>  
                                 </form>
                              </div>
                                 </div>
                              </div>
                              
                           </div>
                        </div>
                     </div
                           </div>
                        </div>
                     </div>
                     
                  </div> 
               </div>
            </div>
            
            <script>
               $("#changePic").submit(function(event){
                  debugger;
                  let isValid = true;
                  let image = $("#photo");
                  const acceptedImageTypes = ['image/gif', 'image/jpeg', 'image/png'];
                  //isValid = image.files && $.inArray(image['type'], acceptedImageTypes);
                  if(isValid){
                     $("#changePic").attr("method", "POST");
                     $("#changePic").attr("enctype", "multipart/form-data");
                     $("#changePic").attr("action", "includes/uploadImage.php");
                  }
                  else{
                     $("#changePic").preventDefault();
                     alert("Please select a valid image!");
                  }
               });
               const occuList = ["Worker", "Manager", "Accountant"];
               occuList.forEach(element => {
                  if(occu.toLowerCase() === element.toLowerCase()){
                     $("#occu").append(`<option class="clearExit" selected="${element}">${element}</option>`);
                  }
                  else{
                     $("#occu").append(`<option class="clearExit" value="${element}">${element}</option>`);
                  }
               });

               $("#userPass").submit(function(event){
                  let pass_1 = $("#pass").val();
                  let pass_2 = $("#r_pass").val();
                  if(pass_1 !== pass_2){
                     event.preventDefault();
                     alert("Passwords do not match!");                     
                  }
                  else if(pass_1 === "" || pass_2 === ""){
                     event.preventDefault();
                     alert("Please enter new password!");
                  }
                  else{
                     $("#userPass").attr('method', 'POST');
                     $("#userPass").attr('action', 'includes/updateUser-inc.php');
                  }
               });

               $("#userInfo").submit(function(event){
                  let isValid = true;
                  let fname = $("#first_name").val();
                  let lname = $("#last_name").val();
                  let occu = $("#occu").val();
                  if(fname === ""){
                     isValid = false;
                     $("#first_nameError").css("display", "block");
                  }
                  if(lname === ""){
                     isValid = false;
                     $("#last_nameError").css("display", "block");
                  }
                  if(!isValid){
                     event.preventDefault();
                  }
                  else{
                     if(confirm("You will be logged out of the current session. Continue?")){
                        $("#userInfo").attr("method", "POST");
                        $("#userInfo").attr("action", "includes/updateUser-inc.php");
                     }
                     else{
                        event.preventDefault();
                     }
                  }
               });
               $("#first_name").keyup(function(event){
                  $("#first_nameError").css("display", "none");
               });
               $("#last_name").keyup(function(event){
                  $("#last_nameError").css("display", "none");
               });
            </script>
            <?php require 'footer.php' ?>

         </div>
         <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script><script src="assets/js/script.min.js"></script>
   </body>
</html>