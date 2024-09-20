<!-- 1.edit product pg of action button in mag-product pg-->
<!-- 2.redirects to this pg using id -->
<!-- 3.Gets id and displays its value -->
<!-- 4.form to get new values and update that value in db-->
<!-- 5.Checks for img availability -->


<?php include('partials/nav.php')?>

<?php

ob_start();

    //check id set or not
    if(isset($_GET['pro_id']))
    {
        //get data
        $id = $_GET['pro_id'];
        //sql query
        $sql2 = " SELECT * FROM tbl_product WHERE pro_id=$id";
        //exc query
        $res2 = mysqli_query($conn, $sql2);
        //get value
        $row2 = mysqli_fetch_assoc($res2);
        //individual value or product
        $title = $row2['pro_title'];
        $descrpt = $row2['pro_discrpt'];
        $price = $row2['pro_price'];
        $current_img = $row2['pro_img'];
        $current_category = $row2['category_id'];
        $featured = $row2['pro_featured'];
    }
    else
    {
        //redirect 
        header('location:'.SITEURL.'admin/mag-products.php');
    }


?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Products</h1>
        <br><br>

        <form action="" method="POST"enctype="multipart/form-data">

        <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
            </tr>
            <tr>
                <td>Description:</td>
                <td><textarea name="description" cols="50" rows="5" > <?php echo $descrpt; ?></textarea></td>
            </tr>
            <tr>
                <td>Price:</td>
                <td><input type="number" name="price" value="<?php echo $price; ?>" ></td>
            </tr>
            <tr>
                <td>Current Image:</td>
                <td>
                    <?php
                        //check img avail or no
                        if($current_img =="")
                        {
                            //img not avail
                            echo "No Image Added";
                        }
                        else
                        {
                            //img avail
                            ?>
                            <img src="<?php echo SITEURL; ?>images/product/<?php echo $current_img; ?>" width="200px">
                            <?php
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td>Select New Image:</td>
                <td><input type="file" name="image"></td>
            </tr>
            <tr>
                <td>Caterogy:</td>
                <td><select name="category">
                    <?php
                        //to get data
                        $sql = "SELECT * FROM tbl_category";
                        //to exc query
                        $res = mysqli_query($conn, $sql);
                        //count rows
                        $count = mysqli_num_rows($res);
                        //check category avail or not
                        if($count>0)
                        {
                            //data available
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $category_title = $row['cat_title'];
                                $category_id = $row['cat_id'];
                               
                                //echo selected because dropdown option
                                ?>
                                <option <?php if($current_category==$category_id) {echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                <?php
                            }

                        }
                        else
                        {
                            //data not available
                            echo "<option value='0'>Category not Available</option>";
                        }

                    ?>
                   
                </select>
                </td>
            </tr>
            <tr>
                <td>Featured:</td>
                <td>
                <input <?php if($featured=="Yes") {echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
                <input <?php if($featured=="No") {echo "checked";}  ?> type="radio" name="featured" value="No">No
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="current_img" value="<?php echo $current_img; ?>">

                    <input type="submit" name="submit" value="Update Product" class="btn-sec">
                </td>
            </tr>
        </table>

        </form>

        <?php 
            if(isset($_POST['submit']))
            {
                //1. get data
                $id = $_POST['id'];
                $title = $_POST['title'];
                $descrpt = $_POST['description'];
                $price = $_POST['price'];
                $current_img = $_POST['current_img'];
                $category = $_POST['category'];
                $featured = $_POST['featured'];

                //2.upload if selected

                //check img upload clicked or not
                if(isset($_FILES['image']['name']))
                {
                    //upload clicked
                    $image_name = $_FILES['image']['name']; //new image name

                    //check file avail or not
                    if($image_name!="")
                    {
                        //img avail
                        //rename img
                        $ext = end(explode('.', $image_name));
                        $image_name = "product_name".rand(0000, 9999).'.'.$ext;
                        //get src and destinaation
                        $src_path = $_FILES['image']['tmp_name'];
                        $dest_path = "../images/product/".$image_name;
                        //upload image
                        $upload = move_uploaded_file($src_path, $dest_path);
                        //check img uploaded or not
                        if($upload==false)
                        {
                            //failed to upload
                            $_SESSION['upload'] = "Fialed to upload Image"; //display msg
                            header('location:'.SITEURL.'admin/mag-products.php');  //redirect to manage pg
                            die();  //end process
                        }

                        //3. remove img if uploaded
                        //remove current img if available
                        if($current_img!="")
                        {
                            //current image avaiable
                            //remove img
                            $remove_path = "../images/product/".$current_img;
                            $remove = unlink($remove_path);

                            //check img removed or not
                            if($remove==false)
                            {
                                //msg failed
                                $_SESSION['remove-img'] = "FAiled to remove image";
                                header('location:'.SITEURL.'admin/mag-products.php');
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
                    //current img name
                    $image_name = $current_img;
                }
                
                //4.update data in db
                $sql3 = "UPDATE tbl_product SET
                    pro_title = '$title',
                    pro_discrpt = '$descrpt',
                    pro_price = $price,
                    pro_img = '$image_name',
                    category_id = '$category',
                    pro_featured = '$featured'
                    WHERE pro_id=$id

                ";

                //exc query
                $res2 = mysqli_query($conn, $sql3);
                //check query exc or not
                if($res2==true)
                {
                    //query exc
                    $_SESSION['update'] = "Product updated Successfully";
                    header('location:'.SITEURL.'admin/mag-products.php');
                }
                else {
                    //failed to update
                    $_SESSION['update'] = "Failed to Update";
                    header('location:'.SITEURL.'admin/mag-products.php');
                }

            }            
        ?>

    </div>

</div>


<?php include('partials/footer.php')?>
