<!-- 1.delete page of product -->
<!-- 2.redirected page of mag-product delete button -->
<!-- 3.gets product id and image-->
<!-- 4.if both available will delete from tbl_product -->


<?php

//Incude const file
include('../config/constants.php');

//check id img value set or no
if(isset($_GET['pro_id']) AND isset($_GET['pro_img']))
{
    //get id and img name
    $id = $_GET['pro_id'];
    $image_name = $_GET['pro_img'];

    //remove img avail
    //check img avail or not
    if($image_name !='')
    {
        //get img path
        $path = "../images/product/".$image_name;
        //remove img 
        $remove = unlink($path);
        //check img removed or not
        if($remove==false)
        {
            $_SESSION['upload'] = "Failed to remove image";  //display msg
            header('location:'.SITEURL.'admin/mag-products.php');   //redirect pg
            die();  //end process
        }
    }

    //delete data from db
    $sql = "DELETE FROM tbl_product WHERE pro_id=$id";
    //exc query
    $res = mysqli_query($conn, $sql);

    //check query exc or not
    if($res==true)
    {
        //delete product
        $_SESSION['delete'] = "Deleted Successfully";
        header('location:'.SITEURL.'admin/mag-products.php');    
    }
    else
    {
        //failed to delete 
        $_SESSION['delete'] = "Failed to Delete";
        header('location:'.SITEURL.'admin/mag-products.php');
    }

    //redirect to manage pg with msg
   
}
else
{
    //redirect 
    $_SESSION['AuthAcc'] = "Failed to delete (Unauthorized Access)";
    header('location:'.SITEURL.'admin/mag-products.php');
}

?>