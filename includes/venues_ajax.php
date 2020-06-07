<?php

require 'venues.php';

$req = $_POST['req'];


$obj = new venues;
//Getting all Images By Ven ID admin
if($req == 1){
    $id = $_POST["id"];
    echo $obj->getImagesByVenId($id);
}
//Getting Image Grid For Updation
if($req == 2){
    $id = $_POST["id"];
    echo $obj->getImageGrid($id);
}
//Deleting Images By Img ID and Also Deleting From Uploads Folder
if($req == 3){
    $id = $_POST["mid"];
    $name = $_POST["name"];
    echo $obj->deleteImageById($name, $id);
}
?>