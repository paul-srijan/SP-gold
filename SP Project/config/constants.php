<!-- Connection of database to avoild repeating it in every page -->
<!-- created constanst to not repeat values-->


<?php

    // start session
    session_start();


    // create constant nonrep values
    define('SITEURL', 'http://localhost/Amaris-project/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'amaris-project');

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());  //db connection
    $db_select = mysqli_select_db($conn, DB_NAME)  or die(mysqli_error());  //selecting db



?>