<?php
   session_start();

if(session_destroy()){
    ?>
    <script>
        location.href='login';
    </script>
    <?php
}

?>