<?php
    include '../db/conn.php';

    if(isset($_POST['state']))
    {
        $state=$_POST['state'];

        $citySql = mysqli_query($DB_CONNECT,"SELECT * FROM cities WHERE stateId='$state' ");
        echo '<option selected disabled>Select City</option>';

        while($cityFet=mysqli_fetch_array($citySql)){
            echo '<option value="'.$cityFet['id'].'">'.$cityFet['name'].'</option>';
        }

    }

?>