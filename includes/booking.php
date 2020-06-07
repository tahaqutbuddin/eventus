<?php

require 'venues.php';

class bookings extends venues
{

    private $type;
    private $date;
    private $price;
    private $music;
    private $venId;
    private $caterer;
    private $comments;
    private $clientId;
    private $bookingId;
    private $decoration;
    private $activity;
    private $ename;
    private $image;
    private $fb;
    private $web;
    private $whats;
    private $edesc;
    private $promotion;
    public function __construct() {}
    public function __destruct() {}
    public function setall()  // Setter for All attributes -- TAHA
    {
        try
        {
        //Checking if values is set ELSE set as null
        isset($_SESSION['newBooking']['type']) === true ? $this->type = $_SESSION['newBooking']['type']: ' ';
        isset($_SESSION['newBooking']['date']) === true ? $this->date= $_SESSION['newBooking']['date']: ' ';
        isset($_SESSION['newBooking']['price']) === true ? $this->price= $_SESSION['newBooking']['price']: ' ';
        isset($_SESSION['newBooking']['venid']) === true ? $this->venId = $_SESSION['newBooking']['venid']: ' ';
        isset($_SESSION['newBooking']['music']) === true ? $this->music = $_SESSION['newBooking']['music']: ' ';
        isset($_SESSION['newBooking']['activity']) === true ? $this->activity = $_SESSION['newBooking']['activity']: ' ';
        isset($_SESSION['newBooking']['ename']) === true ? $this->ename = $_SESSION['newBooking']['ename']: ' ';
        isset($_SESSION['newBooking']['desc']) === true ? $this->edesc = $_SESSION['newBooking']['desc']: ' ';
        isset($_FILES['image']['name']) === true ? $this->image = $_FILES['image']['name']: ' ';
        isset($_SESSION['newBooking']['facebook']) === true ? $this->fb = $_SESSION['newBooking']['facebook']: ' ';
        isset($_SESSION['newBooking']['website']) === true ? $this->web = $_SESSION['newBooking']['website']: ' ';
        isset($_SESSION['newBooking']['whatsapp']) === true ? $this->whats = $_SESSION['newBooking']['whatsapp']: ' ';
        isset($_SESSION['newBooking']['promotion']) === true ? $this->promotion = $_SESSION['newBooking']['promotion']: ' ';
        $this->clientId = $_SESSION['userid'];
        unset($_SESSION['newBooking']);
    }catch(Exception $ex)
    {
        echo 'Error '.$ex->getMessage();
    }
    }
    public function registerEvent()  // Book a new event --TAHA
    {
        try
        {
        $finalprice= $this->price;
        if($this->promotion=="yes" && $this->music=="yes")
        {
            $finalprice += 9999+4999;
        }
        else if($this->promotion=="yes")
        {
            $finalprice += 9999;
        }
        else if($this->music=="yes")
        {
            $finalprice += 4999;
        }
        $uploadfilename = $_SESSION['image']['image']['tmp_name'];
            $target = "../images/bookingPics/".$this->image;
            if (move_uploaded_file($uploadfilename, $target)) {
                $sql='INSERT INTO event_bookings (client_id,event_name,event_desc,event_date,price,
                promotion,music,venue_id,activity_status,status,event_cate_id,image,route,facebook,website,whatsapp,admin_noti,
                user_noti) VALUES (:cli,:name,:desc,:date,:price,:promo,:music,:venid,:act,"pending",:cate,:img,:rout,:fb,
                :web,:whats,"0","0")';
                $salt = "EvEnTuS53";
                $route = md5($salt.$this->date);
                $stmt = $this->connect()->prepare($sql);
                $q = $stmt->execute(array
                (
                ':cli' => $this->clientId,
                ':name' =>$this->ename,
                ':desc' =>$this->edesc,
                ':date' => $this->date,
                ':price' => $finalprice,
                ':promo' =>$this->promotion,
                ':music' => $this->music,
                ':venid' => $this->venId,
                ':act'=>$this->activity,
                ':cate'=>$this->type,
                ':img'=>$this->image,
                ':fb'=>$this->fb,
                ':web'=>$this->web,
                ':whats'=>$this->whats,
                ':rout'=>$route
                ));
            }


        }catch(PDOException $ex)
        {
            echo 'Error '.$ex->getMessage();
        }
       
    }

    function verifyUrl($url,$flag) // verify existence of Incoming URL -- TAHA
    {

        try
        {
            if (filter_var($url, FILTER_VALIDATE_URL)) 
            {

                if($flag==1)
                {
                    if((strpos($url, "https://facebook.com") !== false) ||  (strpos($url, "https://www.facebook.com") !== false))
                        {
                            $page = file_get_contents($url);
                            $pos = strrpos( $page, 'The page you requested was not found' );
                            if ( $pos === true )
                            {
                            return "The requested URL was not found";
                            }
                        } 
                        else{
                            return 'Please enter correct Facebook URL';
                        } 
                }
                else if($flag==2)
                {
                    if((strpos($url, "https://") !== false) ||  (strpos($url, "http://") !== false))
                        {
                       
                        } 
                        else{
                            return 'Please Enter correct URL';
                        } 
                }
            }
        }catch(PDOException $ex)
        {
            echo 'Error:- '.$ex->getMessage();
        }

    }
    function verifyImage($filename)        // verify name of Image uploaded at Runtime -- TAHA
    {
        try
        {

        $validextensions = array("jpeg", "jpg", "png");      // Extensions which are allowed.
            $ext = explode('.', basename($filename));   // Explode file name from dot(.)
            $file_extension = end($ext); // Store extensions in the variable.

            if($ext[count($ext) - 1] == "jpeg" || $ext[count($ext) - 1] == "jpg" || $ext[count($ext) - 1] == "png" ||
            $ext[count($ext) - 1] == "JPEG" || $ext[count($ext) - 1] == "JPG" || $ext[count($ext) - 1] == "PNG")
            {
                return true;
            }else
            {
                return 'Invalid format.Use only (jpeg,jpg,png)';
            }

        }catch(PDOException $ex)
        {
            echo 'Error'.$ex->getMessage();
        }
           
    }

    public function eventtypes($ab) // Show all types of event categories provided by us -- TAHA
    {
        try
        {
        $a = $this->connect()->prepare("select * from event_category");
        if($a->execute())
        {
            $output = ' ';
            foreach($a as $row)
            {
                if(strlen($ab)>0 && $row['cate_id']==$ab)
                {
                    $output .= '<option value="'.$row["cate_id"].'" selected="selected">'.$row['cate_name'].'</option>';
                }
                else
                {
                    $output .= '<option value="'.$row["cate_id"].'">'.$row['cate_name'].'</option>';
                }
            }
            return $output;
        }else
        {
            throw new Exception("Unable to execute query");
        }
        }catch(PDOException $ex)
        {
            echo 'Error'.$ex->getMessage();
        }
    }

   
    public function venueThumbnail($venid) // get thumbnail image for venue
    {
        try
        {
        $stmt = $this->connect()->prepare("SELECT * FROM venue_images WHERE ven_id=:id");
            $stmt->bindValue(':id', (int)$venid, PDO::PARAM_INT); 
            $stmt->execute();
            $venuesList = $stmt->fetch();
      if($venuesList)
          {
          if($venuesList['name'])
            {
            return $venuesList['name'];
            }
        }else
        {
            return "no.png";
        }    
        }catch(PDOException $ex)
        {
            echo 'Error'.$ex->getMessage();
        }
    }

    public function eventAll()          // Display all venues from database
    {
        try
        {
        $ab = $this->connect()->prepare("SELECT * from all_venues ");
        $ab->execute();
        $output = ' ';
        foreach($ab as $row)
        {
            $image = $this->venueThumbnail($row['venue_id']);
            $output .= '  <div class="cr mb-3 col-lg-4 col-md-6">
            <div class="card mb-5 mb-lg-0">
              <img class="card-img-top img-fluid" style="height:250px;"src="../images/bookingPics/'.$image.'" alt="Card image cap">
              <div class="card-body">
              <h4 class="card-title text-uppercase text-center">'.$row['venue_name'].'</h4><br/>
                  <span><b>Owner:</b> '.$row['owner'].'</span><br/>
                  <span><b>Address:</b> '.$row['venue_address'].'</span><br/>
                  <span><b>Price:</b> Rs '.$row['booking_price'].'/=</span><br/>
                <span></span>
                <hr>  
                <a href="#" class="btn btn-block btn-warning text-uppercase seeMore" data-id="'.$row['venue_id'].'" >See More</a>
                <a href="#" id="select_button_for_form2" class="btn btn-block btn-success text-uppercase finalSelect" data-id="'.$row['venue_id'].'" >Select</a>
              </div>
            </div>
          </div>';
        }
        return $output; 
        }catch(PDOException $ex)
        {
            echo 'Error'.$ex->getMessage();
        }  
    }


    public function checkCategoryOfVenue($ven,$cateid) // created by TAHA to check existence of respective venue category
    {
        try
        {
        $arr = array();
        $ab = $this->connect()->prepare("Select event_cate_id from venue_categories where venue_id= :id");
                $ab->execute(array(':id'=>$ven));
            while($list = $ab->fetch(PDO::FETCH_ASSOC))
            {
                array_push($arr,$list["event_cate_id"]);
        }
                if(in_array($cateid,$arr)){
                return $cateid;
            }
            else
            {
                return 0;
            }
                         
        }catch(PDOException $ex)
        {
            echo 'Error'.$ex->getMessage();
        }
                    
    }

    public function getData($sel_loc,$sel_cate,$sel_amin,$sel_amax, $sel_bmax,$sel_bmin) // created by TAHA for searching venues records based upon filters
    {
        try
        {   
            // building custom query based upon number of Active parameters
            $query="Select * from all_venues";
            $count=0;
            
            if($sel_loc != 0 || strlen($sel_loc)>1)    // for checking area received is not Equal to 0 OR null
            { 
                if($count==0){
                $query .=" WHERE area='$sel_loc' AND"; 
                $count++;
                }
                else{
                    $query.=" area='$sel_loc' AND"; 
                }
            }
            if($sel_amin >= "0" && $sel_amax <="100000") // for checking hall capacity received is between the range
            {
                if($count==0){
                $query .=" WHERE capacity BETWEEN '$sel_amin' AND '$sel_amax' AND";
                $count++;
                }
                else{
                    $query.=" capacity BETWEEN '$sel_amin' AND '$sel_amax' AND"; 
                }
            }

    
            if($sel_bmax >= "0" && $sel_bmax <="500000"){
                if($count==0){
                $query .=" WHERE booking_price BETWEEN '$sel_bmin' AND '$sel_bmax' AND";
                $count++;
                }
                else{
                    $query.=" booking_price BETWEEN '$sel_bmin' AND '$sel_bmax' AND"; 
                }
            }
    
            $lastThree = substr($query, -3);
    
            if($lastThree == "AND"){
                $query = substr($query, 0, -3);
    
            }

            $ab = $this->connect()->prepare($query);
            $output = ' ';
            $cnt = 0;
            if($ab->execute())
            {
            
                foreach($ab as $row)
                {
                    $checker = 0;
                    $image = $this->venueThumbnail($row['venue_id']);  // fetching thumbnail picture for venue using this function
                    if($sel_cate==0)    //if category is not selected
                    {

                        $output .= '  <div class="cr mb-3 col-lg-4 col-md-6">
                        <div class="card mb-5 mb-lg-0">
                        <img class="card-img-top img-fluid" style="height:250px;"src="../images/bookingPics/'.$image.'" alt="Card image cap">
                        <div class="card-body">
                        <h4 class="card-title text-uppercase text-center">'.$row['venue_name'].'</h4><br/>
                            <span><b>Owner:</b> '.$row['owner'].'</span><br/>
                            <span><b>Address:</b> '.$row['venue_address'].'</span><br/>
                            <span><b>Price:</b> Rs '.$row['booking_price'].'/=</span><br/>
                            <span></span>
                            <hr>  
                            <a href="#" class="btn btn-block btn-warning text-uppercase seeMore" data-id="'.$row['venue_id'].'" >See More</a>
                            <a href="#" id="select_button_for_form2" class="btn btn-block btn-success text-uppercase finalSelect" data-id="'.$row['venue_id'].'" >Select</a>
                        </div>
                        </div>
                    </div>';
                    }else if($sel_cate!=0 && $sel_cate>0)
                    {
                        $checker =  $this->checkCategoryOfVenue($row['venue_id'],$sel_cate);                 
                        if($checker > 0 ) // if category received as parameter exists for any venue. Print it
                        {
                                    $output .= '  <div class="cr mb-3 col-lg-4 col-md-6">
                        <div class="card mb-5 mb-lg-0">
                        <img class="card-img-top img-fluid" style="height:250px;"src="../images/bookingPics/'.$image.'" alt="Card image cap">
                        <div class="card-body">
                        <h4 class="card-title text-uppercase text-center">'.$row['venue_name'].'</h4><br/>
                            <span><b>Owner:</b> '.$row['owner'].'</span><br/>
                            <span><b>Address:</b> '.$row['venue_address'].'</span><br/>
                            <span><b>Price:</b> Rs '.$row['booking_price'].'/=</span><br/>
                            <span></span>
                            <hr>  
                            <a href="#" class="btn btn-block btn-warning text-uppercase seeMore" data-id="'.$row['venue_id'].'" >See More</a>
                            <a href="#" id="select_button_for_form2" class="btn btn-block btn-success text-uppercase finalSelect" data-id="'.$row['venue_id'].'" >Select</a>
                        </div>
                        </div>
                    </div>';
                        }else if($checker==0)
                        {
                            continue;
                        }
                    }    
                $cnt++;
                }
            }
           if($cnt==0)
            {
                $output .= '<div class="col-12">
                <h2 class="jumbotron text-center text-uppercase text-danger">No Records Found<br/><br/>
                <small class="text-muted text-capitalize">Your desired venue is not available.Search something else.</small
                ></h2></div>';
            }
            return $output;
            }catch(PDOException $ex)
            {
                echo 'ERROR: ' . $ex->getMessage();
            }
    }

    public function fetch_String_of_particular_table_by_column_and_id($tablename,$column,$id)//taha
    {
        try
        { $stmt = $this->connect()->prepare("Select * from $tablename where $column = :id");
        if($stmt->execute(array(':id'=>$id)))
        {
        if($stmt->rowCount())
        {
            return $stmt;
        } 
        else 
        {
            return 0;
        }
        }else
        {
            throw new Exception("Unable to execute query");
        }
        }catch(PDOException $ex)
        {
            echo 'Error'.$ex->getMessage();
        }
    }

     public function seeMoreForm($a,$cid)
    {   
        try
        {
        $output = ''; 
        $cate='' ;  
        $stmt = $this->connect()->prepare("Select * from all_venues where venue_id = :id");
        $stmt->execute(array(':id'=>$a));
        $result = $stmt->fetch();
        if($cid!=0)
        {
        $cate_name = $this->fetch_String_of_particular_table_by_column_and_id("event_category","cate_id",$cid);
        $r = $cate_name->fetch();
        $cate .= '
        <div class="form-group col-auto">
                <label for="bdate_1">Event Type</label>
                <input type="text" class="form-control" id="bdate_1" name="type" value="'.$r['cate_name'].'" readonly />
            </div>                    
        ';
        }
        else 
        {
 
            $cate_id = $this->fetch_String_of_particular_table_by_column_and_id("venue_categories","venue_id",$result['venue_id']);
          $cp = 0;
             if($cate_id->rowCount()>1) // for multiple categories of a single venue
             { 
                $display ='';
               while($row = $cate_id->fetch())
                {
                    $cc = $this->fetch_String_of_particular_table_by_column_and_id("event_category","cate_id",$row['event_cate_id']);
                   $ccc = $cc->fetch();
                    $display .= '<option value="'.$row['event_cate_id'].'">'.ucfirst($ccc['cate_name']).'</option>';
                    $cp++;
                }
            $cate .= '
            <div class="form-group col-4">
            <label for="bcake_2">Supports Event Types ('.$cp.')</label> 
            <select class="form-control" name="cake" id="bcake_2">
            <option value="0">Select option</option>'.$display.'
            </select>
            </div>
            ';
             }else if($cate_id->rowCount()==1)    // confirming that only 1 category exist for a venue
             {
                 $row = $cate_id->fetch();
                 $cc = $this->fetch_String_of_particular_table_by_column_and_id("event_category","cate_id",$row['event_cate_id']);
                 $ccc = $cc->fetch();
                 $cate .= '
                 <div class="form-group col-auto">
                         <label for="bdate_1">Event Type</label>
                         <input type="text" class="form-control" id="bdate_1" name="type" data-id ="'.$row["event_cate_id"].'" value="'.ucfirst($ccc['cate_name']).'" readonly />
                     </div>                    
                 ';
             }
         
            
        }

        $output .= '
        <div class="form-row justify-content-center">
        '.$cate.'
        </div>
        <div class="form-row justify-content-center">

        <div class="form-group col-6">
            <label for="venue_name">Venue Name</label>
            <input type="text" class="form-control text-center" id="venue_name" name="vname" value="'.ucfirst($result['venue_name']).'" readonly />
            </div>
        
            <div class="form-group col-auto">
            <label for="rating">Rating</label>'.$this->printstars($result['rating']).'
            <input type="number" class="form-control text-center" id="rating" name="rating" value="'.$result['rating'].'" readonly />
        </div>
        </div>

        
        <div class="form-row justify-content-center">

        <div class="form-group col-auto">
            <label for="owner_name">Owner Name</label>
            <input type="text" class="form-control text-center" id="owner_name" name="oname" value="'.ucfirst($result['owner']).'" readonly />
            </div>

            <div class="form-group col-auto">
            <label for="owner_number">Owner Contact Number</label>
            <input type="text" class="form-control text-center" id="owner_number" number="onumber" value="'.$result['owner_contact'].'" readonly />

        </div>

        </div>
        <div class="form-row justify-content-center">
        <div class="form-group col-auto">
        <label for="owner_name">Area</label>
        <input type="text" class="form-control text-center" id="area" name="area" value="'.ucfirst($result['area']).'" readonly />
        </div>

    <div class="form-group col-8">
    <label for="venue_address">Venue address</label>
    <input type="text" class="form-control text-center" id="venue_address" name="vaddress" value="'.ucfirst($result['venue_address']).'"" readonly />
    </div>
        </div>

        <div class="form-row justify-content-center">


        <div class="form-group col-auto">
            <label for="booking_price">Booking Price</label>
            <input type="number" class="form-control text-center" id="booking_price" name="bbprice" value="'.$result['booking_price'].'" readonly />

        </div>
            
        
        <div class="form-group col-auto">
            <label for="capacity">Capacity</label>
            <input type="number" class="form-control text-center" id="capacity" name="capacity" value="'.$result['capacity'].'" readonly />

        </div>

        </div>
        <div class="text-center">
        <a href="#"  class="btn  btn-success text-uppercase" onclick="close_form1()"  >Select</a>
        <button type="button" id="close_button_for_form1" class="btn  btn-danger" data-dismiss="modal"><i class="fas fa-window-close"></i> Close</button>
        </div>
        ';
        return $output;
    
    }catch(PDOException $ex)
    {
        echo 'Error'.$ex->getMessage();
    }
    }
 
    
    public function finalSelectionForm($a,$cid) // created by TAHA for showing up data in SELECT modal
    {

        try
        {   
        $output = '';
        $stmt = $this->connect()->prepare("Select * from all_venues where venue_id = :id");
        $stmt->execute(array(':id'=>$a));
        $result = $stmt->fetch();
        $cate='' ;  
        if($cid!=0)     // if category has been selected by user
        {
        $cate_name = $this->fetch_String_of_particular_table_by_column_and_id("event_category","cate_id",$cid); 
        $r = $cate_name->fetch();
        $cate .= '
        <div class="form-group col-auto">
                <label for="bdate_1">Event Type</label>
                <input type="text" class="form-control" id="bdate_1" name="type" data-id ="'.$r["cate_id"].'" value="'.$r['cate_name'].'" readonly />
            </div>                    
        ';
        }
        else 
        {
            $cate_id = $this->fetch_String_of_particular_table_by_column_and_id("venue_categories","venue_id",$result['venue_id']);
                $display ='';
               
                if( $cate_id->rowCount()>1)  // if multiple category for a single venue
                {
                    while($row = $cate_id->fetch())
                    {
                        $cc = $this->fetch_String_of_particular_table_by_column_and_id("event_category","cate_id",$row['event_cate_id']);
                    $ccc = $cc->fetch();
                        $display .= '<option value="'.$row['event_cate_id'].'">'.ucfirst($ccc['cate_name']).'</option>';
                    }
                    $cate .= '
                    <div class="form-group col-auto">
                    <label for="bcate_2">Event Type</label>
                    <select class="form-control" name="type" id="bcate_2" required>
                    <option value="0">Select option</option>'.$display.'
                    </select>
                    </div>
                    ';
                }else if($cate_id->rowCount()==1)
                {
                    $row = $cate_id->fetch();
                    $cc = $this->fetch_String_of_particular_table_by_column_and_id("event_category","cate_id",$row['event_cate_id']);
                    $ccc = $cc->fetch();
                    $cate .= '
                    <div class="form-group col-auto">
                            <label for="bdate_1">Event Type</label>
                            <input type="text" class="form-control" id="bdate_1" name="type" data-id ="'.$row["event_cate_id"].'" value="'.ucfirst($ccc['cate_name']).'" readonly />
                        </div>                    
                    ';
                }
            
        }

        // Defining Modal Output
        $output .= '
        <input type="hidden" name="venid" value="'.$result['venue_id'].'"/>
        <div class="form-row justify-content-center">

            <div class="form-group col-6">
            <label for="venue_name">Venue Name</label>
            <input type="text" class="form-control text-center" id="venue_name" name="venue" value="'.ucfirst($result['venue_name']).'" readonly />
            </div>

            <div class="form-group col-auto">
            <label for="rating">Rating</label>'.$this->printstars($result['rating']).'
            <input type="number" class="form-control text-center" id="rating" name="rating" value="'.$result['rating'].'" readonly />
            </div>

            </div>

        <div class="form-row justify-content-center">

        <div class="form-group col-auto">
            <label for="owner_name">Area</label>
            <input type="text" class="form-control text-center" id="area" name="area" value="'.ucfirst($result['area']).'" readonly />
            </div>
        <div class="form-group col-8">
        <label for="venue_address">Venue address</label>
        <input type="text" class="form-control text-center" id="venue_address" name="vaddress" value="'.ucfirst($result['venue_address']).'"" readonly />
        </div>
        </div>

        <div class="form-row justify-content-center">
        <div class="form-group col-3">
        <label for="booking_price">Booking Price</label>
        <input type="number" class="form-control text-center" id="booking_price" name="price" value="'.$result['booking_price'].'" readonly />
    </div>
        <div class="form-group col-3">
            <label for="capacity">Capacity</label>
            <input type="number" class="form-control text-center" id="capacity" name="capacity" value="'.$result['capacity'].'" readonly />
        </div>
        </div>
    <hr/>
            <div class="form-row justify-content-center">
            <div class="form-group col-8">
            <h3 class="text-secondary">Enter Details for Booking</h3>
            </div>
            </div>

            <div class="form-row justify-content-center">
            <div class="form-group col-4">
            <label>Event Title</label>
            <input type="text" name="ename" class="form-control text-center" placeholder="Enter a catchy name" required/>
            </div>
            <div class="form-group col-7">
            <label>Enter Your Event\'s description</label>
            <textarea name="desc" rows=2 class="form-control" required/></textarea>
            </div>
            


            </div>
            <div class="form-row justify-content-center">'.$cate.'

                <div class="form-group col-auto">
                <label for="act_1">Open For Public?</label>
                <select class="form-control" name="activity" onchange="urlGenerate()"  id="act_1" required> 
                <option >Select Option</option>
                <option value="public">Public</option>
                    <option value="private">Private</option>
                </select>
                </div>
                
                <div class="form-group col-auto">
                <label for="act_1">Select Date</label>
                <input type="date" name="date" class="form-control datepicker text-center" autocomplete="off" required>
                </div>
            </div>



            <div class="form-row justify-content-left">
            <div class="form-group col-3">
            <label for="music_2">Music System</label>
            <select class="form-control music_2" onchange="addMusicPrice()" name="music" id="music_2">
            <option value="yes">Yes</option>
                <option value="no" selected>No</option>
            </select>
            <small>Extra charges of Rs.4999/=</small>
            </div>
    
            <div class="form-group col-3">
            <label for="decoration_1">Event Promotion</label>
            <select class="form-control promotion_1"  name="promotion" id="promotion_1">  
            <option value="yes">Yes</option>
                <option value="no" selected>No</option>
            </select>
            <small>Extra charges of Rs.9999/=</small>
            </div>

            <div class="form-group col-auto">
            <label>Poster/ Image of Event</label>
            <input type="file" name="image" class="form-control" onchange="verifyImage()" id="eimage" required />
            <small id="verify" class="text-danger"></small>
            </div>
            </div>
            
            <div class="form-row" id="urls">
            </div>
            <div class="text-right">
            <button type="submit" name="submit_request"  class="btn  btn-success mb-1"> <i class="fas fa-paper-plane"></i> Submit</button>
            <button type="button" class="btn btn-danger mb-1" data-dismiss="modal"><i class="fas fa-window-close"></i> Close</button>
            </div>
            ';
            return $output;
        
        }catch(PDOException $ex)
        {
            echo 'Error'.$ex->getMessage();
        }

    }

}
?>