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
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget">
							<span class="dash-widget-bg1"><i class="fa fa-user-friends" aria-hidden="true"></i></span>
							<div class="dash-widget-info text-right">
								<?php 
									$userQue = mysqli_query($DB_CONNECT,"SELECT * FROM user_tb");
									$countUser = mysqli_num_rows($userQue);
								?>
								<h3><?php echo $countUser; ?></h3>
								<span class="widget-title1">Users <i class="fa fa-check" aria-hidden="true"></i></span>
							</div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget">
                            <span class="dash-widget-bg2"><i class="fa fa-users"></i></span>
                            <div class="dash-widget-info text-right">
								<?php 
									$customerQue = mysqli_query($DB_CONNECT,"SELECT * FROM customer_tb");
									$countCus = mysqli_num_rows($customerQue);
								?>
                                <h3><?php echo $countCus; ?></h3>
                                <span class="widget-title2">Customers <i class="fa fa-check" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget">
                            <span class="dash-widget-bg3"><i class="fa fa-warehouse" aria-hidden="true"></i></span>
                            <div class="dash-widget-info text-right">
								<?php 
									$wrQue = mysqli_query($DB_CONNECT,"SELECT * FROM warehouse_tb");
									$countWr = mysqli_num_rows($wrQue);
								?>
                                <h3><?php echo $countWr; ?></h3>
                                <span class="widget-title3">Warehouse <i class="fa fa-check" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget">
                            <span class="dash-widget-bg4"><i class="fa fa-archive" aria-hidden="true"></i></span>
                            <div class="dash-widget-info text-right">
								<?php 
									$contaQue = mysqli_query($DB_CONNECT,"SELECT * FROM container_tb");
									$countCont = mysqli_num_rows($contaQue);
								?>
                                <h3><?php echo $countCont; ?></h3>
                                <span class="widget-title4">Containers <i class="fa fa-check" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="row">
					<div class="col-12 col-md-6 col-lg-6 col-xl-6">
						<div class="card">
							<div class="card-body">
								<div class="chart-title">
									<h4>Transport Analytics</h4>
									<!-- <span class="float-right"><i class="fa fa-caret-up" aria-hidden="true"></i> 15% Higher than Last Month</span> -->
								</div>	
								<div id="barchart_values" style="width: 100%;"></div>
							</div>
						</div>
					</div>
					<div class="col-12 col-md-6 col-lg-6 col-xl-6">
						<div class="card">
							<div class="card-body">
								<div class="chart-title">
									<h4>Containers/Cargo Analytics</h4>
									
								</div>	
								<div id="chart_div"></div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-12 col-md-6 col-lg-8 col-xl-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title d-inline-block">Recent Container/Cargo </h4> <a href="container" class="btn btn-primary float-right">View all</a>
							</div>
							<div class="card-block">
								<div class="table-responsive">
									<table class="table mb-0 new-patient-table">
										<!-- <thead>
											<tr>
												<th>Container-ID</th>
												<th>Container/Cargo Name</th>
												<th>Warehouse Name</th>
												<th>Size</th>
												<th>No. Of </br>Packages</th>
												<th>Status</th>
												<th class="text-right">Action</th>
											</tr>
										</thead> -->
										<tbody>
											<?php 
												if (isset($_POST['update_container'])) {
													$container_id = $_POST['container_id'];
													$upcontainer_name = $_POST['upcontainer_name'];
													$upwarehouse_id = $_POST['upwarehouse_id'];
													$upsize = $_POST['upsize'];
													$upstatus = $_POST['upstatus'];

													$updQur = mysqli_query($DB_CONNECT,"UPDATE `container_tb` SET `container_name`='$upcontainer_name',`warehouseId`='$upwarehouse_id',`size`='$upsize',`status`='$upstatus' WHERE `container_id`='$container_id'");

													if ($updQur) {
														?>
														<script>
															alert("Container is succesfully Updated");
														</script>
														<?php
														echo "<meta http-equiv='refresh' content='0'>";
													}else {
														echo 'Failed to update Container' .mysqli_error($DB_CONNECT);
													}
												}

												$containerSql = mysqli_query($DB_CONNECT,"SELECT * FROM container_tb  ORDER BY container_id DESC LIMIT 5");
												while ($contFet = mysqli_fetch_array($containerSql)) {

													$wrhQury = mysqli_query($DB_CONNECT,"SELECT * FROM warehouse_tb WHERE id='".$contFet['warehouseId']."'");
													$wrhFet = mysqli_fetch_array($wrhQury);

													$pacQu = mysqli_query($DB_CONNECT,"SELECT * FROM package_tb WHERE container_id='".$contFet['container_id']."'");
													$packCount = mysqli_num_rows($pacQu);

													if ($contFet['status'] == 'Not Full') {
														$status = '<span class="badge badge-danger">Not Yet Full</span>';
														$action = '<a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_container_'.$contFet['container_id'].'"><i class="fa fa-pencil-alt m-r-5"></i> Edit</a>';
													}else {
														$status = '<span class="badge badge-success">Full</span>';
														if ($contFet['shipping_method_id'] == null) {
															$action = '<span style="color:orange; font-weight:bold;"><i class="fa fa-box"></i> Ready for Packing</span>';
														}else{
															$action = '<span style="color:green; font-weight:bold;"><i class="fa fa-box"></i> Packed</span>';
														}
													}

													echo '
														<tr>
															<td>CTN-00'.$contFet['container_id'].'</td>
															<td>'.$contFet['container_name'].'</td>
															<td>'.$wrhFet['warehouse_name'].'</td>
															<td>'.$contFet['size'].'</td>
															<td>'.$packCount.'</td>
															<td>'.$status.'</td>
															<td class="text-right">'.$action.'</td>
														</tr>
													';

													?>
														<div id="edit_container_<?php echo $contFet['container_id'] ?>" class="modal fade delete-modal" role="dialog">
															<div class="modal-dialog modal-dialog-centered">
																<div class="modal-content">
																	<div class="modal-body">
																		
																		<form method="post" class="row">
																			<input type="hidden" name="container_id" value="<?php echo $contFet['container_id'] ?>">
																			<div class="form-group">
																				<label>Container/Cargo Name <span class="text-danger">*</span></label>
																				<input class="form-control" name="upcontainer_name" type="text" value="<?php echo $contFet['container_name'] ?>">
																			</div>
																		
																		
																			<div class="form-group">
																				<label>Warehouse</label>
																				<select class="form-control select" name="upwarehouse_id" required>
																					<option value="<?php echo $wrhFet['id']; ?>"><?php echo $wrhFet['warehouse_name']; ?></option>
																					<option disabled></option>
																					<?php 
																						$warehouseSql = mysqli_query($DB_CONNECT,"SELECT * FROM warehouse_tb");
																						while ($warehouseFet = mysqli_fetch_array($warehouseSql)) {
																							echo '<option value="'.$warehouseFet['id'].'">'.$warehouseFet['warehouse_name'].'</option>';
																						}
																					?>
																				</select>
																			</div>

																			<div class="form-group">
																				<label>Size <span class="text-danger">*</span></label>
																				<input class="form-control" name="upsize" type="text" value="<?php echo $contFet['size'] ?>">
																			</div>
																			<div class="form-group">
																				<label>Status</label>
																				<select class="form-control select" name="upstatus" required>
																					<option><?php echo $contFet['status']; ?></option>
																					<option disabled></option>
																					<option>Full</option>
																					<option>Not Full</option>
																				</select>
																			</div>
																			<div class="m-t-20 col-md-12"> 
																				<a href="#" class="btn btn-danger" data-dismiss="modal">Close</a>
																				
																				<button type="submit" name="update_container" class="btn btn-primary" style="color:white;">Save</button>
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
					
					 
				</div>
            </div>
        </div>

<?php include 'includes/footer.php'; ?>