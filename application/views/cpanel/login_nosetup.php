<!DOCTYPE html>
<html lang="en">
<head>
	<title>APPKU Create Project</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link href="<?= base_url()?>asset_cpanel/img/favicon.png" rel="icon">
	<link href="<?= base_url()?>asset_cpanel/img/favicon.png" rel="apple-touch-icon">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>asset_docker/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>asset_docker/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>asset_docker/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>asset_docker/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>asset_docker/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>asset_docker/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>asset_docker/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>asset_docker/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>asset_docker/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>asset_docker/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url('<?= base_url()?>asset_docker/images/bg-01.jpg');">
					<span class="login100-form-title-1">
						APPKU CREATE PROJECT
					</span>
				</div>

				<form action="<?= base_url()?>cpanel/create_project" method="post" class="login100-form validate-form">
					<div class="wrap-input100 validate-input m-b-26" data-validate="Project Name is required">
						<span class="label-input100">Project</span>
						<input class="input100" type="text" name="project_name" placeholder="Enter Project Name">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-26" data-validate="First Name is required">
						<span class="label-input100">First Name</span>
						<input class="input100" type="text" name="first_name" placeholder="Enter First Name">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-26" data-validate="Email is required">
						<span class="label-input100">Email</span>
						<input class="input100" type="email" name="email" placeholder="Enter Email">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="password" placeholder="Enter Password">
						<span class="focus-input100"></span>
					</div>

					<div class="flex-sb-m w-full p-b-30">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div>

					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Create Project
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
<!--===============================================================================================-->
	<script src="<?= base_url()?>asset_docker/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url()?>asset_docker/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url()?>asset_docker/vendor/bootstrap/js/popper.js"></script>
	<script src="<?= base_url()?>asset_docker/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url()?>asset_docker/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url()?>asset_docker/vendor/daterangepicker/moment.min.js"></script>
	<script src="<?= base_url()?>asset_docker/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url()?>asset_docker/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url()?>asset_docker/js/main.js"></script>

</body>
</html>