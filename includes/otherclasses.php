<?php
    trait dbh{
        private $servername;
        private $username;
        private $password;
        private $dbname;

        public function __construct() {}
        public function __destruct() {}
        protected function connect()
        {
            $this->servername="localhost";
            $this->username="root";
            $this->password="";
            $this->dbname="eventus";

            try {
                $dsn ="mysql:host=".$this->servername.";dbname=".$this->dbname;
                $pdo =new PDO($dsn, $this->username, $this->password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
                return $pdo;
            } catch (PDOException $e) {
                echo "Connection Failed :".$e->getMessage();
            }
        }

    }
    trait eventus
        {
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