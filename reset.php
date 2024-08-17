<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/signup.css">
<body style="background: url('img/signup.jpg');     background-size: cover;">

<title>Create Account</title>
<style>
    .container{
        animation: transitionIn-X 0.5s;
    }
</style>
<script src="js/jquery.min.js"></script>
<script src="js/jquery.validate.min.js"></script>

</head>
<body>
<?php

//learn from w3schools.com
//Unset all the server side variables

session_start();

$_SESSION["user"]="";
$_SESSION["usertype"]="";

// Set the new timezone
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');

$_SESSION["date"]=$date;


//import database
include("connection.php");





if($_POST){

    $result= $database->query("select * from webuser");

    $email=$_POST['newemail'];
    $newpassword=$_POST['newpassword'];
    $cpassword=$_POST['cpassword'];

    if ($newpassword==$cpassword){
        $result= $database->query("select * from webuser where email='$email';");
        if($result->num_rows==1){
            $utype = $result->fetch_assoc()['usertype'];
            if ($utype == 'p') {
                $checker = $database->query("update patient set  ppassword='$newpassword' where pemail='$email' ");
                header('location: patient/index.php');
            } elseif ($utype == 'a') {
                $checker = $database->query("update admin set apassword='$newpassword' where aemail='$email'");
                header('location: admin/index.php');
            } elseif ($utype == 'd') {
                $checker = $database->query("update doctor set docpassword='$newpassword' where docemail='$email' ");
                header('location: doctor/index.php');
            }
        }
    }else{
        $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Password Conformation Error! Reconform Password</label>';
    }




}else{
    //header('location: signup.php');
    $error='<label for="promter" class="form-label"></label>';
}

?>


<center>
    <div class="container">
        <form action="" method="POST"  id="loginform">
            <table border="0" style="width: 69%;">
                <tr>
                    <td colspan="2">
                        <p class="header-text">Reset Password</p>
                        <p class="sub-text">Enter your new passowrd</p>
                    </td>
                </tr>
                <tr>

                    <td class="label-td" colspan="2">
                        <label for="newemail" class="form-label">Email: </label>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <input type="email" name="newemail" class="input-text" placeholder="Email Address" value="<?php echo $_GET['email'] ?>" required>
                    </td>

                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <label for="newpassword"  class="form-label">Create New Password: </label>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <input type="password" name="newpassword" minlength="8" id="newpwd"  class="input-text strong_password required" placeholder="New Password" required>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <label for="cpassword" class="form-label">Confirm Password: </label>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <input type="password" name="cpassword" class="input-text" data-rule-equalTo="#newpwd" placeholder="Conform Password" required>
                    </td>
                </tr>

                <tr>

                    <td colspan="2">
                        <?php echo $error ?>

                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="submit" value="Reset password" class="login-btn btn-primary btn">
                    </td>

                </tr>
                <tr>
                    <td colspan="2">
                        <br>
                        <label for="" class="sub-text" style="font-weight: 280;">Already have an account&#63; </label>
                        <a href="login.php" class="hover-link1 non-style-link">Login</a>
                        <br><br><br>
                    </td>
                </tr>


                </tr>
            </table>
        </form>
    </div>
</center>
</body>
<script>
  $(document).ready(function () {
    $(".login-btn").click(function (e) {
      e.preventDefault();
      if ($('#loginform').valid()) {
        $('#loginform').submit();
      }
    })
  })
</script>

</html>