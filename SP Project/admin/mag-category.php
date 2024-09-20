<!-- 1.SP category manage page -->
<!-- 2.navigation and footer from partials folder-->
<!-- 3.Created html table -->
<!-- 4.fetch all data of category from databse and display it-->
<!-- 5.add action button to add-catgory pg -->
<!-- 6.have 2 action button leading to 2 diff pg with its id value-->
<!-- 7.Has session msg to notify all actions performed-->


<?php include('partials/nav.php')?>

<div class= main-content>
    <div class= wrapper>
         <!-- button of -->
         <a href="<?php echo SITEURL;?>admin/add-category.php" class="btn-primary">ADD NEW</a>
         <br>
         <h2>SP Category Manage</h2>
        <br>
         <?php
            if(isset($_SESSION['add']))  //check session set 
            {
                echo $_SESSION['add'];  // display session msg if set
                unset($_SESSION['add']);   //remove session msg
            }
            if(isset($_SESSION['remove']))  //check session set 
            {
                echo $_SESSION['remove'];  // display session msg if set
                unset($_SESSION['remove']);   //remove session msg
            }
            if(isset($_SESSION['delete']))  //check session set 
            {
                echo $_SESSION['delete'];  // display session msg if set
                unset($_SESSION['delete']);   //remove session msg
            }
            if(isset($_SESSION['no-cat-found']))  //check session set 
            {
                echo $_SESSION['no-cat-found'];  // display session msg if set
                unset($_SESSION['no-cat-found']);   //remove session msg
            }
            if(isset($_SESSION['update']))  //check session set 
            {
                echo $_SESSION['update'];  // display session msg if set
                unset($_SESSION['update']);   //remove session msg
            }
            if(isset($_SESSION['upload']))  //check session set 
            {
                echo $_SESSION['upload'];  // display session msg if set
                unset($_SESSION['upload']);   //remove session msg
            }
            if(isset($_SESSION['Failed-remove']))  //check session set 
            {
                echo $_SESSION['Failed-remove'];  // display session msg if set
                unset($_SESSION['Failed-remove']);   //remove session msg
            }
            ?>

                <br><br><br>
              <table class="tbl-full">
                  <tr>
                      <th>No.</th>
                      <th>Title</th>
                      <th>Image Name</th>
                      <th>Conducts</th>
                  </tr>
                  <?php
                    //sql query
                    $sql = "SELECT * FROM tbl_category";
                    
                    //Exc query
                    $res = mysqli_query($conn, $sql);

                    //Count rows
                    $count = mysqli_num_rows($res);    

                    //srno var
                    $sr=1;
                    
                    //check data ther or not
                    if($count>0)
                    {
                        //have data
                        //get displat data
                        while($row =mysqli_fetch_assoc($res))
                        {
                            $id = $row['cat_id'];
                            $title = $row['cat_title'];
                            $image_name = $row['cat_img'];
                             ?>

                                <tr>
                                    <td><?php echo $sr++; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td>
                                        <?php 
                                            //Check img name avail or no
                                            if($image_name!='')
                                            {
                                                //display img
                                                ?>
                                                <img src = "<?php echo SITEURL; ?>/images/category/<?php echo $image_name; ?>" width="150px" >
                                                <?php
                                            }
                                            else 
                                            {
                                               //display msg
                                               echo "Image not added";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                    <a href="<?php echo SITEURL; ?>admin/edit-category.php?cat_id=<?php echo $id; ?>" class="btn-sec">EDIT </a>
                                    <a href="<?php echo SITEURL; ?>admin/del-category.php?cat_id=<?php echo $id; ?>&cat_img=<?php echo $image_name; ?> " class="btn-thi">DELETE</a>
                                    </td>
                                </tr>

                             <?php 

                        }
                    }
                    else 
                    {
                        //have no data
                        //displaying msg in table
                        ?>
                        
                        <tr>
                            <td colspan ="3"> No Category Added.</td>
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