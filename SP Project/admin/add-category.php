<!-- 1.add category of admin pg-->
<!-- 2.from with post method -->
<!-- 3.if submit clicked get title and img of category -->
<!-- 4.if img added renames it  -->
<!-- 5.add in to tbl_category -->
<!-- 6.2 session for category add and image failed -->



<?php include('partials/nav.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>
        <?php
            if(isset($_SESSION['add']))  //check session set 
            {
                echo $_SESSION['add'];  // display session msg if set
                unset($_SESSION['add']);   //remove session msg
            }
            if(isset($_SESSION['upload']))  //check session set 
            {
                echo $_SESSION['upload'];  // display session msg if set
                unset($_SESSION['upload']);   //remove session msg
            }
            
            ?>
            <br>
        <!-- add category start -->
            
            <!-- enctype will allow to add image -->
         <form action="" method="POST" enctype="multipart/form-data">  
             <table class="tbl-30">
                 <tr>
                     <td>Title:</td>
                     <td><input type="text" name="title" placeholder="Category name"></td>
                 </tr><br>
                 <tr>
                     <td>Select Image:</td>
                     <td> <input type="file" name="image"></td>
                 </tr>
                 <tr>
                     <td colspan="2">
                        <input type="submit" name="submit" value="Add category" class="btn-sec">
                    </td>
                </tr>
             </table>
         </form>


        <!-- add category end-->
        
    </div>
</div>





<?php include('partials/footer.php');?>

<?php
 //check button clicked or not
 if(isset($_POST['submit']))
 {
     //1.get value of title
      $title = $_POST['title'];

    // print_r($_FILES['image']); //echo doesn't shows array
    //   die();                     //break code here
    
    if(isset($_FILES['image']['name']))
    {
        //upload image
        //to upload, need image name and source path and destination path
        $image_name = $_FILES ['image']['name'];

        if($image_name != "")
        {

        //auto rename image
        //get extension    
        $ext = end(explode('.', $image_name));

        //rename img
        $image_name = "pro_category_".rand(000, 999).'.'.$ext;  
        //1.break img name 2.only takes extension 3.add random no with ext obtained
        //eg: ringImg.png (".png") then adds ("pro_category_783.png")
        //Why? when adding same img exist img will replace images added so to avoid that.

        
        $source_path= $_FILES['image']['tmp_name'];
        $destination_path ="../images/category/".$image_name;

        //final upload
        $upload = move_uploaded_file($source_path, $destination_path);

        //check img uploaded or not. if not stop process and redirect 
        if($upload==false)
        {
            //display meg
            $_SESSION['upload'] = "Failed to upload Image";
            //redirect to add cat pg
            header('location:'.SITEURL.'admin/add-category.php');
            die(); 
        }
    }
    }
    else
    {
        //dont upload image set value blank
        $image_name="";
    }




      //2.add data into db
      $sql = " INSERT INTO tbl_category SET
      cat_title= '$title',
      cat_img= '$image_name'
      ";

      //3.exc query
      $res = mysqli_query($conn, $sql);

      //4.check query exc or no
      if($res==true)
      {
        $_SESSION['add'] = "added seccessfully";  // exc and add success
        header('location:'.SITEURL.'admin/mag-category.php'); //display msg
      }
      else
      {
        $_SESSION['add'] = "add Failed";  // exc and add success
        header('location:'.SITEURL.'admin/add-category.php'); //display msg
      }
      
 }

?>