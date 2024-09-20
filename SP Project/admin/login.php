<!-- 1.SP login page -->
<!-- 2.login form-->
<!-- 3.Gets data using post method and check id user in admin db -->
<!-- 4.if yes redirects to admin mange dashboard of not login in page -->



<?php include('../config/constants.php');?>


<html>
    <head>
        <title>Login-SP</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body style="background-color:#C68B59;">
       <div class="login">
           <h1 class= "text-center">SP ADMIN LOGIN</h1>
            <br><br><br>

            <?php  
                 if(isset($_SESSION['login'])) //check session set 
                 {
                     echo $_SESSION['login'];  // display session msg
                     unset($_SESSION['login']);   //remove session
                 }
                 if(isset($_SESSION['nologin-msg'])) //check session set 
                 {
                     echo $_SESSION['nologin-msg']; // display session msg
                     unset($_SESSION['nologin-msg']); //remove session
                 }
            ?>


           <!-- FORM STARTS -->

            <form action="" method="POST" class=" text-center">
                
                <input type="text" name="username" placeholder="Username"><br><br>
			    <input type="password"  name="password" placeholder="Password">
			    <br><br><br>
                
                <input type="submit" name="submit" value= "Login" class= "btn">
            </form>
           
            <!-- FORM ENDS -->
        
       </div>
    </body>
</html>


<?php
// check submit click
if(isset($_POST['submit']))

{
    //1.get data from login
     $username = $_POST['username'];
     $password = md5($_POST['password']);

    //2.sql to check user exist
    $sql = "SELECT * FROM tbl_admin WHERE admin_username='$username' AND admin_pwd='$password'";

    //3. exc query
    $res = mysqli_query($conn, $sql);

    //4.count rows to check user exist
    $count = mysqli_num_rows($res);

    if($count==1)
    {
        $_SESSION['login'] = "Login Successfull";  //avail and success
        $_SESSION['user'] = $username;   //check user login or not
       header('location:'.SITEURL.'admin/');
    }
    else 
    {
        $_SESSION['login'] = "Invalid User or Password";   // no avail and fail
        header("location:".SITEURL.'admin/login.php');    //redirect mange pg
    }

}





?>