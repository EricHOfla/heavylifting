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
                        <a class="btn btn-danger" href="warehouse">Back</a><h4 class="page-title">Add Warehouse</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <?php 
                            if (isset($_POST['add_warehouse'])) {
                                $wrh_id = 'WRH'.rand(1000, 999999);
                                $user_id = $userFet['user_id'];
                                $wrh_name = $_POST['wrh_name'];
                                $manager_name = $_POST['manager_name'];
                                $manager_email = $_POST['manager_email'];
                                $address = $_POST['address'];
                                $country = $_POST['country'];
                                $state = $_POST['state'];
                                $city = $_POST['city'];
                                $status = $_POST['status'];

                                $wrhinsQuery = mysqli_query($DB_CONNECT,"INSERT INTO `warehouse_tb`(`warehouseId`,`user_id`, `warehouse_name`, `manager_name`, `manager_email`, `countryId`, `stateId`, `cityId`, `address`, `status`) VALUES ('$wrh_id','$user_id','$wrh_name','$manager_name','$manager_email','$country','$state','$city','$address','$status')");

                                if ($wrhinsQuery) {
                                    ?>
                                    <script>
                                        alert("Warehouse is succesfully Added");
                                        
                                    </script>
                                    <?php
                                    echo "<meta http-equiv='refresh' content='0'>";
                                }else {
                                    echo 'Failed to Add Warehouse' .mysqli_error($DB_CONNECT);
                                }
                            }
                        ?>
                        <form method="post" action="">
                            <div class="row">
                                
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Warehouse Name</label>
                                        <input class="form-control" name="wrh_name" type="text" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Manager Names <span class="text-danger">*</span></label>
                                        <input class="form-control" name="manager_name" type="text" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Manager Email <span class="text-danger">*</span></label>
                                        <input class="form-control" name="manager_email" type="email" required>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Street Address</label>
                                        <input type="text" name="address" class="form-control " required>
                                    </div>
                                </div>
                                
								<div class="col-sm-12">
									<div class="row">
										
										<div class="col-sm-6 col-md-6 col-lg-4">
											<div class="form-group">
												<label>Country</label>
												<select class="form-control select" name="country" id="country_name" required>
													<option selected disabled>Select Country</option>
													<?php 
                                                        $countrySql = mysqli_query($DB_CONNECT,"SELECT * FROM countries");
                                                        while ($countryFet = mysqli_fetch_array($countrySql)) {
                                                            echo '<option value="'.$countryFet['id'].'">'.$countryFet['name'].'</option>';
                                                        }
                                                    ?>
												</select>
											</div>
										</div>
										
										<div class="col-sm-6 col-md-6 col-lg-4">
											<div class="form-group">
												<label>State/Province</label>
												<select class="form-control select" name="state" id="state" required>
												</select>
											</div>
										</div>
                                        <div class="col-sm-6 col-md-6 col-lg-4">
											<div class="form-group">
												<label>City</label>
												<select class="form-control select" name="city" id="city" required>
												</select>
											</div>
										</div>
										
									</div>
								</div>
                            </div>
                            <div class="form-group">
                                <label class="display-block">Status</label>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="status" id="patient_active" value="Active" checked>
									<label class="form-check-label" for="patient_active">
									Active
									</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="status" id="patient_inactive" value="Inactive">
									<label class="form-check-label" for="patient_inactive">
									Inactive
									</label>
								</div>
                            </div>
                            <div class="m-t-20 text-center">
                                <button type="submit" name="add_warehouse" class="btn btn-primary submit-btn">Add Warehouse</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php include 'includes/notification.php'; ?>
        </div>


<?php include 'includes/footer.php'; ?>