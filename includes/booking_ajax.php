<?php
require_once 'booking.php';


$req = $_POST['req'];

$bookevent = new bookings;
//$bookevent->displayData($req);
if($req=="seeMoreData")    // created by TAHA for handling See More Requests
{
    $ven_id = $_POST['venue_id'];
    $cid = $_POST['cate_id'];
   $result =  $bookevent->seeMoreForm($ven_id,$cid);
   echo $result;
}
if($req=="verifyImage")
{
    $img = $_POST['image'];
    $result =  $bookevent->verifyImage($img);
    echo $result;
}
if($req=="verifyUrl")
{
    $url = $_POST['URL'];
    $flag = $_POST['FLAG'];
    $result =  $bookevent->verifyUrl($url,$flag);
    echo $result;
}
if($req=="finalSelectData")     // created by TAHA for handling SELECT Requests
{
    $ven_id = $_POST['venue_id'];
    $cid = $_POST['cate_id'];
    $result =  $bookevent->finalSelectionForm($ven_id,$cid);
    echo $result;
}
?>