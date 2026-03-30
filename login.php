<!DOCTYPE html> 
<html lang="en"> 
<head> 
 <meta charset="UTF-8"> 
 <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
 <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
 fwap" rel="stylesheet"> 
 <link rel="stylesheet" href="css/login.css"> 
 <title>Login</title> 
</head> 
<body> 
<?php 
session_start(); 
// Set timezone 
date_default_timezone_set('Asia/Kolkata'); 
$date = date('Y-m-d'); 
$_SESSION["date"] = $date; 
// Import database 
include("connection.php"); 
$error = '<label for="promter" class="form-label">&nbsp;</label>'; 
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
 $email = $_POST['useremail']; 
 $password = $_POST['userpassword']; 
 // Check in webuser table 
 $result = $database->query("SELECT * FROM webuser WHERE email='$email'"); 
 if ($result->num_rows == 1) { 
 $utype = $result->fetch_assoc()['usertype']; 
 //   Patient Login 
 if ($utype == 'p') { 
 $checker = $database->query("SELECT * FROM patient WHERE pemail='$email' AND 
ppassword='$password'"); 
 if ($checker->num_rows == 1) { 
 $_SESSION['user'] = $email; 
 $_SESSION['usertype'] = 'p'; 
 header('location: patient/index.php'); 
 exit(); 
 } else { 
 $error = '<label class="form-label" style="color:red;text-align:center;">Invalid Email or 
Password for Patient</label>'; 
 } 
 } 
 //   Doctor Login 
 elseif ($utype == 'd') { 
 $checker = $database->query("SELECT * FROM doctor WHERE docemail='$email' AND 
docpassword='$password'"); 
 if ($checker->num_rows == 1) { 
 $_SESSION['user'] = $email; 
 $_SESSION['usertype'] = 'd'; 
 $_SESSION['username'] = $docfetch['docname']; 
 header('location: doctor/index.php'); 
 exit(); 
 } else { 
 $error = '<label class="form-label" style="color:red;text-align:center;">Invalid Email or 
Password for Doctor</label>'; 
 } 
 } 
 //   Admin Login 
 elseif ($utype == 'a') { 
 $checker = $database->query("SELECT * FROM admin WHERE aemail='$email' AND 
apassword='$password'"); 
 if ($checker->num_rows == 1) { 
 $_SESSION['user'] = $email; 
 $_SESSION['usertype'] = 'a'; 
 header('location: admin/index.php'); 
 exit(); 
 } else { 
 $error = '<label class="form-label" style="color:red;text-align:center;">Invalid Email or 
Password for Admin</label>'; 
 } 
 } 
 } else { 
 $error = '<label class="form-label" style="color:red;text-align:center;">No account found for 
this email.</label>'; 
 } 
} 
?> 
<div class="container"> 
 <h1 class="header-text">Welcome Back  </h1> 
 <p class="sub-text">Login to continue your journey</p> 
 <form action="" method="POST"> 
 <div class="form-group"> 
 <label class="form-label">Email Address</label> 
 <input type="email" name="useremail" class="input-text" placeholder="Enter your email" 
required> 
 </div> 
 <div class="form-group"> 
 <label class="form-label">Password</label> 
 <input type="password" name="userpassword" class="input-text" placeholder="Enter your 
password" required> 
 </div> 
 <div class="button-group"> 
 <input type="submit" value="Login →" class="btn-primary"> 
 </div> 
 <div style="margin-top:15px;"> 
 <?php echo $error; ?> 
 </div> 
 <p class="sub-text" style="margin-top: 20px;"> 
 Don’t have an account? 
 <a href="signup.php" class="hover-link1">Sign Up</a> 
 </p> 
 </form> 
</div> 
</body> 
</html>
