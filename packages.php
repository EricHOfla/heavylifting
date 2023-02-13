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
                        <h4 class="page-title">Packages</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="add_package" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Package</a>
                    </div>
                </div>
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-border table-striped custom-table datatable mb-0">
								<thead>
									<tr>
										<th>PackageID</th>
										<th>Package Name</th>
										<th>Container</th>
										<th>Warehouse</th>
										<th>Customer</th>
										<th>Country To Be Shipped</th>
										<th>State/Province</th>
										<th>City</th>
										
										<th class="text-right">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										if (isset($_POST['notify_pickup'])) {
											$package_id = $_POST['package_id'];

											$paqu = mysqli_query($DB_CONNECT,"SELECT * FROM package_tb WHERE package_id='$package_id'");
											$fetPa = mysqli_fetch_array($paqu);

											$cuqu = mysqli_query($DB_CONNECT,"SELECT * FROM customer_tb WHERE customer_id='".$fetPa['customer_id']."'");
											$fetCu = mysqli_fetch_array($cuqu);

											$data=array(
												"sender"=>'HL_App',
												"recipients"=>$fetCu['phone'],
												"message"=>"Dear ".$fetCu['lastname'].", Your package is now at our warehouse. You may pick it up.",
											);

											$url="https://www.intouchsms.co.rw/api/sendsms/.json";
											$data=http_build_query($data);
											$username="BITS_APP";
											$password="Home66881";

											$ch=curl_init();
											curl_setopt($ch,CURLOPT_URL,$url);
											curl_setopt($ch,CURLOPT_USERPWD,$username.":".$password);
											curl_setopt($ch,CURLOPT_POST,true);
											curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
											curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);
											curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
											$result=curl_exec($ch);
											$httpcode=curl_getinfo($ch,CURLINFO_HTTP_CODE);
											curl_close($ch);

											$uppa = mysqli_query($DB_CONNECT,"UPDATE `package_tb` SET `notify`='Notified' WHERE `package_id`='$package_id'");

											echo "<meta http-equiv='refresh' content='0'>";
										}

										$pckgSql = mysqli_query($DB_CONNECT,"SELECT * FROM package_tb ORDER BY package_id DESC");
										while ($pckgFet = mysqli_fetch_array($pckgSql)) {

											$warhQury = mysqli_query($DB_CONNECT,"SELECT * FROM warehouse_tb WHERE id='".$pckgFet['warehouse_id']."'");
											$warhFet = mysqli_fetch_array($warhQury);

											$contQury = mysqli_query($DB_CONNECT,"SELECT * FROM container_tb WHERE container_id='".$pckgFet['container_id']."'");
											$contFet = mysqli_fetch_array($contQury);

											$custQury = mysqli_query($DB_CONNECT,"SELECT * FROM customer_tb WHERE customer_id='".$pckgFet['customer_id']."'");
											$custFet = mysqli_fetch_array($custQury);

											$countryQury = mysqli_query($DB_CONNECT,"SELECT * FROM countries WHERE id='".$pckgFet['countryId']."'");
											$countryFet = mysqli_fetch_array($countryQury);

											$stateQury = mysqli_query($DB_CONNECT,"SELECT * FROM states WHERE id='".$pckgFet['stateId']."'");
											$stateFet = mysqli_fetch_array($stateQury);

											$cityQury = mysqli_query($DB_CONNECT,"SELECT * FROM cities WHERE id='".$pckgFet['cityId']."'");
											$cityFet = mysqli_fetch_array($cityQury);

											if ($pckgFet['notify'] == null) {
												$notify = '
													<form method="post">
														<input type="hidden" name="package_id" value="'.$pckgFet['package_id'].'">
														<button class="btn btn-info" type="submit" name="notify_pickup">Notify Pick-Up</button>
													</form>
												';
											}else {
												$notify = '<span class="btn btn-success">Notified</span>';
											}

											echo '
												<tr>
													<td>PKG-00'.$pckgFet['package_id'].'</td>
													<td>'.$pckgFet['package_name'].'</td>
													<td>'.$contFet['container_name'].'</td>
													<td>'.$warhFet['warehouse_name'].'</td>
													<td>'.$custFet['firstname'].' '.$custFet['lastname'].'</td>
													<td>'.$countryFet['name'].'</td>
													<td>'.$stateFet['name'].'</td>
													<td>'.$cityFet['name'].'</td>
													<td>'.$notify.'</td>
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