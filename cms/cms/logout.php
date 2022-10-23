<?php include("init.php");
    
    $link = "index";

    foreach($_SESSION as $key=>$val)
    {
        if(isset($_SESSION[$key]))
        {
            echo $_SESSION[$key]."<br>";
            unset($_SESSION[$key]);
        }
    }
    session_destroy();

    redirectfn("$link");
?>

