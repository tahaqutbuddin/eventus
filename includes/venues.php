<?php 
require_once 'otherclasses.php';
session_start();
class venues //tahha
{
    use dbh;
   protected $venue_id;
   protected $venue_name;
   protected $venue_address;
   protected $venue_booking_price;
   protected $venue_owner;
   protected $venue_owner_contact;
   protected $venue_capacity;
   protected $venue_rating;
    
    public function set_venue($n,$a,$bp,$o,$oc,$c,$r)
    {
        $this->venue_name = $n;
        $this->venue_address = $a;
        $this->venue_booking_price = $bp;
        $this->venue_owner = $o;
        $this->venue_owner_contact = $oc;
        $this->venue_capacity = $c; 
        $this->venue_rating = $r;
    }
    public function setVenue_id($a)
    {
        $this->venue_id = $a;
    }
    public function getVenue_name()
    {
        return $this->venue_name;
    }
    public function getVenue_address()
    {
        return $this->venue_address;
    }
    public function getVenue_booking_price()
    {
        return $this->venue_booking_price;
    }
    public function getVenue_owner()
    {
        return $this->venue_owner;
    }
    public function getVenue_owner_contact()
    {
        return $this->venue_owner_contact;
    }
    public function getVenue_capacity()
    {
        return $this->venue_capacity;
    }
    public function getVenue_rating()
    {
        return $this->venue_rating;
    }

    
    public function areasOption($ab)
   {
       try
       {
        $a = $this->connect()->prepare("SELECT DISTINCT area from all_venues");
        $a->execute();
        $output = ' ';
         foreach($a as $row)
        {
            if(strlen($ab)>0 && $row['area'] == $ab)
            {
                $output .= '<option value="'.$row["area"].'" selected="selected">'.$row['area'].'</option>';    
            }
            else
            {
                
            $output .= '<option value="'.$row["area"].'">'.$row['area'].'</option>';
            }
        }
        return $output;
    }catch(PDOException $ex)
    {
     echo 'Error '.$ex->getMessage();
    }
    }

    public function show_category()//asad
        {
            try
            {
                $res = '';
                $stmt = $this->connect()->query("SELECT * FROM event_category");
    
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
                    
                        $res.= '<input type="checkbox" id="'.$row["cate_id"].'"name="cate[]" value="'.$row["cate_id"].'" >'.$row["cate_name"].'<br>  ';    
    
                    }
                    return $res;
    
            }catch(PDOException $e)
            {
                echo 'ERROR: ' . $e->getMessage();
            }   
        }
    
        public function save_category($cates)//asad
        {
            $last_id = $this->getLastId();
            foreach($cates as $cat) {
            $stmt = $this->connect()->prepare("INSERT INTO `venue_categories` ( `venue_id`, `event_cate_id`) VALUES ( '$last_id', '$cat');");
            $stmt->execute(); 
            }
        }

        protected function printStars($rating){
            $output = ' ';
    
            for($i=1;$i<=$rating;$i++)
            {
                $output .= '<i style="color:#57A0D3" class="fa fa-star"></i>';
            }
    
            for($j=1;$j<=6-$i;$j++)
            {
                $output .= '<i class="fa fa-star"></i>';
            }
    
            return $output;
        }

        public function showAllVenues($sort)
    {
         try
        {   
            
            if($sort=="rating"){
                $sort.=" DESC";
            }
            $res = '';
            $stmt = $this->connect()->query("SELECT * FROM all_venues ORDER BY $sort");
                $count = 1;
                while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
          
                    $res.= '<tr>
                    <td> '.$count.'</td>
                    <td> '.htmlentities($row["venue_name"]).'</td>
                    <td>'.htmlentities($row["owner"]).'</td>
                    <td>'.htmlentities($row["owner_contact"]).'</td>
                    
                    <td>'.$this->printStars($row["rating"]).'</td>
                    <td>
                   
                        <div class="table-data-feature">
                      
                            <button class="mr-2 btn btn-success" onclick="showMore('.$row["venue_id"].',\''.$row["venue_name"].'\',\''.$row["venue_address"].'\','.$row["booking_price"].',\''.$row["owner"].'\',\''.$row["owner_contact"].'\','.$row["capacity"].','.$row["rating"].',\''.$row["area"].'\')" title="Edit">
                                <i class="zmdi zmdi-eye"></i>
                            </button>
                            <button class="mr-2 btn btn-warning" onclick="updateVenue('.$row["venue_id"].',\''.$row["venue_name"].'\',\''.$row["venue_address"].'\','.$row["booking_price"].',\''.$row["owner"].'\',\''.$row["owner_contact"].'\','.$row["capacity"].','.$row["rating"].',\''.$row["area"].'\')" title="Edit">
                                <i class="zmdi zmdi-edit"></i>
                            </button>
                            <a class="btn btn-danger" href="?id='.htmlentities($row["venue_id"]).'&oop=del" name="delete" data-placement="top" title="Delete">
                                <i class="zmdi zmdi-delete"></i>
                            </a>      
                  
                        </div>
                    </td></tr>';   
                    $count++; 
                }     

                if($count == 1){
                    $res.= '<tr><h2 id="norecord" name="norec" class="text-center bg-dark text-white p-3">No Records Found</h2></tr>';
                }

                return $res;
        }catch(PDOException $e)
        {
            echo 'ERROR: ' . $e->getMessage();
        }   
    }

    //uzair
    public function addVenue($name, $address, $price, $oname, $ocontact, $capacity, $rating,$area)
    {
        try
        {
            $stmt = $this->connect()->prepare("INSERT INTO all_venues (venue_name, venue_address, booking_price, owner, owner_contact, capacity, rating,area) VALUES (:name, :address, :price, :oname, :ocon, :cap, :rating, :ar)");
            $stmt->execute(array(':name' => $name, ':address' => $address, ':price' => $price, ':oname' => $oname, ':ocon' => $ocontact, ':cap' => $capacity, ':rating' => $rating, ':ar'=>$area));

            return;
        }
        catch(Exception $ex)
        {
            echo "ERROR:". $ex->getMessage();
        }

    }
    //uzair
    public function deleteVenue($id)
    {
        try
        {
            $stmt = $this->connect()->prepare("DELETE FROM all_venues where venue_id = :xyz ");
            $stmt->execute(array(':xyz' => $id)); 
            header("Location:allvenues.php");
            return;
        }
        catch(Exception $ex)
        {
            echo "ERROR:". $ex->getMessage();
        }
    }
    //uzair
    public function updateVenue($id, $name, $address, $price, $oname, $ocontact, $capacity, $rating,$area){
        try
        {
            $stmt = $this->connect()->prepare("UPDATE all_venues SET venue_name=:n, venue_address=:a, booking_price=:p, owner=:oname, owner_contact=:ocon, capacity=:cap, rating=:rat, area=:ara WHERE venue_id=:id");
            $stmt->execute(array(':id' => $id, ':n' => $name, ':a' => $address, ':p' => $price, ':oname' => $oname, ':ocon' => $ocontact, ':cap' => $capacity, ':rat' => $rating ,':ara'=>$area)); 
            header("Location:allvenues.php");
            return;
            
        }
        catch(Exception $ex)
        {
            echo "ERROR:". $ex->getMessage();
        }
    }
    public function getImageGrid($id){
        try
        {   
            $res='';
            $stmt = $this->connect()->query("SELECT * FROM venue_images WHERE ven_id='$id' ");
            $res.='<h2 class="text-center mb-3 bg-dark text-white p-3">Total Images ['.$stmt->rowCount().']</h2>';
            $res.='<div class="row">';
                $count = 0;
                while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    $res.='<div class="col-lg-3 col-md-4 mb-3">
                    <div style="height: 100px">
                    <img class="d-block mx-auto img-fluid" src="../images/bookingPics/'.$row["name"].'" />
                    </div>
                    <button type="button" class="btn btn-danger btn-block" onclick="deleteImageById(\''.$row["name"].'\','.$row["ven_id"].','.$row["img_id"].')">Delete</button>
                </div>';

                $count++;
                }
                $res.='</div>';

                if($count == 0){
                    $res = '<h2 class="text-center mb-3 bg-dark text-white p-3">No Images Found</h2>';
                }
    
                return $res;
                
        }catch(PDOException $ex)
        {
            echo 'ERROR: ' . $e->getMessage();
        }  
    }

    //Delete Image By Image ID uzair

    public function deleteImageById($name, $id){
        try
        {   
            $stmt = $this->connect()->prepare("DELETE FROM venue_images where img_id = '$id' ");
            $stmt->execute();
            
            //Deleting the file form Uploads Folder
            unlink('../images/bookingPics/'.$name);
                
        }catch(PDOException $ex)
        {
            echo 'ERROR: ' . $e->getMessage();
        }  
    }


    //Get all Images By Venue ID uzair

    public function getImagesByVenId($id){
        try
        {   
            $res='';
            $stmt = $this->connect()->query("SELECT * FROM venue_images WHERE ven_id='$id' ");
            $res.='<h2 class="text-center mb-3 bg-dark text-white p-3">Total Images ['.$stmt->rowCount().']</h2>';
            $res.='<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">';
            
                $count = 1;
                while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    if($count==1){
                        $res.='<div style="height: 200px;" class="carousel-item active">
                        <img class="d-block mx-auto img-fluid" src="../images/bookingPics/'.$row["name"].'" alt="First slide">
                        </div>';
                    }
                else{
                        $res.='<div style="height: 200px;" class="carousel-item">
                        <img class="d-block mx-auto img-fluid" src="../images/bookingPics/'.$row["name"].'" alt="First slide">
                        </div>';
                }
                    $count++;
                }
            $res.='</div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
            </div>
        </div>';
                    
                
        if($count!=1){
            return $res;
        }
        else{
            return '<h2 class="text-center bg-dark mb-3 text-white p-3">No Images Found</h2>';
        }
                
        }catch(PDOException $ex)
        {
            echo 'ERROR: ' . $ex->getMessage();
        }   
    }

    //Uploading Files to the upload folder uzair
    public function addImagesToUploads($type, $id){
        try
        {

            $j = 0;     // Variable for indexing uploaded image.
            $target_path = "../images/bookingPics/";     // Declaring Path for uploaded images.
            $img_array = array();
            for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
            $target_path = "../images/bookingPics/"; 
            // Loop to get individual element from the array
            $validextensions = array("jpeg", "jpg", "png");      // Extensions which are allowed.
            $ext = explode('.', basename($_FILES['file']['name'][$i]));   // Explode file name from dot(.)
            $file_extension = end($ext); // Store extensions in the variable.
            $md5_name = md5(uniqid()) . "." . $ext[count($ext) - 1];

            if($ext[count($ext) - 1] == "jpeg" || $ext[count($ext) - 1] == "jpg" || $ext[count($ext) - 1] == "png"){
            array_push($img_array, $md5_name);
            }
            $target_path = $target_path . $md5_name;     // Set the target path with a new name of image.
        
            $j = $j + 1;      // Increment the number of uploaded images according to the files in array.
            if (($_FILES["file"]["size"][$i] < 100000)     // Approx. 100kb files can be uploaded.
            && in_array($file_extension, $validextensions)) {
            if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path)) {
            // If file moved to uploads folder.
            // echo $j. ').<span id="noerror">Image uploaded successfully!.</span><br/><br/>';
            } else {     //  If File Was Not Moved.
            // echo $j. ').<span id="error">please try again!.</span><br/><br/>';
            }
            } else {     //   If File Size And File Type Was Incorrect.
            // echo $j. ').<span id="error">***Invalid file Size or Type***</span><br/><br/>';
            }
            }

            //Adding Images Link to DB
            if($type == "add"){
                $this->addImagesToDb($img_array, $this->getLastId());
            }
            else if($type == "update"){
                $this->addImagesToDb($img_array, $id);
            }
            return;
        }
        catch(Exception $ex)
        {
            echo "ERROR:". $ex->getMessage();
        }
    }

    //Adding Images to DB uzair

    public function addImagesToDb($images, $vid)
    {
        try
        {
            for($i=0; $i<count($images); $i++){
                $stmt = $this->connect()->prepare("INSERT INTO venue_images (name, ven_id) VALUES (:n, :v)");
                $stmt->execute(array(':n' => $images[$i], ':v' => $vid));
            }
            return;
        }
        catch(Exception $ex)
        {
            echo "ERROR:". $ex->getMessage();
        }

    }
    //uzair
    public function deleteAllImagesFromUploads($id){
        try
        {
            $stmt = $this->connect()->query("SELECT * FROM venue_images WHERE ven_id=$id ");
                while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    unlink('../images/bookingPics/'.$row["name"]);
                }
                
                return;
        }
        catch(Exception $ex)
        {
            echo "ERROR:". $ex->getMessage();
        }
        
    }

    //Delete All Images By Venue ID uzair
    public function deleteImagesByVenId($id)
    {
        try
        {
            $stmt = $this->connect()->prepare("DELETE FROM venue_images where ven_id = :xyz ");
            $stmt->execute(array(':xyz' => $id)); 

            return;
        }
        catch(Exception $ex)
        {
            echo "ERROR:". $ex->getMessage();
        }
    }



    //Some Helper Functions 
    protected function getLastId()//uzair
    {
        try
        {   $res='';
            $stmt = $this->connect()->query("SELECT venue_id FROM all_venues ORDER BY venue_id DESC LIMIT 1");
                $count = 1;
                while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    $res = $row["venue_id"];
                }
                return $res;
        }catch(PDOException $ex)
        {
            echo 'ERROR: ' . $e->getMessage();
        }   
    }

}



?>