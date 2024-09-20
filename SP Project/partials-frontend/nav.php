<!-- Navigation bar for all pages -->



<?php (include'config/constants.php');?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <!-- website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SP</title>
    <link rel="icon" href="images/SP.png">

    <!--Google fonts  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel&family=Tenali+Ramakrishna&display=swap" rel="stylesheet">

    <!-- fontawesome -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">


</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a class="navbar-brand" href="<?php echo SITEURL; ?>">
                    <h1>SP</h1>
                  </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL;?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL;?>categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL;?>product.php">Products</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL;?>contact.php">Contact</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL;?>admin/" target="_blank">Admin</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->