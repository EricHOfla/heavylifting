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
                        <h4 class="page-title">Departiment</h4>
                    </div>
                    <!-- <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="add_dpt" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Contaner</a>
                    </div> -->
                </div>
				<div class="row">
					<div class="col-md-7">
						<div class="table-responsive">
							<table class="table table-border table-striped custom-table datatable mb-0">
								<thead>
									<tr>
										<th>No</th>
										<th>Departiment Name</th>
										<th>Head of departiment</th>
										<th class="text-right">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php 
                                        
                                        if (isset($_POST['edit_dpt'])) {
                                            $dpt_id = $_POST['dpt_id'];
                                            $upddpt_name = $_POST['upddpt_name'];
                                            $upddpt_head = $_POST['upddpt_head'];

                                            $upddptQuery = mysqli_query($DB_CONNECT,"UPDATE `dpt_tb` SET `dpt_name`='$upddpt_name',`dpt_head`='$upddpt_head' WHERE `dpt_id`='$dpt_id'");

                                            if ($upddptQuery) {
                                                ?>
                                                    <script>
                                                        alert("Departiment is succesfully Updated");
                                                    </script>
                                                    <?php
                                                    echo "<meta http-equiv='refresh' content='0'>";
                                            }else {
                                                echo 'Failed to Add Departiment' .mysqli_error($DB_CONNECT);
                                            }
                                        }
                                                                
										$dptSql = mysqli_query($DB_CONNECT,"SELECT * FROM dpt_tb ORDER BY dpt_id DESC");
                                        $count = 0;
										while ($dptFet = mysqli_fetch_array($dptSql)) {
                                            $count ++;
											echo '
												<tr>
													<td>'.$count.'</td>
													<td>'.$dptFet['dpt_name'].'</td>
													<td>'.$dptFet['dpt_head'].'</td>
													<td class="text-right">
														<div class="dropdown dropdown-action">
															<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
															<div class="dropdown-menu dropdown-menu-right">
																<a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_dpt_'.$dptFet['dpt_id'].'"><i class="fa fa-pencil-alt m-r-5"></i> Edit</a>
																
															</div>
														</div>
													</td>
												</tr>
											';

											?>
												<div id="edit_dpt_<?php echo $dptFet['dpt_id']; ?>" class="modal fade delete-modal" role="dialog">
													<div class="modal-dialog modal-dialog-centered">
														<div class="modal-content">
															<div class="modal-body">
																
																<form method="post">
                                                                    <input type="hidden" name="dpt_id" value="<?php echo $dptFet['dpt_id']; ?>">
                                                                    <div class="form-group">
                                                                        <label>Department Name <span class="text-danger">*</span></label>
                                                                        <select class="form-control select" name="upddpt_name" required="">
                                                                            <option><?php echo $dptFet['dpt_name']; ?></option>
                                                                            <option disabled></option>
                                                                            <option>Human Resource</option>
                                                                            <option>Administration</option>
                                                                            <option>IT Officer</option>
                                                                            <option>Software Engineer</option>
                                                                            <option>Reception</option>
                                                                            <option>Store Keeper</option>
                                                                        </select>
                                                                    </div>
                                                                
                                                                
                                                                    <div class="form-group">
                                                                        <label>Head of Departiment</label>
                                                                        <select class="form-control select" name="upddpt_head" required="">
                                                                            <option><?php echo $dptFet['dpt_head']; ?></option>
                                                                            <option disabled></option>
                                                                            <?php 
                                                                                $usrSql = mysqli_query($DB_CONNECT,"SELECT * FROM user_tb");
                                                                                while ($usr = mysqli_fetch_array($usrSql)) {
                                                                                    echo '<option>'.$usr['firstname'].' '.$usr['lastname'].'</option>';
                                                                                }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="m-t-20"> 
                                                                        <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                                                                        
                                                                        <button type="submit" name="edit_dpt" class="btn btn-primary" style="color:white;">Edit</button>
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
					<div class="col-md-5">
						<?php 
                            if (isset($_POST['add_dpt'])) {
                                $dpt_name = $_POST['dpt_name'];
                                $dpt_head = $_POST['dpt_head'];

                                $dptQuery = mysqli_query($DB_CONNECT,"INSERT INTO `dpt_tb`(`dpt_name`, `dpt_head`) VALUES ('$dpt_name','$dpt_head')");

                                if ($dptQuery) {
                                    ?>
                                        <script>
                                            alert("Departiment is succesfully Added");
                                        </script>
                                        <?php
										echo "<meta http-equiv='refresh' content='0'>";
                                }else {
                                    echo 'Failed to Add Departiment' .mysqli_error($DB_CONNECT);
                                }
                            }
                        ?>
                        <form method="post" action="">
                            
							<div class="form-group">
								<label>Department Name <span class="text-danger">*</span></label>
								<select class="form-control select" name="dpt_name" required="">
									<option selected disabled>Select Department</option>
									<option>Human Resource</option>
                                    <option>Administration</option>
                                    <option>IT Officer</option>
                                    <option>Software Engineer</option>
                                    <option>Reception</option>
                                    <option>Store Keeper</option>
								</select>
							</div>
						
						
							<div class="form-group">
								<label>Head of Departiment</label>
								<select class="form-control select" name="dpt_head" required="">
									<option selected disabled>Select</option>
									<?php 
										$usrSql = mysqli_query($DB_CONNECT,"SELECT * FROM user_tb");
										while ($usr = mysqli_fetch_array($usrSql)) {
											echo '<option>'.$usr['firstname'].' '.$usr['lastname'].'</option>';
										}
									?>
								</select>
							</div>
                            
                                
                            <div class="m-t-20 text-center">
                                <button type="submit" name="add_dpt" class="btn btn-primary submit-btn">Add Departiment</button>
                            </div>
                        </form>
					</div>
                </div>
            </div>
			
            <?php include 'includes/notification.php'; ?>
        </div>


<?php include 'includes/footer.php'; ?>