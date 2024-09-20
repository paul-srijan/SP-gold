<!-- 1.SP order now page -->
<!-- 2.navigation bar and footer from partials frontend folder-->
<!-- 3.Get product data from tbl_product when selected to order-->
<!-- 4.Get all value from form using post method into  tbl_order-->
<!-- 5.if form filled and data inserted into db rediredt to confirmation pg -->

<?php include('partials-frontend/nav.php')?>



    <?php 
    ob_start();
        //check product id or not
        if(isset($_GET['id']))
        {
            //get product id of clicked
            $product_id = $_GET['id'];
            //get data of id clicked from product table
            $sql = "SELECT * FROM tbl_product WHERE pro_id=$product_id";
            //exc query
            $res = mysqli_query($conn, $sql);
            //count the row
            $count = mysqli_num_rows($res);
            //check data avail or no
            if($count==1)
            {
                //data avail
                //get data from db
                $row = mysqli_fetch_assoc($res);
                $title = $row['pro_title'];
                $price = $row['pro_price'];
                $image_name = $row['pro_img'];
            }
            else {
                //data no avail redirect pg
                header('location:'.SITEURL);
            }
        }
        else
        {
            //redirect pg
            header('location:'.SITEURL);
        }
    ?>

<body>

   <!-- order pg banner section starts here -->
   <section>
            <div class="container">
                <img src="images/end-banner.jpg" height="200px" width="1348" alt="end-banner-img">
            </div>
        </section>
    <!-- order pg banner section ends here -->
    
    
    <!-- category base product Section Starts Here -->
    <section class="food-search food-menu order-bg">
        <div class="container">
            
            <h2 class="text-center text-white oder-heading">TO CONFIRM ORDER</h2>

            <form action="" method="POST" class="order" >
                <fieldset>
                    <legend ><b><h3></h3></b></legend>

                    <div class="food-menu-img">

                        <?php                         
                           //check img avail or no
                           if($image_name=='')
                           {
                               //image no avail
                               echo "Image not Added";
                           } 
                           else
                           {
                               //image avail
                               ?>
                               <img src="<?php echo SITEURL; ?>images/product/<?php echo $image_name; ?>" alt="jewellery img" class="img-responsive img-curve">
                               <?php
                           }
                        ?>

                
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="product" value="<?php echo $title; ?>">

                        <p class="food-price">Rs:<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>"> 

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>                        
                        </div>
    
                        <div class="order-label">Full Name</div>
                        <input type="text" name="full-name" placeholder="E.g. Jade" class="input-responsive" required>

                        <div class="order-label">Email</div>
                        <input type="email" name="email" placeholder="E.g. hi@jade.com" class="input-responsive" required>

                        <div class="order-label">Phone Number</div>
                        <input type="tel" name="contact" placeholder="E.g. 3454xxxxxx" class="input-responsive" required>

                        <div class="order-label">Address</div>
                        <textarea name="address" rows="6" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                        <input type="submit" name="submit" value="Place Order" class="btn-form btn-primary">

                </fieldset>
                
        
            </form>

            <?php
            //check of order button clicked or no 
            if(isset($_POST['submit']))
            {
                //get data
                $product = $_POST['product'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                $total = $price * $qty;
                $order_date = date("Y-m-d h:i:sa");
                $cus_name = $_POST['full-name'];
                $cus_mail = $_POST['email'];
                $cus_conct = $_POST['contact'];
                $cus_add = $_POST['address'];

                //get data in db
                //create query and inserting data into it
                $sql2 = "INSERT INTO tbl_order SET
                    ord_pro = '$product',
                    ord_price = $price,
                    ord_quat = $qty,
                    ord_tol = $total,
                    ord_date = '$order_date',
                    customer_name = '$cus_name',
                    customer_conct = '$cus_conct',
                    customer_email = '$cus_mail',
                    customer_add = '$cus_add'
                ";
                //echo $sql2; die();  check if button clicked or not
                //exc query
                $res2 = mysqli_query($conn, $sql2);
                //check query exc
                if($res2 == true)
                {
                    //if query exc or no
                    //echo "order placed";
                   $_SESSION['order'] = "ORDER PLACED SUCCESSFULLY.";
                   header('location:'.SITEURL.'confirm.php');
                }
                else
                {
                   // echo "order failed";
                    //failed to add
                    $_SESSION['order'] = "FAILED TO PLACED ORDER.";
                    header('location:'.SITEURL.'confirm.php');
                }
            }
            ?>
        </div>
    </section>
    <!-- category base product Section Ends Here -->

    <?php include('partials-frontend/footer.php')?>