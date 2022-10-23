<?php 
    include("../init.php");

    $card_id = $_POST["card_id"];
    $user_id = $_SESSION["user_id"];

    $fields = "card_id,user_id";
    $vals = ":card_id,:user_id";
    $exe = array(":card_id"=>$card_id,":user_id"=>$user_id);
    $savecards = save("user_card_details",$fields,$vals,$exe);
?>