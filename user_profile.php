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
                    <div class="col-sm-7 col-6">
                        <h4 class="page-title">My Profile</h4>
                    </div>
                </div>
                <div class="card-box profile-header">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-view">
                                <div class="profile-img-wrap">
                                    <div class="profile-img">
                                        <a href="#"><img class="avatar" src="assets/img/profile/<?php echo $userFet['img']; ?>" alt=""></a>
                                    </div>
                                    
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="profile-info-left">
                                                <h3 class="user-name m-t-0 mb-0"><?php echo $userFet['firstname'].' '.$userFet['lastname']; ?></h3>
                                                <small class="text-muted">Position: <?php echo $userFet['position']; ?></small>
                                                <div class="staff-id">User ID : USR-000<?php echo $userFet['user_id'] ?></div>
                                                <div class="staff-id">Last Access : <?php echo $userFet['last_access_date'] ?></div>
                                                <?php
                                                    if ($userFet['user_status'] == 'Allowed') {
                                                        $status = '<button class="btn btn-success">Allowed To Use System</button>';
                                                    }else {
                                                        $status = '<button class="btn btn-danger">Not Allowed To Use System</button>';
                                                    }
                                                ?>
                                                <div class="staff-msg"><?php echo $status; ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                                <li>
                                                    <span class="title">Phone:</span>
                                                    <span class="text"><a href="#"><?php echo $userFet['phone'] ?></a></span>
                                                </li>
                                                <li>
                                                    <span class="title">Email:</span>
                                                    <span class="text"><a href="#"><?php echo $userFet['email'] ?></a></span>
                                                </li>
                                                <li>
                                                    <span class="title">Birthday:</span>
                                                    <span class="text"><?php echo $userFet['birth_date'] ?></span>
                                                </li>
                                                <li>
                                                    <span class="title">Address:</span>
                                                    <span class="text"><?php echo $userFet['address'] ?></span>
                                                </li>
                                                <li>
                                                    <span class="title">Gender:</span>
                                                    <span class="text"><?php echo $userFet['gender'] ?></span>
                                                </li>
                                                <li>
                                                    <span class="title">Department:</span>
                                                    <span class="text"><?php echo $dptFet['dpt_name'] ?></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>                        
                        </div>
                    </div>
                </div>
				<div class="profile-tabs">
					<ul class="nav nav-tabs nav-tabs-bottom">
						<li class="nav-item"><a class="nav-link active" href="#about-cont" data-toggle="tab">Change Password</a></li>
						<li class="nav-item"><a class="nav-link" href="#bottom-tab2" data-toggle="tab">Profile Image</a></li>
						<li class="nav-item"><a class="nav-link" href="#bottom-tab3" data-toggle="tab">Update Basic Info</a></li>
					</ul>

					<div class="tab-content">
						<div class="tab-pane show active" id="about-cont">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            <h3 class="card-title">Update Password</h3>
                            <?php 
                                if (isset($_POST['update_pass'])) {
                                    $old_pass = sha1($_POST['old_pass']);
                                    $new_pass = sha1($_POST['new_pass']);
                                    $confirm_pass = sha1($_POST['confirm_pass']);

                                    if ($old_pass != $userFet['password']) {
                                    echo '<span class="alert alert-danger">Old Password is Incorrect!</span>';
                                    }elseif ($new_pass != $confirm_pass) {
                                    echo '<span class="alert alert-warning">Confirmed Password is Incorrect!</span>';
                                    }else {
                                    $updatePassQuery = mysqli_query($DB_CONNECT,"UPDATE `user_tb` SET `password`='$new_pass' WHERE `user_id`='$userID'");

                                    if ($updatePassQuery) {
                                        ?>
                                        <script>
                                            alert("Password is successfuly updated!")
                                        </script>
                                        <?php
                                        echo "<meta http-equiv='refresh' content='0'>";
                                    }else {
                                        echo "Failed".mysqli_error($DB_CONNECT);
                                    }
                                    }

                                }
                            ?>
                            <form method="post">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-focus">
                                            <label class="focus-label">Old Password</label>
                                            <input type="password" name="old_pass" class="form-control floating" required>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group form-focus">
                                            <label class="focus-label">New Password</label>
                                            <input type="password" name="new_pass" class="form-control floating" required>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group form-focus">
                                            <label class="focus-label">Confirm Password</label>
                                            <input type="password" name="confirm_pass" class="form-control floating" required>
                                        </div>
                                    </div>
                                    
                                </div>
                            
                                <div class="add-more">
                                    <button type="submit" name="update_pass" class="btn btn-primary"> Save New Password</button>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
						</div>
						<div class="tab-pane" id="bottom-tab2">
                            <?php
                                if (isset($_POST['updateProfile'])) {
                                    $upload_image = $_FILES['upload_image']['name'];
                                    $location = 'assets/img/profile/'.basename($_FILES['upload_image']['name']);

                                    $updateSql = mysqli_query($DB_CONNECT,"UPDATE `user_tb` SET `img`='$upload_image' WHERE `user_id`='$userID'");

                                    if (move_uploaded_file($_FILES['upload_image']['tmp_name'], $location)) {
                                        echo "<meta http-equiv='refresh' content='0'>";
                                    }else {
                                        echo "Failed To Upload File".mysqli_error($DB_CONNECT);
                                    }
                                    
                                }

                                
                            ?>
							<form method="post" enctype="multipart/form-data">
                                <div class="card-box">
                                    <h3 class="card-title">Profile Image</h3>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Upload Image</label>
                                                <div class="profile-upload">
                                                    <div class="upload-img">
                                                        <img alt="" src="assets/img/profile/<?php echo $userFet['img']; ?>">
                                                    </div>
                                                    <div class="upload-input">
                                                        <input type="file" name="upload_image" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="text-center m-t-20">
                                    <button class="btn btn-primary submit-btn" type="submit" name="updateProfile">Save Image</button>
                                </div>
                            </form>
						</div>
						<div class="tab-pane" id="bottom-tab3">
                            <?php 
                                if (isset($_POST['update_user_info'])) {
                                    $upd_firstname = $_POST['upd_firstname'];
                                    $upd_lastname = $_POST['upd_lastname'];
                                    $upd_phone = $_POST['upd_phone'];
                                    $upd_email = $_POST['upd_email'];
                                    $upd_birthdate = $_POST['upd_birthdate'];
                                    $upd_gender = $_POST['upd_gender'];
                                    $upd_address = $_POST['upd_address'];
                                    $upd_position = $_POST['upd_position'];
                                    $upd_dpt = $_POST['upd_dpt'];
                                    // $upd_status = $_POST['upd_status'];

                                    $userUpdQuery = mysqli_query($DB_CONNECT,"UPDATE `user_tb` SET `firstname`='$upd_firstname',`lastname`='$upd_lastname',`email`='$upd_email',`phone`='$upd_phone',`birth_date`='$upd_birthdate',`gender`='$upd_gender',`address`='$upd_address',`dpt_id`='$upd_dpt',`position`='$upd_position' WHERE `user_id`='$userID'");
                                    
                                    if ($userUpdQuery) {
                                        ?>
                                        <script>
                                            alert("User's Information is succesfully Updated");
                                        </script>
                                        <?php
                                        echo "<meta http-equiv='refresh' content='0'>";
                                    }else {
                                        echo 'Failed to Update Information' .mysqli_error($DB_CONNECT);
                                    }
                                }
                            ?>
							<form method="post">
                                <div class="card-box">
                                    <h3 class="card-title">Basic Informations</h3>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus">
                                                        <label class="focus-label">First Name</label>
                                                        <input type="text" name="upd_firstname" value="<?php echo $userFet['firstname']; ?>" class="form-control floating">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus">
                                                        <label class="focus-label">Last Name</label>
                                                        <input type="text" name="upd_lastname" class="form-control floating" value="<?php echo $userFet['lastname']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus">
                                                        <label class="focus-label">Phone Number</label>
                                                        <input type="text" name="upd_phone" class="form-control floating" value="<?php echo $userFet['phone']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus">
                                                        <label class="focus-label">Email</label>
                                                        <input type="email" name="upd_email" class="form-control floating" value="<?php echo $userFet['email']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus">
                                                        <label class="focus-label">Birth Date</label>
                                                        <div class="cal-icon">
                                                            <input class="form-control floating datetimepicker" type="text" name="upd_birthdate" value="<?php echo $userFet['birth_date']; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus select-focus">
                                                        <label class="focus-label">Gendar</label>
                                                        <select class="select form-control floating" name="upd_gender">
                                                            <option><?php echo $userFet['gender']; ?></option>
                                                            <option disabled></option>
                                                            <option>Male</option>
                                                            <option>Female</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus">
                                                        <label class="focus-label">Address</label>
                                                        <input type="text" name="upd_address" class="form-control floating" value="<?php echo $userFet['address']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus">
                                                        <label class="focus-label">Position</label>
                                                        <input type="text" name="upd_position" class="form-control floating" value="<?php echo $userFet['position']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus select-focus">
                                                        <label class="focus-label">Department</label>
                                                        <select class="select form-control floating" name="upd_dpt">
                                                            <option value="<?php echo $dptFet['dpt_id']; ?>"><?php echo $dptFet['dpt_name']; ?></option>
                                                            <option disabled></option>
                                                            <?php 
                                                                $dptSql = mysqli_query($DB_CONNECT,"SELECT * FROM dpt_tb");
                                                                while ($fetDpt = mysqli_fetch_array($dptSql)) {
                                                                    echo '<option value="'.$fetDpt['dpt_id'].'">'.$fetDpt['dpt_name'].'</option>';
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus">
                                                        <label class="focus-label">User Status</label>
                                                        <input type="text" class="form-control floating" value="<?php echo $userFet['user_status']; ?>" disabled>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="text-center m-t-20">
                                    <button class="btn btn-primary submit-btn" type="submit" name="update_user_info">Save Changed Info</button>
                                </div>
                            </form>
						</div>
					</div>
				</div>
            </div>
            	
            <?php include 'includes/notification.php'; ?>
        </div>


<?php include 'includes/footer.php'; ?>