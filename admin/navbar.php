<?php

    if(isset($_REQUEST['logout']))
    {
        $object =new admin;
        $object->logout();
        header('location:/eventus/admin/adminlogin.php');
    }
    if(!isset($_SESSION['id']))
    {
        header('location:/eventus/admin/adminlogin.php');
    }
?>
<!-- HEADER DESKTOP-->
<header class="header-desktop3 d-none d-lg-block">
    <div class="section__content section__content--p35">
        <div class="header3-wrap">
            <div class="header__logo">
                <a href="/eventus/admin/home.php">
                    <img src="https://i.imgur.com/hBZkkPY.png?1" alt="EVENTUS" />
                </a>
            </div>
            <div class="header__navbar">
                <ul class="list-unstyled">
                    <li>
                        <a href=/eventus/admin/home.php>
                            <i class="fas fa-home"></i>
                            <span class="bot-line"></span>Home</a>
                    </li>
                    <li class="has-sub">
                        <a href="#">
                            <i class="fas fa-user"></i>Users
                            <span class="bot-line"></span>
                        </a>
                        <ul class="header3-sub-list list-unstyled">
                            <li>
                                <a href="/eventus/admin/activeusers.php">Active Users</a>
                            </li>
                            <li>
                                <a href="/eventus/admin/pendingusers.php">Pending Users</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="/eventus/admin/allvenues.php">
                            <i class="fas fa-map-marker"></i>
                            <span class="bot-line"></span>Venues</a>
                    </li>
                    <li>
                            <li>
                        <a href="/eventus/admin/allrequests.php">
                            <i class="fa fa-tag"></i>
                            <span class="bot-line"></span>Event Booking</a>
                    </li>
                    </li>
                </ul>
            </div>
            <div class="header__tool">
               <div class="account-wrap">
               <ul class="list-unstyled">
                    </li>
                    <li><form action="" methode="request"><button  class="btn btn-outline-secondary btn-lg btn-block bo-5" style="border-style:none  "  value="logout"  name="logout" >Log out</button></form></li>
                </ul>
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
                <a class="logo" href="/eventus/admin/home.php">
                    <img src="https://i.imgur.com/hBZkkPY.png?1" alt="EVENTUS" />
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
                        <a href="/eventus/admin/home.php">
                            <i class="fas fa-home"></i>
                            <span class="bot-line"></span>Home</a>
                    </li>
                    <li class="has-sub">
                        <a href="#">
                            <i class="fas fa-user"></i>Users
                            <span class="bot-line"></span>
                        </a>
                        <ul class="header3-sub-list list-unstyled">
                            <li>
                                <a href="/eventus/admin/activeusers.php">Active Users</a>
                            </li>
                            <li>
                                <a href="/eventus/admin/pendingusers.php">Pending Users</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="/eventus/admin/allvenues.php">
                            <i class="fas fa-map-marker"></i>
                            <span class="bot-line"></span>Venues</a>
                    </li>
                    <li>
                        <a href="/eventus/admin/allrequests.php">
                            <i class="fa fa-tag"></i>
                            <span class="bot-line"></span>Event Booking</a>
                    </li>
                       <li>
                       <form action="" methode="request"><button  class="btn btn-outline-secondary btn-lg btn-block bo-5" style="border-style:none  "  value="logout"  name="logout" >Log out</button></form>
                       </li>     
                </ul>
        </div>
    </nav>
</header>

<!-- END HEADER MOBILE -->
