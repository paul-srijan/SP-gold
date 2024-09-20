<?php

//authorization

//check login or not
if(!isset($_SESSION['user']))   //if session not set

{
    $_SESSION['nologin-msg'] = "<h3> PLEASE LOGIN </h3>";  //redirect with msg
    header('location:'.SITEURL.'admin/login.php');
}



?>