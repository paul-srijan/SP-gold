<!-- 1.SP product page -->
<!-- 2.navigation bar and footer from partials frontend folder-->
<!-- 3.Get all product data from tbl_product-->


<?php include('partials-frontend/nav.php')?>

<body>


    <!-- start banner section starts here -->
        <section>
            <div class="container">
                <img src="images/banner2.jpg" height="200px" width="1348px" alt="end-banner-img">
            </div>
        </section>
    <!-- start banner section ends here -->

    
    <!-- hot products starts here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Trending Products</h2>

            <?php

                //display product data from db
                $sql = "SELECT * FROM tbl_product";
                //exc query
                $res = mysqli_query($conn, $sql);
                //count rows
                $count = mysqli_num_rows($res);
                //check product avail or not
                if($count>0)
                {
                    // if product avail get product else no product added
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //get value
                        $id = $row['pro_id'];
                        $title = $row['pro_title'];
                        $descrpt = $row['pro_discrpt'];
                        $price =  $row['pro_price'];
                        $image_name = $row['pro_img'];

                        ?>

                            <div class="food-menu-box">
                                <div class="food-menu-img">

                                    <?php 
                                        //check img avail or no img added
                                        if($image_name=="")
                                        {
                                            //img no avail
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
                else
                {
                    //not avail
                    echo "No Product Added";
                }

            ?>

            <div class="clearfix"></div>

        </div>

    </section>

<!-- hot products ends here -->

<?php include('partials-frontend/footer.php')?>