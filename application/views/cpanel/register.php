<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>APPKU SETUP</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>shop_asset/login/css/my-login.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
						<p>Login as Customer you can buy with cheapest price</p>
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Set Login Page</h4>
							<form method="POST" action="<?= base_url()?>cpanel/setup_register" class="my-login-validation" novalidate="">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group row" onclick="set_fields('Multiple Checkboxes'); return false;">
			                                <label class="col-md-4 col-form-label">User Register</label>
			                                <div class="col-md-8">
			                                    <div class="checkbox">
			                                        <label for="checkboxes-0">
			                                            <input type="checkbox" name="first_name" id="first_name" value="1">
			                                            First Name
			                                        </label>
			                                    </div>
			                                    <div class="checkbox">
			                                        <label for="checkboxes-0">
			                                            <input type="checkbox" name="last_name" id="last_name" value="1">
			                                            Last Name
			                                        </label>
			                                    </div>
			                                    <div class="checkbox">
			                                        <label for="checkboxes-1">
			                                            <input type="checkbox" name="phone_number" id="phone_number" value="1">
			                                            Phone Number
			                                        </label>
			                                    </div>
			                                    <div class="checkbox">
			                                        <label for="checkboxes-1">
			                                            <input type="checkbox" name="address" id="address" value="1">
			                                            Address
			                                        </label>
			                                    </div>
			                                    <div class="checkbox">
			                                        <label for="checkboxes-1">
			                                            <input type="checkbox" name="avatar" id="avatar" value="1">
			                                            Upload Avatar
			                                        </label>
			                                    </div>
			                                    <div class="checkbox">
			                                        <label for="checkboxes-1">
			                                            <input type="checkbox" name="user_id" id="user_id" value="1">
			                                            User ID
			                                        </label>
			                                    </div>
			                                    <div class="checkbox">
			                                        <label for="checkboxes-1">
			                                            <input type="checkbox" name="" id="" value="2" checked="checked" disabled>
			                                            Email
			                                        </label>
			                                    </div>
			                                    <div class="checkbox">
			                                        <label for="checkboxes-1">
			                                            <input type="checkbox" name="" id="" value="2" checked="checked" disabled>
			                                            Password
			                                        </label>
			                                    </div>
			                                </div>
			                            </div>
									</div>
								</div>
								<hr>
								<div class="form-group row">
									<div class="col-md-12" id="">
					                    <div class="row">
					                      <div class="col-md-4">
					                        <label class="col-form-label">Add Role </label>
					                      </div>
					                      <div class="col-md-4">
					                        <input type="text" class="form-control" name="role" id="role" placeholder="Label">
					                      </div>
					                      <div class="col-md-2">
					                        <button class="btn btn-primary" onclick="add_role(); return false;">Add</button>
					                      </div>
					                    </div>
					               	</div>


					               	<div class="col-md-12" id="" style="padding-top: 30px;">
					                    <div class="row">
					                      <div class="col-md-12">

					                      	<table class="table">
											  <thead>
											    <tr>
											      <th scope="col">Role</th>
											      <th scope="col">Action</th>
											    </tr>
											  </thead>
											  <tbody id="data_role">

											  </tbody>
											</table>

					                      </div>
					                    </div>
					                </div>



								</div>


								<hr>
								<div class="col-md-12" style="padding-top: 30px; padding-bottom: 30px;">
				                    <div class="row">
				                      <div class="col-md-8"></div>
				                      <div class="col-md-4">
				                        <button class="btn btn-success" onclick="create_field();">Next Step</button>
				                      </div>
				                    </div>
				                </div>

							</form>
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
	    width: 800px;
	}
</style>


<script type="text/javascript">
	function add_role()
	{
		var url_go = "<?= base_url()?>cpanel/";
		var role = $("#role").val();

		if(role==''){

		} else {

			var data = 
	              {
	                  'role':role,
	                  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
	              }

	              
		    $.ajax({
		            url: url_go+'add_role',
		            type: 'POST',
		            dataType: 'html',
		            data: data,
		            beforeSend: function() {
		               // alert('Sila Tunggu');

		            },
		            success: function(response){
		            	$("#role").val('');
		            	call_role();
		            }
		    });

		}
	}

	function call_role()
	{
		var url_go = "<?= base_url()?>cpanel/";
		var data = 
	              {
	                  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
	              }

	              
		    $.ajax({
		            url: url_go+'call_role',
		            type: 'POST',
		            dataType: 'html',
		            data: data,
		            beforeSend: function() {
		               // alert('Sila Tunggu');

		            },
		            success: function(response){
		            	$("#data_role").html(response);
		            }
		    });
	}

	function delete_role(id)
	{
		var url_go = "<?= base_url()?>cpanel/";
		var data = 
	              {
	              	  'id':id,
	                  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
	              }

	              
		    $.ajax({
		            url: url_go+'delete_role',
		            type: 'POST',
		            dataType: 'html',
		            data: data,
		            beforeSend: function() {
		               // alert('Sila Tunggu');

		            },
		            success: function(response){
		            	call_role();
		            }
		    });
	}

	$(document).ready(function (){
		call_role();
	});
</script>