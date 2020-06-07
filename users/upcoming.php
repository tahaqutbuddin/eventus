<?php
session_start();
require '../includes/users.php';
$obj = new users;


if(!isset($_SESSION['email']) ||  !isset($_SESSION['userid']))  // checking is user is logged in else redirect to HOME
{
   header('location:/eventus/index.php');
   return;
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

    <style>
    /* For Scrollable Function In Modal */
   
       
        #review-form .modal-body #replies{
            max-height: calc(100vh - 350px);
            overflow-y: auto;
        }

    </style>

</head>

<body class="animsition">
    <div class="page-wrapper">
        
    <?php     require '../navbar.php'?>

        <!-- PAGE CONTENT-->
        <div class="page-content--bgf7">  

            
            <h2 class="text-center bg-dark text-white p-3">Upcomming Events</h2>

            <div class="container">
                <div id="requests" class="row mt-3">
                    
                </div>
            </div>


            <!-- modals -->

            <!-- Show More Modal -->

            <div class="modal fade" id="show-more" tabindex="-1" role="dialog" aria-labelledby="Custom Form" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 id="s_heading" class="modal-title text-center" id="exampleModalLongTitle"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                    <form>

                                        <div class="form-row justify-content-center">
                                            
                                            <div class="form-group col-12">
                                                <label for="ID">Event Type: </label>
                                                <input readonly type="text" class="form-control" id="s_type">
                                            </div>

                                        </div>

                                        <div class="form-row justify-content-center">
                
                                            <div class="form-group col-12">
                                                <label for="client">Client: </label>
                                                <input readonly type="text" class="form-control" id="s_client">
                                            </div>
                
                                        </div>

                                        <div class="form-row justify-content-center">
                                            <div class="form-group col-12">
                                                <label for="venue">Venue: </label>
                                                <input readonly type="text" class="form-control" id="s_venue">
                                            </div>
                                        </div>

                                        <div class="form-row justify-content-center">
                                            <div class="form-group col-12">
                                                <label for="date">Booking Date: </label>
                                                <input readonly type="text" class="form-control" id="s_date">
                                            </div>
                                        </div>
                
                                        <div class="form-row justify-content-center">
                                            <div class="form-group col-12">
                                                <label for="audience">Audience Size: </label>
                                                <input readonly type="number" class="form-control" id="s_audience">
                                            </div>
                                        </div>
                                    
                                        <div class="form-row justify-content-center">
                                            <div class="form-group col-12">
                                                <label for="Budget Min">Budget Min: </label>
                                                <input readonly type="number" class="form-control" id="s_bmin" >
                                            </div>
                                        </div>

                                        <div class="form-row justify-content-center">
                                            <div class="form-group col-12">
                                                <label for="Budget Max">Budget Max: </label>
                                                <input readonly type="number" class="form-control" id="s_bmax" >
                                            </div>
                                        </div>

                                        <div class="form-row justify-content-center">
                                            <div class="form-group col-12">
                                                <label for="Music">Music: </label>
                                                <input readonly type="text" class="form-control" id="s_music" >
                                            </div>
                                        </div>
                                        <div class="form-row justify-content-center">
                                            <div class="form-group col-12">
                                                <label for="Decoration">Decoration: </label>
                                                <input readonly type="text" class="form-control" id="s_decoration" >
                                            </div>
                                        </div>
                                        <div class="form-row justify-content-center">
                                            <div class="form-group col-12">
                                                <label for="Cake">Cake: </label>
                                                <input readonly type="text" class="form-control" id="s_cake" >
                                            </div>
                                        </div>

                                        <div class="form-row justify-content-center">
                                            <div class="form-group col-12">
                                                <label for="Rating">Activity Status: </label>
                                                <input readonly type="text" class="form-control" id="s_activity" >
                                            </div>
                                        </div>
                
                                        <div class="row">
                                        <button  type="button" class="btn btn-block btn-danger" data-dismiss="modal"><i class="fas fa-window-close"></i> Close</button>
                                        </div>
                
                                    </form>

                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- modals-end -->

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
<script>

        fetchRequests();
        //Show More Modal Functionality
        function showMore(eid, cid, vid, date, aud, bmin, bmax, mus, dec, cake, activity){
            $('#s_type').val(eid);
            $('#s_client').val(cid);
            $('#s_venue').val(vid);
            $('#s_date').val(date);
            $('#s_audience').val(aud);
            $('#s_bmin').val(bmin);
            $('#s_bmax').val(bmax);
            $('#s_music').val(mus);
            $('#s_decoration').val(dec);
            $('#s_cake').val(cake);
            $('#s_activity').val(activity);

            $('#show-more').modal();
        }

        
        setInterval(() => {
            fetchRequests();
        }, 5000);

        
    

        function fetchRequests(){

            $.ajax({
            url: '../includes/users_ajax.php',
            type: 'post',
            data: {req: "fetch-upcomming-requests", cuser: <?php echo $_SESSION['userid']; ?>},
            success: function(response){ 

                $('#requests').html(response);
                
            }
            });

        }




  </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

    <!-- To Stop Multiple Reloading -->
    <script>
        if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
        }
    </script>

</body>

</html>


<!-- end document-->
