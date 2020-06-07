
<?php
require '../includes/users.php';
$obj = new users;
session_start();
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

            
            <h2 class="mt-3 text-center bg-dark text-white p-3">Your Requests</h2>

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
                                                <label for="ID">Event Name: </label>
                                                <input readonly type="text" class="form-control" id="s_name">
                                            </div>

                                        </div>

                                        <div class="form-row justify-content-center">
                
                                            <div class="form-group col-12">
                                                <label for="client">Event Desc: </label>
                                                <input readonly type="text" class="form-control" id="s_desc">
                                            </div>
                
                                        </div>

                                        <div class="form-row justify-content-center">
                                            <div class="form-group col-12">
                                                <label for="Music">Event Cat: </label>
                                                <input readonly type="number" class="form-control" id="s_cat" >
                                            </div>
                                        </div>

                                        <div class="form-row justify-content-center">
                                            <div class="form-group col-12">
                                                <label for="venue">Client: </label>
                                                <input readonly type="number" class="form-control" id="s_cid">
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
                                                <label for="audience">Price: </label>
                                                <input readonly type="number" class="form-control" id="s_price">
                                            </div>
                                        </div>
                                    
                                        <div class="form-row justify-content-center">
                                            <div class="form-group col-12">
                                                <label for="Budget Min">Promotion: </label>
                                                <input readonly type="text" class="form-control" id="s_promotion" >
                                            </div>
                                        </div>

                                        <div class="form-row justify-content-center">
                                            <div class="form-group col-12">
                                                <label for="Budget Max">Music: </label>
                                                <input readonly type="text" class="form-control" id="s_music" >
                                            </div>
                                        </div>

                                        <div class="form-row justify-content-center">
                                            <div class="form-group col-12">
                                                <label for="Music">Venue: </label>
                                                <input readonly type="number" class="form-control" id="s_vid" >
                                            </div>
                                        </div>
                                        <div class="form-row justify-content-center">
                                            <div class="form-group col-12">
                                                <label for="Activity">Decoration: </label>
                                                <input readonly type="text" class="form-control" id="s_activity" >
                                            </div>
                                        </div>
                                        <div class="form-row justify-content-center">
                                            <div class="form-group col-12">
                                                <label for="Status">Cake: </label>
                                                <input readonly type="text" class="form-control" id="s_status" >
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


            <!-- NEW CHANGE -->
            <!-- Show Participants -->

            <div class="modal fade" id="participant-form" tabindex="-1" role="dialog" aria-labelledby="Custom Form" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <div class="container">
                        <div class="row">
                            <div class="p-0 mb-2 col-sm-12">
                                <h2 class="mt-2 text-center bg-dark text-white p-3"><i class="fas fa-user"></i> PARTICIPANTS</h2>
                            </div>
                            
                        </div>
                        </div>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">

                                <div id="participants"></div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <button  type="button" class="btn btn-block btn-danger" data-dismiss="modal"><i class="fas fa-window-close"></i> Close</button>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Review Form -->

            <div class="modal fade" id="review-form" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" aria-labelledby="Custom Form" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <div class="container">
                        <div class="row">
                            <div class="p-0 mb-2 col-sm-12">
                                <h2 class="mt-2 text-center bg-dark text-white p-3"><i class="fas fa-comments"></i> REPLIES</h2>
                            </div>
                            <div class="mb-2 col-sm-12">
                                <button class="btn btn-outline-dark disabled">
                                <input type="checkbox" name="refresh" id="refresh">
                                Tick the Checkbox to Stop Auto Refresh
                                </button>
                            </div>
                        </div>
                        </div>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                
                            <input readonly hidden type="text" class="form-control" id="bid" >
                            <input readonly hidden type="text" class="form-control" id="cid" >


                                <div id="replies"></div>

    
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="container">
                            <div class="form-row justify-content-center">
                                <div class="form-group col-12">
                                    <textarea required class="form-control" rows="3" id="message"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <button  type="button" onclick="addReply()" class="btn btn-block btn-success"><i class="fas fa-edit"></i> Add New Comment</button>
                                </div>
                                <div class="col-sm-6">
                                    <button  type="button" onclick="stopInterval(); deleteNotification();" class="btn btn-block btn-danger" data-dismiss="modal"><i class="fas fa-window-close"></i> Close</button>
                                </div>
                            </div>
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
        //NEW CHANGE
        function showMore(e_name, e_desc, e_cid, e_date, e_price, e_promotion, e_music, e_vid, e_activity, e_status, e_cat_id){

            $('#s_name').val(e_name);
            $('#s_desc').val(e_desc);
            $('#s_cat').val(e_cat_id);
            $('#s_cid').val(e_cid);
            $('#s_date').val(e_date);
            $('#s_price').val(e_price);
            $('#s_promotion').val(e_promotion);
            $('#s_music').val(e_music);
            $('#s_vid').val(e_vid);
            $('#s_activity').val(e_activity);
            $('#s_status').val(e_status);

            $('#show-more').modal();
        }

        // NEW CHANGE
        function participantForm(bid){
            $.ajax({
            url: '../includes/users_ajax.php',
            type: 'post',
            data: {req: "fetch-participants", bid:bid},
            success: function(response){ 
                // Add response in Modal body
                $('#participants').html(response);

            }
            });

            $('#participant-form').modal();

        }

        //NEW CHANGE
        function fetchurl(route){
            var baseURL = "http://localhost/eventus/users/event.php?route="
            alert("Your Event Url is: "+baseURL+route);
        }
        
        setInterval(() => {
            fetchRequests();
        }, 5000);


        var intervalId;
        function startInterval(){
            
            intervalId=setInterval(() => {
            checkModal();
        }, 3000);
        }
        

        function stopInterval(){
            clearInterval(intervalId);
        }

        function checkModal(){
            if($('#review-form').is(':visible')){
                var bid = $('#bid').val();
                var cid = $('#cid').val();
                fetchReplies(bid, cid);
            }
        }


     
        function fetchReplies(bid, cid){
            $.ajax({
            url: '../includes/users_ajax.php',
            type: 'post',
            data: {req: "fetch-replies", cuser:"client", bid:bid, cid:cid},
            success: function(response){ 
                // Add response in Modal body
                $('#replies').html(response);

                    if ($('#refresh').is(":checked"))
                    {
                    }
                    else{
                        $("#replies").animate({ scrollTop: $('#replies').prop("scrollHeight")}, 1000);
                    }

            }
            });
        }

        function addReply(){
            var message = $('#message').val();
            var bid = $('#bid').val();
            var cid = $('#cid').val();

            $.ajax({
            url: '../includes/users_ajax.php',
            type: 'post',
            data: {req: "send-replies", message:message, bid:bid, from:cid, to:"admin"},
            success: function(response){ 
                // Add response in Modal body
                fetchReplies(bid, cid);
                $('#message').val("");
                fetchRequests();

            }
            });
        }
        
        function deleteNotification(){
            var bid = $('#bid').val();
            
            $.ajax({
            url: '../includes/users_ajax.php',
            type: 'post',
            data: {req: "delete-notification",bid:bid, to:0},
            success: function(response){ 
              console.log("dismissed");
            }
            });
        }

        function deleteReply(id){

            $.ajax({
            url: '../includes/users_ajax.php',
            type: 'post',
            data: {req: "delete-reply", id:id},
            success: function(response){ 
                // Add response in Modal body
                var bid = $('#bid').val();
                var cid = $('#cid').val();
                fetchReplies(bid, cid);
                fetchRequests();
            }
            });
        }

        function fetchRequests(){

            $.ajax({
            url: '../includes/users_ajax.php',
            type: 'post',
            data: {req: "fetch-requests", cuser: <?php echo $_SESSION['userid'];?>},
            success: function(response){ 

                $('#requests').html(response);
                
            }
            });

        }

        function showReviewForm(b, c){
            console.log("working fine");
            $('#message').val("");
            
            fetchReplies(b, c);

            $('#bid').val(b);
            $('#cid').val(c);

            $('#review-form').modal();

            
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
