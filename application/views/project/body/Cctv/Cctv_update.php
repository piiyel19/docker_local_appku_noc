
<form action="<?=base_url()?>Cctv/update_Cctv_submit/<?= $this->uri->segment(3)?>" method="POST">
		  				<section class="forms">
						    <div class="container-fluid">
						      <div class="row">

						        <header style="padding-left: 18px;"> 
						          <h1 class="h3 display">Update CCTV Information</h1>
						        </header>

						        <div class="col-lg-12">
						          <div class="card">
						            <div class="card-header d-flex align-items-center">
						              <h4>Update Data</h4>
						            </div>
						            <div class="card-body">
						            	<div class="row">
		  			
								
					                <div class="col-md-4" draggable="true">
					                  <label>Name Of CCTV</label>
					                  <input type="text" class="form-control" name="cctv_name" id="cctv_name" placeholder="Name Of CCTV" required>
					                </div>
					            
					            

							 
								
					                <div class="col-md-4" draggable="true">
					                  <label>Latitude</label>
					                  <input type="text" class="form-control" name="latitude" id="latitude" placeholder="Latitude" required>
					                </div>
					            
					            

							 
								
					                <div class="col-md-4" draggable="true">
					                  <label>Longitude</label>
					                  <input type="text" class="form-control" name="longitude" id="longitude" placeholder="Longitude" required>
					                </div>
					            
					            

							 
								
					                <div class="col-md-8" draggable="true">
					                  <label>Embed Code CCTV</label>
					                  <textarea class="form-control" id="location" name="location" placeholder="Embed Code CCTV" cols="5" rows="5" required></textarea>
					                </div>
					       
					            

							 	
	  				<div class="col-lg-12" style="padding-top: 30px; padding-bottom: 30px;">
	  					<input type="hidden" name="id_form" value="2004216172"><div style="float: right"><button class="btn btn-primary" type="submit">Submit</div>
	  				</div>					


	  								</div>
		  					 </div>
							</div>
						  </div>
						</div>
					</section>
	  				</form>

							<script type="text/javascript">
						   		$(document).ready(function (){
						   			var id = "<?= $this->uri->segment(3)?>";
			
									var data =  {
									                    "id":id, //declare variable dalam data 
									                    "<?php echo $this->security->get_csrf_token_name(); ?>" : "<?php echo $this->security->get_csrf_hash(); ?>"
									            }

							        $.ajax({
							                    url: "<?= base_url() ?>Cctv/Cctv_details", 
							                    type: "POST",
							                    dataType: "json",
							                    data: data,
							                    beforeSend: function() {
							                       
							                    },
							                    success: function(response){

							                    	$("#cctv_name").val(response.cctv_name);$("#latitude").val(response.latitude);$("#longitude").val(response.longitude);$("#location").val(response.location);

												}
										  });
						   		});
						   </script>

					  