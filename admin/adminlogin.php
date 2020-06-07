<?php
require '../includes/admin.php';

 if(isset($_SESSION['id']))
 {
    header('location:/eventus/admin/home.php');
 }

if(isset($_POST['login']))
{
    if($_POST['ID']=="admin")
    {
        $obj= new admin;
        $obj->set_id($_POST['ID']);
        $obj->set_pass($_POST['password']);

        if($obj->login_admin()==1)
        {
            $_SESSION['id']=$_POST['ID'];
            $_SESSION['pass']=$_POST['password'];
            header('location:/eventus/admin/home.php');
        }
        else
        {
        $_SESSION['message']='<div class="row justify-content-center">
                <div class="col-sm-12" >
                    <div class=" alert alert-warning alert-dismissible fade show my-2">
                    <strong>Password is incorrect!</strong> You should check in on some of those fields above.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                </div>';
        }
    }else
    {
        $_SESSION['message']='<div class="row justify-content-center">
                <div class="col-sm-12" >
                    <div class=" alert alert-warning alert-dismissible fade show my-2">
                    <strong>Email and password is incorrect!</strong> You should check in on some of those fields above.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                </div>';
    }
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
    <title>Eventus-admin</title>

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

    <div class="page-wrapper">

        <!-- PAGE CONTENT-->
        <div class="page-content--bgf7">

            <!-- login form  -->
            <div class="container pb-5">
            <div class="login-wrap ">
            <div class="login-content shadow-lg" style="border: 2px solid black;">
                <div class="login-logo">
                    <a href="#">
                        <img src="https://i.imgur.com/3xK3BNI.png?1" alt="eventus">
                    </a>
                </div>
                <?php
                    if(isset($_SESSION['message']))
                    {
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                    }
                ?>
                <div class="login-form mb-5" style="padding:10%">
                    <form action="" method="post">
                        <div class="form-group">
                            <label><i class="fas fa-id-badge"></i> ID</label>
                            <input class="btn searchbar" type="ID" name="ID" required  placeholder="Enter a Valid ID">
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-lock"></i> Password</label>
                            <input class="btn searchbar" pattern=".{8,}" title="Min 8 Characters Required" type="password" name="password" required placeholder="Enter your Password">
                        </div>
                        <div class="row justify-content-center">
                        <button class="btn search" type="submit" name="login">login</button>
                        </div>
                    </form>
                </div>
            </div>
            </div>
            </div>
            <!-- login form end -->
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
