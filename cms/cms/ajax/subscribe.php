<?php include("../init.php");

if(isset($_REQUEST["subsemail"]))
{
    $createdon= date("Y-m-d H;i:s");
    $table="subscribe_me";
    $fld= "email,ceatedon";
    $vl= ":email,:createon";
    
    $email= $_REQUEST["subsemail"];
    $ex= array(":email"=>$email,":createon"=>$createdon);
    $save= save($table,$fld,$vl,$ex);
}

?>