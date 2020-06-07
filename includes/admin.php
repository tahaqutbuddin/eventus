<?php
    session_start();
    require 'otherclasses.php';
    class admin
    {
        use dbh,eventus;
        private $id;
        private $orginal_id;
        private $adminpassword;
        private $orginal_password;
        public function __construct() {
            $this->orginal_password=md5("admin123");    
            $this->orginal_id="admin";
            }
        public function __destruct() {}
        public function set_pass($a)
        {
            $this->adminpassword=$a;
            $this->adminpassword = md5($this->adminpassword);
        }
        public function set_id($a)
        {
            $this->$id=$a;

        }
        public function login_admin()
        {
           
            if($this->adminpassword==$this->orginal_password || $this->id==$this->orginal_id)
            {
                return 1;
            }
        }
        public function showPendingRequest()//uzair
        {
            try
            {
                $stmt = $this->connect()->query("SELECT * FROM users where status= 'pending' ");
                $this->request = $stmt->rowCount();
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
    
                        echo '<tr>
                        <td>'.htmlentities($row["name"]).'</td>
                        <td class="desc">'.htmlentities($row["email"]).'</td>
                        <td>'.htmlentities($row["phone"]).'</td>
                        <td>'.htmlentities($row["cnic"]).'</td>
                        <td>
                        <form method="POST">
                            <div class="table-data-feature">
                            <input type="hidden" value="'.$row["id"].'" name="val"/>
                                <button class="item btn btn-success" type="submit" name="approve" data-placement="top" title="Approve">
                                    <i class="zmdi zmdi-check"></i>
                                </button>
                                <button class="item btn btn-danger" type="submit"  name="reject" data-placement="top" title="Approve">
                                <i class="zmdi zmdi-close"></i>
                            </button>
                            </form>
                            </div>
                        </td></tr>';    
                    }     
            }
            catch(PDOException $ex)
            {
                echo 'ERROR: ' . $e->getMessage();
            }
        }

        public function delUser($id)//create by taha edit by uzair
        {
            try
            {
                $stmt = $this->connect()->prepare("DELETE FROM users where id = :xyz ");
                $stmt->execute(array(':xyz' => $id));
                unset($_SESSION['delId']);  
                header("Location:allusers.php");
                return;
            }
            catch(Exception $ex)
            {
                echo "ERROR:". $ex->getMessage();
            }
    
        }

        public function showUsers($status)//uzair
        {
             try
            {
                $result = '';
                $stmt = $this->connect()->query("SELECT * FROM users where status='$status' ");
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
    
                        $result .=  '<tr>
                        <td> '.htmlentities($row["id"]).'</td>
                        <td> '.htmlentities($row["name"]).'</td>
                        <td class="desc">'.htmlentities($row["email"]).'</td>
                        <td>'.htmlentities($row["phone"]).'</td>
                        <td>'.htmlentities($row["cnic"]).'</td>
                        <td></td>
                        <td>';
    
                        if($status == "active"){
    
                            $result.='<div class="table-data-feature">
                                
                                            <button class="btn btn-danger" onclick="del('.$row['id'].')"   data-toggle="modal" href="#exampleModal" name="deleteuser" data-placement="top" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>      
                                        </div>
    
                                    </td></tr>';
                        }
                       
                        else{
                            $result.='<div class="table-data-feature">
    
                                            <button class="btn btn-success" onclick="approve('.$row['id'].')"   data-toggle="modal" data-target="#approveModal" href="#exampleModal" name="approveuser" data-placement="top" title="Apprve">
                                                <i class="zmdi zmdi-check"></i>
                                            </button> 
                                                    
                                            <button class="btn btn-danger" onclick="del('.$row['id'].')"   data-toggle="modal" href="#exampleModal" name="deleteuser" data-placement="top" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>      
                                        </div>
    
                                    </td></tr>';
                        }
                        
                                
                    } 
                    return $result;    
            }catch(PDOException $e)
            {
                echo 'ERROR: ' . $e->getMessage();
            }   
        }

        public function getRequestnumber()//taha
        {
            $stmt = $this->connect()->query("SELECT * FROM users where status= 'pending' ");
            $this->request = $stmt->rowCount();
            return $this->request;
        }
    
    
        public function numberUsers()//asad
        {
            $stmt = $this->connect()->query("SELECT * FROM users where status = 'active'");
            $cnt = $stmt->rowCount();
            return $cnt;
        }
    
        public function numberactiveevent()//asad
        {
            $stmt = $this->connect()->query("SELECT * FROM event_bookings where status = 'accepted'");
            $cnt = $stmt->rowCount();
            return $cnt;
        }
        public function pending_event()//asad
        {
            $stmt = $this->connect()->query("SELECT * FROM event_bookings where status = ''");
            $cnt = $stmt->rowCount();
            return $cnt;
        }
        public function total_venue()//asad
        {
            $stmt = $this->connect()->query("SELECT * FROM all_venues ");
            $cnt = $stmt->rowCount();
            return $cnt;
        }
    
       

        public function approve($a)//taha
        {
            try
            {
                
            $stmt = $this->connect()->prepare("UPDATE users set status='active' where id = '$a' ");
            $stmt->execute();  
            unset($_SESSION['approveID']); 
            header("Location:index.php");
            }catch(Exception $ex)
            {
                echo "ERROR:".$ex->getMessage();
            }
        }
    
    
         public function reject($a)//taha
        {
            try
            {
            $stmt = $this->connect()->prepare("DELETE FROM users where id = '$a' ");
            $stmt->execute();
            unset($_SESSION['delID']); 
            header("Location:index.php");
            }catch(Exception $ex)
        {
            echo "ERROR:".$ex->getMessage();
        }
        }

    //Print Stars uzair


    // Venues Functions uzair

    
    //asad
    public function logout()
    {
        session_unset();
        session_destroy();
    }

    // All The Requests Functions uzair
    public function showAllRequests($person, $status)
    {
            try
        {
            $query = '';

            // Fetch all Pending Requests From Database
            if($person == "admin" && $status == "pending"){
                $query = 'WHERE status="pending"';
            }

            // Fetch all Accepted Requests From Database
            else if($person == "admin" && $status == "accepted"){
                $query = 'WHERE status="accepted"';
            }

            // Fetch all Rejected Requests From Database
            else if($person == "admin" && $status == "rejected"){
                $query = 'WHERE status="rejected"';
            }

            // Fetch all Pending Requests From Database Wrt Client ID
            else if($person != "admin" && $status == "pending"){
                $query = 'WHERE client_id='.$person.' AND status="pending"';
            }

            // Fetch all Accepted Requests From Database Wrt Client ID
            else if($person != "admin" && $status == "accepted"){
                $query = 'WHERE client_id='.$person.' AND status="accepted"';
            }

            // Fetch all Rejected Requests From Database Wrt Client ID
            else if($person != "admin" && $status == "rejected"){
                $query = 'WHERE client_id='.$person.' AND status="rejected"';
            }

            // Fetch all Requests From Database Wrt Client ID
            else if($person != "admin" && $status == "all"){
                $query = 'WHERE client_id='.$person;
            }
            
            // Fetch all Requests From Database Wrt Admin
            else if($person == "admin" && $status == "all"){
                $query="";
            }

            $newQuery = "SELECT * FROM event_bookings ".$query;
    
            $res = '';
            $stmt = $this->connect()->query($newQuery);
                $count =1;
                while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    
                    if($person == "admin"){
                    $res.= '<tr>
                    <td> '.$count.'</td>
                    <td> '.htmlentities($row["event_cate_id"]).'</td>
                    <td>'.htmlentities($row["event_date"]).'</td>
                    <td>'.htmlentities($row["activity_status"]).'</td>
                    <td>';
                    if($row["status"] == "pending"){
                        $res.='<button class="btn btn-warning">'.$row["status"].'</button>';
                    }
                    else if($row["status"] == "accepted"){
                        $res.='<button class="btn btn-success">'.$row["status"].'</button>';
                    }
                    else{
                        $res.='<button class="btn btn-danger">'.$row["status"].'</button>';
                    }

                    $res.='
                    <td>
                        <div class="table-data-feature">';

                            if($row["status"]=="pending"){
                                $res.='
                                <button class="ml-2 btn btn-success" type="button" name="accept" onclick="acceptRequest('.$row["booking_id"].')" data-placement="top" title="Reply">
                                <i class="zmdi zmdi-check"></i>
                                </button>

                                <button class="ml-2 btn btn-danger" type="button" name="reject" onclick="rejectRequest('.$row["booking_id"].')" data-placement="top" title="Reply">
                                <i class="zmdi zmdi-close"></i>
                                </button>';
                                
                            }

                            else if($row["status"]=="accepted"){
                                $res.='
                                <button class="ml-2 btn btn-danger" type="button" name="reject" onclick="rejectRequest('.$row["booking_id"].')" data-placement="top" title="Reply">
                                <i class="zmdi zmdi-close"></i>
                                </button>';

                            }

                            else if($row["status"]=="rejected"){

                                $res.='
                                <button class="ml-2 btn btn-success" type="button" name="accept" onclick="acceptRequest('.$row["booking_id"].')" data-placement="top" title="Reply">
                                <i class="zmdi zmdi-check"></i>
                                </button>';

                            }
                            
                            $res.='
                        </div>
                    </td>';
                    
                    $id = $row["event_cate_id"];
                    $stmt2 = $this->connect()->query("SELECT * FROM `event_category` WHERE cate_id=$id LIMIT 1");
                
                    $cat = "";
                    while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
                    {
                        $cat = $row2["cate_name"];
                    }

                    $id = $row["venue_id"];
                    $stmt2 = $this->connect()->query("SELECT * FROM `all_venues` WHERE venue_id=$id LIMIT 1");
                
                    $vid = "";
                    while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
                    {
                        $vid = $row2["venue_name"];
                    }

                    $res.='
                    <td>
                    
                        <div class="table-data-feature">
                        
                            <button class="ml-2 btn btn-primary" type="button" name="show" onclick="showMore('.$row["booking_id"].',\''.$row["event_name"].'\',\''.$row["event_desc"].'\','.$row["client_id"].',\''.$row["event_date"].'\','.$row["price"].',\''.$row["promotion"].'\',\''.$row["music"].'\',\''.$vid.'\',\''.$row["activity_status"].'\',\''.$row["status"].'\',\''.$cat.'\',\''.$row["facebook"].'\',\''.$row["whatsapp"].'\',\''.$row["website"].'\')" data-placement="top" title="Reply">
                            <i class="zmdi zmdi-eye"></i>
                            </button>

                            <button class="ml-2 btn btn-warning" type="button" name="show" onclick="update('.$row["booking_id"].',\''.$row["event_name"].'\',\''.$row["event_desc"].'\','.$row["client_id"].',\''.$row["event_date"].'\','.$row["price"].',\''.$row["promotion"].'\',\''.$row["music"].'\',\''.$vid.'\',\''.$row["activity_status"].'\',\''.$row["status"].'\',\''.$cat.'\',\''.$row["facebook"].'\',\''.$row["whatsapp"].'\',\''.$row["website"].'\')" data-placement="top" title="Reply">
                            <i class="zmdi zmdi-edit"></i>
                            </button>';

                            if($row["admin_noti"]==0){
                                $res.='
                                <button class="ml-2 btn btn-success" type="button" name="reply" onclick="deleteNotification(); startInterval(); showReviewForm('.$row["booking_id"].','.$row["client_id"].')" data-placement="top" title="Reply">
                                <i class="zmdi zmdi-comments"></i>
                                </button>';
                            }
                            else{
                                $res.='
                                <button class="ml-2 btn btn-warning" type="button" name="reply" onclick="deleteNotification(); startInterval(); showReviewForm('.$row["booking_id"].','.$row["client_id"].')" data-placement="top" title="Reply">
                                <i class="zmdi zmdi-comments"></i>
                                </button>
                                <button class="ml-2 btn btn-warning">
                                '.$row["admin_noti"].'
                                </button>
                                ';
                            }

                            $res.='
                            <button class="ml-2 btn btn-danger" type="button" name="delete" onclick="deleteBooking('.$row["booking_id"].')" data-placement="top" title="Delete">
                                <i class="zmdi zmdi-delete"></i>
                            </button> 
                        </div>
                    </td></tr>';
                }
                else{

                    $id = $row["event_cate_id"];
                    $stmt2 = $this->connect()->query("SELECT * FROM `event_category` WHERE cate_id=$id LIMIT 1");
                
                    $cat = "";
                    while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
                    {
                        $cat = $row2["cate_name"];
                    }

                    $id = $row["venue_id"];
                    $stmt2 = $this->connect()->query("SELECT * FROM `all_venues` WHERE venue_id=$id LIMIT 1");
                
                    $vid = "";
                    while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
                    {
                        $vid = $row2["venue_name"];
                    }

                    //Added this query to check for number of participants
                    $cnt=0;
                    $bid = $row["booking_id"];
                    $stmt2 = $this->connect()->query("SELECT * FROM registration where booking_id = $bid ");
                    $cnt = $stmt2->rowCount();

                    //End
                    
                    $status_color="";
                    if($row["status"] == "accepted"){
                        $status_color = "success";
                    }
                    else if($row["status"] == "rejected"){
                        $status_color = "danger";
                    }
                    else{
                        $status_color = "warning";
                    }
                    $res.='
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="mx-auto card border border-primary mb-4" style="max-width: 100%;">
                            <div class="bg-dark text-white text-center card-header">Booking ID: #'.$row["booking_id"].'</div>
                            <div class="card-body">
                                <!-- <h5 class="card-title">Primary card title</h5> -->
                                <button class="btn btn-outline-primary btn-block disabled text-uppercase">Event: '.$cat.'</button>
                                <button class="btn btn-outline-secondary btn-block disabled text-uppercase">Venue: '.$vid.'</button>
                                <button class="btn btn-outline-danger btn-block disabled text-uppercase">Date: '.$row["event_date"].'</button>
                                <hr />
                                <button class="btn btn-'.$status_color.' btn-block text-uppercase" >'.$row["status"].'</button>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="p-2 col-sm-12">
                                            <button type="button" class="btn btn-info btn-block" onclick="showMore(\''.$row["event_name"].'\',\''.$row["event_desc"].'\','.$row["client_id"].',\''.$row["event_date"].'\','.$row["price"].',\''.$row["promotion"].'\',\''.$row["music"].'\','.$row["venue_id"].',\''.$row["activity_status"].'\',\''.$row["status"].'\','.$row["event_cate_id"].')" ><i class="zmdi zmdi-eye"></i> See More</button>
                                    </div>';

                                    //5-6-20 uzair
                                    if($cnt > 0 && $row["status"] == "accepted"){
                                    $res.='
                                    <div class="p-2 col-sm-12">
                                            <button type="button" class="btn btn-success btn-block" onclick="participantForm('.$row["booking_id"].')"><i class="zmdi zmdi-account"></i> Participants</button>
                                    </div>';
                                    }
                                    //

                                    if($row["promotion"] == "yes" && $row["activity_status"] == "public" && $row["status"] == "accepted"){
                                    $res.='
                                    <div class="p-2 col-sm-12">
                                            <button type="button" class="btn btn-secondary btn-block" onclick="fetchurl(\''.$row["route"].'\')"><i class="zmdi zmdi-copy"></i> Fetch URL</button>
                                    </div>';   
                                    }

                                    $res.='
                                    <div class="p-2 col-sm-12">';
                                    if($row["user_noti"] != 0){
                                        $res .= '<button type="button" class="btn btn-info btn-block" onclick="deleteNotification(); startInterval(); showReviewForm('.$row["booking_id"].','.$row["client_id"].');"><i class="zmdi zmdi-comments"></i> Comments <span class="btn btn-dark" >'.$row["user_noti"].'</span></button>';
                                    }
                                    else{
                                        $res .= '<button type="button" class="btn btn-danger btn-block" onclick="deleteNotification(); startInterval(); showReviewForm('.$row["booking_id"].','.$row["client_id"].');"><i class="zmdi zmdi-comments"></i> Comments</button>';
                                    }
                                    
                                    $res.=
                                    '</div>
                                </div>
                            </div>
                        </div>
                    </div>';
                }    
                $count++;
                }     
                if($count == 1){
                    $res.= '<tr><h2 id="norecord" name="norec" class="text-center bg-dark text-white p-3">No Records Found</h2></tr>';
                }

                return $res;

        }catch(PDOException $ex)
        {
            echo 'ERROR: ' . $e->getMessage();
        }   
    }

    //Accept Booking Request - Param(bid = booking id) uzair and email done by asad
    public function acceptRequest($bid){
        try
        {
            $stmt = $this->connect()->prepare("UPDATE event_bookings SET status=:n WHERE booking_id=:bid");
            $stmt->execute(array(':n' => "accepted", ':bid' => $bid)); 
                try  //send mail for register event sucessfully
                {
                    $stmt = $this->connect()->query("SELECT * FROM event_bookings WHERE booking_id=$bid");
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
                        $cid=$row["client_id"];
                        $_SESSION['event_name']=$row["event_name"];
                        $_SESSION['event_date'] = $row["event_date"];
                        $_SESSION['booking_price'] = $row["price"];
                        $_SESSION['activity'] = $row["activity_status"];
                        $v_id=$row["venue_id"];
                    }
                }catch(Exception $ex)
                {
                    echo "ERROR:". $ex->getMessage();
                }
                    try
                    {
                        $stmt = $this->connect()->query("SELECT * FROM users WHERE id=$cid");
                        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                        {
                            $_SESSION['email_client'] = $row["email"];
                            $_SESSION['client_name']=$row["name"];
                        }
                        $stmt = $this->connect()->query("SELECT * FROM all_venues WHERE venue_id=$v_id");
                        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                        {
                            $_SESSION['venue_name'] = $row["venue_name"];
                            $_SESSION['venue_address'] = $row["venue_address"];
                            $_SESSION['capacity'] = $row["capacity"];
                            $_SESSION['owner_name'] = $row["owner"];
                            $_SESSION['owner_number'] = $row["owner_contact"];
                        }
                        $_SESSION['flag']=0;
                        require '../mail/mail.php';
                        
                    }catch(Exception $ex)
                    {
                        echo "ERROR:". $ex->getMessage();
                    }
                    return;
                    
                }
                catch(Exception $ex)
                {
                    echo "ERROR:". $ex->getMessage();
                }
    }

    // Reject Booking Request - Param(bid = booking id) uzair
    public function rejectRequest($bid){
        try
        {
           
            $stmt = $this->connect()->prepare("UPDATE event_bookings SET status=:n WHERE booking_id=:bid");
            $stmt->execute(array(':n' => "rejected", ':bid' => $bid)); 

            return;
            
        }
        catch(Exception $ex)
        {
            echo "ERROR:". $ex->getMessage();
        }
    }

    //Updating the Request uzair
    public function updateRequest($bid, $name, $desc, $cat, $cid, $date, $price, $promotion, $music, $venue, $activity, $status, $facebook, $whatsapp, $website){
        try
        {
           
            $stmt = $this->connect()->prepare("UPDATE event_bookings SET event_name='$name',event_desc='$desc',client_id='$cid',event_date='$date',price='$price',promotion='$promotion',music='$music',venue_id='$venue',activity_status='$activity',status='$status',event_cate_id='$cat',facebook='$facebook',website='$website',whatsapp='$whatsapp' WHERE booking_id=$bid");
            $stmt->execute(); 
            return;
        }
        catch(Exception $ex)
        {
            echo "ERROR:". $ex->getMessage();
        }
    

    }


    //uzair 
    public function deleteBooking($bid){
        try
        {   
            $stmt = $this->connect()->prepare("DELETE FROM event_bookings where booking_id = $bid");
            $stmt->execute();

            $stmt = $this->connect()->prepare("DELETE FROM replies where booking_id = $bid");
            $stmt->execute();
                
        }catch(PDOException $ex)
        {
            echo 'ERROR: ' . $e->getMessage();
        }  
    }

    //uzair 
    public function deleteReply($id){
        try
        {   
            $stmt = $this->connect()->prepare("DELETE FROM replies where m_id = $id");
            $stmt->execute();
                
        }catch(PDOException $ex)
        {
            echo 'ERROR: ' . $e->getMessage();
        }  
    }
    //asad
    public function sendEmail($cid, $message){
        try
        {
            $stmt = $this->connect()->query("SELECT * FROM users WHERE id=$cid");
                while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    $email = $row["email"];
                    $name = $row["name"];
                    
                }
            
        }catch(Exception $ex)
        {
            echo "ERROR:". $ex->getMessage();
        }
        $_SESSION['cid']=$cid;
        $_SESSION['email_client']=$email;
        $_SESSION['flag']=1;
        $_SESSION['message']=$message;
        $_SESSION['name']=$name;

        require '../mail/mail.php';
    }  

    }

    

    

?>