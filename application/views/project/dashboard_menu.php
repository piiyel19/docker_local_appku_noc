<?php if(($this->session->userdata('role')=='developer')|| ($this->session->userdata('role')=='Admin')){  ?>
							<div class="col-md-12">
						  	<div class="card">
							    <div class="card-header">
							      <a class="card-link" data-toggle="collapse" href="#collapse100">
							         CCTV
							      </a>
							    </div>
						    <div id="collapse100" class="collapse show" data-parent="#accordion">
						    <div class="card-body">
						  <a href='<?= base_url()?>Cctv/Cctv_Cctv_list'> <i class="fa fa-angle-right"></i> CCTV</a> <br>			
					     	  	</div>
							    </div>
							  </div>
							</div>
				     	  <?php } ?>