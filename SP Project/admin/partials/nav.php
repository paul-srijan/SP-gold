<?php 

include('../config/constants.php');
include('login-check.php');

?>



<html>

    <head>
        <title>Admin page</title>
        <link rel="icon" href="../images/SP.png">

        <link rel="stylesheet" href="../css/admin.css">

        <!-- google fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans&display=swap" rel="stylesheet">
        
        <!-- fontawesome -->
        <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    </head>

  <body>



      <!-- navigation section -->
      
      <div class="nav">
      <div class="wrapper text-center">  
            <div >
                <a href= "index.php"class="navbar-brand">
                    <h1>SP</h1>
                  </a>
            </div> 
            <br><br>       
          <ul>
              <li><a href="mag-admin.php">Admin Manager</a></li>
              <li><a href="mag-category.php">Category</a></li>
              <li><a href="mag-products.php">Product</a></li>
              <li><a href="mag-order.php">Order</a></li>
              <li><a href="summary.php">SneakPeek</a></li>
              <li><a href="logout.php">Logout</a></li>
          </ul>
          </div>

      </div>
      <!-- navigation section -->