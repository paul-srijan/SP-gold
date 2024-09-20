<!-- 1.SP admin manage page -->
<!-- 2.navigation and footer from partials folder-->
<!-- 3.Created html table -->
<!-- 4.fetch all data of admin from database and display it-->
<!-- 5.add action button to add-admin pg -->
<!-- 6.have 2 action button leading to 2 diff pg with its id value-->
<!-- 7.Has session msg to notify all actions performed-->


<?php include('partials/nav.php')?>




      <!-- content section -->
      <div class="main-content">
          <div class="wrapper">
              <!-- button of add admin -->
              <a href="add-admin.php" class="btn-primary">ADD NEW</a>
              <br>
              <h2>SP Admin Manage</h2>
                <br>
                
                <?php  
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];  // display session msg
                        unset($_SESSION['add']);   //remove session
                    }
                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];  // display session msg
                        unset($_SESSION['delete']);   //remove session
                    }
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];  // display session msg
                        unset($_SESSION['update']);   //remove session
                    }
                ?>

                <br><br><br>
              <table class="tbl-full">
                  <tr>
                      <!-- <th>Sr.no</th> -->
                      <th>No.</th>
                      <th>Name</th>
                      <th>Username</th>
                      <th>Conducts</th>
                  </tr>


                
                 <?php
                    // get query from table
                    $sql = "SELECT * FROM tbl_admin";
                    //execute query
                    $res = mysqli_query($conn, $sql);
                    //srno var
                    $sr=1;
                    // check query executed or not
                    if($res==TRUE)
                    {
                        //Ccounts rows
                        $count = mysqli_num_rows($res); // get all  rows of db
                        // check num of rows
                        if($count>0)
                        {
                            // data in db
                            while($rows=mysqli_fetch_assoc($res))
                            {
                                // using while to get data
                                // wile run as long as data

                                //individual data
                                $id=$rows['admin_id'];
                                $name=$rows['admin_name'];
                                $username=$rows['admin_username'];

                      
                                //displat value
                                ?>

                                     <tr>
                                        <td><?php echo $sr++; ?>.</td>
                                        <td><?php echo $name; ?></td>
                                        <td><?php echo $username; ?></td>
                                        <td>
                                        <a href="<?php echo SITEURL; ?>admin/edit-admin.php?admin_id=<?php echo $id; ?>" class="btn-sec">EDIT</a>
                                        <a href="<?php echo SITEURL; ?>admin/del-admin.php?admin_id=<?php echo $id; ?>" class="btn-thi">DELETE</a>
                                        </td>
                                    </tr>


                                    <?php 
                            
                            }
                        }
                        else
                        {
                            // no data in db
                        }
                    }

                  ?>

              </table>


          </div>
    </div>
      <!-- content section -->



 <?php include('partials/footer.php')?>