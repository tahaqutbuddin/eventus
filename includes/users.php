<?php
    require_once 'otherclasses.php';
    class users 
    {
        use dbh,eventus;
        private $id;
        private $name;
        private $email;
        private $userpassword;
        private $cnic;
        private $phone;
        public function __construct() {}
        public function __destruct() {}
        //asad
        public function set_name($a)
        {
            $this->name=$a;
        }
        //asad
        public function set_email($a)
        {
            $this->email=$a;
        }
        //asad
        public function set_pass($a)
        {
            $this->userpassword=$a;
            $this->userpassword = md5($this->userpassword);
        }
        //asad
        public function set_cnic($a)
        {
            $this->cnic=$a;
        }
        //asad
        public function set_phone($a)
        {
            $this->phone=$a;
        }
        //asad
        public function get_name()
        {
            return $this->name;
        }
        //asad
        public function get_id()
        {
            return $this->id;
        }
        //asad
        public function register()
        {
            $sql='INSERT INTO users (name,email,password,cnic,phone,status) VALUES (:name,:email,:password,:cnic,:phone,"pending")';
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute(array(':name' => $this->name,':email' => $this->email,':password' => $this->userpassword,':cnic' => $this->cnic,':phone' => $this->phone));
        }
        //asad
        public function login()
        {
            $flag=3;
            $stmt = $this->connect()->query("SELECT * FROM users");
            while($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                if($this->email==$row['email'] || $this->userpassword==$row['password'])
                {
                    if($row['status']=="pending")
                    {
                        $flag=0;
                    }else if($row['status']=="active"){
                        $flag=1;
                        $this->name=$row['name'];
                        $this->id=$row['id'];
                    }
                }else if($this->email==$row['email'])
                {
                    $flag=2;
                }
            }
            if($flag==1)
            {
                return 1;
                
            }else if($flag==2)
            {
                return 2;
            }else if($flag==3)
            {
                return 3;
            }elseif ($flag==0) {
                return 0;
            }
        }
        //asad
        public function logout()
        {
            session_unset();
            session_destroy();
        }
        //asad
        public function check_register()
        {

            $stmt = $this->connect()->query("SELECT * FROM users");
            while($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                if($this->name==$row['name'] )
                {
                    return 1;
                }else if($this->email==$row['email'])
                {
                   return 2;
                }
                else if($this->cnic==$row['cnic'])
                {
                   return 3;
                }
            }
            return 0;
        }
        //uzair
        public function showAllUpcommingRequests($cid)
        {
            try
            {   
                $res='';
                $stmt = $this->connect()->query('SELECT * FROM event_bookings WHERE activity_status="public" AND status="accepted" AND promotion="yes" ');
                
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
                        $cnt=0;
                        $bid=0;
                        $bid = $row["booking_id"];

                        $stmt2 = $this->connect()->query("SELECT * FROM registration where user_id = $cid AND booking_id=$bid ");
                        $cnt = $stmt2->rowCount();

                        $res.='
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="mx-auto card border border-primary mb-4" style="max-width: 100%;">
                                <div class="card-body">
                                    <!-- <h5 class="card-title">Primary card title</h5> -->
                                    <div class="row">
                                        <div class="col-sm-12" >
                                        <img  src="../images/bookingPics/'.$row['image'].'" style="height:200px " class="d-block img-fluid mx-auto " ></img>
                                        </div>
                                    </div>
                                    <p class="border border-primary text-center p-2 text-primary mt-2" style="word-wrap: break-word;">Name: '.$row["event_name"].'</p>
                                    <p class="border border-danger text-center p-2 mt-2 text-danger" style="word-wrap: break-word;">Desc: '.$row["event_desc"].'</p>
                                    <p  class="border border-secondary text-center p-2 mt-2 text-secondary" style="word-wrap: break-word;">Date: '.$row["event_date"].'</p>
                                </div>
                                <div class="card-footer">
                                    <div class="row">';
                                        if($cnt>0){
                                        $res.='
                                        <div class="p-2 col-sm-12">
                                            <button type="button" class="btn btn-success btn-muted btn-block"><i class="zmdi zmdi-check-circle"></i> Already Registered</button>
                                        </div>
                                        ';
                                        }
                                        $res.='
                                        <div class="p-2 col-sm-12">
                                            <a type="button" class="btn btn-info btn-block" onclick="" href="event.php?route='.$row["route"].'" ><i class="zmdi zmdi-plus"></i> More Info</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    
                    }
                    return $res;
            }catch(PDOException $ex)
            {
                echo 'ERROR: ' . $e->getMessage();
            } 
        }
        //Function to Show Single Event Acc. to Route uzair
        //Taking Client ID as cid to check if user has previously registered or not
        //Params - cid = client id & route = event route
        public function showSingleEvent($cid, $route){
            try
            {   
                $res='';
                $stmt = $this->connect()->query("SELECT * FROM event_bookings WHERE route='$route'");
                
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
                        $cnt=0;
                        $dis="";
                        $bid=0;
                        $bid = $row["booking_id"];

                        $stmt2 = $this->connect()->query("SELECT * FROM registration where user_id = $cid AND booking_id=$bid ");
                        $cnt = $stmt2->rowCount();
                        
                        if($cnt > 0){
                            $dis = "disabled";
                        }
                        else{
                            $dis = "";
                        }

                        
                        $res.='
                            <div class="mt-3 col-sm-12 rounded border border-dark bg-white shadow-lg">
                                <div class="row p-3">
                                    <div class="mt-3 col-sm-12 bg-primary">
                                        <h2 class="text-center text-white font-weight-bold p-3">'.$row["event_name"].'</h2>
                                    </div>
                                    <div class="mt-3 col-sm-12 border border-primary">
                                        <p class="text-center text-primary font-weight-bold p-3"><i class="zmdi zmdi-collection-text"></i> '.$row["event_desc"].'</p>
                                    </div>
                                    <div class="mt-3 col-sm-12" >
                                        <div class="row">
                                            <div class="col-sm-6 border border-primary">
                                                <p class="text-center text-primary font-weight-bold p-3"><i class="zmdi zmdi-calendar-alt"></i> '.$row["event_date"].'</p>
                                            </div>
                                            <div class="col-sm-6 border border-primary">                            
                                                <p class="text-center text-primary font-weight-bold p-3"><i class="zmdi zmdi-brightness-7"></i> '.$row["venue_id"].'</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                            if($cnt>0){
                                $res.='
                                <div class="mt-3 col-sm-12 rounded border border-dark bg-white shadow-lg">
                                    <div class="row p-3">
                                        <div class="col-sm-12">
                                            <p class="bg-success text-white text-center p-3 mt-2"><i class="zmdi zmdi-check-circle"></i> You Are Already Registered</p>
                                        </div>
                                    </div>
                                </div>
                                ';
                            }
                            else{
                            $res.='
                            <div class="mt-3 col-sm-12 rounded border border-dark bg-white shadow-lg">
                                <div class="row p-3">
                                    <div class="mt-3 col-sm-12">
                                        <h2 class="bg-warning text-white text-center p-3"><i class="zmdi zmdi-account"></i> Only Few Seats Left</h2>
                                        <p class="bg-warning text-white text-center p-3 mt-2"><i class="zmdi zmdi-info"></i> Register Now To Reserve Your Spot</p>
                                    </div>
                                    <div class="mt-3 col-sm-12">
                                        <div class="progress">
                                        <div class="progress-bar progress-bar-success progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="26" aria-valuemin="0" aria-valuemax="100" style="width: 26%"></div>
                                        </div>
                                    </div>
                                    <div class="mt-3 col-sm-12">
                                        <button type="button" '.$dis.' onclick="openRegisterForm('.$row["booking_id"].')" class="p-3 btn btn-block btn-outline-primary">
                                            <p style="font-size: 20px;" class="text-center"><i class="zmdi zmdi-sign-in"></i> Register</p>
                                        </button>
                                    </div>
                                </div>
                            </div>';
                            }

                            if($row["facebook"] != "" || $row["website"] != "" || $row["whatsapp"] != ""){

                                $res.='

                                <div class="mt-3 col-sm-12 rounded border border-dark bg-white shadow-lg">
                                    <div class="row p-3">
                                        <div class="col-sm-12 bg-info">
                                            <h2 class="text-white text-center p-3">Our Social Profiles</h2>
                                        </div>
                                    </div>
                                    <div class="row mt-3">';

                                        if($row["website"] != ""){
                                        $res.='
                                        <div style="background-color: #a9a9a9" class="col-sm">
                                            <p class="text-white text-center p-3"><i class="zmdi zmdi-home"></i> '.$row["website"].'</p>
                                        </div>';
                                        }

                                        if($row["facebook"] != ""){
                                        $res.='
                                        <div style="background-color: #3b5998" class="col-sm">
                                            <p class="text-white text-center p-3"><i class="zmdi zmdi-facebook-box"></i> '.$row["facebook"].'</p>
                                        </div>';
                                        }

                                        if($row["whatsapp"] != ""){
                                        $res.='
                                        <div style="background-color: #075e54" class="col-sm">
                                            <p class="text-white text-center p-3"><i class="zmdi zmdi-whatsapp"></i> '.$row["whatsapp"].'</p>
                                        </div>';
                                        }

                                    $res.='
                                    </div>
                                </div>';

                            }
                        
                    
                    }
                    return $res;
            }catch(PDOException $ex)
            {
                echo 'ERROR: ' . $e->getMessage();
            } 
        }
        //Function to Register New Participants (1 Param is Booking ID, 2 Param is Client ID) - Uzair
        public function registerParticipant($bid, $cid){
            try
            {
                    $stmt = $this->connect()->prepare("INSERT INTO registration (booking_id, user_id) VALUES (:b, :c)");
                    $stmt->execute(array(':b' => $bid, ':c' => $cid));

                return;
            }
            catch(Exception $ex)
            {
                echo "ERROR:". $ex->getMessage();
            }
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

         //To Get All The Participants WRT. Booking ID
        //Param - bid=booking-id
        public function fetchParticipants($bid){
            try
            {
    
                $res = '';
                $stmt = $this->connect()->query("SELECT * FROM registration WHERE booking_id=$bid");
                    
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
                        $email="";
                        $phone="";
                        $uid=$row["user_id"];
                        $stmt2 = $this->connect()->query("SELECT * FROM users WHERE id=$uid");
                    
                        while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
                        {
                            $email = $row2["email"];
                            $phone = $row2["phone"];
                        }

                        $res .= '
                        <div class="mt-2 bg-primary col-sm-12">
                            <p class="p-3 text-center text-white">'.$email.'  ['.$phone.']</p>
                        </div>
                        ';

                    }     
                    return $res;

            }catch(PDOException $ex)
            {
                echo 'ERROR: ' . $ex->getMessage();
            }  
        }
        //uzair livechat feathure
        public function fetchRepliesById($currentUser, $bid, $cid){
            try
            {
     
                $res = '';
                $stmt = $this->connect()->query("SELECT * FROM replies WHERE booking_id=$bid ORDER BY time_submitted ASC");
                    $count =1;
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
                    
                    $res .= '
                    <div class="it border border-dark col-sm-12 mb-2">
                        <div class="row">';
                            if($row["m_from"]==0){
                                $text = "";
                                $person="";
                                if($currentUser == "admin"){
                                    $text = "text-right";
                                    $person = "You";
                                }
                                else{
                                    $text = "text-left";
                                    $person = "Admin";
                                }
                                $res.='
                                <div class="p-0 col-sm-12">
                                <button type="button" class="btn btn-dark '.$text.' text-white btn-block"><a class="btn btn-danger">'.$person.'</a><a class="btn btn-warning text-light">'.$row["time_submitted"].'</a></button>
                                </div>';
                            }
                            else{
                                $text = "";
                                $person="";
                                if($currentUser == "admin"){
                                    $text = "text-left";
                                    $person = "User";
                                }
                                else{
                                    $text = "text-right";
                                    $person = "You";
                                }
                                $res.='
                                <div class="p-0 col-sm-12">
                                <button type="button" class="btn btn-dark '.$text.' text-white btn-block"><a class="btn btn-danger">'.$person.'</a><a class="btn btn-warning text-light">'.$row["time_submitted"].'</a></button>
                                </div>';
                            }
                            
                            $res.='
                            <div class="p-3 text-center col-sm-12">
                              
                                <p style="word-wrap: break-word;">'.$row["mess"].'</p>
        
                            </div>';
    
                            if($currentUser=="admin"){
                            $res.='
                            <div class="p-0 col-sm-12">
                                <button type="button" onclick="deleteReply('.$row["m_id"].')" class="btn btn-danger btn-block"><i class="fas fa-window-close"></i></button>
                            </div>';
                            }
                            $res.='
                        </div>
                    </div>'; 
    
                    $count++;
                    }     
                    if($count == 1){
                        $res= '<h2 id="norecord" name="norec" class="text-center bg-dark text-white p-3">No Replies</h2>';
                        
                    }
    
                    return $res;
    
            }catch(PDOException $ex)
            {
                echo 'ERROR: ' . $ex->getMessage();
            }  
        }

        // uzair livechat feathure
        public function addReply($bid, $from, $to, $message)
        {
            try
            {
                if($from == "admin"){
                    $from = 0;
                }
    
                if($to == "admin"){
                    $to = 0;
                }
                $stmt = $this->connect()->prepare("INSERT INTO replies (booking_id, mess, m_from, m_to) VALUES (:id, :m, :mf, :mt)");
                $stmt->execute(array(':id' => $bid, ':m' => $message, ':mf' => $from, ':mt' => $to));
    
    
    
                $this->pushNotification($bid, $to);
    
    
                return;
                
            }
            catch(Exception $ex)
            {
                echo "ERROR:". $ex->getMessage();
            }
    
        }
        //uzair 
        public function deleteNotification($bid, $to){
       
            try
            {        
                if($to == 0){
                    $stmt = $this->connect()->prepare("UPDATE event_bookings SET user_noti=:n WHERE booking_id=:bid");
                    $stmt->execute(array(':n' => 0, ':bid' => $bid)); 
                    return;
                }
                else{
                    $stmt = $this->connect()->prepare("UPDATE event_bookings SET admin_noti=:n WHERE booking_id=:bid");
                    $stmt->execute(array(':n' => 0, ':bid' => $bid)); 
                    return;
                }
    
                    
            }catch(PDOException $ex)
            {
                echo 'ERROR: ' . $e->getMessage();
            } 
    
        }
        
        //uzair use in addreply
        public function pushNotification($bid, $to){
           
            try
            {   
        
                $stmt = $this->connect()->query("SELECT * FROM event_bookings WHERE booking_id=$bid");
                    $a_noti=0;
                    $u_noti=0;
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
                        $a_noti = $row["admin_noti"];
                        $u_noti = $row["user_noti"];
                        
                    }
                    
                    if($to == 0){
                        $a_noti = $a_noti + 1;
                        $stmt = $this->connect()->prepare("UPDATE event_bookings SET admin_noti=:n WHERE booking_id=:bid");
                        $stmt->execute(array(':n' => $a_noti, ':bid' => $bid)); 
                    }
                    else{
                        $u_noti = $u_noti + 1;
                        $stmt = $this->connect()->prepare("UPDATE event_bookings SET user_noti=:n WHERE booking_id=:bid");
                        $stmt->execute(array(':n' => $u_noti, ':bid' => $bid)); 
                    }
    
                    return;
                    
            }catch(PDOException $ex)
            {
                echo 'ERROR: ' . $e->getMessage();
            } 
        }
    }
?>