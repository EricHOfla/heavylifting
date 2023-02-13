<?php 
    include 'includes/head.php'; 

    $warehouse_id = $_REQUEST['warehouse_id'];

    $warehouseSql = mysqli_query($DB_CONNECT,"SELECT * FROM warehouse_tb WHERE id='$warehouse_id' ");
    $warehouse_fet = mysqli_fetch_array($warehouseSql);

    $countryQury = mysqli_query($DB_CONNECT,"SELECT * FROM countries WHERE id='".$warehouse_fet['countryId']."'");
    $countryFet = mysqli_fetch_array($countryQury);

    $stateQury = mysqli_query($DB_CONNECT,"SELECT * FROM states WHERE id='".$warehouse_fet['stateId']."'");
    $stateFet = mysqli_fetch_array($stateQury);

    $cityQury = mysqli_query($DB_CONNECT,"SELECT * FROM cities WHERE id='".$warehouse_fet['cityId']."'");
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
                        <a class="btn btn-danger" href="warehouse">Back</a><h4 class="page-title">Update Warehouse</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <?php 
                            if (isset($_POST['edit_warehouse'])) {
                                $upd_wrh_id = $_POST['upd_wrh_id'];
                                $upd_wrh_name = $_POST['upd_wrh_name'];
                                $upd_manager_name = $_POST['upd_manager_name'];
                                $upd_manager_email = $_POST['upd_manager_email'];
                                $upd_address = $_POST['upd_address'];
                                $upd_country = $_POST['upd_country'];
                                $upd_state = $_POST['upd_state'];
                                $upd_city = $_POST['upd_city'];
                                $upd_status = $_POST['upd_status'];

                                $wrhUpdQuery = mysqli_query($DB_CONNECT,"UPDATE `warehouse_tb` SET `warehouse_name`='$upd_wrh_name',`manager_name`='$upd_manager_name',`manager_email`='$upd_manager_email',`countryId`='$upd_country',`stateId`='$upd_state',`cityId`='$upd_city',`address`='$upd_address',`status`='$upd_status' WHERE `id`='$upd_wrh_id'");

                                if ($wrhUpdQuery) {
                                    ?>
                                    <script>
                                        alert("Warehouse is succesfully Updated");
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
                                <input class="form-control" value="<?php echo $warehouse_fet['id']; ?>" name="upd_wrh_id" type="hidden">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Warehouse ID</label>
                                        <input class="form-control" value="<?php echo $warehouse_fet['warehouseId']; ?>" type="text" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Warehouse Name</label>
                                        <input class="form-control" value="<?php echo $warehouse_fet['warehouse_name']; ?>" name="upd_wrh_name" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Manager Names <span class="text-danger">*</span></label>
                                        <input class="form-control" value="<?php echo $warehouse_fet['manager_name']; ?>" name="upd_manager_name" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Manager Email <span class="text-danger">*</span></label>
                                        <input class="form-control" value="<?php echo $warehouse_fet['manager_email']; ?>" name="upd_manager_email" type="email">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control select" name="upd_status" id="state">
                                            <option><?php echo $warehouse_fet['status']; ?></option>
                                            <option></option>
                                            <option>Active</option>
                                            <option>Inactive</option>

                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Street Address</label>
                                        <input type="text" name="upd_address" value="<?php echo $warehouse_fet['address']; ?>" class="form-control ">
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
                                <button type="submit" name="edit_warehouse" class="btn btn-primary submit-btn">Update Warehouse</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php include 'includes/notification.php'; ?>
        </div>


<?php include 'includes/footer.php'; ?>