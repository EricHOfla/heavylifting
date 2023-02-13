<?php
    include '../db/conn.php';

    if(isset($_POST['country']))
    {
        $country=$_POST['country'];

        $stateSql = mysqli_query($DB_CONNECT,"SELECT * FROM states WHERE countryId='$country' ");
        echo '<option selected disabled>Select State</option>';

        while($stateFet=mysqli_fetch_array($stateSql)){
            echo '<option value="'.$stateFet['id'].'">'.$stateFet['name'].'</option>';
        }

    }

?>