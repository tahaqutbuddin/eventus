<?php
require '../includes/admin.php';
$obj = new admin;

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

<?php
require '../includes/headerlinks.php';
?>

    <style>

        #review-form .modal-body #replies{
            max-height: calc(100vh - 350px);
            overflow-y: auto;
        }


    </style>

</head>

<body class="animsition">
    <div class="page-wrapper">
        
    <?php     require 'navbar.php'?>

        <!-- PAGE CONTENT-->
        <div class="page-content--bgf7">  

            
            <h2 class="text-center bg-dark text-white text-uppercase p-3">All Requests</h2>

            <!-- DATA TABLE-->
            <section class="p-t-20">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive m-b-40">
                                <table id="table-ven" class="table table-borderless table-data3">
                                    <thead>
                                        <tr>
                                           
                                            <th>NO.</th>
                                            <th>EVENT TYPE</th>
                                            <th>DATE</th>
                                            <th>ACTIVITY</th>
                                            <th>STATUS</th>
                                            <th>ACTION</th>
                                            <th>MORE...</th>
                                        </tr>
                                    </thead>
                                    <tbody id="requests">
            
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END DATA TABLE-->

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
                                                <label for="ID">Event ID: </label>
                                                <input readonly type="number" class="form-control" id="s_id">
                                            </div>

                                        </div>

                                        <div class="form-row justify-content-center">
                                            
                                            <div class="form-group col-12">
                                                <label for="ID">Event Name: </label>
                                                <input readonly type="text" class="form-control" id="s_name">
                                            </div>

                                        </div>

                                        <div class="form-row justify-content-center">
                
                                            <div class="form-group col-12">
                                                <label for="client">Event Descrpition: </label>
                                                <input readonly type="text" class="form-control" id="s_desc">
                                            </div>
                
                                        </div>

                                        <div class="form-row justify-content-center">
                                            <div class="form-group col-12">
                                                <label for="Music">Event Category: </label>
                                                <input readonly type="text" class="form-control" id="s_cat" >
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
                                                <input readonly type="text" class="form-control" id="s_vid" >
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
                                                <label for="Status">Status: </label>
                                                <input readonly type="text" class="form-control" id="s_status" >
                                            </div>
                                        </div>

                                        <div class="form-row justify-content-center">
                                            
                                            <div class="form-group col-12">
                                                <label for="Facebook">Facebook Link: </label>
                                                <input readonly type="text" class="form-control" id="s_facebook">
                                            </div>

                                        </div>

                                        <div class="form-row justify-content-center">
                                            
                                            <div class="form-group col-12">
                                                <label for="Website">Website URL: </label>
                                                <input readonly type="text" class="form-control" id="s_website">
                                            </div>

                                        </div>

                                        <div class="form-row justify-content-center">
                                            
                                            <div class="form-group col-12">
                                                <label for="Whatsapp">Whatsapp: </label>
                                                <input readonly type="text" class="form-control" id="s_whatsapp">
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
            <!-- Update Modal -->

            <div class="modal fade" id="update-form" tabindex="-1" role="dialog" aria-labelledby="Custom Form" aria-hidden="true">
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
                                    <div id="update-content">

                                        <div class="form-row justify-content-center">
                                            
                                            <div class="form-group col-12">
                                                <label for="ID">Event ID: </label>
                                                <input readonly type="number" class="form-control" id="u_id">
                                            </div>

                                        </div>

                                        <div class="form-row justify-content-center">
                                            
                                            <div class="form-group col-12">
                                                <label for="ID">Event Name: </label>
                                                <input type="text" class="form-control" id="u_name">
                                            </div>

                                        </div>

                                        <div class="form-row justify-content-center">
                
                                            <div class="form-group col-12">
                                                <label for="client">Event Desc: </label>
                                                <input type="text" class="form-control" id="u_desc">
                                            </div>
                
                                        </div>

                                        <div class="form-row justify-content-center">
                                            <div class="form-group col-12">
                                                <label for="Music">Event Cat: </label>
                                                <input readonly type="text" class="form-control" id="u_cat" >
                                            </div>
                                        </div>

                                        <div class="form-row justify-content-center">
                                            <div class="form-group col-12">
                                                <label for="venue">Client: </label>
                                                <input readonly type="number" class="form-control" id="u_cid">
                                            </div>
                                        </div>

                                        <div class="form-row justify-content-center">
                                            <div class="form-group col-12">
                                                <label for="date">Booking Date: </label>
                                                <input type="date" class="form-control" id="u_date">
                                            </div>
                                        </div>
                
                                        <div class="form-row justify-content-center">
                                            <div class="form-group col-12">
                                                <label for="audience">Price: </label>
                                                <input type="number" class="form-control" id="u_price">
                                            </div>
                                        </div>
                                    
                                        <div class="form-row justify-content-center">
                                            
                                            <div class="form-group col-12">
                                            <label for="activity">Promotion: </label>
                                                <select class="form-control" name="u_promotion" id="u_promotion">
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-row justify-content-center">
                                            
                                            <div class="form-group col-12">
                                            <label for="activity">Music: </label>
                                                <select class="form-control" name="u_music" id="u_music">
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-row justify-content-center">
                                            <div class="form-group col-12">
                                                <label for="Music">Venue: </label>
                                                <input readonly type="text" class="form-control" id="u_vid" >
                                            </div>
                                        </div>

                                        <div class="form-row justify-content-center">
                                            
                                            <div class="form-group col-12">
                                            <label for="activity">Activity: </label>
                                                <select class="form-control" name="u_activity" id="u_activity">
                                                    <option value="private">Private</option>
                                                    <option value="public">Public</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-row justify-content-center">
                                            
                                            <div class="form-group col-12">
                                            <label for="status">Status: </label>
                                                <select class="form-control" name="u_status" id="u_status">
                                                    <option value="accepted">Accepted</option>
                                                    <option value="rejected">Rejected</option>
                                                </select>
                                            </div>
                                        </div>
            

                                        <div class="form-row justify-content-center">
                                            
                                            <div class="form-group col-12">
                                                <label for="Facebook">Facebook Link: </label>
                                                <input type="text" class="form-control" id="u_facebook">
                                            </div>

                                        </div>

                                        <div class="form-row justify-content-center">
                                            
                                            <div class="form-group col-12">
                                                <label for="Website">Website URL: </label>
                                                <input type="text" class="form-control" id="u_website">
                                            </div>

                                        </div>

                                        <div class="form-row justify-content-center">
                                            <div class="form-group col-12">
                                                <label for="Whatsapp">Whatsapp: </label>
                                                <input type="text" class="form-control" id="u_whatsapp">
                                            </div>
                                        </div>
                
                                        <div class="row">
                                        <button  type="button" class="btn btn-block btn-warning" onclick="updateRequest()"><i class="fas fa-edit"></i> Update</button>
                                        <button  type="button" class="btn btn-block btn-danger" data-dismiss="modal"><i class="fas fa-window-close"></i> Close</button>
                                        </div>
                
                                    </div>
                                    <!-- here is error -->
                                    <div id="mess" class="alert alert-success fade show" role="alert">
                                    <strong>Event Data Updated</strong>
                                    </div>

                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Review Form -->
            <!-- Modal -->

            <div class="modal fade" id="review-form" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-labelledby="Custom Form" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-lg modal-dialog-centered" role="document">
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
                                <div class="col-sm-4">
                                    <button  type="button" onclick="addReply()" class="btn btn-block btn-success"><i class="fas fa-edit"></i> Add New Comment</button>
                                </div>
                                <div class="col-sm-4">
                                    <button  type="button" onclick="sendEmail()" class="btn btn-block btn-info"><i class="fas fa-envelope"></i> Send Email</button>
                                </div>
                                <div class="col-sm-4">
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
    </script>

<script>

        fetchRequests();

        setInterval(() => {
            fetchRequests();
        }, 5000);
        //Show More Modal Functionality
        function showMore(e_id, e_name, e_desc, e_cid, e_date, e_price, e_promotion, e_music, e_vid, e_activity, e_status, e_cat_id, e_facebook, e_whatsapp, e_website){
        $('#s_id').val(e_id);
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
        $('#s_facebook').val(e_facebook);
        $('#s_whatsapp').val(e_whatsapp);
        $('#s_website').val(e_website);

        $('#show-more').modal();
        }

        //NEW CHANGE
        function update(e_id, e_name, e_desc, e_cid, e_date, e_price, e_promotion, e_music, e_vid, e_activity, e_status, e_cat_id, e_facebook, e_whatsapp, e_website){
        $('#u_id').val(e_id);
        $('#u_name').val(e_name);
        $('#u_desc').val(e_desc);
        $('#u_cat').val(e_cat_id);
        $('#u_cid').val(e_cid);
        $('#u_date').val(e_date);
        $('#u_price').val(e_price);
        $('#u_promotion').val(e_promotion);
        $('#u_music').val(e_music);
        $('#u_vid').val(e_vid);
        $('#u_facebook').val(e_facebook);
        $('#u_whatsapp').val(e_whatsapp);
        $('#u_website').val(e_website);

        $('#update-content').show();
        $('#mess').hide();

        $("#u_activity > option").each(function() {
                if(this.value == e_activity){
                    $(this).attr("selected","selected");
                }
        });

        $("#u_status > option").each(function() {
                if(this.value == e_activity){
                    $(this).attr("selected","selected");
                }
        });

        $("#u_promotion > option").each(function() {
                if(this.value == e_activity){
                    $(this).attr("selected","selected");
                }
        });

        $("#u_music > option").each(function() {
                if(this.value == e_activity){
                    $(this).attr("selected","selected");
                }
        });

        $('#update-form').modal();
        }

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
            url: '../includes/admin_ajax.php',
            type: 'post',
            data: {req: "fetch-replies",cuser:"admin", bid:bid, cid:cid},
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

        function acceptRequest(bid){
            
            $.ajax({
            url: '../includes/admin_ajax.php',
            type: 'post',
            data: {req: "accept-request", bid:bid},
            success: function(response){ 
                fetchRequests();
                
            }
            });
        }

        function rejectRequest(bid){
            $.ajax({
            url: '../includes/admin_ajax.php',
            type: 'post',
            data: {req: "reject-request", bid:bid},
            success: function(response){ 
                fetchRequests();
            }
            });
        }

        function updateRequest(){
        var bid = $('#u_id').val();
        var name = $('#u_name').val();
        var desc = $('#u_desc').val();
        var cat = $('#u_cat').val();
        var cid = $('#u_cid').val();
        var date = $('#u_date').val();
        var price = $('#u_price').val();
        var promotion = $('#u_promotion').val();
        var music = $('#u_music').val();
        var venue = $('#u_vid').val();
        var activity = $('#u_activity').val();
        var status = $('#u_status').val();
        var facebook = $('#u_facebook').val();
        var whatsapp = $('#u_whatsapp').val();
        var website = $('#u_website').val();

        $.ajax({
        url: '../includes/admin_ajax.php',
        type: 'post',
        data: {req: "update-request", bid:bid, name:name, desc:desc, cat:cat, cid:cid, date:date, price:price, promotion:promotion, music:music, venue:venue, activity:activity, status:status, facebook:facebook, whatsapp:whatsapp, website:website},
        success: function(response){ 
            $('#update-content').hide();
            $('#mess').show();
            fetchRequests();
        }
        });
        }

        function deleteBooking(bid){
            console.log("function working");
            $.ajax({
            url: '../includes/admin_ajax.php',
            type: 'post',
            data: {req: "delete-booking",bid:bid},
            success: function(response){ 
            
                fetchRequests();
            }
            });
        }

        function addReply(){
            var message = $('#message').val();
            var bid = $('#bid').val();
            var cid = $('#cid').val();

            $.ajax({
            url: '../includes/admin_ajax.php',
            type: 'post',
            data: {req: "send-replies", message:message, bid:bid, from:"admin", to:cid},
            success: function(response){ 
                
                fetchReplies(bid, cid);
                $('#message').val("");
                fetchRequests();
              
            }
            });
        }

        function sendEmail(){
            var message = $('#message').val();
            var cid = $('#cid').val();

            $.ajax({
            url: '../includes/admin_ajax.php',
            type: 'post',
            data: {req: "send-email", message:message, cid:cid},
            success: function(response){ 
            
              $('#message').val("");
            }
            });
        }

        function deleteNotification(){
            var bid = $('#bid').val();
            var cid = $('#cid').val();
            $.ajax({
            url: '../includes/admin_ajax.php',
            type: 'post',
            data: {req: "delete-notification",bid:bid, to:cid},
            success: function(response){ 
              console.log("dismissed");
            }
            });
        }

        function deleteReply(id){

            $.ajax({
            url: '../includes/admin_ajax.php',
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
            url: '../includes/admin_ajax.php',
            type: 'post',
            data: {req: "fetch-requests", cuser: "admin"},
            success: function(response){ 

                $('#requests').html(response);
            }
            });

        }

        function showReviewForm(b, c){
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
