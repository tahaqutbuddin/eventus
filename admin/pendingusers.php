<?php
require '../includes/admin.php';
$obj = new admin;


$pendingUsers = $obj->getRequestnumber();
$result = $obj->showUsers("pending");

if(isset($_POST['approveuser']))
{

    $obj->approve( $_POST['val']);
    header("Location:pendingusers.php");
    return;
}

if(isset($_POST['deleteuser']))
{

    $obj->delUser( $_POST['val']);
    header("Location:pendingusers.php");
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
    <title>Eventus-admin</title>

 <?php
require '../includes/headerlinks.php'; 
?>

</head>

<body class="animsition">
    <div class="page-wrapper">
    <?php     require 'navbar.php'?>
        <!-- PAGE CONTENT-->
        <div class="page-content--bgf7">
            <!-- BREADCRUMB-->
        
            <!-- END BREADCRUMB-->
          

            <?php 
            if($pendingUsers == 0){
                echo '<h2 class="mt-5 text-center bg-dark text-white p-3">No Records Found</h2>';
            }
            
            else{
                echo '<h2 class="mt-2 text-center bg-dark text-white p-3">Pending Users ['.$pendingUsers.']</h2>';
            }
            ?>

            <!-- DATA TABLE-->
            <section class="p-t-20">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive m-b-40">
                                <?php 
                                if($pendingUsers > 0){
                                    echo '<table class="table table-borderless table-data3">
                                    <thead>
                                        <tr>
                                           
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Cnic</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
            
                                            '.$result.'
                         
                                    </tbody>
                                </table>';
                                }
                                
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END DATA TABLE-->

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

</body>

</html>
<!-- end document-->
<script>
function del(a)
{
        $(".modal-body #hiddenValue").val(a);
}

function approve(a)
{
        $("#approveModal #hiddenValue").val(a);
}
</script>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Record</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    Are you sure you want to delete this record?
    <form  method="POST">
     <input type="text" name="val" id="hiddenValue"/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="deleteuser" class="btn btn-danger">Delete</button></form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Approve Record</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    Are you sure you want to approve this record?
    <form  method="POST">
     <input type="text" name="val" id="hiddenValue"/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="approveuser" class="btn btn-success">Approve</button></form>
      </div>
    </div>
  </div>
</div>
<!-- end document-->

