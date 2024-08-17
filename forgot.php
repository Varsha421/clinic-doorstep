<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/login.css">
<body style="background: url('img/login2.avif');     background-size: cover;">

<title>Login</title>
<script src="js/jquery.min.js"></script>
<script src="js/jquery.validate.min.js"></script>


</head>
<body>
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require_once 'PHPMailer-master/Exception.php';
require_once  'PHPMailer-master/PHPMailer.php';
require_once 'PHPMailer-master/SMTP.php';

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

    $error = '';

    $result = $database->query("select * from webuser where email='$email'");

    if ($result->num_rows == 1) {
        $utype = $result->fetch_assoc()['usertype'];
        $mail = new PHPMailer(true);
        $token = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(8/strlen($x)) )),1,8);

        try {
            //Server settings
            $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   //Enable SMTP authentication
            $mail->Username = 'clinicatdoorstep@gmail.com';                     //SMTP username
            $mail->Password = 'clrzziuxqtszjsdt';                               //SMTP password
            $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
            $mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('clinicatdoorstep@gmail.com', 'Clinic@DoorStep');
            $mail->addAddress($email);     //Add a recipient

            //Attachments

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Forgot Password';
            $mail->Body = 'Hello,<br><br> You can now reset your password. <br><br> <a href="http://localhost/clinic@doorstep1/reset.php?token=' . $token . '&utype='.$utype.'&email='.$email.' ">Reset Password</a> <br><br><br> If you did not request a password reset, no further action is required.<br><br>Regards,<br>Clinic@DoorStep';

            if (!$mail->send()) {
                $error = "Mailer Error: " . $mail->ErrorInfo;
            } else {
                $error = "Recovery email sent to your email";
            }

        }catch (\Exception $e)
        {
            $error = "error {$mail->ErrorInfo}";
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
                        <p class="header-text">Forgot Password</p>
                    </td>
                </tr>
                <div class="form-body">
                    <tr>
                        <td>
                            <p class="sub-text">Enter your registered email to get recovery of your password
                        </td>
                    </tr><tr>
                        <td>
                            <p style="color: darkgreen"><?php echo $error; ?>
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
                        <td>
                            <input type="submit" value="Send Reset Link" class="login-btn btn-primary btn">
                        </td>
                    </tr>
                </div>
                <tr>
                    <td>
                        <br>
                        <a href="login.php" class="hover-link1 non-style-link">Login</a>
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