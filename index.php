<?php
    session_start();
    require 'includes/users.php';
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
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <!-- Main CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/theme.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="mycss.css">
</head>

<body class="animsition">
    
    <div class="page-wrapper">
    <!-- The social media icon bar -->

        <?php    require 'navbar.php'?>

        <div class="page-content--bgf7">
        <!-- ======= Hero Section ======= -->
        <section id="hero">
            <div class="hero-container">
            <h3>Welcome to <strong>EVENT US</strong></h3>
            <h1>We are an Event management portal</h1>
            <h2>We make event management easier.</h2>
            <a href="/eventus/contactus.php" class="btn-get-started scrollto">Contact Us</a>
            </div>
        </section><!-- End Hero -->
            <!-- STATISTIC-->
            <section class="statistic statistic2">
                <div class="container">
                    <h2 class="text-center mb-2 p-2 bg-dark text-white">Our Stats</h2>
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="statistic__item statistic__item--green">
                                <h2 class="number">10,368</h2>
                                <span class="desc">members online</span>
                                <div class="icon">
                                    <i class="zmdi zmdi-account-o"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="statistic__item statistic__item--orange">
                                <h2 class="number">388,688</h2>
                                <span class="desc">items sold</span>
                                <div class="icon">
                                    <i class="zmdi zmdi-shopping-cart"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="statistic__item statistic__item--blue">
                                <h2 class="number">1,086</h2>
                                <span class="desc">this week</span>
                                <div class="icon">
                                    <i class="zmdi zmdi-calendar-note"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END STATISTIC-->
            <!-- Testimonial -->
            <section class="testimonial text-center">
                <div class="container">
        
                    <div class="heading white-heading">
                        Testimonial
                    </div>
                    <div id="testimonial4" class="carousel slide testimonial4_indicators testimonial4_control_button thumb_scroll_x swipe_x" data-ride="carousel" data-pause="hover" data-interval="5000" data-duration="2000">
                     
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active">
                                <div class="testimonial4_slide">
                                    <img src="https://i.ibb.co/8x9xK4H/team.jpg" class="img-circle img-responsive" />
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
                                    <h4>Client 1</h4>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="testimonial4_slide">
                                    <img src="https://i.ibb.co/8x9xK4H/team.jpg" class="img-circle img-responsive" /><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
                                    <h4>Client 2</h4>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="testimonial4_slide">
                                    <img src="https://i.ibb.co/8x9xK4H/team.jpg" class="img-circle img-responsive" />
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
                                    <h4>Client 3</h4>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#testimonial4" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </a>
                        <a class="carousel-control-next" href="#testimonial4" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </a>
                    </div>
                </div>
            </section>
            <!-- End Testimonial -->

            <!-- Call to Action -->
            
            <?php
                if(!isset($_SESSION['email']))
                {
                    echo ' <section>
                    <div class="py-5 bg-light service-34 wrap-service34-box">
                        <!-- Row  -->
                        <div class="row ">
                            <div class="col-lg-6 left-image"> 
                                        <img src="./images/image1.jpg" class="img-fluid" alt="wrappixel" /> 
                                    </div>
                            <div class="container">
                                <div class="col-lg-6 ml-auto">
                                    <div class=""> 
                                        <span class="badge badge-danger rounded-pill px-3 py-1 font-weight-light">Live Now</span>
                                        <h3 class="my-3 text-uppercase">The Best Event Management Portal is now Live</h3>
                                        <p class="op-8">You can relay on our amazing features list and also our customer services will be great experience.To get access to the portal just click the Register Button Below</p>
                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <div class="card card-shadow border-0 mb-3">
                                                    <div class="card-body">
                                                        <div class="row p-3">
                                                            <div class="col-lg-12 mt-3"> 
                                                             <a class="btn btn-success-gradiant btn-md btn-block" href="/eventus/users/register.php"><span>Register Now - Its Free</span></a> </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Column -->
                        </div>
                    </div>
                </section>';
                }
                ?>
           
            <!-- Call to Action - End -->

            <!-- COPYRIGHT-->
            <section class="p-t-60 p-b-20">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="copyright">
                                <p>Copyright © 2020 Eventus. All rights reserved</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END COPYRIGHT-->
        </div>

    </div>
    <div class="icon-bar">
  <a href="https://www.facebook.com/" class="facebook"><i class="fa fa-facebook"></i></a> 
  <a href="https://linkedin.com/" class="linkedin"><i class="fa fa-linkedin"></i></a>
  <a href="https://www.youtube.com/" class="youtube"><i class="fa fa-youtube"></i></a> 
</div>
              
    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->
