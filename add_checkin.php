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
                    <div class="col-lg-8 offset-lg-2">
                        <a class="btn btn-danger" href="checkin">Back</a><h4 class="page-title">Add Ckeck-In</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <?php 
                            if (isset($_POST['add_check_item'])) {
                                $user_id = $userFet['user_id'];
                                $wrh_id = $_POST['wrh_id'];
                                $item_name = $_POST['item_name'];
                                $checkin_date = $_POST['checkin_date'];
                                $unit = $_POST['unit'];
                                $qty = $_POST['qty'];
                                $cost = $_POST['cost'];
                                $item_description = $_POST['item_description'];

                                $invinsQuery = mysqli_query($DB_CONNECT,"INSERT INTO `inventory_tb`(`user_id`, `warehouse_id`, `item_name`, `item_description`, `unit`, `in_qty`, `out_qty`, `cost`, `checkin_date`) VALUES (' $user_id','$wrh_id','$item_name','$item_description','$unit','$qty','$qty','$cost','$checkin_date')");

                                if ($invinsQuery) {
                                    ?>
                                    <script>
                                        alert("Item is succesfully Added");
                                        location.href = 'checkin';
                                    </script>
                                    <?php
                                    // echo "<meta http-equiv='refresh' content='0'>";
                                }else {
                                    echo 'Failed to Add Item' .mysqli_error($DB_CONNECT);
                                }
                            }
                        ?>
                        <form method="post" action="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Warehouse</label>
                                        <select class="form-control select" name="wrh_id" required>
                                            <option selected disabled>Select Warehouse</option>
                                            <?php 
                                                $warehouseSql = mysqli_query($DB_CONNECT,"SELECT * FROM warehouse_tb");
                                                while ($warehouseFet = mysqli_fetch_array($warehouseSql)) {
                                                    echo '<option value="'.$warehouseFet['id'].'">'.$warehouseFet['warehouse_name'].'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Item Name</label>
                                        <input class="form-control" name="item_name" type="text" required>
                                    </div>
                                </div> 
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Check-in Date</label>
                                        <div class="cal-icon">
                                            <input type="text" name="checkin_date" class="form-control datetimepicker" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Unit</label>
                                        <select class="form-control select" name="unit" required>
                                            <option selected disabled>Select Unit</option>
                                            <option>gram</option>
                                            <option>kilogram</option>
                                            <option>litter</option>
                                            <option>box</option>
                                            <option>piece</option>
                                            <option>dozen</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Quantity</label>
                                        <input class="form-control" name="qty" type="number" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Cost Per Item</label>
                                        <input class="form-control" name="cost" type="number" required>
                                    </div>
                                </div>
                                
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Item Description <span class="text-danger">*</span></label>
                                        <textarea class="form-control" rows="5" name="item_description" required></textarea>
                                    </div>
                                </div>

                            </div>
                            
                            <div class="m-t-20 text-center">
                                <button type="submit" name="add_check_item" class="btn btn-primary submit-btn">Add Item</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php include 'includes/notification.php'; ?>
        </div>


<?php include 'includes/footer.php'; ?>