<!-- 1.Amaris order manage page -->
<!-- 2.navigation and footer from partials folder-->
<!-- html table -->
<!-- Fetch all data from tbl_order and display them is descending order -->


<?php include('partials/nav.php')?>

<!-- start banner section starts here -->
        <section>
            <div class="container">
                <img src="../images/banner2.jpg" height="200px" width="1348px" alt="end-banner-img">
            </div>
        </section>
    <!-- start banner section ends here -->

<div class= main-content>
    <div class= wrapper>
         <h2>Orders Till Now</h3>
             <br><br>
              <table class="tbl-full">
                  <tr>
                      <th>No.</th>
                      <th>Product</th>
                      <th>Price</th>
                      <th>Qty</th>
                      <th>Total</th>
                      <th>Date</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Ph.no</th>
                      <th>Address</th>
                      <!-- <th>Actions</th> -->
                  </tr>

                    <?php 
                    //get data
                    $sql = "SELECT * FROM tbl_order ORDER BY ord_id DESC"; //get data in descending format
                    //exc query
                    $res = mysqli_query($conn, $sql);
                    //count rows
                    $count = mysqli_num_rows($res);
                    //srno var
                    $sr=1;
                    //check daat ther or no
                    if($count>0)
                    {
                        //order avail
                        while($row =mysqli_fetch_assoc($res))
                        {
                            //get data
                            $id = $row['ord_id'];
                            $product = $row['ord_pro'];
                            $price = $row['ord_price'];
                            $qty = $row['ord_quat'];
                            $total = $row['ord_tol'];
                            $order_date = $row['ord_date'];
                            $cus_name = $row['customer_name'];
                            $cus_email = $row['customer_email'];
                            $cus_conct = $row['customer_conct'];
                            $cus_add = $row['customer_add'];
                            
                            ?>
                                <tr>
                                    <td><?php echo $sr++; ?></td>
                                    <td><?php echo $product; ?></td>
                                    <td><?php echo $price; ?></td>
                                    <td><?php echo $qty; ?></td>
                                    <td><?php echo $total; ?></td>
                                    <td><?php echo $order_date; ?></td>
                                    <td><?php echo $cus_name; ?></td>
                                    <td><?php echo $cus_email; ?></td>
                                    <td><?php echo $cus_conct; ?></td>
                                    <td><?php echo $cus_add; ?></td>

                                    <!-- <td>
                                    <a href=" #" class="btn-sec">edit order</a>
                                    </td> -->
                                </tr>
                            <?php


                        }

                    }
                    else{
                        //no order avail
                        echo "No Orders Available";
                    }
                    ?>

              </table>


          </div>
    </div>
      <!-- content section -->

    </div>
</div>


<?php include('partials/footer.php')?>