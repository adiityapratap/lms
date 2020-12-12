<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Zouki East</title>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
	<!-- google font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>assets/css/ionicons.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>assets/css/simple-line-icons.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>assets/css/jquery.mCustomScrollbar.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/css/responsive.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
	
</head>
<body>
	<div class="wrapper">
		<!-- header -->
		<header class="main-header">
			<div class="container_header">
				<div class="logo d-flex align-items-center">
					<a href="<?php echo base_url();?>index.php/general/login/show_option"><span class="logo-default"> <img src="<?php echo base_url();?>assets/images/logo.png" alt=""> </span> </a>
					<div class="icon_menu full_menu">
						<a href="#" class="menu-toggler sidebar-toggler"></a>
					</div>
				</div>
				<div class="right_detail">
					<div class="row d-flex align-items-center min-h pos-md-r">
						<div class="col-xl-12 col-9 d-flex justify-content-end">
							<div class="right_bar_top d-flex align-items-center">
								<div class="navigation scroll_auto">
									<ul id="dc_accordion" class="sidebar-menu tree">
										<li class="menu_sub">
											<a href="<?php echo base_url();?>index.php/orders/open_dash"> <i class="fa fa-home"></i> <span>Dashboard</span></a>
										</li>
										<li class="menu_sub">
											<a href="#"> <i class="fa fa-shopping-cart"></i> <span>Orders </span> <span class="arrow"></span> </a>
											<ul class="down_menu">
												<li>
													<a href="<?php echo base_url();?>index.php/orders/new_order_customer_details">Place Orders</a>
												</li>
												<li>
													<a href="<?php echo base_url();?>index.php/orders/order_history">View Orders</a>
												</li>
													<li>
													<a href="<?php echo base_url();?>index.php/orders/myoborders">Maroondah  Orders</a>
												</li>
												<li>
													<a href="<?php echo base_url();?>index.php/orders/standing_orders">Standing Orders</a>
												</li>
												<li>
													<a href="<?php echo base_url();?>index.php/orders/past_orders">Past Orders</a>
												</li>
												<li>
													<a href="<?php echo base_url();?>index.php/orders/reports">Reports</a>
												</li>
											</ul>
										</li>
										<li class="menu_sub">
											<a href="#"> <i class="fa fa-ticket"></i> <span>Coupons</span> <span class="arrow"></span> </a>
											<ul class="down_menu">
												<li>
													<a href="<?php echo base_url();?>index.php/orders/active_coupons">Active</a>
												</li>
												<li>
													<a href="<?php echo base_url();?>index.php/orders/archived_coupons">Archived</a>
												</li>
											</ul>
										</li>
										
										<li class="menu_sub">
											<a href="#"> <i class="fa fa-ticket"></i> <span>Categories</span> <span class="arrow"></span> </a>
											<ul class="down_menu">
											    
									    <li class="menu_sub">
											<a href="<?php echo base_url();?>index.php/products/categories"> <i class="fa fa-cutlery"></i> <span>Main Category</span></a>
										</li>
										<li class="menu_sub">
											<a href="<?php echo base_url();?>index.php/products/subcategory"> <i class="fa fa-cutlery"></i> <span>Sub Category</span></a>
										</li>
										
										<li class="menu_sub">
											<a href="<?php echo base_url();?>index.php/products/subsubcategory"> <i class="fa fa-cutlery"></i> <span>Sub-Sub Category</span></a>
										</li>
										
											</ul>
										</li>

										<li class="menu_sub">
											<a href="<?php echo base_url();?>index.php/general/products"> <i class="fa fa-cutlery"></i> <span>Products</span></a>
										</li>
										
									
										<li class="menu_sub">
											<a href="<?php echo base_url();?>index.php/general/customers"> <i class="fa fa-users"></i> <span>Customers</span></a>
										</li>
										<li class="menu_sub">
											<a href="<?php echo base_url();?>index.php/general/logout"> <i class="fa fa-sign-out"></i> <span>Logout</span></a>
										</li>
											
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			
		</header>