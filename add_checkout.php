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
                        <a class="btn btn-success" href="checkin">Check-In</a>
                        <a class="btn btn-danger" href="checkout">Check-Out</a>
                        <h4 class="page-title">Make A Check-Out</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <?php 
                            if (isset($_POST['add_checkout_item'])) {
                                $user_id = $userFet['user_id'];
                                $inventoryID = $_POST['wrh_id'];
                                $out_qty = $_POST['out_qty'];
                                $checkout_date = $_POST['checkout_date'];
                                $out_note = $_POST['out_note'];
                                $qty_remain1 = $invFet['in_qty'] - $checkoutinvFet['out_qty'];
                                $qtyout = $qty_remain1 - $out_qty;

                                if ($out_qty > $invFet['in_qty']) {
                                    ?>
                                    <script>
                                        alert("Check-Out Quantity is Greater than Available Quantity");
                                    </script>
                                    <?php
                                    echo "<meta http-equiv='refresh' content='0'>";
                                }else {
                                    $invqtyqury = mysqli_query($DB_CONNECT,"UPDATE `inventory_tb` SET `out_qty`='$qtyout' WHERE `inventory_id`='".$invFet['inventory_id']."' ");

                                    $invoutinsQuery = mysqli_query($DB_CONNECT,"INSERT INTO `inventory_cheout_tb`(`user_id`, `inventory_id`, `out_qty`, `description`, `checkout_date`) VALUES ('$user_id','".$invFet['inventory_id']."','$out_qty','$out_note','$checkout_date')");

                                    if ($invqtyqury == true && $invoutinsQuery == true) {
                                        
                                        ?>
                                        <script>
                                            alert("Check-Out is succesfully");
                                            location.href = 'checkout';
                                        </script>
                                        <?php
                                        // echo "<meta http-equiv='refresh' content='0'>";
                                    }else {
                                        echo 'Failed to Check-Out' .mysqli_error($DB_CONNECT);
                                    }
                                }
                            }
                        ?>
                        <form method="post" action="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Warehouse</label>
                                        <input class="form-control" value="<?php echo $warhFet['warehouse_name'] ?>" type="text" disabled>
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Item</label>
                                        <input class="form-control" value="<?php echo $invFet['item_name'] ?>" type="text" disabled>
                                    </div>
                                </div> 
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Remain Qty</label>
                                        <input type="text" value="<?php echo number_format($invFet['out_qty']); ?>" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Cost</label>
                                        <input type="text" value="<?php echo number_format($invFet['cost']) ?>" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Inventory Value</label>
                                        <input type="text" value="<?php echo number_format($sum) ?>" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Check-In Date</label>
                                        <input type="text" value="<?php echo $invFet['checkin_date']; ?>" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Item Description <span class="text-danger">*</span></label>
                                        <textarea class="form-control" rows="3" name="item_description" disabled><?php echo $invFet['item_description']; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Check-Out Quantity</label>
                                        <input class="form-control" name="out_qty" type="number" required>
                                    </div>
                                </div> 

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Check-out Date</label>
                                        <div class="cal-icon">
                                            <input type="text" name="checkout_date" class="form-control datetimepicker" required>
                                        </div>
                                    </div>
                                </div> 
                                
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Check-out Note <span class="text-danger">*</span></label>
                                        <textarea class="form-control" rows="5" name="out_note" required></textarea>
                                    </div>
                                </div>

                            </div>
                            
                            <div class="m-t-20 text-center">
                                <button type="submit" name="add_checkout_item" class="btn btn-danger submit-btn">Make Check-Out</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php include 'includes/notification.php'; ?>
        </div>


<?php include 'includes/footer.php'; ?>