<?php

//include const file
include('../config/constants.php');

//1. destroy session
 session_destroy();   // unset $_SESSION['user]

//2.redirect to login in
header('location:'.SITEURL.'admin/login.php');



?>