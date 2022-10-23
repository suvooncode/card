<?php

include("../../init.php");

if(isset($_POST["userid"]) && $_POST["userid"]!='')
{
    $userid= $_POST["userid"];

    $find = find('first','users','*','where user_id="'.$userid.'" ',array());
    
    echo json_encode(array('name'=>$find['name'],'email'=>$find['email']));

}

?>