

									<!DOCTYPE html>
									<html lang="en">
									<head>
										<meta charset="utf-8">
										<meta name="author" content="Kodinger">
										<meta name="viewport" content="width=device-width,initial-scale=1">
										<title>Creator</title>
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
															<h4>Register To System</h4>
															<p>“Experience is the name everyone gives to their mistakes.”</p>
														</div>
														<div class="card fat">
															<div class="card-body">
																<h4 class="card-title">Set Login Page</h4>
								
								<form method="POST" action="https://creator_lynx.appku.my/register/register_user" enctype="multipart/form-data">
							
						<div class="row">
							<div class="col-md-12">
								
						<div class="">
                            <label for="">Role</label>
                            <select class="form-control" name="role" id="role" required>
                            	<option value="Admin">Admin</option>
                            	<option value='User'>User</option>
                            </select>
                        </div>
					
							<div class="">
                                <label for="">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" required>
                            </div>
					     
								<div class="">
	                                <label for="">Password</label>
	                                    <input type="password" class="form-control" name="password" id="password" required>
	                            </div>
							
									<div class="">
                                        <label for="">First Name</label>
                                            <input type="text" class="form-control" name="first_name" id="first_name" required>
                                    </div>
								  
								<div class="">
                                    <label for="">User Photo</label>
                                        <input type="file" class="form-control" name="avatar" id="avatar" required>
                                </div>
							  
						<div class="col-md-12" style="padding-top: 30px; padding-bottom: 30px;">
		                    <div class="row">
		                      <div class="col-md-8"></div>
		                      <div class="col-md-4">
		                        <button class="btn btn-success" type="submit">Create</button>
		                      </div>
		                    </div>
		                </div>
					  
							</div>
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
								