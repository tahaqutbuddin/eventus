<?php

    if(isset($_REQUEST['logout']))
    {
        $object =new users;
        $object->logout();
        header('location:/eventus/index.php');
    }
?>
<!-- HEADER DESKTOP-->
<header class="header-desktop3 d-none d-lg-block">
    <div class="section__content section__content--p35">
        <div class="header3-wrap">
            <div class="header__logo" style="height:80%" >
                <a href="/eventus/index.php">
                    <img src="https://i.imgur.com/3xK3BNI.png?1" alt="EVENTUS" />
                </a>
            </div>
            <div class="header__navbar">
                <ul class="list-unstyled">
                    <li>
                        <a href="/eventus/index.php">
                            <i class="fas fa-home"></i>
                            <span class="bot-line"></span>Home</a>
                    </li>
                    <?php 
                            if(isset($_SESSION['email']) || isset($_SESSION['userid']))
                            {
                                echo '<li>
                                <a href="/eventus/users/search_temp.php">
                                    <i class="fas fa-copy"></i>
                                    <span class="bot-line"></span>Make a Request</a>
                            </li>
                            <li>
                                <a href="/eventus/users/allrequestsuser.php">
                                    <i class="fas fa-file"></i>
                                    <span class="bot-line"></span>My Requests</a>
                            </li>
                            <li><a href="/eventus/users/upcoming.php">
                                <i class="fa fa-calendar-o"></i>
                                <span class="bot-line"></span>Upcoming Events</a>
                            </li>';
                            }else
                            {
                            }
                    ?>

                    <li>
                        <a href="table.html">
                            <i class="fas fa-user"></i>
                            <span class="bot-line"></span>About Us</a>
                    </li>
                    <li>
                        <a href="/eventus/contactus.php">
                            <i class="fas fa-phone"></i>
                            <span class="bot-line"></span>Contact Us</a>
                    </li>
                </ul>
            </div>
            <div class="header__tool">
               <div class="account-wrap">
                    <div class="account-item account-item--style2 clearfix js-item-menu">
                    <?php 
                            if(isset($_SESSION['email']) || isset($_SESSION['userid']))
                            {
                                echo '<div class="image">
                                        <img src="/eventus/images/icon/user.jpg" alt="'.$_SESSION['name'].'" />
                                    </div>
                                    <div class="content">
                                        <a class="js-acc-btn" href="#">'.$_SESSION['name'].'</a>
                                    </div>
                                    <div class="account-dropdown js-dropdown">
                                        <div class="info clearfix">
                                            <div class="image">
                                                <a href="#">
                                                    <img src="/eventus/images/icon/user.jpg" alt="'.$_SESSION['name'].'" />
                                                </a>
                                            </div>
                                            <div class="content">
                                                <h5 class="name">
                                                    <a href="#">'.$_SESSION['name'].'</a>
                                                </h5>
                                                <span class="email">'.$_SESSION['email'].'</span>
                                            </div>
                                        </div>
                                        <div class="account-dropdown__body">
                                            <div class="account-dropdown__item">
                                                <a href="#">
                                                    <i class="zmdi zmdi-account"></i>Account</a>
                                            </div>
                                        </div>
                                        <div class="account-dropdown__footer">

                                                <form action="/eventus/index.php" methode="request">
                                                <button  class="btn btn-outline-secondary btn-lg btn-block" style="border-style:none "    value="logout"  name="logout" >Log out</button></form>
        
                                        </div>
                                    </div>';
                            }else
                            {
                                echo '<button class="btn btn-secondary " onClick="parent.location=(\'/eventus/users/login.php\')" type="button" name="log-in" style="margin-right: 5px" >Login</button>';
                                echo '<button class="btn btn-secondary" onClick="parent.location=(\'/eventus/users/register.php\')" type="button" name="register">Register</button>';
                            }

                        ?>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</header>
<!-- END HEADER DESKTOP-->

<!-- HEADER MOBILE-->
<header class="header-mobile header-mobile-2 d-block d-lg-none">
    <div class="header-mobile__bar">
        <div class="container-fluid">
            <div class="header-mobile-inner">
                <a class="logo" href="/eventus/index.php">
                    <img src="https://i.imgur.com/3xK3BNI.png?1" alt="EVENTUS" />
                </a>
                <button class="hamburger hamburger--slider" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <nav class="navbar-mobile">
        <div class="container-fluid">
            <ul class="navbar-mobile__list list-unstyled">
                <li>
                    <a href="/eventus/index.php">
                        <i class="fas fa-home"></i>
                        <span class="bot-line"></span>Home</a>
                </li>
                <?php 
                        if(isset($_SESSION['email']) || isset($_SESSION['userid']))
                        {
                            echo '<li>
                            <a href="/eventus/users/search_temp.php">
                                <i class="fas fa-copy"></i>
                                <span class="bot-line"></span>Make a Request</a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-file"></i>
                                <span class="bot-line"></span>My Requests</a>
                        </li>
                        <li><a href="/eventus/users/upcoming.php">
                            <i class="fa fa-calendar-o"></i>
                            <span class="bot-line"></span>Upcoming Events</a>
                         </li>';
                        }
                ?>
                <li> 
                    <a href="table.html">
                        <i class="fas fa-user"></i>
                        <span class="bot-line"></span>About Us</a>
                </li>
                <li>
                    <a href="/eventus/contactus.php">
                        <i class="fas fa-phone"></i>
                        <span class="bot-line"></span>Contact Us</a>
                </li>
                <?php 
            
                        if(!isset($_SESSION['email']) || isset($_SESSION['userid']))
                        {
                            echo '
                            <li> 
                            <a href="/eventus/users/login.php">
                                <i class="fa fa-user"></i>
                                <span class="bot-line"></span>Login</a>
                        </li>
                        <li>
                            <a href="/eventus/users/register.php">
                                <i class="fa  fa-share"></i>
                                <span class="bot-line"></span>Register</a>
                        </li>';
                        }
                ?>
                
            </ul>
        </div>
    </nav>
</header>
<?php 
        if(isset($_SESSION['email']) || isset($_SESSION['userid']))
        {
            echo '  <div class="sub-header-mobile-2 d-block d-lg-none">
    <div class="header__tool">
       <div class="account-wrap">
            <div class="account-item account-item--style2 clearfix js-item-menu">
                <div class="image">
                    <img src="/eventus/images/icon/user.jpg" alt="'.$_SESSION['name'].'" />
                </div>
                <div class="content">
                    <a class="js-acc-btn" href="#">'.$_SESSION['name'].'</a>
                </div>
                <div class="account-dropdown js-dropdown">
                    <div class="info clearfix">
                        <div class="image">
                            <a href="#">
                                <img src="/eventus/images/icon/user.jpg" alt="'.$_SESSION['name'].'" />
                            </a>
                        </div>
                        <div class="content">
                            <h5 class="name">
                                <a href="#">'.$_SESSION['name'].'</a>
                            </h5>
                            <span class="email">'.$_SESSION['email'].'</span>
                        </div>
                    </div>
                    <div class="account-dropdown__body">
                        <div class="account-dropdown__item">
                            <a href="#">
                                <i class="zmdi zmdi-account"></i>Account</a>
                        </div>
                    </div>
                    <div class="account-dropdown__footer">
                    <form action="" methode="request"><button  class="btn btn-outline-secondary btn-lg btn-block bo-5" style="border-style:none  "  value="logout"  name="logout" >Log out</button></form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>';
        }
?>

<!-- END HEADER MOBILE -->
