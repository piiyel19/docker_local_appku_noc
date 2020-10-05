<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>APPKU cPANEL</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>shop_asset/login/css/my-login.css">

	<link href="<?= base_url()?>asset_cpanel/img/favicon.png" rel="icon">
	<link href="<?= base_url()?>asset_cpanel/img/favicon.png" rel="apple-touch-icon">
</head>

<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="" align="center" style="padding-top: 100px; padding-bottom: 40px;">
						<h4>Start Project</h4>
						<p>“Any fool can write code that a computer can understand. Good programmers write code that humans can understand.” </p>
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Menu Project</h4>
								<div class="row">
									<div class="col-md-12">
										<div class="row">
											<a href="<?= base_url()?>cpanel/creator">
												<div class="form-group row">
					                                <div class="col-md-4">
					                                	<div class="card" style="width: 18rem;">
														  <img class="card-img-top" src="https://zdnet4.cbsistatic.com/hub/i/r/2019/04/15/80b9225e-58bb-465f-b17f-d46cfda17fcc/thumbnail/570x322/5c7c926523232080be05c7020ccaa56f/programming-languages-developers-reveal-5caf2b6add173300b8a0f402-1-apr-15-2019-14-56-07-poster.jpg" alt="Card image cap" height="225px;">
														  <div class="card-body" style="    background: blanchedalmond;">
														    <p class="card-text"><b>Code Builder</b></p>
														  </div>
														</div>
					                                </div>
					                            </div>
					                        </a>
					                        <a href="<?= base_url()?>cpanel/add_developer">
					                            <div class="form-group row">
					                                <div class="col-md-4">
					                                	<div class="card" style="width: 18rem;">
														  <img class="card-img-top" src="https://blog.herzing.ca/hubfs/becoming%20a%20programmer%20analyst%20lead-1.jpg" alt="Card image cap" height="225px;">
														  <div class="card-body" style="background: seashell;">
														    <p class="card-text"><b>Add Developer</b></p>
														  </div>
														</div>
					                                </div>
					                            </div>
					                        </a>
					                        <a href="<?= base_url()?>dashboard">
					                            <div class="form-group row">
					                                <div class="col-md-4">
					                                	<div class="card" style="width: 18rem;">
														  <img class="card-img-top" src="https://galileosuite.com/wp-content/uploads/2018/05/shutterstock_345950657-min.jpg" alt="Card image cap" height="225px;">
														  <div class="card-body" style="background: azure;">
														    <p class="card-text"><b>Live Project</b></p>
														  </div>
														</div>
					                                </div>
					                            </div>
					                        </a>
				                        </div>
									</div>
								</div>


								<hr>
								<div class="col-md-12" style="padding-top: 30px; padding-bottom: 30px;">
				                    <div class="row">
				                      <div class="col-md-8"></div>
				                      <div class="col-md-4">
				                        <a href="<?= base_url()?>cpanel/logout"><button class="btn btn-success">Logout</button></a>
				                      </div>
				                    </div>
				                </div>

						</div>
					</div>
					<div class="footer">
						Copyright &copy; 2020 &mdash; Creator
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

<style type="text/css">
	.my-login-page .card-wrapper {
	    width: 900px;
	}
</style>