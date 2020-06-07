<?php
require '../includes/users.php';
$obj = new users;
session_start();
if(!isset($_SESSION['email']) ||  !isset($_SESSION['userid']))  // checking is user is logged in else redirect to HOME
{
   header('location:/eventus/index.php');
   return;
}

if(isset($_GET["route"])  != null ){
    //Set Client ID from Session as uid
    $uid = $_SESSION['userid'];
    $res = $obj->showSingleEvent($uid, $_GET["route"]);
}
else{
    echo "null";
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
        
    <?php     require '../navbar.php'?>

        <!-- PAGE CONTENT-->
        <div class="page-content--bgf7">  


            <div class="container">
                <div id="event" class="row mt-3">
                    <?php echo $res ?>
                </div>
            </div>


            <!-- modals -->
            <!-- Show More Modal -->

            <!-- The Modal -->
            <div class="modal" id="register">
            <div class="modal-dialog">
                <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Event Registration</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div id="mbody" class="modal-body">
                    <input id="bid" type="text" hidden>
                    Press the Register Button to Confirm Your Registration
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" id="sbutton" onclick="register();" class="btn btn-success">Register</button>
                    <button type="button" onclick="location.reload();" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

                </div>
            </div>
            </div>

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

   <?php
   require '../includes/footerlinks.php';
   ?>

    <!-- Main JS-->
    <script src="js/main.js"></script>

    <script>
    function openRegisterForm(bid){
        $('#bid').val(bid);
        $('#register').modal();
    }

    function register(){
        $('#sbutton').show();
        var bid = $('#bid').val();
        //Set Client ID From Session as uid
        var cid = <?php echo $_SESSION['userid']; ?>;
        $.ajax({
        url: '../includes/users_ajax.php',
        type: 'post',
        data: {req: "register-participant", bid:bid, cid:cid},
        success: function(response){ 
            $('#mbody').html('<h3 class="bg-success text-white p-3">Registration Successful</h3>');
            $('#sbutton').hide();
        }
        });
    }


    </script>

    <!-- To Stop Multiple Reloading -->
    <script>
        if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
        }
    </script>

</body>

</html>


<!-- end document-->
