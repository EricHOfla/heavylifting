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
                        <a class="btn btn-danger" href="customer">Back</a><h4 class="page-title">Add Customer</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <?php 
                            if (isset($_POST['add_customer'])) {
                                $user_id = $userFet['user_id'];
                                $first_name = $_POST['first_name'];
                                $last_name = $_POST['last_name'];
                                $phone = $_POST['phone'];
                                $fax = $_POST['fax'];
                                $email = $_POST['email'];
                                $country = $_POST['country'];
                                $state = $_POST['state'];
                                $city = $_POST['city'];
                                $address = $_POST['address'];
                                

                                $custinsQuery = mysqli_query($DB_CONNECT,"INSERT INTO `customer_tb`(`user_id`, `firstname`, `lastname`, `phone`, `fax`, `email`, `countryId`, `stateId`, `cityId`, `address`) VALUES ('$user_id','$first_name','$last_name','$phone','$fax','$email','$country','$state','$city','$address')");

                                if ($custinsQuery) {
                                    ?>
                                    <script>
                                        alert("Customer is succesfully Added");
                                    </script>
                                    <?php
                                    echo "<meta http-equiv='refresh' content='0'>";
                                }else {
                                    echo 'Failed to Add Customer' .mysqli_error($DB_CONNECT);
                                }
                            }
                        ?>
                        <form method="post" action="">
                            <div class="row">
                                
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Firstname</label> <span class="text-danger">*</span>
                                        <input class="form-control" name="first_name" type="text" required>
                                    </div>
                                </div>
                                 <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Lastname</label> <span class="text-danger">*</span>
                                        <input class="form-control" name="last_name" type="text" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Phone Number <span class="text-danger">*</span></label>
                                        <input class="form-control" name="phone" type="text" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Fax Number </label>
                                        <input class="form-control" name="fax" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input class="form-control" name="email" type="email" required>
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
                            
                            <div class="m-t-20 text-center">
                                <button type="submit" name="add_customer" class="btn btn-primary submit-btn">Add Customer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php include 'includes/notification.php'; ?>
        </div>


<?php include 'includes/footer.php'; ?>