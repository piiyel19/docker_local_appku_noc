
						<!DOCTYPE html>
						<html>
						  <head>
						    <meta charset="utf-8">
						    <meta http-equiv="X-UA-Compatible" content="IE=edge">
						    <title><?= project_name()?></title>
						    <meta name="description" content="">
						    <meta name="viewport" content="width=device-width, initial-scale=1">
						    <meta name="robots" content="all,follow">

						  </head>

						<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
						<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
						<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
						<!------ Include the above in your HEAD tag ---------->

						 <body>

						<div class="container">
						<br>  <p class="text-center"><b><?= project_name()?></b> | <a href="<?= base_url()?>login/logout"> <b>Logout</b></a></p>
						<hr>

						<div class="row" style="padding-bottom:30px;">
				  <?php if(($this->session->userdata('role')=='developer')|| ($this->session->userdata('role')=='Admin')){  ?>
								<aside class="col-sm-4" style="padding-bottom:30px;">
									<p><b>Module : CCTV</b></p>
										<div class="card">
											
							<img class="card-img-top" src="https://creator_lynx.appku.my/source/all_file/f0e89fce716facb8c058fdad48e7cb65.jpg" alt="Card image cap">
						  

											<div class="card-body">
											    <p class="card-text">Register CCTV for monitoring</p>
											</div>
											<ul class="list-group list-group-flush">
						  <li class='list-group-item'><a href='<?= base_url()?>Cctv/Cctv_list'> <i class="fa fa-angle-right"></i>Manage CCTV</a><a href='<?= base_url()?>map' style="float:right"> <i class="fa fa-angle-right"></i> LIVE</a></li>			
					     	  		</ul>
								</div>
							</aside>
				     	  <?php } ?>

						</div>
						</div> 
						</body>
						</html>
				  