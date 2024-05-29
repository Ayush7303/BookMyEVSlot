$("#otp").hide();
$(".verifyotp").hide();
var  em_error=true;
var  pwd_error=true;
var  reg_un_error=true;
var  reg_em_error=true;
var  reg_mn_error=true;
var  reg_pwd_error=true;
var  reg_cpwd_error=true;
$("#loginemail").keyup(function(){
    email_check();
});

$("#loginpassword").keyup(function(){
    password_check();
})
$("#registerun").keyup(function(){
    register_username_check();
});
$("#registeremail").keyup(function(){
    register_email_check();
})
$("#registerpwd").keyup(function(){
    register_password_check();
});
$("#registercpwd").keyup(function(){
    register_confirm_password_check();
});
$("#registermn").keyup(function(){
    register_mobileno_check();
})
function email_check(){
    var email_val=$("#loginemail").val();
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(email_val.length=='')
    {
        $("#emailerr").html("*E-mail is empty.");
        $("#emailerr").focus();
        $("#emailerr").css("color","red");
        em_error=false;
        return false;
    }
    else{
        $("#emailerr").html("");
    }
    if(!regex.test(email_val))
    {
        $("#emailerr").html("*Enter valid email.");
        $("#emailerr").focus();
        $("#emailerr").css("color","red");
        em_error=false;
        return false;
    }
    else{
        $("#emailerr").html("");
    }
}
function password_check(){
    var pwd_val=$("#loginpassword").val();
    var regex1 = /^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%&]).*$/;
    if(pwd_val.length=='')
    {
        $("#pwderr").html("*Password is empty.");
        $("#pwderr").focus();
        $("#pwderr").css("color","red");
        pwd_error=false;
        return false;
    }
    else{
        $("#pwderr").html("");
    }
    if(!regex1.test(pwd_val))
    {
        $("#pwderr").html("*Password must contain at least 1 capital letter,1 small letter, 1 number and 1 special character and maximum 8 letters.");
        $("#pwderr").focus();
        $("#pwderr").css("color","red");
        pwd_error=false;
        return false;
    }
    else{
        $("#pwderr").html("");
    }
}
function register_username_check()
{
    var un_val=$("#registerun").val();
    var regex3 = /^[a-z0-9_-]{4,15}$/;
    if(un_val.length=='')
    {
        $("#unerr").html("*Username is empty.");
        $("#unerr").focus();
        $("#unerr").css("color","red");
        reg_un_error=false;
        return false;
    }
    else{
        $("#unerr").html("");
    }
    if(!regex3.test(un_val))
    {
        $("#unerr").html("*Enter valid username.");
        $("#unerr").focus();
        $("#unerr").css("color","red");
        reg_un_error=false;
        return false;
    }
    else{
        $("#unerr").html("");
    }
}
function register_email_check()
{
    var reg_email_val=$("#registeremail").val();
    var regex4 = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(reg_email_val.length=='')
    {
        $("#remailerr").html("*E-mail is empty.");
        $("#remailerr").focus();
        $("#remailerr").css("color","red");
        reg_em_error=false;
        return false;
    }
    else{
        $("#remailerr").html("");
    }
    if(!regex4.test(reg_email_val))
    {
        $("#remailerr").html("*Enter valid E-mail.");
        $("#remailerr").focus();
        $("#remailerr").css("color","red");
        reg_em_error=false;
        return false;
    }
    else{
        $("#remailerr").html("");
    }
}
function register_password_check(){
    var reg_pwd_val=$("#registerpwd").val();
    var regex5 = /^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%&]).*$/;
    if(reg_pwd_val.length=='')
    {
        $("#rpwderr").html("*Password is empty.");
        $("#rpwderr").focus();
        $("#rpwderr").css("color","red");
        reg_pwd_error=false;
        return false;
    }
    else{
        $("#rpwderr").html("");
    }
    if(!regex5.test(reg_pwd_val))
    {
        $("#rpwderr").html("*Password must contain at least 1 capital letter,1 small letter, 1 number and 1 special character and maximum 8 letters.");
        $("#rpwderr").focus();
        $("#rpwderr").css("color","red");
        reg_pwd_error=false;
        return false;
    }
    else{
        $("#rpwderr").html("");
    }
}
function register_confirm_password_check(){
    var reg_cpwd_val=$("#registercpwd").val();
    var reg_pwd_val=$("#registerpwd").val();
    // var regex6 = /^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%&]).*$/;
    if(reg_pwd_val.length=='')
    {
        $("#cpwderr").html("*Password is empty.");
        $("#cpwderr").focus();
        $("#cpwderr").css("color","red");
        reg_cpwd_error=false;
        return false;
    }
    else{
        $("#cpwderr").html("");
    }
    if(reg_cpwd_val!=reg_pwd_val)
    {
        $("#cpwderr").html("*Password not matching");
        $("#cpwderr").focus();
        $("#cpwderr").css("color","red");
        reg_cpwd_error=false;
        return false;
    }
    else{
        $("#cpwderr").html("");
    }
}
function register_mobileno_check()
{
    var reg_mn_val=$("#registermn").val();
    var regex5 = /[0-9]{10}/;
    if(reg_mn_val.length=='')
    {
        $("#mnerr").html("*Mobile Number is empty.");
        $("#mnerr").focus();
        $("#mnerr").css("color","red");
        reg_mn_error=false;
        return false;
    }
    else{
        $("#mnerr").html("");
    }
    if(!regex5.test(reg_mn_val))
    {
        $("#mnerr").html("*Mobile number is numeric only and contain 10 digits.");
        $("#mnerr").focus();
        $("#mnerr").css("color","red");
        reg_mn_error=false;
        return false;
    }
    else{
        $("#mnerr").html("");
    }
}
$("#linkCreateAccount").on("click",function(e){
    e.preventDefault();
    $("#login").hide();
    $("#register").show();
});
$("#linkforgotpass").on("click",function(e){
    e.preventDefault();
    $("#login").hide();
    $("#forgotpwd").show();
});
$("#linkLogin").on("click",function(e){
    e.preventDefault();
    $("#login").show();
    $("#register").hide();
});
$(".uregister").on("click", function(e){
    e.preventDefault();
    reg_un_error=true;
    reg_em_error=true;
    reg_mn_error=true;
    reg_pwd_error=true;
    reg_cpwd_error=true;
    register_username_check();
    register_email_check();
    register_mobileno_check();
    register_password_check();
    register_confirm_password_check();
    if(reg_un_error==true && reg_em_error==true && reg_mn_error==true && reg_pwd_error==true && reg_cpwd_error==true)
    {
    uname= $(".un").val();
    email= $(".em").val();
    pwd= $(".pwd").val();
    mobn = $(".mn").val();
    $.ajax({
        url: "../ajax.php",
        type: "POST",
        data: { "flag": "register", "uname": uname,"email":email, "pwd": pwd, "mobileno": mobn },
        success: function(data) {
            if (data == 2) {
                alert("Account already exists...!!");
            }else if(data==1){
                sendemail();
                alert("Registration successful...!!");
                
                $("#login").show();
                $("#register").hide();
            }
            else {
                alert("Registration does not successfully...!!");
            }
        }
    })
}
});
function sendemail()
{
    email= $(".em").val();

    // email= $(".loginem").val();

    $.ajax({
        url: "../ajax.php",
        type: "POST",
        data: { "flag": "sendregemail","email":email},
        success: function(data) {
// alert(data);
            // alert(data);
            if (data == 1) {
            //    alert("Mail sent.!!");
              
            }
            else {
                alert("E-mail not sent...!!");
            }
        }
    })
}
$(".ulogin").on("click", function(e){
    e.preventDefault();
    em_error=true;
    pwd_error=true;
    email_check();
    password_check();
    if(em_error==true && pwd_error==true){
    email= $(".loginem").val();
    pwd= $(".loginpwd").val();
    $.ajax({
        url: "../ajax.php",
        type: "POST",
        data: { "flag": "login","email":email, "pwd": pwd},
        success: function(data) {
            // alert(data);
            if (data == 1) {
              //  alert("admin Login successful...!!");
                location.href="../admin/index.php";
            }
            else if(data==2)
            {
               // alert("Login successful...!!");
                location.href="../index.php";
            }
            else {
                alert("No data found...!!");
                $("#login").trigger("reset");
            }
        }
    })
}
});
$(".getotp").on("click", function(e){
    e.preventDefault();
    email= $(".logine").val();
    $.ajax({
        url: "../ajax.php",
        type: "POST",
        data: { "flag": "fg","email":email},
        success: function(data) {
            // alert(data);
            if (data == 1) {
             //   alert("Email-found...!!");
                $("#otp").show();
                $(".getotp").hide();
                $(".verifyotp").show();
            }
            else {
               alert("h");
               $("#otp").show();
               $(".getotp").hide();
               $(".verifyotp").show();
                // $("#login").trigger("reset");
            }
        }
    })
});