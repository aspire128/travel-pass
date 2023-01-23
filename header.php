<?php
    session_start();
    if(!isset($_SESSION['username']))
        header("Location: login.php");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>AdminLTE 3 | Starter</title>
		<!-- Google Font: Source Sans Pro -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
		<!-- Font Awesome Icons -->
		<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="dist/css/adminlte.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
        <!-- Select2 -->
        <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
        <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
	</head>
	<body class="hold-transition sidebar-mini">
		<div class="wrapper">
			<!-- Navbar -->
			<nav class="main-header navbar navbar-expand navbar-white navbar-light">
				<!-- Left navbar links -->
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
					</li>
				</ul>
				<!-- Right navbar links -->
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link" data-widget="fullscreen" href="#" role="button">
						<i class="fas fa-expand-arrows-alt"></i>
						</a>
					</li>
				</ul>
			</nav>
			<!-- /.navbar -->
			<!-- Main Sidebar Container -->
			<aside class="main-sidebar sidebar-dark-primary elevation-4">
				<!-- Brand Logo -->
				<a href="admin.php" class="brand-link">
				<span class="brand-text font-weight-light">TRAVEL PASS</span>
				</a>
				<!-- Sidebar -->
				<div class="sidebar">
					<!-- Sidebar user panel (optional) -->
					<div class="user-panel mt-3 pb-3 mb-3 d-flex">
						<div class="image">
							<img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
						</div>
						<div class="info">
							<a href="#" class="d-block"><?php echo "$_SESSION[firstname] $_SESSION[lastname]";?></a>
						</div>
					</div>
					<!-- Sidebar Menu -->
					<nav class="mt-2">
						<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
							<!-- Add icons to the links using the .nav-icon class
								with font-awesome or any other icon font library -->
                            <li class="nav-item">
								<a href="travelApplications.php" class="nav-link">
									<i class="nav-icon fas fa-car"></i>
									<p>
										Travel Applications
									</p>
								</a>
							</li>
                            <?php if($_SESSION["usertype"] == "System Administrator"){ ?>
                                <li class='nav-item'>
                                    <a href='municipalities.php' class='nav-link'>
                                        <i class='nav-icon fas fa-home'></i>
                                        <p>Municipalities</p>
                                    </a>
                                </li>
                                <li class='nav-item'>
                                    <a href='status_requirements.php' class='nav-link'>
                                        <i class='nav-icon fas fa-list'></i>
                                        <p>Status Requirements</p>
                                    </a>
                                </li>
                                <li class='nav-item'>
                                    <a href='systemUsers.php' class='nav-link'>
                                        <i class='nav-icon fas fa-users'></i>
                                        <p>System Users</p>
                                    </a>
                                </li>
                            <?php } ?>
                            <li class="nav-item">
								<a href="actions.php?logout=1" class="nav-link">
									<i class="nav-icon fas fa-power-off"></i>
									<p>
										Log-Out
									</p>
								</a>
							</li>
						</ul>
					</nav>
					<!-- /.sidebar-menu -->
				</div>
				<!-- /.sidebar -->
			</aside>