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
                        <h4 class="page-title">Check-out Inventory</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="checkin" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-file"></i> Check-In</a>
                    </div>
                </div>
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-border table-striped custom-table datatable mb-0">
								<thead>
									<tr>
										<th>InventoryID</th>
                                        <th>Item Name</th>
										<th>Check-Out Qty</th>
										<th>Note</th>
										<th>Check-Out Date</th>
										<th>Recorded By</th>
										<!-- <th class="text-right">Action</th> -->
									</tr>
								</thead>
								<tbody>
									<?php 
										$checkoutinvSql = mysqli_query($DB_CONNECT,"SELECT * FROM `inventory_cheout_tb` ORDER BY inventory_checkout_id DESC");
										while ($checkoutinveFet = mysqli_fetch_array($checkoutinvSql)) {

											$invQury = mysqli_query($DB_CONNECT,"SELECT * FROM inventory_tb WHERE inventory_id='".$checkoutinveFet['inventory_id']."'");

											$userSq = mysqli_query($DB_CONNECT,"SELECT * FROM user_tb WHERE user_id='".$checkoutinveFet['user_id']."'");
											$userFe = mysqli_fetch_array($userSq);

											$inveFet = mysqli_fetch_array($invQury);
                                            $sum = $inveFet['cost'] * $inveFet['in_qty'];
											echo '
												<tr>
													<td>INV-00'.$inveFet['inventory_id'].'</td>
													<td>'.$inveFet['item_name'].'</td>
													<td>'.$checkoutinveFet['out_qty'].'</td>
													<td>'.$checkoutinveFet['description'].'</td>
													<td>'.$checkoutinveFet['checkout_date'].'</td>
													<td>'.$userFe['firstname'].' '.$userFe['lastname'].'</td>
													
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