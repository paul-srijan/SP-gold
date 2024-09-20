<!-- 1.SP category page -->
<!-- 2.navigation bar and footer from partials frontend folder-->
<!-- 3.Get all category data from tbl_category-->



<?php include('partials-frontend/nav.php')?>

<body>


    <!-- start banner section starts here -->
        <section>
            <div class="container">
                <img src="images/banner1.jpg" height="200px" width="1348px" alt="end-banner-img">
            </div>
        </section>
    <!-- start banner section ends here -->

    
<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore </h2>

        <?php
            //display all categories from db
            //sql query
            $sql = "SELECT * FROM tbl_category";
            //exc query
            $res = mysqli_query($conn, $sql);
            //count rows
            $count = mysqli_num_rows($res);
            //check category avail or not
            if($count>0)
            {
                //category available
                while($row=mysqli_fetch_assoc($res))
                {
                    //get value
                    $id = $row['cat_id'];
                    $title = $row['cat_title'];
                    $image_name = $row['cat_img'];

                    ?>

                        <a href="<?php echo SITEURL; ?>product-category.php?cat_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php
                                    if($image_name=="")
                                    {
                                        //img not avail
                                        echo "No Image Added";
                                    }
                                    else
                                    {
                                        //img avail
                                        ?>
                                         <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name; ?>" alt="jewellery img" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
        
                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                        </a>


                    <?php
                }

            }
            else
            {
                //no category available
                echo "No Category Added";
            }
        ?>



        <div class="clearfix"></div>
    </div>
</section>



<!-- Categories Section Ends Here -->


<?php include('partials-frontend/footer.php')?>