<?php include 'includes/head.php'; ?>

<body>
    <div class="main-wrapper">
        <?php 
            include 'includes/header.php';
            include 'includes/sidebar.php';
        ?>
              
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Add User</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <?php 
                            if (isset($_POST['add_user'])) {
                                $firstname = $_POST['firstname'];
                                $lastname = $_POST['lastname'];
                                $email = $_POST['email'];
                                $phone = $_POST['phone'];
                                $password = sha1($_POST['password']);
                                $birth_date = $_POST['birth_date'];
                                $dpt = $_POST['dpt'];
                                $gender = $_POST['gender'];
                                $position = $_POST['position'];
                                $permission = $_POST['permission'];
                                $address = $_POST['address'];
                                $status = $_POST['status'];

                                $upload_image = $_FILES['upload_image']['name'];
                                $location = 'assets/img/profile/'.basename($_FILES['upload_image']['name']);

                                if ($upload_image == null) {
                                    if ($gender == 'Male') {
                                        $img_pro = 'boy.png';
                                    }else {
                                        $img_pro = 'girl.png';
                                    }
                                    $userInsSql = mysqli_query($DB_CONNECT,"INSERT INTO `user_tb`(`firstname`, `lastname`, `email`, `phone`, `birth_date`, `gender`, `address`, `dpt_id`, `position`, `password`, `role`, `user_status`, `img`) VALUES ('$firstname','$lastname','$email','$phone','$birth_date','$gender','$address','$dpt','$position','$password','$permission','$status','$img_pro')");

                                    if ($userInsSql) {
                                        ?>
                                        <script>
                                            alert("User is succesfully Added");
                                            location.href = 'users';
                                        </script>
                                        <?php
                                    }else {
                                        echo 'Failed to Add user' .mysqli_error($DB_CONNECT);
                                    }


                                }else {
                                    $userInsSql = mysqli_query($DB_CONNECT,"INSERT INTO `user_tb`(`firstname`, `lastname`, `email`, `phone`, `birth_date`, `gender`, `address`, `dpt_id`, `position`, `password`, `role`, `user_status`, `img`) VALUES ('$firstname','$lastname','$email','$phone','$birth_date','$gender','$address','$dpt','$position','$password','$permission','$status','$upload_image')");

                                    if (move_uploaded_file($_FILES['upload_image']['tmp_name'], $location)) {
                                        ?>
                                        <script>
                                            alert("User is succesfully Added");
                                            location.href = 'users';
                                        </script>
                                        <?php
                                    }else {
                                        echo 'Failed to Add user' .mysqli_error($DB_CONNECT);
                                    }
                                }

                            }
                        ?>
                        <form method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>First Name <span class="text-danger">*</span></label>
                                        <input class="form-control" name="firstname" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Last Name <span class="text-danger">*</span></label>
                                        <input class="form-control" name="lastname" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input class="form-control" name="email" type="email">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Phone <span class="text-danger">*</span></label>
                                        <input class="form-control" name="phone" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Password (Default Pass: User123)</label>
                                        <input class="form-control" name="password" value="User123" readonly type="password">
                                    </div>
                                </div>
                                
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Date of Birth</label>
                                        <div class="cal-icon">
                                            <input type="text" name="birth_date" class="form-control datetimepicker">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Department</label>
                                        <select class="form-control select" name="dpt">
                                            <?php 
                                                $dptque = mysqli_query($DB_CONNECT,"SELECT * FROM dpt_tb");
                                                while ($dptFetch = mysqli_fetch_array($dptque)) {
                                                    echo '<option value="'.$dptFetch['dpt_id'].'">'.$dptFetch['dpt_name'].'</option>';
                                                }
                                            ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
									<div class="form-group gender-select">
										<label class="gen-label">Gender:</label>
										<div class="form-check-inline">
											<label class="form-check-label">
												<input type="radio" name="gender" value="Male" class="form-check-input">Male
											</label>
										</div>
										<div class="form-check-inline">
											<label class="form-check-label">
												<input type="radio" name="gender" value="Female" class="form-check-input">Female
											</label>
										</div>
									</div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Position <span class="text-danger">*</span></label>
                                        <input class="form-control" name="position" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Permission</label>
                                        <select class="form-control select" name="permission">
                                            <option>Manager</option>
                                            <option>Sub_Manager</option>
                                            <option>Agent</option>
                                        </select>
                                    </div>
                                </div>
								<div class="col-sm-12">
									<div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<label>Address</label>
												<input type="text" name="address" class="form-control ">
											</div>
										</div>
										
									</div>
								</div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>System Access Status</label>
                                        <select class="form-control select" name="status">
                                            <option>Allowed</option>
                                            <option>Ristricted</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
									<div class="form-group">
										<label>Profile Image (optional)</label>
										<div class="profile-upload">
											<div class="upload-img">
												<img alt="" src="assets/img/user.jpg">
											</div>
											<div class="upload-input">
												<input type="file" name="upload_image" class="form-control">
											</div>
										</div>
									</div>
                                </div>
                            </div>
							
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn" type="submit" name="add_user">Add User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php include 'includes/notification.php'; ?>
        </div>


<?php include 'includes/footer.php'; ?>