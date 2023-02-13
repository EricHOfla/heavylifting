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
                        <h4 class="page-title">Customer</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="add_customer" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Customer</a>
                    </div>
                </div>
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-border table-striped custom-table datatable mb-0">
								<thead>
									<tr>
										<th>No</th>
										<th>Customer Names</th>
										<th>Phone</th>
										<th>Fax</th>
                                        <th>Email</th>
                                        <th>Country</th>
										<th>State/Province</th>
										<th>City</th>
										<th>Address</th>
										<th class="text-right">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php 
                                        $count = 0;
										$custSql = mysqli_query($DB_CONNECT,"SELECT * FROM customer_tb ORDER BY customer_id DESC");
										while ($custFet = mysqli_fetch_array($custSql)) {
                                            $count ++;
											$countryQury = mysqli_query($DB_CONNECT,"SELECT * FROM countries WHERE id='".$custFet['countryId']."'");
											$countryFet = mysqli_fetch_array($countryQury);

											$stateQury = mysqli_query($DB_CONNECT,"SELECT * FROM states WHERE id='".$custFet['stateId']."'");
											$stateFet = mysqli_fetch_array($stateQury);

											$cityQury = mysqli_query($DB_CONNECT,"SELECT * FROM cities WHERE id='".$custFet['cityId']."'");
											$cityFet = mysqli_fetch_array($cityQury);

                                            if ($custFet['fax'] == null) {
                                                $fax = 'Null';
                                            }else{
                                                $fax = $custFet['fax'];
                                            }

											echo '
												<tr>
													<td>'.$count.'</td>
													<td>'.$custFet['firstname'].' '.$custFet['lastname'].'</td>
													<td>'.$custFet['phone'].'</td>
                                                    <td>'.$fax.'</td>
                                                    <td>'.$custFet['email'].'</td>
													<td>'.$countryFet['name'].'</td>
													<td>'.$stateFet['name'].'</td>
													<td>'.$cityFet['name'].'</td>
													<td>'.$custFet['address'].'</td>
													<td class="text-right">
														<a class="dropdown-item" href="edit-customer?customer_id='.$custFet['customer_id'].'"><i class="fa fa-pencil-alt m-r-5"></i> Edit</a>
													</td>
												</tr>
											';

											?>
												<div id="delete_cust_<?php echo $custFet['customer_id']; ?>" class="modal fade delete-modal" role="dialog">
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