<?php
 include("../includes/users.php");
 session_start();
 if(isset($_SESSION['email']))
 {
    header('location:../index.php');
 }
 
    if(isset($_POST['login']))
    {
        $_SESSION['emailc']=$_POST['email'];//here in session i used emails reason on line 6
        $_SESSION['passwordc']=$_POST['password'];
        header("Location: " . $_SERVER['REQUEST_URI']);
        return;
    }
    else if(isset($_SESSION['emailc']) && isset($_SESSION['passwordc']))
    {
        $object =new users;
        $object->set_email($_SESSION['emailc']);
        $object->set_pass($_SESSION['passwordc']);
        $_SESSION['email']=$_SESSION['emailc'];
        $_SESSION['password']=$_SESSION['passwordc'];
        unset($_SESSION['emailc']);
        unset($_SESSION['passwordc']);
        $result=$object->login();
        if($result==3)
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
        unset($_SESSION['email']);
        unset($_SESSION['password']);
        }
        else if($result==2)
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
        unset($_SESSION['email']);
        unset($_SESSION['password']);
        }else if($result==0)
        {
            $_SESSION['message']='<div class="row justify-content-center">
                <div class="col-sm-12" >
                    <div class=" alert alert-warning alert-dismissible fade show my-2">
                        <strong>Registration is in process!</strong> You will recived an email for confirmation of your account in 24 hours.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                </div>';
        unset($_SESSION['email']);
        unset($_SESSION['password']);
        }
        else if($result==1)
        {
            $_SESSION['name']=$object->get_name();
            $_SESSION['userid']=$object->get_id();
            echo $_SESSION['userid'];
            header('Location:../index.php');
            return;
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
    <title>Eventus</title>
    <?php 
    require '../includes/headerlinks.php';
    ?>

</head>

<body class="animsition">

    <div class="page-wrapper">
    <?php     require '../navbar.php';?>
        <!-- PAGE CONTENT-->
        <div class="page-content--bgf7">

            <!-- login form  -->
            <div class="container pb-5">
            <div class="login-wrap ">
            <div class="login-content shadow-lg" style="border: 2px solid black;">
                <div class="login-logo">
                    <a href="#">
                        <img src="https://i.imgur.com/3xK3BNI.png?1" alt="EVENTUS">
                    </a>
                </div>
                <?php
                    if(isset($_SESSION['message']))
                    {
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                    }
                ?>
                <div class="login-form mb-5">
                    <form action="" method="post">
                        <div class="form-group">
                            <label><i class="fas fa-envelope"></i> Email</label>
                            <input class="btn searchbar" type="email" name="email" required  placeholder="Enter a Valid Email">
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-lock"></i> Password</label>
                            <input class="btn searchbar" pattern=".{8,}" title="Min 8 Characters Required" type="password" name="password" required placeholder="Enter your Password">
                        </div>
                        <div class="row justify-content-center">
                        <button class="btn search" type="submit" name="login">login</button>
                        </div>
                    </form>
                    <div class="register-link">
                        <p>
                            Dont have an account?
                            <a href="/eventus/users/register.php">Sign Up</a>
                        </p>
                    </div>
                </div>
            </div>
            </div>
            </div>
            <!-- login form end -->
        </div>
    </div>
<?php
require '../includes/footerlinks.php';
?>

</body>

</html>
<!-- end document-->
