<!--1.SP admin pg -->
<!--2.navigation and footer from partials folder-->
<!--3.Welcome page to SP -->



<?php include('partials/nav.php')?>

    <!-- start banner section starts here -->
        <section>
            <div class="container">
                <img src="../images/banner3.jpg" height="300px" width="1348px" alt="end-banner-img">
            </div>
        </section>
    <!-- start banner section ends here -->

      <!-- content section -->
      <div class="main-content text-center">
          <div class="wrapper"> 
              <?php  
                 if(isset($_SESSION['login']))
                 {
                     echo $_SESSION['login'];  // display session msg
                     unset($_SESSION['login']);   //remove session
                 }
                ?>
                <br><br>
            <h2>WELCOME</h2>
            <h2>MANAGE AMARIS</h2>
          </div>
    </div>
              
      <!-- content section -->



<?php include('partials/footer.php')?>