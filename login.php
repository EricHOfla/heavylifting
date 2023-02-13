<?php
    include 'db/conn.php';
?>
<!DOCTYPE html>
<html lang="en">


<!-- login23:11-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.PNG">
    <title>Heavy Lifting Login Form!</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
    <div class="main-wrapper account-wrapper">
        <div class="account-page">
			<div class="account-center">
				<div class="account-box">
                    <?php
                        if (isset($_POST['user_login'])) {
                            $email = $_POST['email'];
                            $password = sha1($_POST['password']);
                            $last_access = date("Y-m-d H:i:s");
                            // $sqlNumRows = 0;

                            $sqlQuery = mysqli_query($DB_CONNECT,"SELECT * FROM `user_tb` WHERE `email`='$email' ");

                            // $sqlNumRows = mysql_num_rows($sqlQuery);
                            $sqlFetch = mysqli_fetch_array($sqlQuery);
                            if($email==$sqlFetch['email']){

                                if ($sqlFetch['user_status'] == 'Allowed') {

                                    if($email==$sqlFetch['email'] && $password==$sqlFetch['password'] ){

                                        mysqli_query($DB_CONNECT,"UPDATE `user_tb` SET `last_access_date`='$last_access' WHERE `email`='$email'");

                                        session_start();
                                        $_SESSION['userID'] = $sqlFetch['user_id'];

                                        ?>
                                        <script>
                                            location.href='index';
                                        </script>
                                        <?php
                                    }
                                    else{
                                        echo'<span style="color: orange;">Wrong Email, Password or You Do not have access to the system </span><br/>'.mysqli_error($DB_CONNECT);
                                    }
                                }else{
                                    echo'<span style="color: red;">Sorry, You have been restricted from accessing this system</span><br/>'.mysqli_error($DB_CONNECT);
                                }
                            }
                            else{
                            echo'<span style="color: white;">Your Email is Not Register.</span><br/>'.mysqli_error($DB_CONNECT);
                            }

                        }
                        
                        ?>
                    <form action="" method="post" class="form-signin">
						<div class="account-logo">
                            <img src="assets/img/logo-dark.png" alt="">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" autofocus="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <!-- <div class="form-group text-right">
                            <a href="forgot-password.html">Forgot your password?</a>
                        </div> -->
                        <div class="form-group text-center">
                            <button type="submit" name="user_login" class="btn btn-primary account-btn">Login</button>
                        </div>
                        
                    </form>
                </div>
			</div>
        </div>
    </div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>


<!-- login23:12-->
</html>