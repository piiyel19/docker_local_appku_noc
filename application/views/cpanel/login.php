<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>APPKU cPANEL</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>shop_asset/login/css/my-login.css">

	<!-- Favicons -->
	<link href="<?= base_url()?>asset_cpanel/img/favicon.png" rel="icon">
	<link href="<?= base_url()?>asset_cpanel/img/favicon.png" rel="apple-touch-icon">
</head>

<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="" align="center" style="padding-top: 100px; padding-bottom: 40px;">
						<h4>APPKU CPANEL</h4>
						<p>“Before software can be reusable it first has to be usable.”</p>
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Login</h4>
							<form method="POST" action="<?= base_url()?>cpanel/sso" >
								<div class="form-group">
									<label for="email">E-Mail Address</label>
									<input id="email" type="email" class="form-control" name="email" value="" required autofocus>
									<div class="invalid-feedback">
										Email is invalid
									</div>
								</div>

								<div class="form-group">
									<input id="password" type="password" class="form-control" name="password" required data-eye>
								    <div class="invalid-feedback">
								    	Password is required
							    	</div>
								</div>

								<div class="form-group">
									<div class="custom-checkbox custom-control">
										<input type="checkbox" name="remember" id="remember" class="custom-control-input">
										<label for="remember" class="custom-control-label">Remember Me</label>
									</div>
								</div>

								<div class="form-group m-0">
									<button type="submit" class="btn btn-primary btn-block">
										Login
									</button>
								</div>
							</form>
						</div>
					</div>
					<div class="footer">
						Copyright &copy; 2020 &mdash; APPKU
					</div>
				</div>
			</div>
		</div>
	</section>

	

	
</body>
</html>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js" integrity="sha512-WNLxfP/8cVYL9sj8Jnp6et0BkubLP31jhTG9vhL/F5uEZmg5wEzKoXp1kJslzPQWwPT1eyMiSxlKCgzHLOTOTQ==" crossorigin="anonymous"></script>

<?php $fb = $this->session->flashdata('feedback');?>
<?php if(!empty($fb)){ ?>

    <script type="text/javascript">
        $(document).ready(function (){
            var status = "<?= $fb['feedback'] ?>";
            alert(status);
        });
    </script>
    
<?php } ?>