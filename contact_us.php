<?php
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contact_us</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/animations.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/index.css">
    <body style="background: url('img/contact_us3.jpg');     background-size: cover;">      
    
    <script src="js/jquery.validate.min.js"></script>
</head>
<body style="background: url('img/contact.jpg');     background-size: cover;">
<div class="" style="overflow: hidden">
    <table border="0" class="mt-2">
        <tr>
            <td width="80%">
                <font class="edoc-logo">clinic@doorstep</font>
                <font class="edoc-logo-sub"></font>
            </td>
            <td width="10%">
                <a href="index.html"  class="non-style-link"><p class="nav-item">HOME</p></a>
            </td>
            <td width="10%">
                <a href="login.php"  class="non-style-link"><p class="nav-item">LOGIN</p></a>
            </td>
            <td  width="10%">
                <a href="signup.php" class="non-style-link"><p class="nav-item" style="padding-right: 10px;">REGISTER</p></a>
            </td>

        </tr>
    </table>
    <div class="row mt-5 h-auto" style="overflow-y: hidden">
        <div class="col-md-6 offset-3" >
            <div class="w-100 m-auto card  p-5  ">
                <div class="">
                    <h2 class="text-center">CONTACT US</h2>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <form acttion="contact_us.php" method="post">
                            <div class="form-group">
                                <label>Name:</label>
                                <input type="text" name="nm" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Email:</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Message:</label>
                                <input type="text" name="message" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>

                    </div>
                    <div class="col-md-6 mt-2">
                        <h4>Reach out to us:</h4>
                        <p>Email: <a href="mailto:clinic@doorstep.com">clinic@doorstep.com</a></p>
                        <p>Phone: +91 3265544545</p>
                    </div>
                </div>


            </div>

        </div>

    </div>

</div>




</body>
</html>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $con = new mysqli("localhost", "root", "root", "edoc");

    if ($con) {
        echo "connection successful!";
    } else {
        echo "connection failed!";
    }

    mysqli_select_db($con, 'edoc');

    $nm = $_POST['nm'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $query = "INSERT INTO contact_us (name, email, message) VALUES ('$nm', '$email', '$message')";
    echo $query;
    mysqli_query($con, $query);
    header('location:thankyou.html');
}


?>