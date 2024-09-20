<!-- 1.add product of admin pg-->
<!-- 2.from with post method -->
<!-- 3.get data from form  and rename img -->
<!-- 5.add aall data in to tbl_product -->
<!-- 6.2 session for product add and image failed-->



<?php include('partials/nav.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Products</h1>
        <br><br>
        
        <?php
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>



        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" placeholder=" Product name"></td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td><textarea name="description"  cols="50" rows="5" placeholder="Product description"></textarea></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="number" name="price"></td>
                </tr>
                <tr>
                    <td>Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category" >

                        <?php 
                            // to display category from db
                            //1. sql query
                            $sql = "SELECT * FROM tbl_category";

                            //exc query
                            $res = mysqli_query($conn, $sql);
                            
                            //counts rows
                            $count = mysqli_num_rows($res);

                            //if count > 0 have category or no category
                            if($count>0)
                            {
                                //have category
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    //get value of category
                                    $id = $row['cat_id'];
                                    $title = $row['cat_title'];

                                    ?>
                                    <option value="<?php echo $id;?>"><?php echo $title;?> </option>

                                    <?php
                                }
                            }
                            else
                            {
                                //no category
                                ?>
                                <option value="0">No category Found</option>
                                <?php
                            }
                        ?>
                          
                        </select>
                    </td>
            </tr>
            <tr>
                <td>Featured:</td>
                <td>
                    <input type="radio" name="featured" value="Yes">Yes
                    <input type="radio" name="featured" value="No">No
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Product" class="btn-sec">

            </td>
        </tr>
            </table>


        </form>


        <?php

            //check button clicked or not
            if(isset($_POST['submit']))
            {
                //add data to db
                // echo "click";

                //1.get data
                $title = $_POST['title'];
                $discript = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                //check radio button featured or no
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "No"; //default value
                }


                //2.upload img
                //select img or not, upload if selected
                if(isset($_FILES['image']['name']))
                {
                    //get data
                    $image_name = $_FILES['image']['name'];  //button clicked or not
                    //check img selected or not. upload or not
                    if($image_name!="")
                    {
                        //img selected
                        //rename the img and get extension
                        $ext = end(explode('.', $image_name));

                        //new name for image
                        $image_name = "pro_name_".rand(0000, 9999).".".$ext; 

                        //upload img
                        //get src and path
                        $src = $_FILES['image']['tmp_name'];
                        $dest = "../images/product/".$image_name;

                        //source and path is current img
                        $upload = move_uploaded_file($src, $dest);

                        //check img uploaded or no
                        if($upload==false)
                        {
                            $_SESSION['upload'] = "Failed to upload Image";  //failed to upload img
                            header('location:'.SITEURL.'admin/add-products');   //redirect msg
                            die();//stop process
                        }
                        
                         
                    }
                }
                else
                {
                    $image_name ="";  //defalu value none
                }

                //3.insert data
                //create sql query to save data
                //'' no adding for numeric value
                $sql2 = "INSERT INTO tbl_product SET
                    pro_title = '$title',
                    pro_discrpt = '$discript',
                    pro_price = $price,    
                    pro_img = '$image_name',
                    category_id = '$category',
                    pro_featured = '$featured'
                ";


                //4.redirect with msg
                $res2 = mysqli_query($conn, $sql2);
                //check data inserted or not
                if($res2 == true)
                {
                    //inserted successfully
                    $_SESSION['add'] = "Added Successfully";
                    header('location:'.SITEURL.'admin/mag-products.php');
                }
                else
                {
                    $_SESSION['add'] = "Failed to add";
                    header('location:'.SITEURL.'admin/mag-products.php');
                }
            }



        ?>

    </div>
</div>


<?php include('partials/footer.php');?>