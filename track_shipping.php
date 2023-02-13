<?php 
    include 'includes/head.php'; 
    $shipped_id = $_REQUEST['shipped_id'];
    $shipQuery = mysqli_query($DB_CONNECT,"SELECT * FROM  track_shipping_tb WHERE shipping_method_id='$shipped_id' ");
    $fetShipp = mysqli_fetch_array($shipQuery);
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
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Container / Cargo Packed</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="add_container" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Contaner</a>
                    </div>
                </div>
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-border table-striped custom-table datatable mb-0">
								<thead>
									<tr>
										<th>Container-ID</th>
										<th>Container/Cargo Name</th>
										<th>Size</th>
                                        <th>Final Destination</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										$trackShipSql = mysqli_query($DB_CONNECT,"SELECT * FROM track_shipping_tb WHERE shipping_method_id='$shipped_id' ORDER BY track_shipping_id DESC");
										while ($tracShippFet = mysqli_fetch_array($trackShipSql)) {
											$conQury = mysqli_query($DB_CONNECT,"SELECT * FROM container_tb WHERE container_id='".$tracShippFet['container_id']."'");
											$contFet = mysqli_fetch_array($conQury);

                                            echo '
												<tr>
													<td>CTN-00'.$contFet['container_id'].'</td>
													<td>'.$contFet['container_name'].'</td>
													<td>'.$contFet['size'].'</td>
                                                    <td>'.$tracShippFet['final_destination'].'</td>
												</tr>
											';

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