<!-- 1.delete page of admin -->
<!-- 2.redirected page of mag-admin delete button -->
<!-- 3.gets product id -->
<!-- 4.if id available will delete from tbl_admin -->


<?php

//const file 
include('../config/constants.php');

// 1. get id of admin
$id = $_GET['admin_id'];

// 2. query to del admin
$sql = "DELETE FROM tbl_admin WHERE admin_id = $id";

//exc query
$res = mysqli_query($conn, $sql);

// query exc success
//3.redirect to manage with msg
if($res==true)
{
    // echo "admin del";
    $_SESSION['delete'] = "admin deleted seccessfully"; //display msg in adminmanage
    header("location:".SITEURL.'admin/mag-admin.php');  // redirect to adminmanage
}
else{
    $_SESSION['delete'] = "failed to delete";
    header("location:".SITEURL.'admin/mag-admin.php');
}

?>
