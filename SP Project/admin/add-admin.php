<!-- 1.add admin of admin pg-->
<!-- 2.from with post method -->
<!-- 3.if submit ckicled get data from form -->
<!-- 4.insert into tbl_admin if sucessfully inserted has session -->



<?php include('partials/nav.php')?>

<div class="main-content">
          <div class="wrapper">

          <h1>Add Admin</h1>
          <br><br>

            <?php
            if(isset($_SESSION['add']))  //check session set 
            {
                echo $_SESSION['add'];  // display session msg if set
                unset($_SESSION['add']);   //remove session msg
            }
            ?>

          <form action="" method ="POST" >
            <table class="tbl-30">
                <tr>
                    <td>Name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter Name"><br><br></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" placeholder="Enter Userame"><br><br></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Enter Password"><br><br><br></td>
                </tr>
                <tr>
                    <td colspan="2">
                    <input type="submit" name="submit" value="Add Admin" class="btn-sec">
                </tr>
            </table>
          </form>
          </div> 
</div>




<?php include('partials/footer.php')?>


<?php

    // process value from form saving it in database
    // check submit clicked or not
    if(isset($_POST['submit']))
    {
        // button clicked
        // echo "button clicked";

        // 1.get data from form
         $name = $_POST['full_name'];
         $username = $_POST['username'];
         $password = md5($_POST['password']); // enycript with md5

        //  2.sql query to set data into db
        $sql = "INSERT INTO tbl_admin SET
        admin_name='$name',
        admin_username='$username',
        admin_pwd='$password'
        ";
        
        
        //3. excuting qyery and save data in db
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //4. check data insterted 
        if($res==TRUE)
        {
            // inserted
            //echo "inserted";
            // create session to display msg
            $_SESSION['add'] = " Admin Add Successfully";
            // redirect manage admin page 
            header("location:".SITEURL.'admin/mag-admin.php');
        }
        else
        {
           // failed to insert
           //echo "failed";
           // create session to display msg
           $_SESSION['add'] = " Failed to Add ";
           // redirect add admin page
           header("location:".SITEURL.'admin/add-admin.php');
        }
    }


?>
