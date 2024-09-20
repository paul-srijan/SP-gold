<!-- 1.edit product pg of action button in mag-product pg-->
<!-- 2.redirects to this pg using id -->
<!-- 3.Gets id and displays its value -->
<!-- 4.form to get new values and update that value in db-->


<?php include('partials/nav.php')?>

<div class="main-content">
          <div class="wrapper">

          <h1>Edit Admin</h1>
          <br><br>

            <?php
            //1. get id of admin selected to edit
            $id= $_GET['admin_id'];
            
            // 2. query to del admin
            $sql= "SELECT * FROM tbl_admin WHERE admin_id=$id";
            
            //exc query
            $res= mysqli_query($conn, $sql);
            
            // query exc success
            if($res==true)
            {
                //check data available or not
                $count = mysqli_num_rows($res);
                // chech have admin data or not
                if($count == 1)
                {
                    $row=mysqli_fetch_assoc($res);

                    $name=$row['admin_name'];
                    $username=$row['admin_username'];

                }
                else
                {
                    //redirect pg
                    header("location:".SITEURL."admin/mag-admin.php");
                }
                
            }
            ?>

          <form action="" method ="POST" >
            <table class="tbl-30">
                <tr>
                    <td>Name:</td>
                    <td><input type="text" name="full_name" value ="<?php echo $name; ?>"><br><br></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" value ="<?php echo $username; ?>" ><br><br></td>
                </tr>
                <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value ="<?php echo $id?>" > 
                    <input type="submit" name="submit" value="Edit Admin" class="btn-sec"></td>
               
                </tr>

            
            </table>
 
</form>
              </div>
</div>


<?php

    // process value from form saving it in database
    // check submit clicked or not
    if(isset($_POST['submit']))
    {
        // button clicked
         //echo "button clicked";

        // 1.get data from form
        echo $id = $_POST['id'];
        echo $name = $_POST['full_name'];
        echo $username = $_POST['username'];
         

        // query to update data into db
        $sql = "UPDATE tbl_admin SET
        admin_name = '$name',
        admin_username = '$username'
        WHERE admin_id='$id'
        ";
        
        
        //3. excuting qyery and save data in db
        $res = mysqli_query($conn, $sql);

        //4. check data updated 
        if($res==TRUE)
        {
            // create session to display msg
            $_SESSION['update'] = " Admin edited Successfully";
            // redirect manage admin page 
            header("location:".SITEURL.'admin/mag-admin.php');
        }
        else
        {
           // create session to display msg
           $_SESSION['update'] = " Failed to Edit ";
           // redirect add admin page
           header("location:".SITEURL.'admin/add-admin.php');
        }
    }


?>


<?php include('partials/footer.php')?>
