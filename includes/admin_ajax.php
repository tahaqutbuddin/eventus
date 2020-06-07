<?php

require 'admin.php';

$req = $_POST['req'];


$obj = new admin;

if($req == "fetch-requests"){
    $cuser="";
    $cuser = $_POST["cuser"];
    //First Parameter can Be "admin" or client-id
    // Second Parameter can be "pending" , "answered" , "all"
    echo $obj->showAllRequests($cuser, "all");   
}

if($req == "accept-request"){
    $bid = $_POST["bid"];
    $obj->acceptRequest($bid);

}

if($req == "update-request"){

    $bid = $_POST["bid"];
    $name = $_POST["name"];
    $desc = $_POST["desc"];
    $cat = $_POST["cat"];
    $cid = $_POST["cid"];
    $date = $_POST["date"];
    $price = $_POST["price"];
    $promotion = $_POST["promotion"];
    $music = $_POST["music"];
    $venue = $_POST["venue"];
    $activity = $_POST["activity"];
    $status = $_POST["status"];
    $facebook = $_POST["facebook"];
    $whatsapp = $_POST["whatsapp"];
    $website = $_POST["website"];

    $obj->updateRequest($bid, $name, $desc, $cat, $cid, $date, $price, $promotion, $music, $venue, $activity, $status, $facebook, $whatsapp, $website);

}

if($req == "reject-request"){
    $bid = $_POST["bid"];
    $obj->rejectRequest($bid);
}
if($req == "delete-booking"){
    $bid="";
    $bid = $_POST["bid"];
    
    $obj->deleteBooking($bid);
   
}
if($req == "fetch-replies"){

    $bid = $_POST["bid"];
    $cid = $_POST["cid"];
    $currentUser = $_POST["cuser"];

    echo $obj->fetchRepliesById($currentUser, $bid, $cid);
}
if($req == "send-replies"){
    $message="";
    if (isset($_POST['message'])) {
    $message = $_POST['message'];
    }
    $bid = $_POST["bid"];
    $from = $_POST["from"];
    $to = $_POST["to"];
 
    if($message == !NULL){
        $obj->addReply($bid, $from, $to, $message);
    }
}
if($req == "send-email"){
    $message="";
    if (isset($_POST['message'])) {
    $message = $_POST['message'];
    }
    $cid = $_POST["cid"];
 
    if($message == !NULL){
        $obj->sendEmail($cid, $message);
    }
}
if($req == "delete-notification"){

    $bid = $_POST['bid'];
    $to = $_POST['to'];

    $obj->deleteNotification($bid, $to);
}
if($req == "delete-reply"){

    $id = $_POST['id'];

    $obj->deleteReply($id);
}

?>