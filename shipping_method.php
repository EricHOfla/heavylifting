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
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Shipping Method</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="#" data-toggle="modal" data-target="#add_shipping_method" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Shipping Method</a>
                    </div>
                </div>
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-border table-striped custom-table datatable mb-0">
								<thead>
									<tr>
                                        <th>Shipping Type</th>
                                        <th>Transportation Name</th>
										<th>Country From</th>
										<th>Country To</th>
                                        <th>Landing Port</th>
										<th>Departure Date</th>
										<th>Arrival Date</th>
                                        <th>Status</th>
                                        <th></th>
									</tr>
								</thead>
								<tbody>
									<?php 
                                        if (isset($_POST['update_status'])) {
                                            $updstatus_id = $_POST['updstatus_id'];
                                            $update_status_field = $_POST['update_status_field'];
                                            
                                            $updStaQue = mysqli_query($DB_CONNECT,"UPDATE `shipping_method_tb` SET `status`='$update_status_field' WHERE `shipping_method_id`='$updstatus_id'");

                                            if ($updStaQue == true) {
                                        
                                                ?>
                                                <script>
                                                    alert("Status is succesfully Updated");
                                                </script>
                                                <?php
                                                echo "<meta http-equiv='refresh' content='0'>";
                                            }else {
                                                echo 'Failed to update Status' .mysqli_error($DB_CONNECT);
                                            }
                                        }

                                        if (isset($_POST['pack_container'])) {
                                            $shipp_meth_id = $_POST['shipp_meth_id'];
                                            $selcont = $_POST['selcont'];
                                            $finalDestin = $_POST['finalDestin'];
                                            // $arrivalDate = $_POST['arrivalDate'];

                                            $packCqur = mysqli_query($DB_CONNECT,"INSERT INTO `track_shipping_tb`(`user_id`, `shipping_method_id`, `container_id`, `final_destination`) VALUES ('$userID','$shipp_meth_id','$selcont','$finalDestin')");
                                            if ($packCqur == true) {
                                                $updQu = mysqli_query($DB_CONNECT,"UPDATE `container_tb` SET `packed`='Packed',`shipping_method_id`='$shipp_meth_id' WHERE `container_id`='$selcont'");
                                                if ($updQu == true) {
                                                    ?>
                                                    <script>
                                                        alert("Container/Cargo is succesfully Packed");
                                                    </script>
                                                    <?php
                                                    echo "<meta http-equiv='refresh' content='0'>";
                                                }else {
                                                    echo 'Failed to update Container/Cargo' .mysqli_error($DB_CONNECT);
                                                }
                                                
                                            }else {
                                                echo 'Failed to Add Container/Cargo' .mysqli_error($DB_CONNECT);
                                            }
                                        }


										$shippSql = mysqli_query($DB_CONNECT,"SELECT * FROM shipping_method_tb ORDER BY shipping_method_id DESC");
                                        $count = 0;
										while ($shippFet = mysqli_fetch_array($shippSql)) {
                                            $count ++;

                                            $countryFromQury = mysqli_query($DB_CONNECT,"SELECT * FROM countries WHERE id='".$shippFet['from_country']."'");
											$countryFromFet = mysqli_fetch_array($countryFromQury);

                                            $countrytoQury = mysqli_query($DB_CONNECT,"SELECT * FROM countries WHERE id='".$shippFet['to_country']."'");
											$countrytoFet = mysqli_fetch_array($countrytoQury);

                                            if ($shippFet['status'] == null) {
                                                $stt = '<span class="badge badge-danger">Pending</span>';
                                                $drpDwn = '
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a href="#" class="dropdown-item" data-toggle="modal" data-target="#press_container_'.$shippFet['shipping_method_id'].'"><i class="fa fa-plus m-r-5"></i> Add Container/Cargo</a>
                                                            <a href="track_shipping?shipped_id='.$shippFet['shipping_method_id'].'" class="dropdown-item"><i class="fa fa-boxes m-r-5"></i> Packed</a>
                                                            <a href="#" class="dropdown-item" data-toggle="modal" data-target="#status_update_'.$shippFet['shipping_method_id'].'"><i class="fa fa-pencil-alt m-r-5"></i> Status Update</a>
                                                            
                                                        </div>
                                                    </div>
                                                ';
                                            }elseif ($shippFet['status'] == 'Started') {
                                                $stt = '<span class="badge badge-warning">On Move</span>';
                                                $drpDwn = '
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            
                                                            <a href="track_shipping?shipped_id='.$shippFet['shipping_method_id'].'" class="dropdown-item"><i class="fa fa-boxes m-r-5"></i> Packed</a>
                                                            <a href="#" class="dropdown-item" data-toggle="modal" data-target="#status_update_'.$shippFet['shipping_method_id'].'"><i class="fa fa-pencil-alt m-r-5"></i> Status Update</a>
                                                            
                                                        </div>
                                                    </div>
                                                ';
                                            }elseif($shippFet['status'] == 'Cancelled'){
                                                $stt = '<span class="badge badge-info">Cancelled</span>';
                                                $drpDwn = '';
                                            }else {
                                                $stt = '<span class="badge badge-success">Done</span>';
                                                $drpDwn = '<a href="track_shipping?shipping_method_id='.$shippFet['shipping_method_id'].'" class="dropdown-item"><i class="fa fa-boxes m-r-5"></i> Packs</a>';
                                            }
											
											echo '
												<tr>
													<td>'.$shippFet['transport_type'].'</td>
                                                    <td>'.$shippFet['name_transport'].'</td>
													<td>'.$countryFromFet['name'].' </td>
													<td>'.$countrytoFet['name'].'</td>
													<td>'.$shippFet['landing_port'].'</td>
                                                    <td>'.$shippFet['departure_date'].'</td>
                                                    <td>'.$shippFet['arrival_date'].'</td>
                                                    <td>'.$stt.'</td>
                                                    <td class="text-right">'.$drpDwn.'</td>
												</tr>
											';
                                            ?>
                                                <div id="press_container_<?php echo $shippFet['shipping_method_id'] ?>" class="modal fade delete-modal" role="dialog">
													<div class="modal-dialog modal-dialog-centered">
														<div class="modal-content">
															<div class="modal-body">
																
																<form method="post" class="row">
                                                                    <input type="hidden" value="<?php echo $shippFet['shipping_method_id'] ?>" name="shipp_meth_id">
         
                                                                    <div class="form-group">
                                                                        <label>Container/Cargo</label>
                                                                        <select class="form-control select" name="selcont" required>
                                                                            <option selected disabled>Select</option>
                                                                            <?php 
                                                                                $contaiQur3 = mysqli_query($DB_CONNECT,"SELECT * FROM container_tb WHERE status='Full' AND `packed`='Not Packed'");
                                                                                while ($fetCo2 = mysqli_fetch_array($contaiQur3)) {
                                                                                    echo '<option value="'.$fetCo2['container_id'].'">'.$fetCo2['container_name'].'</option>';
                                                                                }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                           
                                                                    <div class="form-group">
                                                                        <label>Final Destination</label>
                                                                        <input class="form-control" name="finalDestin" type="text" required>
                                                                    </div>

                                                                    <!-- <div class="form-group">
                                                                        <label>Arrival Date</label>
                                                                        <div class="cal-icon">
                                                                            <input type="text" name="arrivalDate" class="form-control datetimepicker" required>
                                                                        </div>
                                                                    </div> -->

																	<div class="m-t-20 col-md-12"> 
																		<a href="#" class="btn btn-danger" data-dismiss="modal">Close</a>
																		
																		<button type="submit" name="pack_container" class="btn btn-primary" style="color:white;">Add</button>
																	</div>
																</form>
															</div>
														</div>
													</div>
												</div>

                                                <div id="status_update_<?php echo $shippFet['shipping_method_id'] ?>" class="modal fade delete-modal" role="dialog">
													<div class="modal-dialog modal-dialog-centered">
														<div class="modal-content">
															<div class="modal-body">
																
																<form method="post" class="row">
                                                                    <input type="hidden" name="updstatus_id" value=
                                                                    "<?php echo $shippFet['shipping_method_id'] ?>">
                                                                    <div class="form-group">
                                                                        <label>Status</label>
                                                                        <select class="form-control select" name="update_status_field" required>
                                                                            <option selected value="">Select Status</option>
                                                                            <option value="Started">Shipping Started</option>
                                                                            <option value="Done">Shipping Done</option>
                                                                            <option value="Cancelled">Shipping Cancelled</option>
                                                                        </select>
                                                                    </div>     

																	<div class="m-t-20 col-md-12"> 
																		<a href="#" class="btn btn-danger" data-dismiss="modal">Close</a>
																		
																		<button type="submit" name="update_status" class="btn btn-primary" style="color:white;">Update</button>
																	</div>
																</form>
															</div>
														</div>
													</div>
												</div>
                                            <?php
										}
									?>
									
								</tbody>
							</table>
							
						</div>
					</div>
                </div>
            </div>

            <div id="add_shipping_method" class="modal fade delete-modal" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <?php 
                                if (isset($_POST['add_shipping'])) {
                                    $transport_type = $_POST['transport_type'];
                                    $transportation_name = $_POST['transportation_name'];
                                    $country_from = $_POST['country_from'];
                                    $country_to = $_POST['country_to'];
                                    $landing_port = $_POST['landing_port'];
                                    $departure_date = $_POST['departure_date'];
                                    $arrival_date = $_POST['arrival_date'];

                                    $insShippQuery = mysqli_query($DB_CONNECT,"INSERT INTO `shipping_method_tb`(`user_id`,`transport_type`, `name_transport`, `from_country`, `to_country`, `landing_port`, `departure_date`, `arrival_date`) VALUES ('$userID','$transport_type','$transportation_name','$country_from','$country_to','$landing_port','$departure_date','$arrival_date')");

                                    if ($insShippQuery) {
                                        ?>
                                        <script>
                                            alert("Shipping Mehtod is succesfully Added");
                                        </script>
                                        <?php
                                        echo "<meta http-equiv='refresh' content='0'>";
                                    }else {
                                        echo 'Failed to Add Shipping Mehtod' .mysqli_error($DB_CONNECT);
                                    }
                                }
                            ?>
                            <form method="post" class="row">
                                <div class="form-group col-md-12">
                                    <label>Transport Type</label> <span class="text-danger">*</span>
                                    <select class="form-control select" name="transport_type" required="">
                                        <option selected disabled>Select type</option>
                                        <option>Air Transport</option>
                                        <option>Water Transport</option>
                                        <option>Road Transport</option>
                                        <option>Rail Transport</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Name of Transportation</label>
                                    <input class="form-control" name="transportation_name" type="text" required>
                                </div>
                            
                                <div class="form-group col-md-6">
                                    <label>Country From</label>
                                    <select class="form-control select" name="country_from" required="">
                                        <option selected disabled>Select Country</option>
                                        <?php 
                                            $ctry1Sql = mysqli_query($DB_CONNECT,"SELECT * FROM countries");
                                            while ($ctry1 = mysqli_fetch_array($ctry1Sql)) {
                                                echo '<option value="'.$ctry1['id'].'">'.$ctry1['name'].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Country To</label>
                                    <select class="form-control select" name="country_to" id="ctryPort" required="">
                                        <option selected disabled>Select Country</option>
                                        <?php 
                                            $ctry2Sql = mysqli_query($DB_CONNECT,"SELECT * FROM countries");
                                            while ($ctry2 = mysqli_fetch_array($ctry2Sql)) {
                                                echo '<option value="'.$ctry2['id'].'">'.$ctry2['name'].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-12" id="port">
                                    <label>Landing Port Name</label>
                                    <input class="form-control" name="landing_port" type="text" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Date of Departure</label>
                                    <div class="cal-icon">
                                        <input type="text" name="departure_date" class="form-control datetimepicker" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Date of Arrival</label>
                                    <div class="cal-icon">
                                        <input type="text" name="arrival_date" class="form-control datetimepicker" required>
                                    </div>
                                </div>
                                <div class="m-t-20 col-md-12"> 
                                    <a href="#" class="btn btn-danger" data-dismiss="modal">Close</a>
                                    
                                    <button type="submit" name="add_shipping" class="btn btn-primary" style="color:white;">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
			
            <?php include 'includes/notification.php'; ?>
        </div>


<?php include 'includes/footer.php'; ?>