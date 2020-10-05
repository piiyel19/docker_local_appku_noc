<div class="breadcrumb-holder">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="">Data Management</a></li>
      <li class="breadcrumb-item active">Upload Data</li>
    </ul>
  </div>
</div>



<section class="forms">
    <div class="container-fluid">
      <div class="row">


        <div class="col-lg-12" style="padding-top: 30px;">
          <div class="card">
            <div class="card-header">
              <p>Please Download Sample & Use Sample Excel To Upload <a href="<?= base_url()?>cpanel/single_data/<?=$this->uri->segment(3)?>" style="float: right"><button class="btn btn-primary" >Sample Excel</button></a></p>
            </div>
            <div class="card-body">
            	<form action="<?= base_url()?>cpanel/direct_data" method="post" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-4">
                  		
                  		<input type="hidden" name="tbl" value="<?= $this->uri->segment(3);?>">
						<input type="file" name="uploadFile" id="uploadFile" class="form-control">
						<input type="hidden" name="submit" value="submit" >
						
					
                  </div>
                  <div class="col-md-2">
                  	<button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>