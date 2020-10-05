

		  				<section class="forms">
						    <div class="container-fluid">
						      <div class="row">

						        <header style="padding-left: 18px;"> 
						          <h1 class="h3 display">Live Camera Location</h1>
						        </header>

						        <div class="col-lg-12">
						          <div class="card">
						            <div class="card-header d-flex align-items-center">
						              <h4 id="cctv_name"></h4>
						            </div>
						            <div class="card-body">
						            	<div class="row">
		  			
								
					            
					            

							 
					            

							 
								
					                <div class="col-md-12" draggable="true" id="location">
					                </div>
					       
					            

							 					


	  								</div>
		  					 </div>
							</div>
						  </div>
						</div>
					</section>
	  				

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

							                    	$("#cctv_name").html(response.cctv_name);
							                    	// $("#latitude").val(response.latitude);
							                    	// $("#longitude").val(response.longitude);
							                    	$("#location").html(response.location);

												}
										  });
						   		});
						   </script>


<style type="text/css">
   iframe{
   width: 100%;
   height: 500px;
   }
</style>
					  