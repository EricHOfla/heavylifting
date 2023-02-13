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
                        <h4 class="page-title">Warehouses</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="add_warehouse" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Warehouse</a>
                    </div>
                </div>
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-border table-striped custom-table datatable mb-0">
								<thead>
									<tr>
										<th>WRH_ID</th>
										<th>WRH Name</th>
										<th>Manager Name</th>
										<th>Country</th>
										<th>State/Province</th>
										<th>City</th>
										<th>Address</th>
										<th class="text-right">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										$wrhSql = mysqli_query($DB_CONNECT,"SELECT * FROM warehouse_tb ORDER BY id DESC");
										while ($wrhFet = mysqli_fetch_array($wrhSql)) {

											$countryQury = mysqli_query($DB_CONNECT,"SELECT * FROM countries WHERE id='".$wrhFet['countryId']."'");
											$countryFet = mysqli_fetch_array($countryQury);

											$stateQury = mysqli_query($DB_CONNECT,"SELECT * FROM states WHERE id='".$wrhFet['stateId']."'");
											$stateFet = mysqli_fetch_array($stateQury);

											$cityQury = mysqli_query($DB_CONNECT,"SELECT * FROM cities WHERE id='".$wrhFet['cityId']."'");
											$cityFet = mysqli_fetch_array($cityQury);

											echo '
												<tr>
													<td>'.$wrhFet['warehouseId'].'</td>
													<td>'.$wrhFet['warehouse_name'].'</td>
													<td>'.$wrhFet['manager_name'].'</td>
													<td>'.$countryFet['name'].'</td>
													<td>'.$stateFet['name'].'</td>
													<td>'.$cityFet['name'].'</td>
													<td>'.$wrhFet['address'].'</td>
													<td class="text-right">
														<div class="dropdown dropdown-action">
															<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
															<div class="dropdown-menu dropdown-menu-right">
																<a class="dropdown-item" href="edit-warehouse?warehouse_id='.$wrhFet['id'].'"><i class="fa fa-pencil m-r-5"></i> Edit</a>
																<a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_wrh_'.$wrhFet['id'].'"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
															</div>
														</div>
													</td>
												</tr>
											';

											?>
												<div id="delete_wrh_<?php echo $wrhFet['id']; ?>" class="modal fade delete-modal" role="dialog">
													<div class="modal-dialog modal-dialog-centered">
														<div class="modal-content">
															<div class="modal-body text-center">
																<img src="assets/img/sent.png" alt="" width="50" height="46">
																<h3>Are you sure want to delete this Warehouse?</h3>
																<?php 
																	if (isset($_POST['delete_wrh'])) {
																		$wrh_id = $_POST['wrh_id'];

																		$delWrhSQL = mysqli_query($DB_CONNECT,"DELETE FROM `warehouse_tb` WHERE id='$wrh_id'");

																		if ($delWrhSQL) {
																			echo "<meta http-equiv='refresh' content='0'>";		
																		}else {
																			echo "Failed".mysqli_error($DB_CONNECT);
																		}
																	}
																?>
																<form method="post">
																	<div class="m-t-20"> 
																		<input type="hidden" name="wrh_id" value="<?php echo $wrhFet['id']; ?>" >

																		<a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
																		
																		<button type="submit" name="delete_wrh" class="btn btn-danger">Delete</button>
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
			
            <?php include 'includes/notification.php'; ?>
        </div>


<?php include 'includes/footer.php'; ?>