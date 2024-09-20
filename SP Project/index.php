<!-- 1.SP index page or home page -->
<!-- 2.navigation and footer from partials frontend folder-->
<!-- 3.Banner section, categories section, hot product section,end banner section, social section -->
<!-- 4.get category data from tbl_category with only 3 with limit -->
<!-- 5.get product featured data from tbl_product with 2 limit -->




<?php include('partials-frontend/nav.php')?>

    <!--Main Banner-->
    <div id="carouselSlides" class="carousel slide" data-ride="carousel" data-interval="3000">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="images/main1.jpg" height="800" width="1348" class="d-block w-100" alt="bag_img">
          </div>  
        </div>
      </div>

    </div>
  </section>
   <!--Main Banner-->
    
    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Products</h2>

            <?php

            //create sql query to display category from category db
            $sql = "SELECT * FROM tbl_category LIMIT 3";
            //exc query
            $res = mysqli_query($conn, $sql);
            //count rows
            $count = mysqli_num_rows($res);
            if($count>0)
            {
                //check if category are available
                while($row=mysqli_fetch_assoc($res))
                {
                    //get values
                    $id= $row['cat_id'];
                    $title = $row['cat_title'];
                    $image_name = $row['cat_img'];
                    
                    //get image with the id of category 

                    ?>
                        
                        <a href="<?php echo SITEURL; ?>product-category.php?cat_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">

                                <?php 
                                    //check img avail or not
                                    if($image_name=="")
                                    {
                                        echo "Image Not Available";  //display msg if not
                                    }
                                    else
                                    {
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name?>" alt="Pizza" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>

                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                        </a>

                    <?php
                }
            }
            else {
                //category nto available
                echo "No Category Updated";
            }

            ?>


            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <!-- mid banner section starts here -->
    <section>
            <div class="container">
                <img src="images/main2.jpg" alt="end-banner-img">
            </div>
        </section>
    <!-- mid banner section ends here -->


    <!-- hot products Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Hot Products</h2>


            <?php
            //getting product data from db
            //sql query
            $sql2 = "SELECT * FROM tbl_product WHERE pro_featured='Yes' LIMIT 2";
            //exc query
            $res2 = mysqli_query($conn, $sql2);
            //count rows
            $count2 = mysqli_num_rows($res2);
            //check product avail or no
            if($count2>0)
            {
                //if product avail
                while($row=mysqli_fetch_assoc($res2))
                {
                    //get value
                    $id = $row['pro_id'];
                    $title = $row['pro_title'];
                    $price = $row['pro_price'];
                    $descrpt = $row['pro_discrpt'];
                    $image_name = $row['pro_img'];

                    ?>

                        <div class="food-menu-box">
                                <div class="food-menu-img">

                                <?php 

                                //check img avail or no
                                if($image_name=="")
                                {
                                    //img not avail
                                    echo "No Image Added";
                                }
                                else
                                {
                                    //img avail
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/product/<?php echo $image_name; ?>" alt="jewellery img" class="img-responsive img-curve">
                                    <?php
                                }

                                ?>
                                    
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $title ;?></h4>
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
            else
            {
                //no product avail
                echo "No Product Added";
            }
            ?>


            <div class="clearfix"></div>

            

        </div>
        <br>
        <p class="text-center">
            <a href="<?php echo SITEURL; ?>product.php"><b>See All Products</b></a>
        </p>
    </section>
    <!-- hot products Section Ends Here -->

    <!-- end banner section starts here -->
        <section>
            <div class="container">
                <img src="images/end-banner1.jpg" height="200px" width="1348px" alt="end-banner-img">
            </div>
        </section>
    <!-- end banner section ends here -->





    <?php include('partials-frontend/footer.php')?>

    