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
                        <h4 class="page-title">User</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="add-user" class="btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add User</a>
                    </div>
                </div>
				<div class="row doctor-grid">
                    <?php 
                        $userQu = mysqli_query($DB_CONNECT,"SELECT * FROM user_tb");
                        while ($userFetch = mysqli_fetch_array($userQu)) {
                            if ($userFetch['user_status'] == 'Ristricted') {
                                $stat = '<div class="doc-prof badge badge-danger" style="color:white;">'.$userFetch['user_status'].'</div>';
                            }else{
                                $stat = '<div class="doc-prof badge badge-success" style="color:white;">'.$userFetch['user_status'].'</div>';
                            }
                            echo '
                                <div class="col-md-4 col-sm-4  col-lg-3">
                                    <div class="profile-widget">
                                        <div class="doctor-img">
                                            <a class="avatar"><img alt="" src="assets/img/profile/'.$userFetch['img'].'"></a>
                                        </div>
                                        <div class="dropdown profile-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="edit-user-profile?user_profile_id='.$userFetch['user_id'].'"><i class="fas fa-pencil-alt m-r-5"></i> Edit</a>
                                                
                                            </div>
                                        </div>
                                        <h4 class="doctor-name text-ellipsis"><a >'.$userFetch['firstname'].' '.$userFetch['lastname'].'</a></h4>
                                        <div class="doc-prof">'.$userFetch['position'].'</div>
                                        Access: '.$stat.'
                                        <div class="user-country">
                                            <i class="fa fa-map-marker"></i> '.$userFetch['address'].'
                                        </div>
                                    </div>
                                </div>
                            ';
                        }
                    ?>

                </div>
				
            </div>
			
            <?php include 'includes/notification.php'; ?>
        </div>


<?php include 'includes/footer.php'; ?>