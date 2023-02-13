<div class="header">
			<div class="header-left">
				<a href="index" class="logo">
					<img src="assets/img/logo-dark.PNG" width="135" alt=""> <span></span>
				</a>
			</div>
			<a id="toggle_btn" href="javascript:void(0);" style="color:black;"><i class="fa fa-bars"></i></a>
            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar" style="color:black;"><i class="fa fa-bars"></i></a>
            <ul class="nav user-menu float-right">
                
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img">
							<img class="rounded-circle" src="assets/img/profile/<?php echo $userFet['img']; ?>" width="24" alt="Admin">
							<span class="status online"></span>
						</span>
						<strong><?php echo $userFet['lastname']; ?></strong>
                    </a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="user_profile">My Profile</a>
						
						<a class="dropdown-item" href="logout">Logout</a>
					</div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" style="color:black;" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="user_profile">My Profile</a>
                    
                    <a class="dropdown-item" href="logout">Logout</a>
                </div>
            </div>
        </div>