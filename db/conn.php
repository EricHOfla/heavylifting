<?php 

    $DB_HOSTNAME = "localhost";
    $DB_USERNAME = "root";
    $DB_PASSWORD = "";
    $DB_NAME = "heavylifting_db";

    $DB_CONNECT = mysqli_connect($DB_HOSTNAME,$DB_USERNAME,$DB_PASSWORD);

    if (!$DB_CONNECT) {
        die("Failed to connect to the Database"); 
    }
    $DB_SELECT = mysqli_select_db($DB_CONNECT,$DB_NAME);

    if (!$DB_SELECT) {
        die("Failed to select Database");
    }
    // mysql_close();	 			
 
?>