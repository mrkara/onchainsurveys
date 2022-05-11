<!DOCTYPE html>
<html class="dark">
	<head>

		<!-- Basic -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">	

		<title>Onchain Surveys</title>	
 
		<base href="<?=base_url();?>">

		<meta name="keywords" content="Onchain Surveys, Blockchain" />
		<meta name="description" content="Onchain Surveys, Blockchain">
		<meta name="author" content="">

		<!-- Favicon -->
		<link rel="shortcut icon" href="assets/onchainsurveys/img/favicon.ico?v=1" type="image/x-icon" />
		<link rel="apple-touch-icon" href="assets/onchainsurveys/img/favicon.ico">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">

		<!-- Web Fonts  -->
		<link id="googleFonts" href="https://fonts.googleapis.com/css?family=family=Lora:400,400i,700,700i|Poppins:300,400,500,600,700,800,900&display=swap" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="assets/onchainsurveys/vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/onchainsurveys/vendor/fontawesome-free/css/all.min.css">
		<link rel="stylesheet" href="assets/onchainsurveys/vendor/animate/animate.compat.css">
		<link rel="stylesheet" href="assets/onchainsurveys/vendor/simple-line-icons/css/simple-line-icons.min.css">
		<link rel="stylesheet" href="assets/onchainsurveys/vendor/owl.carousel/assets/owl.carousel.min.css">
		<link rel="stylesheet" href="assets/onchainsurveys/vendor/owl.carousel/assets/owl.theme.default.min.css">
		<link rel="stylesheet" href="assets/onchainsurveys/vendor/magnific-popup/magnific-popup.min.css">

		<!-- Theme CSS -->
		<link rel="stylesheet" href="assets/onchainsurveys/css/theme.css">
		<link rel="stylesheet" href="assets/onchainsurveys/css/theme-elements.css">
		<link rel="stylesheet" href="assets/onchainsurveys/css/theme-blog.css">
		<link rel="stylesheet" href="assets/onchainsurveys/css/theme-shop.css">

		<!-- Demo CSS -->
		<link rel="stylesheet" href="assets/onchainsurveys/css/onchainsurveys.css?v=01_05">

		<!-- Skin CSS -->
		<link id="skinCSS" rel="stylesheet" href="assets/onchainsurveys/css/skin.css">

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="assets/onchainsurveys/css/custom.css">

		<!-- Global CSS -->
		<link rel="stylesheet" href="assets/onchainsurveys/css/global.css">


		<!-- Head Libs -->
		<script src="assets/onchainsurveys/vendor/modernizr/modernizr.min.js"></script>

		<!-- Sweet ALert  -->
		<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

		 
		<style>
			pre{font-size: 15px;}
			.form_error p {  color: #e41645 ;  margin: 0px; }

			/* anket tablolar */
			#all_surveys tr:hover,#my_survey tr:hover,#user_list tr:hover { cursor: pointer; }
			
			/* anket cevaplama label */
			label.form-check-label:hover {cursor: pointer;}

			/* anket sonuç seçenekler, harfler */ 
			.letter{ padding: 5px; }
			.selected-letter{ border: 2px solid red; border-radius: 50px; }

			/* formlarda zorunlar alanlar * işareti  */
			label.required:after{color: red;}

			select{
				background: url('assets/onchainsurveys/img/icons/br_down_white.webp') no-repeat 97% #fff;
			}


		</style>	


	</head>

	<?php 

		//pre($this->session->userdata());
 
	 ?>


	<body class="dark">

		<div class="body">
			<header id="header" class="header-transparent header-effect-shrink" data-plugin-options="{'stickyEnabled': true, 'stickyEffect': 'shrink', 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': false, 'stickyChangeLogo': false, 'stickyStartAt': 1, 'stickyHeaderContainerHeight': 100}">
				<div class="header-body border-top-0 bg-color-dark box-shadow-none">
					<div class="header-container container">
						<div class="header-row">
							<div class="header-column header-column-logo">
								<div class="header-row">
									<div class="header-logo">
										<a href="#home">
											<img alt="Onchain Surveys" width="139" height="59" src="assets/onchainsurveys/img/logo/onchaing_survey_logo_white.png">
										</a>
									</div>

								</div>
							</div>
							<div class="header-column header-column-nav-menu justify-content-end w-100">
								<div class="header-row">
									<div class="header-nav header-nav-links header-nav-dropdowns-dark header-nav-light-text order-2 order-lg-1">
										<div class="header-nav-main header-nav-main-mobile-dark header-nav-main-square header-nav-main-dropdown-no-borders header-nav-main-effect-2 header-nav-main-sub-effect-1">
											<nav class="collapse" id="menu">
 
												<ul class="nav nav-pills" id="mainNav">
  
													<li class="dropdown-primary">
														<a class="nav-link text-capitalize font-weight-semibold custom-text-3" href="javascript:"> 
															<div class="menu_wallet btn btn-outline custom-btn-outline btn-primary font-weight-semibold text-color-light bg-color-hover-primary text-3 btn-px-4" id="menu_wallet">
																<i class="fas fa-wallet"></i> 
															Connect Wallet
															</div>
															
														</a>
													</li>

													<li class="dropdown-primary">
														<a class="nav-link text-capitalize font-weight-semibold custom-text-3 " href="<?=base_url("home");?>"  >  <!-- active -->
 															Home
														</a>
													</li>
													
													<li class="dropdown-primary">
														<a class="nav-link text-capitalize font-weight-semibold custom-text-3" href="<?=base_url("#about_us");?>"  >
															About Us
														</a>
													</li>
													 
													
													<li class="dropdown">
														<a class="nav-link dropdown-toggle text-capitalize font-weight-semibold custom-text-3" class="dropdown-toggle" href="<?=base_url("user");?>" id="survey">
															Surveys
														</a>
														<ul class="dropdown-menu">
															 
															<li>
																<a class="dropdown-item font-weight-normal" href="<?=base_url("survey/all");?>">
																	All Surveys
																</a>
															</li>

															<li>
																<a class="dropdown-item font-weight-normal" href="<?=base_url("survey/open");?>" id="open_survey">
																	Open Surveys
																</a>
															</li>

															<?php if(is_login()){?>
																<li>
																	<a class="dropdown-item font-weight-normal" href="<?=base_url("survey/my_surveys");?>">
																		My Surveys
																	</a>
																</li>
															<?php } ?>
															<li>
																<a class="dropdown-item font-weight-normal" href="<?=base_url("survey/create");?>">
																	Create Survey
																</a>
															</li>

 
														</ul>
													</li>


													<?php if(is_login()){?>
													<li class="dropdown">
														<a class="nav-link dropdown-toggle text-capitalize font-weight-semibold custom-text-3" class="dropdown-toggle" href="<?=base_url("user");?>">
															Profile
														</a>
														<ul class="dropdown-menu">
															<li>
																<a class="dropdown-item font-weight-normal" href="<?=base_url("user");?>">
																	<?php echo $this->session->userdata('user_name'); ?>
																</a>
															</li>
															<li>
																<a class="dropdown-item font-weight-normal" href="<?=base_url("survey/my_surveys");?>">
																	My Surveys
																</a>
															</li>
															<li>
																<a class="dropdown-item font-weight-normal" href="survey/history">
																	Survey History 
																</a>
															</li>
 
														</ul>
													</li>

													<?php if(is_superUser()){?>
														<li class="dropdown">
														<a class="nav-link dropdown-toggle text-capitalize font-weight-semibold custom-text-3" class="dropdown-toggle" href="<?=base_url("user");?>" id="admin">
															Admin
														</a>
														<ul class="dropdown-menu" id="admin_dropdown">
															<li>
																<a class="dropdown-item font-weight-normal" href="<?=base_url("user/userlist");?>">
																	User List
 																</a>
															</li>
															<li>
																<a class="dropdown-item font-weight-normal" href="survey/approve" id="approve">
																	Approve Surveys
																</a>
															</li>

															<li>
																<a class="dropdown-item font-weight-normal" href="survey/rejected">
																	Rejected Surveys
																</a>
															</li>

 
														</ul>
													</li>
													<?php }?>
 
													<li class="dropdown-primary">
														<a class="nav-link text-capitalize font-weight-semibold custom-text-3" href="<?=base_url("user/logout");?>" id="logout">
															Logout
														</a>
													</li>

													<?php }else{?>
														<li class="dropdown-primary">
															<a class="nav-link text-capitalize font-weight-semibold custom-text-3" href="<?=base_url("user/login");?>" id="login">
																Login
															</a>
														</li>
													<?php } ?>
 
													
												</ul>
											</nav>
										</div>
										<button class="btn header-btn-collapse-nav" data-bs-toggle="collapse" data-bs-target=".header-nav-main nav">
											<i class="fas fa-bars"></i>
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</header>

			<div role="main" class="main">
 