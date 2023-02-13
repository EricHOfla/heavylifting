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
                        <h4 class="page-title">Check-In Inventory</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="add_checkin" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Check-In</a>
                    </div>
                </div>
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-border table-striped custom-table datatable mb-0">
								<thead>
									<tr>
										<th>InventoryID</th>
                                        <th>Warehouse</th>
										<th>Item Name</th>
										<th>Unity</th>
										<th>Recorded Qty</th>
										<th>Cost Per Item</th>
										<th>Qty Remain</th>
										<th>Inventory Value</th>
										<th>Recorded Date</th>
										<th>Check-Out</th>
										<!-- <th class="text-right">Action</th> -->
									</tr>
								</thead>
								<tbody>
									<?php 
										$invSql = mysqli_query($DB_CONNECT,"SELECT * FROM inventory_tb ORDER BY inventory_id DESC");
										while ($inveFet = mysqli_fetch_array($invSql)) {

											$warhQury = mysqli_query($DB_CONNECT,"SELECT * FROM warehouse_tb WHERE id='".$inveFet['warehouse_id']."'");
											$warhFet = mysqli_fetch_array($warhQury);

											$checkoutinvsql = mysqli_query($DB_CONNECT,"SELECT * FROM inventory_cheout_tb WHERE inventory_id='".$inveFet['inventory_id']."' ");
    										$checkoutinvFet = mysqli_fetch_array($checkoutinvsql);

                                            $sum = $inveFet['cost'] * $inveFet['in_qty'];

											$sum1 = $inveFet['cost'] * $inveFet['out_qty'];

											// $remainqty = $inveFet['in_qty'] - $checkoutinvFet['out_qty'];

											$totaInventory = $sum1;

											if ($inveFet['out_qty'] == 0) {
												$checkout = '<span class="badge badge-danger">Out-Off Stock</span>';
											}else {
												$checkout = '<a href="add_checkout?inventoryID='.$inveFet['inventory_id'].'" class="badge badge-warning" style="color:white;"><i class="fa fa-minus"></i> Check-Out</a>';
											}
											echo '
												<tr>
													<td>INV-00'.$inveFet['inventory_id'].'</td>
													<td>'.$warhFet['warehouse_name'].'</td>
													<td>'.$inveFet['item_name'].'</td>
													<td>'.$inveFet['unit'].'</td>
													<td>'.$inveFet['in_qty'].'</td>
                                                    <td>'.number_format($inveFet['cost']).'</td>
													<td>'.$inveFet['out_qty'].'</td>
                                                    <td>'.number_format($sum1).'</td>
                                                    <td>'.$inveFet['checkin_date'].'</td>
													<td>'.$checkout.'</td>
													
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
							<table class="table align-items-left table-flush" style="background-color: skyblue; color: black;">
								<tr style="font-size: 20px;">
								<th>Total Inventories' Amount</th>
								<th style="text-align: right;"><?php echo number_format($totaInventory); ?> Frw</th>
								</tr>
							</table>
						</div>
					</div>
                </div>
            </div>
			
            <?php include 'includes/notification.php'; ?>
        </div>


<?php include 'includes/footer.php'; ?>