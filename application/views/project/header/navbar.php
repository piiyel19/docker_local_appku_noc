<?php if(($this->session->userdata('role')=='developer')|| ($this->session->userdata('role')=='Admin')){  ?>	
							<ul id="side-main-menu" class="side-menu list-unstyled"> 
								<li><a href="<?= base_url()?>Cctv/Cctv_list"> <i class="fa fa-camera"></i>CCTV</a></li>
							</ul><?php } ?>