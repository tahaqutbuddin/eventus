<?php 


require_once '../includes/booking.php';

$obj = new bookings;
$area = '0';
$a_min=0;
$a_max=0;
$bud_max=0;
$bud_min=0;
if(isset($_GET['area']))
{
    $area = $_GET['area'];
}
else
{
    $area = '0';
}


if(isset($_GET['audi_min'])) // Checking if min audience is not null. In that case assign 0
{
    $a_min = $_GET['audi_min'];
}
else
{
    $a_min = 0;
}

if(isset($_GET['audi_max'])) // Checking if max audience is not null. In that case assign 100000
{
    $a_max = $_GET['audi_max'];
}
else
{
    $a_max = 100000;
}

if(isset($_GET['budget_min']))  // Checking if min budget is not null. In that case assign 0
{ 
    $bud_min = $_GET['budget_min'];
}
else
{
    $bud_min = 0;
}

if(isset($_GET['budget_max']))      // Checking if max budget is not null. In that case assign 500000
{
    $bud_max = $_GET['budget_max'];
}
else
{
    $bud_max = 500000;
}
$ca = '';
if(isset($_GET['category']))
{
    $ca = $_GET['category'];
}
else
{
    $ca = '0';
}


$event_name = $obj->eventtypes($ca);
$area_name = $obj->areasOption($area);
$displayAll = $obj->eventAll();
if(isset($_GET['search']))
{
     $venues = $obj->getData($area,$ca,$a_min,$a_max,$bud_max,$bud_min);
}
if(isset($_GET['refresh']))
{
    header("Location:search_temp.php");
    return;
}

if(isset($_POST['submit_request']))
{  
        $_SESSION['image'] = $_FILES;
       $_SESSION['newBooking'] = $_POST;
    //    header("Location: " . $_SERVER['REQUEST_URI']);
    //    return;
    $obj->setall();
    $obj->registerEvent();
}
// if(isset($_SESSION['newBooking']))
// {

// }



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
</head>

<body class="animsition">
    <div class="page-wrapper">
    <?php   require '../navbar.php'?>
        <!-- END HEADER DESKTOP -->

        <!-- WELCOME-->
        <section class="welcome2 p-t-40 p-b-55">
            <div class="container">
            <h1 style="text-align: center ;color:white;">Make A Request</h1>
            </div>
        </section>
        <!-- END WELCOME-->

        <!-- PAGE CONTENT-->
        <div class="page-container3">
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-xl-3">
                            <!-- MENU SIDEBAR-->
                            <aside class="menu-sidebar3 js-spe-sidebar">
                            <nav class="navbar-sidebar2">
                                <div class="container">   
                                    <form method="GET">
                                    <div class="mt-3 form-row justify-content-center">
                                            <div class="form-group col-12">
                                                <label for="caterer">Search By Category</label>
                                                <select class="form-control" name="category" id="sel_cat">
                                                    <option value='0'>Select Category</option>
                                                    <?php 
                                                echo $event_name;
                                                    ?> 
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mt-3 form-row justify-content-center">
                                            <div class="form-group col-12">
                                                <label for="caterer">Search By Location</label>
                                                <select class="form-control" name="area" id="sel_cat">
                                                    <option value='0'  >Select Location</option>
                                                    <?php 
                                                echo $area_name;
                                                    ?> 
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mt-3 form-row justify-content-center">
                                            <div class="form-group col-12">
                                            <label for="aud_2">Audience Expected</label>
                                                    <div class="price-slider">
                
                                                        <input  value="<?php  echo $a_min; ?>" min="0" max="100000" step="100" type="range"/>
                                                        <input  value="<?php  echo $a_max ?>" min="0" max="100000" step="100" type="range"/>
                                              
                                                           
                                                    <div class="double-bar-div">from
                                                        <input  class="double-bar-value" type="number" name="audi_min" value="<?php  echo $a_min; ?>" min="0" max="100000"/>    to
                                                        <input  class="double-bar-value" type="number" name="audi_max" value="<?php  echo $a_max; ?>" min="0" max="100000"/></div>                                           
                                                    </div>
                                                    </div>
                                                    <div class="form-group col-12">
                                            <label for="formControlRange">Budget</label>
                                                    <div id="bar2" class="price-slider" >
                
                                                        <input  value="<?php echo $bud_min; ?>" min="0" max="500000" step="500" type="range"/>
                                                        <input  value="<?php echo $bud_max; ?>" min="0" max="500000" step="500" type="range"/>
                                              
                                                           
                                                        <div class="double-bar-div">from
                                                        <input  class="double-bar-value" type="number" name="budget_min" value="<?php echo $bud_min; ?>" min="0" max="500000"/>    to
                                                        <input  class="double-bar-value" type="number" name="budget_max" value="<?php echo $bud_max; ?>" min="0" max="500000"/></div>                                           
                                                    </div>
                           
                                        </div>



                                           

   
                                        
                                        <div class="mt-3 form-row justify-content-center">
                                            <button type="submit" value="venues" name="search" class="btn btn-outline-success btn-block">Search</button>
                                            <button name="refresh" class="btn btn-outline-danger btn-block">Refresh All Filters</button>
                                        </div> 

                                    </form>
                                </div>
                            </nav>
                            </aside>
                            <!-- END MENU SIDEBAR-->
                        </div>
                            <div class="col-xl-9">
                            <!-- PAGE CONTENT-->
                            
                                <div>
                                    <article>
                                    <div class="section__content section__content--p30">
                                        
                                        <section class="pricing py-5 mt-3">
                                            <input class="mt-3 mb-2 form-control" id="myInput" type="text" placeholder="Search..">
                                            <div class="container">
                                            <div id="myDIV" class="row">
                                                <!-- Form 1 -->
                                            <?php
                                            if(isset($venues))
                                            {
                                                    echo $venues;
                                            }else
                                            {
                                                echo $displayAll;
                                            }
                                            ?>
                                            
                                        </section>
                                    </div>
                                    </article>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="copyright " >
                                            <p>Copyright © 2020 Colorlib. All rights reserved.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END PAGE CONTENT-->
                    </div>
                </div>
            </section>
        </div>
        <!-- END PAGE CONTENT  -->

     


        <!--- form1--->
        <div class="modal fade " id="form1" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title text-center" id="exampleModalLongTitle"><i class="fas fa-file-text"></i> Venue Information</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form action="" role="form" id="seeMoreForm" class="text-center font-weight-bold" method="post">
                   
                    </form>
                </div>
            </div>
        </div>
    </div>
        </div>
        <!--- form1--->



        <!--- form2--->
        <div class="modal fade" id="form2" tabindex="-1" role="dialog" aria-hidden="true" style="overflow-y: scroll;">

            <div class='modal-dialog modal-lg modal-dialog-centered' role='document'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h3 class='modal-title text-center' id='exampleModalLongTitle'><i class='fas fa-file-text'></i> Book new Event</h3>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
                </div>
                <div class='modal-body'>
                    <div class='container-fluid'>
                        <form  id="finalSelectForm" class="text-center font-weight-bold" method='post' enctype="multipart/form-data">

                     
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!--- form1--->


    </div>
    
    
<?php
require '../includes/footerlinks.php';
?>



    
    <script>
    function close_form1()
    {
        document.getElementById('close_button_for_form1').click();
        document.getElementById('select_button_for_form2').click();
    }
    function urlGenerate()
    {
      var promote =  document.getElementById("act_1").value;
      if(promote=="public")
      {
          var form = document.getElementById("urls");
          form.innerHTML = "<div class='form-group col-4'>\
          <label>Facebook Page Link</label>\
          <input type='text' class='form-control text-center' onfocusout='verifyURL(1)' placeholder=Event Page Link' name='facebook' id='facebook' />\
          <small id='fb' class='text-danger'></small>\
           </div>\
           <div class='form-group col-4'>\
           <label>Website Link</label>\
          <input type='text' class='form-control text-center' onfocusout='verifyURL(2)' placeholder='Website link' name='website' id='website' />\
          <small id='web' class='text-danger'></small>\
           </div>\
           <div class='form-group col-4'>\
           <label>Whatsapp</label>\
          <input type='text' class='form-control text-center' placeholder='Phone number' name='whatsapp' id='whatsapp' />\
          <small id='whats' class='text-danger'></small>\
           </div>";
      }
      else if(promote=='private')
      {
        var form = document.getElementById("urls");
          form.innerHTML = '';   
      }
    }

    function verifyURL(a)
    {
        var url;
        var error;
       if(a==1)
       {
        url = document.getElementById('facebook').value;
        error = document.getElementById('fb');
       } else if(a==2)
       {
        url = document.getElementById('website').value;
        error = document.getElementById('web');
       }
       $.ajax({
        url:"../includes/booking_ajax.php",
        method:"post",
        data:{req:"verifyUrl" ,URL:url , FLAG:a},
        success:function(data)
        {
            if(data!=1)
            {
                error.innerHTML = data;
            }else
            {
                error.innerHTML = '';
            }
          
        }
         });
    }

   
    // function addMusicPrice()
    // {
    //     var a = document.getElementById('music_2').value;
    //     var b = document.getElementById('price_1').value;
    //     if(a=="yes" && addMusicPrice.cnt ==1)
    //     {
    //     }
    // }
    // addMusicPrice.cnt = 1;

   
</script>
        
    <script>(function() {

var parent = document.querySelector("#bar2");
if(!parent) return;

var
  rangeS = parent.querySelectorAll("input[type=range]"),
  numberS = parent.querySelectorAll(".double-bar-value");
  

rangeS.forEach(function(el) {
  el.oninput = function() {
    var slide1 = parseFloat(rangeS[0].value),
          slide2 = parseFloat(rangeS[1].value);

    if (slide1 > slide2) {
      [slide1, slide2] = [slide2, slide1];
    }

    numberS[0].value = slide1;
    numberS[1].value = slide2;
  }
});

numberS.forEach(function(el) {
  el.oninput = function() {
      var number1 = parseFloat(numberS[0].value),
      number2 = parseFloat(numberS[1].value);

    if (number1 > number2) {
      var tmp = number1;
      numberS[0].value = number2;
      numberS[1].value = tmp;
    }

    rangeS[0].value = number1;
    rangeS[1].value = number2;

  }
});

})();</script>

<script >(function() {

var parent = document.querySelector(".price-slider");
if(!parent) return;

var
  rangeS = parent.querySelectorAll("input[type=range]"),
  numberS = parent.querySelectorAll(".double-bar-value");
  

rangeS.forEach(function(el) {
  el.oninput = function() {
    var slide1 = parseFloat(rangeS[0].value),
          slide2 = parseFloat(rangeS[1].value);

    if (slide1 > slide2) {
      [slide1, slide2] = [slide2, slide1];
    }

    numberS[0].value = slide1;
    numberS[1].value = slide2;
  }
});

numberS.forEach(function(el) {
  el.oninput = function() {
      var number1 = parseFloat(numberS[0].value),
      number2 = parseFloat(numberS[1].value);

    if (number1 > number2) {
      var tmp = number1;
      numberS[0].value = number2;
      numberS[1].value = tmp;
    }

    rangeS[0].value = number1;
    rangeS[1].value = number2;

  }
});

})();</script>


    <script>
        $(document).ready(function(){
          $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myDIV .cr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });

          });
 
   
      
        });
   
        var slider = document.getElementById("customRange");
      var output = document.getElementById("result");
      output.innerHTML = slider.value; // Display the default slider value

      // Update the current slider value (each time you drag the slider handle)
      slider.oninput = function() {
      output.innerHTML = this.value };

    </script>


<script>  // created by TAHA for fetching data for See More and Select Button modal using ajax
 $(document).ready(function(){



 $(".seeMore").click(function(e)
 {
    e.preventDefault();
    var a =  $(this).attr("data-id");
    var b = $(this).attr("data-cateid");
    if(b!=undefined)
    {
        $.ajax({
        url:"../includes/booking_ajax.php",
        method:"post",
        data:{req:"seeMoreData" ,venue_id:a ,cate_id:b},
        success:function(data)
        {
            $("#seeMoreForm").html(data);
             $('#form1').modal("show");
        }
    });
    
    }
    else
    {
    $.ajax({
        url:"../includes/booking_ajax.php",
        method:"post",
        data:{req:"seeMoreData" ,venue_id:a,cate_id:0 },
        success:function(data)
        {
            $("#seeMoreForm").html(data);
             $('#form1').modal("show");
        }
    });
    }
});

$(".finalSelect").click(function(e)
 {
    e.preventDefault();
    var a =  $(this).attr("data-id");
    var b = $(this).attr("data-cateid");
    if(b!=undefined)
    {
        $.ajax({
        url:"../includes/booking_ajax.php",
        method:"post",
        data:{req:"finalSelectData" ,venue_id:a ,cate_id:b},
        success:function(data)
        {
            $("#seeMoreForm").html(data);
             $('#form1').modal("show");
        }
    });
    
    }
    else
    {
    $.ajax({
        url:"../includes/booking_ajax.php",
        method:"post",
        data:{req:"finalSelectData" ,venue_id:a ,cate_id:0 },
        success:function(data)
        {
            $("#finalSelectForm").html(data);
             $('#form2').modal("show");
      }
    });
    }
 });


      


 });
</script>


</body>

</html>






