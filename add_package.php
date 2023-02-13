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
                        <a class="btn btn-danger" href="packages">Back</a><h4 class="page-title">Add Package</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <?php 
                            if (isset($_POST['add_package'])) {
                                $user_id = $userFet['user_id'];
                                $customer_id = $_POST['customer_id'];
                                $wrh_id = $_POST['wrh_id'];
                                $container_id = $_POST['container_id'];
                                $package_name = $_POST['package_name'];
                                $country_id = $_POST['country_id'];
                                $state_id = $_POST['state_id'];
                                $city_id = $_POST['city_id'];
                                // $departure_date = $_POST['departure_date'];
                                // $arrival_date = $_POST['arrival_date'];

                                $packageinsQuery = mysqli_query($DB_CONNECT,"INSERT INTO `package_tb`(`user_id`, `warehouse_id`, `container_id`, `customer_id`, `package_name`, `countryId`, `stateId`, `cityId`) VALUES ('$user_id','$wrh_id','$container_id','$customer_id','$package_name','$country_id','$state_id','$city_id')");

                                if ($packageinsQuery) {
                                    ?>
                                    <script>
                                        alert("Package is succesfully Added");
                                        location.href = 'packages';
                                    </script>
                                    <?php
                                    // echo "<meta http-equiv='refresh' content='0'>";
                                }else {
                                    echo 'Failed to Add Package' .mysqli_error($DB_CONNECT);
                                }
                            }
                        ?>
                        <form method="post" action="">
                            <div class="row">
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Customer Name</label>
                                        <select class="form-control select" name="customer_id" required>
                                            <option selected disabled>Select Customer</option>
                                            <?php 
                                                $customerSql = mysqli_query($DB_CONNECT,"SELECT * FROM customer_tb");
                                                while ($customerFet = mysqli_fetch_array($customerSql)) {
                                                    echo '<option value="'.$customerFet['customer_id'].'">'.$customerFet['firstname'].' '.$customerFet['lastname'].'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Warehouse</label>
                                        <select class="form-control select" id="warehouse" name="wrh_id" required>
                                            <option selected disabled>Select Warehouse</option>
                                            <?php 
                                                $warehouseSql = mysqli_query($DB_CONNECT,"SELECT * FROM warehouse_tb");
                                                while ($warehouseFet = mysqli_fetch_array($warehouseSql)) {
                                                    echo '<option value="'.$warehouseFet['id'].'">'.$warehouseFet['warehouse_name'].'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Container</label>
                                        <select class="form-control select" id="container" name="container_id" required></select>
                                    </div>
                                </div> 
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Package Name <span class="text-danger">*</span></label>
                                        <input class="form-control" name="package_name" type="text" required>
                                    </div>
                                </div>
                                
								<div class="col-sm-12">
									<div class="row">
										
										<div class="col-sm-6 col-md-6 col-lg-4">
											<div class="form-group">
												<label>Destination Country</label>
												<select class="form-control select" name="country_id" id="country_name" required>
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
												<label>Destination State/Province</label>
												<select class="form-control select" name="state_id" id="state" required>
												</select>
											</div>
										</div>
                                        <div class="col-sm-6 col-md-6 col-lg-4">
											<div class="form-group">
												<label>Destination City</label>
												<select class="form-control select" name="city_id" id="city" required>
												</select>
											</div>
										</div>
										
									</div>
								</div>
                                <!-- <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Date of Departure</label>
                                        <div class="cal-icon">
                                            <input type="text" name="departure_date" class="form-control datetimepicker" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Date of Arrival</label>
                                        <div class="cal-icon">
                                            <input type="text" name="arrival_date" class="form-control datetimepicker" required>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                            
                            <div class="m-t-20 text-center">
                                <button type="submit" name="add_package" class="btn btn-primary submit-btn">Add Package</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php include 'includes/notification.php'; ?>
        </div>


<?php include 'includes/footer.php'; ?>