<?php
 include("../includes/users.php");
 session_start();
 if(isset($_SESSION['email']))
 {
     header('location:/eventus/index.php');
 }
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Eventus</title>

    <!-- Fontfaces CSS-->
    <link href="../css/font-face.css" rel="stylesheet" media="all">
    <link href="../vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="../vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="../vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="../vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="../vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="../vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="../vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="../vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="../vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="../vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="../vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="../css/theme.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="../mycss.css">

</head>

<body class="animsition">
<?php
                if(isset($_POST['signup-submit']))
                {

                    $_SESSION['username']=$_POST['username'];
                    $_SESSION['emailc']=$_POST['email'];//here in session i used emails reason on line 6
                    $_SESSION['password']=$_POST['password'];
                    $_SESSION['cnic']=$_POST['cnic'];
                    $_SESSION['phone']=$_POST['number'];
                    header("Location: " . $_SERVER['REQUEST_URI']);
                }else if(isset($_SESSION['username']))
                {
                    $object =new users;
                    $object->set_name($_SESSION['username']);
                    $object->set_email($_SESSION['emailc']);
                    $object->set_pass($_SESSION['password']);
                    $object->set_cnic($_SESSION['cnic']);
                    $object->set_phone($_SESSION['phone']);
                    unset($_SESSION['username']);
                    unset($_SESSION['emailc']);
                    unset($_SESSION['password']);
                    unset($_SESSION['cnic']);
                    unset($_SESSION['phone']);
                    $result=$object->check_register();
                    if($result==1)
                    {

                            $_SESSION['message']='<div class="col-sm-12" >
                            <div class=" alert alert-warning alert-dismissible fade show my-2">
                            <strong>Username is already taken!</strong> You should check in on some of those fields below.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            </div>';
                    }elseif($result==2)
                    {

                            $_SESSION['message']='<div class="col-sm-12" >
                            <div class=" alert alert-warning alert-dismissible fade show my-2">
                            <strong>Email is already taken!</strong> You should check in on some of those fields below.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            </div>';
                    }
                    elseif($result==3)
                    {
                            $_SESSION['message']='<div class="col-sm-12" >
                            <div class=" alert alert-warning alert-dismissible fade show my-2">
                                <strong>CNIC is already taken!</strong> You should check in on some of those fields below.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            </div>';
                    }
                    elseif($result==0)
                    {
                        $object->register();
                        $_SESSION['message']='<div class="col-sm-12" >
                            <div class=" alert alert-warning alert-dismissible fade show my-2">
                            <strong>Registration is in process!</strong> You will recived an email for confirmation of your account in 24 hours.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            </div>';
                    }
                }
            ?>
    <div class="page-wrapper">
    <?php     require '../navbar.php'?>   
     <!-- PAGE CONTENT-->
     
        <div class="page-content--bgf7">
        <div class="container pb-5">
    <div class="login-wrap">
        <div class="login-content shadow-lg" style="border: 2px solid black;">
            <div class="login-logo">
                <a href="#">
                    <img src="https://i.imgur.com/3xK3BNI.png?1" alt="EVENTUS">
                </a>
            </div>
        <div class="row justify-content-center">
        <?php
            if(isset($_SESSION['message']))
            {
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            }
        ?>
        </div>
            <div class="login-form">
                <form action="" method="post">
                    <div class="form-group">
                        <label><i class="fas fa-user"></i> Username</label>
                        <input class="btn searchbar" type="text" name="username" required placeholder="Enter a Username">
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-envelope"></i> Email</label>
                        <input class="btn searchbar" type="email" name="email" required  placeholder="Enter a Valid Email">
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-lock"></i> Password</label>
                        <input class="btn searchbar" pattern=".{8,}" title="Min 8 Characters Required" type="password" name="password" required placeholder="Enter your Password">
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-card"></i> CNIC</label>
                        <input class="btn searchbar" pattern="[0-9]{5}[-]{1}[0-9]{7}[-]{1}[0-9]{1}" title="Enter Valid CNIC Number | Format: [12345-1234567-1]" type="text" name="cnic" required placeholder="Enter your CNIC No">
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-phone"></i> Phone</label>
                        <input class="btn searchbar" pattern="[0]{1}[0-9]{3}[-]{1}[1-9]{7}" title=" Enter Valid Number | Format: [0300-1234567]" type="text" name="number" required placeholder="Enter your Phone No">
                    </div>
                    <div class="row justify-content-center">
                    <button class="btn search" type="submit" name="signup-submit">Register</button>
                    </div>
                </form>
                <div class="register-link">
                    <p>
                        Already have account?
                        <a href="/eventus/users/login.php">Sign In</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="../vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="../vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="../vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="../vendor/slick/slick.min.js">
    </script>
    <script src="../vendor/wow/wow.min.js"></script>
    <script src="../vendor/animsition/animsition.min.js"></script>
    <script src="../vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="../vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="../vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="../vendor/circle-progress/circle-progress.min.js"></script>
    <script src="../vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="../vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="../js/main.js"></script>

</body>

</html>
<!-- end document-->
