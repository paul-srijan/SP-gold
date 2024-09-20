<!-- Summary page od SP admin -->

<?php include('partials/nav.php')?>


<!-- content section -->
<div class="main-content tex-center">
          <div class="wrapper"> 
              <h2>Sneak Peek at SP</h2>
                
                <br>

              <div class="col-4 text-center dash-bg">

                  <?php 
                      //sql query to get category
                      $sql = "SELECT * FROM tbl_category";
                      //exc query
                      $res = mysqli_query($conn, $sql);
                      //count rows
                      $count = mysqli_num_rows($res);
                  ?>

                  <h1><?php echo $count; ?></h1><br>
                  Categories
              </div>
              <div class="col-4 text-center dash-bg">
                    <?php 
                      //sql query to get product
                      $sql2 = "SELECT * FROM tbl_product";
                      //exc query
                      $res2 = mysqli_query($conn, $sql2);
                      //count rows
                      $count2 = mysqli_num_rows($res2);
                    ?>
                  <h1><?php echo $count2; ?></h1><br>
                  Product
              </div>
              <div class="col-4 text-center dash-bg">
                    <?php 
                     //sql query to get orders
                      $sql3 = "SELECT * FROM tbl_order";
                      //exc query
                      $res3 = mysqli_query($conn, $sql3);
                      //count rows
                      $count3 = mysqli_num_rows($res3);
                     ?>
                  <h1><?php echo $count3; ?></h1><br>
                  Orders
              </div>
              
              <div class="clearfix"></div>
          </div>
    </div>
      <!-- content section -->



<?php include('partials/footer.php')?>