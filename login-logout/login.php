<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/login.css">
</head>
<style>
  
    </style>
<body>
    <div class="box">
    <form action="" method="POST" id="login">
        <div class="head1">Login</div>
        <input type="text" placeholder="E-mail" class="loginem" id="loginemail">
        <div id="emailerr" class="err"></div>
        <input type="password" placeholder="Password" class="loginpwd" id="loginpassword">
        <div id="pwderr" class="err"></div>
        <input type="submit" value="Login" class="ulogin">
        <div class="m"><a href="./" id="linkforgetpass">Forgot your password?</a></div>
        <div class="m"><a href="./" id="linkCreateAccount">Don't have an account? Create account</a></div>

</form>


<form action="" method="POST" id="register" class="hidden">
<div class="head1">Create Account</div>
        <input type="text" placeholder="Username" class="un" id="registerun">
        <div id="unerr" class="err"></div>
        <input type="text" placeholder="E-mail" class="em" id="registeremail">
        <div id="remailerr" class="err"></div>
        <input type="password" placeholder="Password" class="pwd" id="registerpwd">
        <div id="rpwderr" class="err"></div>
        <input type="password" placeholder="Confirm Password" id="registercpwd">
        <div id="cpwderr" class="err"></div>
        <input type="text" placeholder="Mobile No." class="mn" id="registermn">
        <div id="mnerr" class="err"></div>
        <input type="submit" value="Register" class="uregister">
        <div class="m"><a href="./" id="linkLogin" class="m">Already have an account? Sign in</a></div>

</form>
</div>
<script src="../assets/js/jQuery.js"></script>
<script src="../assets/js/hide.js"></script>
</body>
</html> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/login.css">
</head>
<style>
  
    </style>
<body>
    <div class="box">
    <form action="" method="POST" id="login">
        <div class="head1">Login</div>
        <input type="text" placeholder="E-mail" class="loginem" id="loginemail">
        <div id="emailerr" class="err"></div>
        <input type="password" placeholder="Password" class="loginpwd" id="loginpassword">
        <div id="pwderr" class="err"></div>
        <input type="submit" value="Login" class="ulogin">
        <!-- <div class="m"><a href="./" id="linkforgotpass">Forgot your password?</a></div> -->
        <div class="m"><a href="./" id="linkCreateAccount">Don't have an account? Create account</a></div>

</form>

<form action="" method="POST" id="forgotpwd" class="hidden">
        <div class="head1">Forgot password</div>
        <input type="text" placeholder="E-mail" class="logine" id="loginfEmail">
        <input type="text" placeholder="One Time Password" class="otp" id="otp" class="hiddenfield">
        <div id="emailerr" class="err"></div>
        <input type="submit" value="Get OTP" class="getotp">
        <input type="submit" value="Verify OTP" class="verifyotp">
        <!-- <div class="m"><a href="./" id="linkforgetpass">Forgot your password?</a></div>
        <div class="m"><a href="./" id="linkCreateAccount">Don't have an account? Create account</a></div> -->

</form>

<form action="" method="POST" id="register" class="hidden">
<div class="head1">Create Account</div>
        <input type="text" placeholder="Username" class="un" id="registerun">
        <div id="unerr" class="err"></div>
        <input type="text" placeholder="E-mail" class="em" id="registeremail">
        <div id="remailerr" class="err"></div>
        <input type="password" placeholder="Password" class="pwd" id="registerpwd">
        <div id="rpwderr" class="err"></div>
        <input type="password" placeholder="Confirm Password" id="registercpwd">
        <div id="cpwderr" class="err"></div>
        <input type="text" placeholder="Mobile No." class="mn" id="registermn">
        <div id="mnerr" class="err"></div>
        <input type="submit" value="Register" class="uregister">
        <div class="m"><a href="./" id="linkLogin" class="m">Already have an account? Sign in</a></div>

</form>
</div>
<script src="../assets/js/jQuery.js"></script>
<script src="../assets/js/hide.js"></script>
</body>
</html>