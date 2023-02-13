<?php 
    include 'includes/head.php'; 

    $inventoryID = $_REQUEST['inventoryID'];

    $invsql = mysqli_query($DB_CONNECT,"SELECT * FROM inventory_tb WHERE inventory_id='$inventoryID' ");
    $invFet = mysqli_fetch_array($invsql);

    $checkoutinvsql = mysqli_query($DB_CONNECT,"SELECT * FROM inventory_cheout_tb WHERE inventory_id='".$invFet['inventory_id']."' ");
    $checkoutinvFet = mysqli_fetch_array($checkoutinvsql);

    $warhQury = mysqli_query($DB_CONNECT,"SELECT * FROM warehouse_tb WHERE id='".$invFet['warehouse_id']."'");
    $warhFet = mysqli_fetch_array($warhQury);

    $sum = $invFet['cost'] * $invFet['out_qty'];

    $qty_remain = $invFet['in_qty'] - $checkoutinvFet['out_qty'];

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
                        <a href="container" class="btn btn-danger" href="checkout">Back</a>
                        <h4 class="page-title">Add Container</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <?php 
                            if (isset($_POST['add_container'])) {
                                $user_id = $userFet['user_id'];
                                $container_name = $_POST['container_name'];
                                $warehouse_id = $_POST['warehouse_id'];
								$size = $_POST['size'];
                                $type = $_POST['type'];

                                $continsQuery = mysqli_query($DB_CONNECT,"INSERT INTO `container_tb`(`user_id`, `container_name`, `warehouseId`,`size`,`status`,`type`) VALUES ('$user_id','$container_name','$warehouse_id','$size','Not Full','$type')");

                                if ($continsQuery) {
                                    ?>
                                        <script>
                                            alert("Container is succesfully Added");
                                            location.href="container";
                                        </script>
                                        <?php
                                }else {
                                    echo 'Failed to Add Container' .mysqli_error($DB_CONNECT);
                                }
                            }
                        ?>
                        <form method="post" action="">
                            
							<div class="form-group">
								<label>Container/Cargo Name <span class="text-danger">*</span></label>
								<input class="form-control" name="container_name" type="text" required>
							</div>
						
						
							<div class="form-group">
								<label>Warehouse</label>
								<select class="form-control select" name="warehouse_id" required>
									<option selected disabled>Select Warehouse</option>
									<?php 
										$warehouseSql = mysqli_query($DB_CONNECT,"SELECT * FROM warehouse_tb");
										while ($warehouseFet = mysqli_fetch_array($warehouseSql)) {
											echo '<option value="'.$warehouseFet['id'].'">'.$warehouseFet['warehouse_name'].'</option>';
										}
									?>
								</select>
							</div>
                            <div class="form-group">
								<label>Type</label>
								<select class="form-control select" name="type" required>
									<option selected disabled>Select Type</option>
									<option>Container</option>
                                    <option>Cargo</option>
								</select>
							</div>

							<div class="form-group">
								<label>Size <span class="text-danger">*</span></label>
								<input class="form-control" name="size" type="text" required>
							</div>
                            
                                
                            <div class="m-t-20 text-center">
                                <button type="submit" name="add_container" class="btn btn-primary submit-btn">Add Container</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php include 'includes/notification.php'; ?>
        </div>


<?php include 'includes/footer.php'; ?>