<?php
    include '../db/conn.php';

    if(isset($_POST['containers']))
    {
        $containers=$_POST['containers'];

        $contaSql = mysqli_query($DB_CONNECT,"SELECT * FROM container_tb WHERE warehouseId='$containers' AND status='Not Full' ");
        echo '<option selected disabled>Select Container</option>';

        while($contaFet=mysqli_fetch_array($contaSql)){
            echo '<option value="'.$contaFet['container_id'].'">'.$contaFet['container_name'].'</option>';
        }

    }

?>