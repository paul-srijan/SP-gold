<!-- 1.edit product pg of action button in mag-product pg-->
<!-- 2.redirects to this pg using id -->
<!-- 3.Gets id and displays its value -->
<!-- 4.form to get new values and update that value in db-->
<!-- 5.Checks for img availability -->



<?php include('partials/nav.php')?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>

        <?php

        //cehck id set or not 
        if(isset($_GET['cat_id']))
        {
            // echo "get data";
            //get data
            $id = $_GET['cat_id'];
            //sql query
            $sql = "SELECT * FROM tbl_category WHERE cat_id=$id";
            //exc query
            $res = mysqli_query($conn, $sql);
            //count rows check data avail or not
            $count = mysqli_num_rows($res);
            
            if($count==1)
            {
                $row = mysqli_fetch_assoc($res);
                $title = $row['cat_title'];
                $current_img = $row['cat_img'];
            }
            else
            {
                $_SESSION['no-cat-found'] = "No Category Found";
                header("location:".SITEURL.'admin/mag-category.php');
            }
        
        }
        else 
        {
            //redirect mes
            header('location:'.SITEURL.'admin/mag-category.php');
        }


        ?>



        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                </tr>
                <tr>
                    <td>Current image: </td>
                    <td>
                        <?php 
                        if($current_img != "")
                        {
                            //Display img
                            ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_img; ?>" width="200px">
                            <?php

                        }
                        else {
                            echo "Image not added";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image: </td>
                    <td><input type="file" name="image" ></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_img" value="<?php echo $current_img; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">

                        <input type="submit" name="submit" value="Update Category" class="btn-sec">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        if(isset($_POST['submit']))
        {
            //get value
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_img = $_POST['current_img'];

            //2.Update img
            //check img selected or no
            if(isset($_FILES['image']['name']))
            {
                //get img data
                $image_name = $_FILES['image']['name'];
                //check img avail or not
                if($image_name != "")
                {
                    //img avail
                    //uplad new image
                    //auto rename image
                    //get extension    
                    $ext = end(explode('.', $image_name));

                    //rename img
                    $image_name = "pro_category_".rand(000, 999).'.'.$ext;  
                    //1.break img name 2.only takes extension 3.add random no with ext obtained
                    //eg: ringImg.png (".png") then adds ("pro_category_783.png")
                    //Why? when adding same img exist img will replace images added so to avoid that.

                    
                    $source_path= $_FILES['image']['tmp_name'];
                    $destination_path ="../images/category/".$image_name;

                    //final upload
                    $upload = move_uploaded_file($source_path, $destination_path);

                    //check img uploaded or not. if not stop process and redirect 
                    if($upload==false)
                    {
                        //display meg
                        $_SESSION['upload'] = "Failed to upload Image";
                        //redirect to add cat pg
                        header('location:'.SITEURL.'admin/add-category.php');
                        die(); 
                    }
                    //remove current img if available
                    if($current_img!="")
                    {
                        $remove_path = "../images/category/".$current_img;
                        $remove = unlink($remove_path);

                        //check img remove or not. if nor display msg and stop process
                        if($remove==false)
                        {
                            //failed to remove img
                            $_SESSION['Failed-remove'] = "failed to remove the current image";
                            header('location:'.SITEURL.'admin/mag-category.php');
                            die();  //stop process
                        }
                    }
                    

                }
                else
                {
                    $image_name = $current_img;
                }
            }
            else 
            {
                $image_name = $current_img;
            }

            //3.update db
            $sql2 = "UPDATE tbl_category SET
                cat_title= '$title',
                cat_img= '$image_name'
                WHERE cat_id='$id'
            ";

            //exc query
            $res2 = mysqli_query($conn, $sql2);

            //4.redirect to manage pg
            if($res2==true)
            {
                //category updated
                $_SESSION['update'] = "Updated Seccessfully";   //displat msg
                header('location:'.SITEURL.'admin/mag-category.php');  //redirect to manage pg
            }
            else
            {
                //failed to update
                $_SESSION['update'] = "Failed to Updated Category";   //displat msg
                header('location:'.SITEURL.'admin/mag-category.php');  //redirect to manage pg
            }
        }

        ?>



    </div>
</div>





<?php include('partials/footer.php')?>