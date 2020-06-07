<?php

require 'users.php';

$req = $_POST['req'];

$obj = new users;
if($req == "fetch-requests"){
    $cuser="";
    $cuser = $_POST["cuser"];
    //First Parameter can Be "admin" or client-id
    // Second Parameter can be "pending" , "answered" , "all"
    echo $obj->showAllRequests($cuser, "all");   
}

if($req == "fetch-upcomming-requests"){
    $cuser="";
    $cuser = $_POST["cuser"];
    //Will try to pass client id to check if the participant is registered or not 
    echo $obj->showAllUpcommingRequests($cuser);   
}

if($req == "register-participant"){
    $bid = $_POST["bid"];
    $cid = $_POST["cid"];

    $obj->registerParticipant($bid, $cid);
}

if($req == "fetch-participants"){
    $bid = $_POST["bid"];

    echo $obj->fetchParticipants($bid);
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
if($req == "delete-notification"){

    $bid = $_POST['bid'];
    $to = $_POST['to'];

    $obj->deleteNotification($bid, $to);
}
?>