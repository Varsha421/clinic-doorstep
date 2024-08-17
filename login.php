<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/login.css">
    <body style="background: url('img/login1.jpeg');     background-size: cover;">
       
    <title>Login</title>
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>


</head>
<body>
<?php

//learn from w3schools.com
//Unset all the server side variables

session_start();

$_SESSION["user"] = "";
$_SESSION["usertype"] = "";

// Set the new timezone
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');

$_SESSION["date"] = $date;


//import database
include("connection.php");


if ($_POST) {

    $email = $_POST['useremail'];
    $password = $_POST['userpassword'];

    $error = '<label for="promter" class="form-label"></label>';

    $result = $database->query("select * from webuser where email='$email'");
    if ($result->num_rows == 1) {
        $utype = $result->fetch_assoc()['usertype'];
        if ($utype == 'p') {
            $checker = $database->query("select * from patient where pemail='$email' and ppassword='$password'");
            if ($checker->num_rows == 1) {


                //   Patient dashbord
                $_SESSION['user'] = $email;
                $_SESSION['usertype'] = 'p';

                header('location: patient/index.php');

            } else {
                $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
            }

        } elseif ($utype == 'a') {
            $checker = $database->query("select * from admin where aemail='$email' and apassword='$password'");
            if ($checker->num_rows == 1) {


                //   Admin dashbord
                $_SESSION['user'] = $email;
                $_SESSION['usertype'] = 'a';

                header('location: admin/index.php');

            } else {
                $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
            }


        } elseif ($utype == 'd') {
            $checker = $database->query("select * from doctor where docemail='$email' and docpassword='$password'");
            if ($checker->num_rows == 1) {


                //   doctor dashbord
                $_SESSION['user'] = $email;
                $_SESSION['usertype'] = 'd';
                header('location: doctor/index.php');

            } else {
                $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
            }

        }

    } else {
        $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">We cant found any acount for this email.</label>';
    }


} else {
    $error = '<label for="promter" class="form-label">&nbsp;</label>';
}

?>


<center>
    <div class="container">
        <form action="" method="POST" id="loginform">

            <table border="0" style="margin: 0;padding: 0;width: 60%;">
                <tr>
                    <td>
                        <p class="header-text">Welcome Back!</p>
                    </td>
                </tr>
                <div class="form-body">
                    <tr>
                        <td>
                            <p class="sub-text">Login with your details to continue</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td">
                            <label for="useremail" class="form-label">Email: </label>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td">
                            <input type="email" name="useremail" class="input-text required" placeholder="Email Address"
                                   required>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td">
                            <label for="userpassword" class="form-label">Password: </label>
                        </td>
                    </tr>

                    <tr>
                        <td class="label-td">
                            <input type="password" name="userpassword" class="input-text required"
                                   placeholder="Password" required>
                        </td>
                    </tr>


                    <tr>
                        <td><br>
                            <?php echo $error ?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="submit" value="Login" class="login-btn btn-primary btn">
                        </td>
                    </tr>
                </div>
                <tr>
                    <td>
                        <br>
                        <label for="" class="sub-text" style="font-weight: 280;">Don't have an account&#63; </label>
                        <a href="signup.php" class="hover-link1 non-style-link">Sign Up</a>
                        <br><br><br>
                    </td>

                </tr>
                <tr>
                    <td>
                        <br>
                        <a href="forgot.php" class="hover-link1 non-style-link">Forgot password?</a>
                        <br><br><br>
                    </td>
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