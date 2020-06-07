<?php
require '../includes/venues.php';
$obj = new venues;


//Sorting Data Requests

if(isset($_GET['sortBy'])=="venue_name"){
    $result = $obj->showAllVenues($_GET['sortBy']); 
}
else if(isset($_GET['sortBy'])=="rating"){
    $result = $obj->showAllVenues($_GET['sortBy']);
}
else{
    $result = $obj->showAllVenues("venue_name"); 
}

//Update Venue Request

if(isset($_POST['updatevenue']))
{
    
    $id = $_POST['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $area = $_POST['area'];

    $price = $_POST['price'];
    $oname = $_POST['oname'];
    $ocontact = $_POST['ocontact'];
    $capacity = $_POST['capacity'];
    $rating = $_POST['rating'];

    
    $obj->updateVenue($id,$name, $address, $price, $oname, $ocontact, $capacity, $rating,$area);

    $obj->addImagesToUploads("update", $id);

    header("Location:/eventus/admin/allvenues.php");
    
};

//Add Venue Request

if(isset($_POST['addvenue']))
{
    
    $name = $_POST['name'];
    $address = $_POST['address'];
    $area = $_POST['area'];
    $price = $_POST['price'];
    $oname = $_POST['oname'];
    $ocontact = $_POST['ocontact'];
    $capacity = $_POST['capacity'];
    $rating = $_POST['rating'];
    $cate = $_POST['cate'];
    $obj->addVenue($name, $address, $price, $oname, $ocontact, $capacity, $rating ,$area);
    $obj->addImagesToUploads("add", 0);
    $obj->save_category($cate);
    header("Location:/eventus/admin/allvenues.php");
    
};

//Delete Venue Request

if(isset($_GET['id'], $_GET['oop'])){
    if($_GET['oop']=="del"){
        $id = $_GET['id'];
        $obj->deleteVenue($id);
    }
    header("Location:/eventus/admin/allvenues.php");
};


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
    <link rel="stylesheet" href="../mycss.css">

    <!-- Main CSS-->
    <link href="../css/theme.css" rel="stylesheet" media="all">
    <link href="../css/dropzone.css" type="text/css" rel="stylesheet">

    <style>
        .carousel-control-prev-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23f00' viewBox='0 0 8 8'%3E%3Cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E");
        }

        .carousel-control-next-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23f00' viewBox='0 0 8 8'%3E%3Cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E");
        }
    </style>


    <style type="text/css">
    /* Yai css image upload form ki hai */
@import "http://fonts.googleapis.com/css?family=Droid+Sans";

#maindiv{
width:960px;
margin:10px auto;
padding:10px;
font-family:'Droid Sans',sans-serif
}
#formdiv{
width:500px;
float:left;
text-align:center
}

.upload{
background-color:red;
border:1px solid red;
color:#fff;
border-radius:5px;
padding:10px;
text-shadow:1px 1px 0 green;
box-shadow:2px 2px 15px rgba(0,0,0,.75)
}
.upload:hover{
cursor:pointer;
background:#c20b0b;
border:1px solid #c20b0b;
box-shadow:0 0 5px rgba(0,0,0,.75)
}
#file{
color:green;
padding:5px;
border:1px dashed #123456;
background-color:#f9ffe5
}
#upload{
margin-left:45px
}
#noerror{
color:green;
text-align:left
}
#error{
color:red;
text-align:left
}
#img{
width:17px;
border:none;
height:17px;
margin-left:-20px;
margin-bottom:91px
}
.abcd{
text-align:center
}
.abcd img{
height:100px;
width:100px;
padding:5px;
border:1px solid #e8debd
}
b{
color:red
}

/* Using this style to set the height to 100% */
.img-fluid {
    max-height: 100%;
}
  </style>

</head>

<body class="animsition">
    <div class="page-wrapper">
        
    <?php     require 'navbar.php'?>

        <!-- PAGE CONTENT-->
        <div class="page-content--bgf7">  

            
            <h2 class="text-center bg-dark text-white p-3">All Venues</h2>
        
            <div class="row">
            <button id="addven" type="button" class="btn btn-lg btn-primary btn-block" data-toggle="modal" data-target="#custom-form">
                <i class="fa fa-plus"></i>&nbsp; ADD A NEW VENUE
            </button>
            </div>
  
            <!-- Sorting Data Buttons -->
            <div class="row mt-3">
                <div class="col-6">
                    <a href="?sortBy=venue_name" class="btn btn-lg btn-danger btn-block">
                        Sort By Name
                    </a>
                </div>
                <div class="col-6">
                    <a href="?sortBy=rating" class="btn btn-lg btn-warning btn-block">
                        Sort By Rating
                    </a>
                </div>
            </div>
            <!-- Sorting Data Buttons End -->

            <!-- DATA TABLE-->
            <section class="p-t-20">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive m-b-40">
                                <table id="table-ven" class="table table-borderless table-data3">
                                    <thead>
                                        <tr>
                                           
                                            <th>No.</th>
                                            <th>NAME</th>
                                            <th>OWNER'S NAME</th>
                                            <th>OWNERS CONTACT</th>
                                            <th>RATING</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php 
                                        echo $result;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END DATA TABLE-->

            <!-- modals -->



            <!-- custom form modal -->
            <div class="modal fade" id="custom-form" tabindex="-1" role="dialog" aria-labelledby="Custom Form" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        
                        <h5 id="m_heading" class="modal-title" id="exampleModalLongTitle"></h5>
                       
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <form  enctype="multipart/form-data" action="allvenues.php"  method="post">

                                        <div id="m_id_block" class="form-row justify-content-center">
                                            
                                            <div class="form-group col-12">
                                                <label for="ID">ID: </label>
                                                <input readonly type="text" class="form-control" id="m_id" name="id" value="" placeholder="">
                                            </div>

                                        </div>

                                        

                                        <div class="form-row justify-content-center">
                
                                            <div class="form-group col-12">
                                                <label for="name">Name: </label>
                                                <input required type="text" class="form-control" id="m_name" name="name" value="" placeholder="Enter Name">
                                            </div>
                
                                        </div>

                                        <div class="form-row justify-content-center">
                                            <div class="form-group col-12">
                                                <label for="address">Address No: </label>
                                                <input required type="text" class="form-control" id="m_address" name="address" placeholder="Enter Address">
                                            </div>
                                        </div>

                                        
                                        <div class="form-row justify-content-center">
                                            <div class="form-group col-12">
                                                <label for="area">Area: </label>
                                                <input required type="text" class="form-control" id="m_area" name="area" placeholder="Enter Area">
                                            </div>
                                        </div>

                                        <div class="form-row justify-content-center">
                                            <div class="form-group col-12">
                                                <label for="price">Price: </label>
                                                <input required type="number" class="form-control" id="m_price" name="price" placeholder="Enter Booking Price">
                                            </div>
                                        </div>
                
                                        <div class="form-row justify-content-center">
                                            <div class="form-group col-12">
                                                <label for="o_name">Owner Name: </label>
                                                <input required type="text" class="form-control" id="m_o_name" name="oname" placeholder="Enter Owner's Name">
                                            </div>
                                        </div>
                                    
                                        <div class="form-row justify-content-center">
                                            <div class="form-group col-12">
                                                <label for="o_contact">Owner Contact: </label>
                                                <input required type="text" class="form-control" id="m_o_contact" name="ocontact" placeholder="Enter Owner's Contact No">
                                            </div>
                                        </div>

                                        <div class="form-row justify-content-center">
                                            <div class="form-group col-12">
                                                <label for="Capacity">Capacity: </label>
                                                <input required type="number" class="form-control" id="m_capacity" name="capacity" placeholder="Enter Seating Capacity">
                                            </div>
                                        </div>

                                        <div class="form-row justify-content-center">
                                            <div class="form-group col-12">
                                                <label for="Rating">Rating: </label>
                                                <input required pattern="[1-5]{1}"  title="Range [1-5]" type="text" class="form-control" id="m_rating" name="rating" placeholder="Enter the Rating">
                                            </div>
                                        </div>

                                        <fieldset>  
                                        <legend>Choose Category</legend>  
                                        <?php echo $obj->show_category(); ?>
                                        </fieldset>  
 

                                        <!-- New -->
                                        <div id="img-grid" class="container mb-3">
                                    
                                        </div>
                                        
                                        <div id="filediv"><input name="file[]" type="file" id="file"/></div>
                                        
                                        <button type="button" id="add_more" class="btn btn-primary upload" value="Add More Files">Add More</button>
                                       
                
                                          
                                        <!-- New End -->

                                        <div class="row">
                                        <button  id="m_button" name="addvenue" type="submit" class="btn btn-block btn-success mb-1"></button>
                                        <button  type="button" class="btn btn-block btn-danger" data-dismiss="modal"><i class="fas fa-window-close"></i> Close</button>
                                        </div>
                
                                </form>

                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
                                                <label for="ID">ID: </label>
                                                <input readonly type="text" class="form-control" id="s_id" name="i" value="" placeholder="Enter the Name">
                                            </div>

                                        </div>


                                        <div id="ven_img" class="container">
                                            
                                        </div>
                                        

                                        <div class="form-row justify-content-center">
                
                                            <div class="form-group col-12">
                                                <label for="name">Name: </label>
                                                <input readonly type="text" class="form-control" id="s_name" name="na" value="" placeholder="Enter the Name">
                                            </div>
                
                                        </div>

                                        <div class="form-row justify-content-center">
                                            <div class="form-group col-12">
                                                <label for="address">Address No: </label>
                                                <input readonly type="text" class="form-control" id="s_address" name="sa" placeholder="Enter Contact No">
                                            </div>
                                        </div>

                                        <div class="form-row justify-content-center">
                                            <div class="form-group col-12">
                                                <label for="area">Area: </label>
                                                <input readonly type="text" class="form-control" id="s_area" name="sar" placeholder="Enter Area">
                                            </div>
                                        </div>

                                        <div class="form-row justify-content-center">
                                            <div class="form-group col-12">
                                                <label for="price">Price: </label>
                                                <input readonly type="text" class="form-control" id="s_price" name="sp" placeholder="Enter Contact No">
                                            </div>
                                        </div>
                
                                        <div class="form-row justify-content-center">
                                            <div class="form-group col-12">
                                                <label for="o_name">Owner Name: </label>
                                                <input readonly type="text" class="form-control" id="s_o_name" name="o_name" placeholder="Enter the Rating">
                                            </div>
                                        </div>
                                    
                                        <div class="form-row justify-content-center">
                                            <div class="form-group col-12">
                                                <label for="o_contact">Owner Contact: </label>
                                                <input readonly type="text" class="form-control" id="s_o_contact" name="o_contact" placeholder="Enter the Rating">
                                            </div>
                                        </div>

                                        <div class="form-row justify-content-center">
                                            <div class="form-group col-12">
                                                <label for="Capacity">Capacity: </label>
                                                <input readonly type="number" class="form-control" id="s_capacity" name="o_contact" placeholder="Enter the Rating">
                                            </div>
                                        </div>

                                        <div class="form-row justify-content-center">
                                            <div class="form-group col-12">
                                                <label for="Rating">Rating: </label>
                                                <input readonly type="number" class="form-control" id="s_rating" name="o_contact" placeholder="Enter the Rating">
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
    <script src="../js/dropzone.js" type="text/javascript"></script>
    </script>

<script>

        //Image Previewing Start

        var abc = 0;      // Declaring and defining global increment variable.
        $(document).ready(function() {
        //  To add new input file field dynamically, on click of "Add More Files" button below function will be executed.
        $('#add_more').click(function() {
        $(this).before($("<div/>", {
        id: 'filediv',
        }).fadeIn('slow').append($("<input/>", {
        name: 'file[]',
        type: 'file',
        id: 'file'
        }), $("<br/><br/>")));

        });
        // Following function will executes on change event of file input to select different file.
        $('body').on('change', '#file', function() {
        if (this.files && this.files[0]) {
        abc += 1; // Incrementing global variable by 1.
        var z = abc - 1;
        var x = $(this).parent().find('#previewimg' + z).remove();
        $(this).before("<div id='abcd" + abc + "' class='abcd'><img id='previewimg" + abc + "' src=''/></div>");
        var reader = new FileReader();
        reader.onload = imageIsLoaded;
        reader.readAsDataURL(this.files[0]);
        $(this).hide();
        $("#abcd" + abc).append($("<img/>", {
        id: 'img',
        src: 'x.png',
        alt: 'delete'
        }).click(function() {
        $(this).parent().parent().remove();
        }));
        }
        });
        // To Preview Image
        function imageIsLoaded(e) {
        $('#previewimg' + abc).attr('src', e.target.result);
        };
        $('#upload').click(function(e) {
        var name = $(":file").val();
        if (!name) {
        alert("First Image Must Be Selected");
        e.preventDefault();
        }
        });
        });

        //Image Previewing End

        //No Records Found Checking
        if($('#norecord').attr("name")=="norec"){
            $('#table-ven').hide();
        }

        //Show More Modal Functionality
        function showMore(id, name, add, price, oname, ocon, capacity, rating,area){
            $('#s_heading').html(name);
            $('#s_id').val(id);
            $('#s_name').val(name);
            $('#s_address').val(add);
            $('#s_area').val(area);
            $('#s_price').val(price);
            $('#s_o_name').val(oname);
            $('#s_o_contact').val(ocon);
            $('#s_capacity').val(capacity);
            $('#s_rating').val(rating);

            $.ajax({
            url: '../includes/venues_ajax.php',
            type: 'post',
            data: {req: 1, id: id},
            success: function(response){ 
                // Add response in Modal body
                $('#ven_img').html(response);

            }
            });

            $('#show-more').modal();

        }

        //Add Venue Button [When Clicked]
        $('#addven').click(function(){
            $('#m_id_block').hide();
            $('#m_name').val("");
            $('#m_address').val("");
            $('#m_area').val("");
            $('#m_price').val("");
            $('#m_o_name').val("");
            $('#m_o_contact').val("");
            $('#m_capacity').val("");
            $('#m_rating').val("");
            $('#m_heading').html("ADD A NEW VENUE");
            $('#m_button').html('<i class="fas fa-plane"></i> Add');
            $('#m_button').attr("name","addvenue");
        });


        function getImageGrid(id){
            $.ajax({
            url: '../includes/venues_ajax.php',
            type: 'post',
            data: {req: 2, id: id},
            success: function(response){ 
                // Add response in Modal body
                $('#img-grid').html(response);

            }
            });
        }

        //Delete single Image by ID
        function deleteImageById(name, vid, mid){
            $.ajax({
            url: '../includes/venues_ajax.php',
            type: 'post',
            data: {req: 3, name: name, mid: mid},
            success: function(response){ 
                // Add response in Modal body
                getImageGrid(vid);
            }
            });
        }

        //Update Venue [Populating the Modal]
        function updateVenue(id, name, add, price, oname, ocon, capacity, rating,area){
            $('#m_button').html('<i class="fas fa-refresh"></i> Update');
            $('#m_button').attr("name","updatevenue");
            $('#m_id_block').show();
            $('#m_id').val(id);
            $('#m_name').val(name);
            $('#m_address').val(add);
            $('#m_area').val(area);
            $('#m_price').val(price);
            $('#m_o_name').val(oname);
            $('#m_o_contact').val(ocon);
            $('#m_capacity').val(capacity);
            $('#m_rating').val(rating);
            $('#m_heading').html("UPDATING DATA OF["+name+"]");
            
            
            getImageGrid(id);
            

            $('#custom-form').modal();
        }

     
  </script>

    <!-- Main JS-->
    <script src="../js/main.js"></script>

    <!-- To Stop Multiple Reloading -->
    <script>
        if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
        }
    </script>
<script>alert($cat);</script>

</body>

</html>


<!-- end document-->
