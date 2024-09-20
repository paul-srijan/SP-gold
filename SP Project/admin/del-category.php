<!-- 1.delete page of category -->
<!-- 2.redirected page of mag-category delete button -->
<!-- 3.gets category id and image-->
<!-- 4.if both available will delete from tbl_category-->



<?php

//Incude const file
include('../config/constants.php');

//check id img value set or no
if(isset($_GET['cat_id'])AND isset($_GET['cat_img']))
{
    //get value and del
    $id = $_GET['cat_id'];
    $image_name = $_GET['cat_img'];

        //remove img
        if($image_name!='')
        {
            //img avail remove it
            $path = "../images/category/".$image_name;
            //remove img
            $remove =unlink($path);
            //Failed to remove then error msg
            if($remove==FALSE)
            {
                $_SESSION['remove'] = "Failed to remove image";  //Display msg
                header('location:'.SITEURL.'admin/mag-category.php');  //redirect to manage category
                die(); //stop the process
            }

        }

        //delete data from db
        $sql = "DELETE FROM tbl_category WHERE cat_id=$id";
        //exc query
        $res = mysqli_query($conn, $sql);
        //chek data deleted or not
        if($res==true)
        {
            $_SESSION['delete'] = "Deleted Successfully"; //display seccuss msg
            header('location:'.SITEURL.'admin/mag-category.php');  //redirect to manage admin pg
        }
        else
        {
            $_SESSION['delete'] = "Deleted Successfully"; //display seccuss msg
            header('location:'.SITEURL.'admin/mag-category.php');  //redirect to manage admin pg
        }
}
else 
{
    header('loction:'.SITEURL.'admin/mag-category.php');  //redirect to manage category
}




?>