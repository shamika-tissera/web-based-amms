document.getElementById("regUser").addEventListener("submit", function(event){
    var isValid = true;
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var uname = document.getElementById("uname");
    var pass = document.getElementById("password");
    var r_pass = document.getElementById("r_password");
    if(fname.value === ""){
        isValid = false;
        document.getElementById("fnameErr").style.display = "block";
    }
    if(lname.value === ""){
        isValid = false;
        document.getElementById("lnameErr").style.display = "block";
    }
    if(uname.value === ""){
        isValid = false;
        document.getElementById("unameErr").style.display = "block";
    }
    if(pass.value === ""){
        isValid = false;
        document.getElementById("passwordErr").style.display = "block";
    }
    if(r_pass.value === ""){
        isValid = false;
        document.getElementById("r_passwordErr").style.display = "block";
    }
    if(isValid){
        if(pass.value !== r_pass.value){
            isValid = false;
            alert("Passwords do not match!");
        }
    }
    if(isValid){
        $("#regUser").attr('method', 'POST');
        $("#regUser").attr('action', './includes/register-inc.php');
    }
    else{
        event.preventDefault();
    }
});
document.getElementById("fname").addEventListener("keyup", function(event){
    document.getElementById("fnameErr").style.display = "none";
});
document.getElementById("lname").addEventListener("keyup", function(event){
    document.getElementById("lnameErr").style.display = "none";
});
document.getElementById("uname").addEventListener("keyup", function(event){
    document.getElementById("unameErr").style.display = "none";
});
document.getElementById("password").addEventListener("keyup", function(event){
    document.getElementById("passwordErr").style.display = "none";
});
document.getElementById("r_password").addEventListener("keyup", function(event){
    document.getElementById("r_passwordErr").style.display = "none";
});