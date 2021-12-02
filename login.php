<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
      <title>Login</title>
      <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   </head>
   <body class="bg-secondary bg-gradient">
      <div class="container">
         <br><br><br><br><br>
         <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
               <div class="card shadow-lg o-hidden border-0 my-5">
                  <div class="card-body p-0">
                     <div class="row">
                        <div class="col-lg-6 d-none d-lg-flex">
                           <div class="flex-grow-1 bg-login-image" style="background-image: url(&quot;assets/img/dogs/image3.jpeg&quot;);"></div>
                        </div>
                        <div class="col-lg-6">
                           <div class="p-5">
                              <div class="text-center">
                                 <h4 class="text-dark mb-4">Welcome Back!</h4>
                              </div>
                              <form id="loginForm" class="user">
                                 <div class="mb-3"><input class="form-control form-control-user" type="text" id="uname" aria-describedby="emailHelp" placeholder="Enter Username..." name="uname"></div>
                                 <div class="mb-3"><input class="form-control form-control-user" type="password" id="pass" placeholder="Enter Password..." name="pwd"></div>
                                 <div class="mb-3">
                                    
                                 </div>
                                 <button class="btn btn-primary d-block btn-user w-100" type="submit" name="submit">Login</button>
                                 <br/><p style="color:red; display:none" id="errorMsg">*Please fill all fields.</p><p style="color:red; display:none" id="regexError">*Please enter valid credentials!</p>
                                 <?php
                                    if(isset($_GET["error"])){   
                                          if($_GET["error"] == "wrong_login" || $_GET["error"] == "invalid_login"){
                                             echo "<br/>";
                                             echo '<p style="color:red">*Credentials are incorrect.</p>';
                                          }
                                          if($_GET["error"] == "emptyinput"){
                                             echo "<br/>";
                                             echo '<p style="color:red">*Please complete all fields</p>';
                                          }            
                                    }
                                    if(isset($_GET["redirect"])){
                                          if($_GET["redirect"] == "logout"){
                                             
                                          }
                                    }
                                    if(isset($_POST["redirect"]) && $_POST["redirect"] == "info_change"){
                                       echo "<script>alert(\"Please login again\"</script>";
                                    }
                                 ?>
                                 <hr>
                              </form>
                              <script>
                                 $("#loginForm").submit(function(event){
                                    let uname = $("#uname");
                                    let pass = $("#pass");
                                    const pattern = "/[^A-Za-z0-9]+/";
                                    const regex = new RegExp(pattern);
                                    if(uname.val() === "" || pass.val() === ""){
                                       $("#errorMsg").css("display", "block");
                                       event.preventDefault();
                                    }
                                    else if(regex.test(uname.val()) || regex.test(pass.val())){
                                       $("#regexError").css("display", "block");
                                       event.preventDefault();
                                    }
                                    else{
                                       $("#loginForm").attr("method", "POST");
                                       $("#loginForm").attr("action", "includes/login-inc.php");
                                    }
                                 });
                                 $("#uname").keyup(function(event){
                                    $("#errorMsg").css("display", "none");
                                 });
                                 $("#pass").keyup(function(event){
                                    $("#errorMsg").css("display", "none");
                                 });
                                 $("#pass").keyup(function(event){
                                    $("#regexError").css("display", "none");
                                 });
                                 $("#uname").keyup(function(event){
                                    $("#regexError").css("display", "none");
                                 });
                              </script>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script><script src="assets/js/script.min.js"></script>
   </body>
</html>