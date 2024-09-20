<!-- 1.SP product page based on category selected-->
<!-- 2.navigation bar and footer from partials frontend folder-->
<!-- 3.Get all product data from tbl_product-->
<!-- 4.get cat id from product table and and display data with it-->

<?php include('partials-frontend/nav.php')?>

<?php 
    //check id passed or no
    if(isset($_GET['cat_id']))
    {
        //category id avail and get it from db
        $category_id = $_GET['cat_id'];
        $sql = "SELECT  cat_title FROM tbl_category WHERE cat_id=$category_id";
        //exc query
        $res = mysqli_query($conn, $sql);
        //get value from db
        $row = mysqli_fetch_assoc($res);
        //get title of that id
        $category_title = $row['cat_title'];

    }
    else
    {
        //category id not passed redirect pg
        header('location:'.SITEURL);
    }

?>

    <!-- category base product Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center"><?php echo $category_title; ?></h2>


            <?php   
            
            //create sql query to get product data based on category id
            $sql2 = "SELECT * FROM tbl_product WHERE category_id=$category_id";
            //exc query
            $res2 = mysqli_query($conn, $sql2);
            //count rows
            $count = mysqli_num_rows($res2);
            //check product avail or no
            if($count>0)
            {
                //if product avail get data
                while($row2=mysqli_fetch_assoc($res2))
                {
                    $id = $row2['pro_id'];
                    $title = $row2['pro_title'];
                    $price = $row2['pro_price'];
                    $descrpt = $row2['pro_discrpt'];
                    $image_name = $row2['pro_img'];

                    ?>


                        <div class="food-menu-box">
                            <div class="food-menu-img">

                                <?php   
                                
                                if($image_name=='')
                                {
                                    //img not avail
                                    echo "No Image Available";
                                }
                                else
                                {
                                    //img avail
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/product/<?php echo $image_name; ?>" alt="IMAGE" class="img-responsive img-curve">
                                    <?php
                                }
                                
                                ?>


                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">Rs:<?php echo $price; ?></p>
                                <p class="food-detail">
                                   <?php echo $descrpt; ?>
                                </p>
                                <br>

                                <a href="<?php echo SITEURL; ?>order.php?id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>


                    <?php 


                }
            }
            else{
                //pdrduct no avail
                echo "No Product available";
            }
            ?>

            <div class="clearfix"></div>            

        </div>

    </section>
    <!-- category base product Section Ends Here -->

    <?php include('partials-frontend/footer.php')?>