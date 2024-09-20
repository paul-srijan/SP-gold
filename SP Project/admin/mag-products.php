<!-- 1.SP product manage page -->
<!-- 2.navigation and footer from partials folder-->
<!-- 3.Created html table -->
<!-- 4.fetch all data of admin from database and display it-->
<!-- 5.add action button to add-product pg -->
<!-- 6.have 2 action button leading to 2 diff pg with its id value-->
<!-- 7.Has session msg to notify all actions performed-->




<?php include('partials/nav.php')?>

<div class= main-content>
    <div class= wrapper>
    <a href="<?php echo SITEURL; ?>admin/add-product.php" class="btn-primary">ADD NEW </a>
    <br>
         <h2>SP Product Manage</h2>
         <br>

            <?php
                if(isset($_SESSION['add'])) //check session set 
                {
                    echo $_SESSION['add']; // display session msg if set
                    unset($_SESSION['add']); //remove session msg
                }
                if(isset($_SESSION['delete'])) //check session set 
                {
                    echo $_SESSION['delete']; // display session msg if set
                    unset($_SESSION['delete']); //remove session msg
                }
                if(isset($_SESSION['upload'])) //check session set 
                {
                    echo $_SESSION['upload']; // display session msg if set
                    unset($_SESSION['upload']); //remove session msg
                }
                if(isset($_SESSION['AuthAcc'])) //check session set 
                {
                    echo $_SESSION['AuthAcc']; // display session msg if set
                    unset($_SESSION['AuthAcc']); //remove session msg
                }
                if(isset($_SESSION['update'])) //check session set 
                {
                    echo $_SESSION['update']; // display session msg if set
                    unset($_SESSION['update']); //remove session msg
                }
            ?>
                <br><br><br>
              <table class="tbl-full">
                  <tr>
                      <th>No.</th>
                      <th>Title</th>
                      <th>Price</th>
                      <th>Images</th>
                      <th>Featured</th>
                      <th>Conducts</th>
                  </tr>

                    <?php
                    //create sql query to get data
                    $sql = "SELECT * FROM tbl_product";

                    //exc query
                    $res = mysqli_query($conn, $sql);

                    //count rows to check data avail ot not
                    $count = mysqli_num_rows($res);

                    //serial no
                    $sr=1;
                    if($count>0)
                    {
                        //data added in db
                        //get data and display data 
                        while($row=mysqli_fetch_assoc($res))
                        {
                            //get value
                            $id = $row['pro_id'];
                            $title = $row['pro_title'];
                            $price = $row['pro_price'];
                            $image_name = $row['pro_img'];
                            $featured = $row ['pro_featured'];

                            ?>

                                <tr>
                                <td><?php echo $sr++; ?> </td>
                                <td><?php echo $title; ?></td>
                                <td><?php echo $price; ?></td>
                                <td>
                                    <?php
                                        //check img or not
                                        if($image_name=="")
                                        {
                                            //no image. diplay msg
                                            echo "No image added";
                                        }
                                        else {
                                            //image not blank
                                            ?>
                                            <img src="<?php echo SITEURL; ?>images/product/<?php echo $image_name; ?>" width="150px">
                                            <?php
                                        }
                                    ?>
                                </td>
                                
                                <td><?php echo $featured; ?></td>
                                <td>
                                <a href="<?php echo SITEURL; ?>admin/edit-product.php?pro_id=<?php echo $id; ?>&pro_img=<?php echo $image_name; ?>" class="btn-sec">EDIT</a>
                                <a href="<?php echo SITEURL; ?>admin/del-product.php?pro_id=<?php echo $id; ?>&pro_img=<?php echo $image_name; ?>" class="btn-thi">DELETE</a>
                                </td>
                                </tr>

                            <?php

                
                        }
                    }
                    else
                    {
                        ?>
                        
                        <tr>
                            <td colspan ="6"> No Product Added.</td>
                        </tr>

                        <?php
                    }
                    ?>

                  
              </table>


          </div>
    </div>
      <!-- content section -->

    </div>
</div>







<?php include('partials/footer.php')?>