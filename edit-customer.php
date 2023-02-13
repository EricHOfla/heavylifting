<?php 
    include 'includes/head.php'; 

    $customer_id = $_REQUEST['customer_id'];

    $customerSql = mysqli_query($DB_CONNECT,"SELECT * FROM customer_tb WHERE customer_id='$customer_id' ");
    $customer_fet = mysqli_fetch_array($customerSql);

    $countryQury = mysqli_query($DB_CONNECT,"SELECT * FROM countries WHERE id='".$customer_fet['countryId']."'");
    $countryFet = mysqli_fetch_array($countryQury);

    $stateQury = mysqli_query($DB_CONNECT,"SELECT * FROM states WHERE id='".$customer_fet['stateId']."'");
    $stateFet = mysqli_fetch_array($stateQury);

    $cityQury = mysqli_query($DB_CONNECT,"SELECT * FROM cities WHERE id='".$customer_fet['cityId']."'");
    $cityFet = mysqli_fetch_array($cityQury);
?>

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
                        <a class="btn btn-danger" href="customer">Back</a><h4 class="page-title">Update Customer</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <?php 
                            if (isset($_POST['upd_customer'])) {
                                $cust_id = $_POST['cust_id'];
                                $upd_first_name = $_POST['upd_first_name'];
                                $upd_last_name = $_POST['upd_last_name'];
                                $upd_phone = $_POST['upd_phone'];
                                $upd_fax = $_POST['upd_fax'];
                                $upd_email = $_POST['upd_email'];
                                $upd_country = $_POST['upd_country'];
                                $upd_state = $_POST['upd_state'];
                                $upd_city = $_POST['upd_city'];
                                $upd_address = $_POST['upd_address'];
                                

                                $custUpdQuery = mysqli_query($DB_CONNECT,"UPDATE `customer_tb` SET `firstname`='$upd_first_name',`lastname`='$upd_last_name',`phone`='$upd_phone',`fax`='$upd_fax',`email`='$upd_email',`countryId`='$upd_country',`stateId`='$upd_state',`cityId`='$upd_city',`address`='$upd_address' WHERE `customer_id`='$cust_id'");

                                if ($custUpdQuery) {
                                    ?>
                                    <script>
                                        alert("Customer is succesfully Updated");
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
                                <input value="<?php echo $customer_fet['customer_id']; ?>" name="cust_id" type="hidden">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Firstname</label> <span class="text-danger">*</span>
                                        <input class="form-control" value="<?php echo $customer_fet['firstname']; ?>" name="upd_first_name" type="text" required>
                                    </div>
                                </div>
                                 <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Lastname</label> <span class="text-danger">*</span>
                                        <input class="form-control" value="<?php echo $customer_fet['lastname']; ?>" name="upd_last_name" type="text" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Phone Number <span class="text-danger">*</span></label>
                                        <input class="form-control" value="<?php echo $customer_fet['phone']; ?>" name="upd_phone" type="text" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Fax Number </label>
                                        <input class="form-control" value="<?php echo $customer_fet['fax']; ?>" name="upd_fax" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input class="form-control" value="<?php echo $customer_fet['email']; ?>" name="upd_email" type="email" required>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Street Address</label>
                                        <input type="text" name="upd_address" value="<?php echo $customer_fet['address']; ?>" class="form-control " required>
                                    </div>
                                </div>
                                
								<div class="col-sm-12">
									<div class="row">
										
										<div class="col-sm-6 col-md-6 col-lg-4">
											<div class="form-group">
												<label>Country</label>
												<select class="form-control select" name="upd_country" id="upd_country_name">
													<option value="<?php echo $countryFet['id']; ?>"><?php echo $countryFet['name']; ?></option>
                                                    <option></option>
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
												<select class="form-control select" name="upd_state" id="upd_state">
                                                    <option value="<?php echo $stateFet['id']; ?>"><?php echo $stateFet['name']; ?></option>
												</select>
											</div>
										</div>
                                        <div class="col-sm-6 col-md-6 col-lg-4">
											<div class="form-group">
												<label>City</label>
												<select class="form-control select" name="upd_city" id="upd_city">
                                                    <option value="<?php echo $cityFet['id']; ?>"><?php echo $cityFet['name']; ?></option>
												</select>
											</div>
										</div>
										
									</div>
								</div>
                            </div>
                            
                            <div class="m-t-20 text-center">
                                <button type="submit" name="upd_customer" class="btn btn-primary submit-btn">Update Customer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php include 'includes/notification.php'; ?>
        </div>


<?php include 'includes/footer.php'; ?>