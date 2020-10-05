<section class="forms">
   <div class="container-fluid">
   <div class="row">
      <header style="padding-left: 18px;">
         <h1 class="h3 display">List Of CCTV</h1>
      </header>
      <div class="col-lg-12">
         <div class="card">
            <div class="card-header d-flex align-items-center">
               <h4>List CCTV</h4>
            </div>
            <div class="card-body">
               <div class="row">
                  <div class="col-md-10" style="padding-left: 0px;">
                     <form method="post" action="<?= base_url()?><?= $this->uri->segment(1)?>/<?= $this->uri->segment(2)?>" id="form_reset">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <div class="input-group">
                           <input type="text" class="form-control" name="search" id="btn_search" placeholder="Find Something" value="<?= $this->session->userdata('search')?>">
                           <input type="hidden" name="submit" value="submit">
                           <div class="input-group-btn">
                              <button class="btn btn-primary" type="submit">
                              <i class="material-icons">search</i>
                              </button>
                           </div>
                        </div>
                     </form>
                  </div>
                  <div class="col-md-2" style="padding-bottom: 10px; padding-right: 0px; padding-top: 30px;">
                     <a href="<?= base_url()?>Cctv/Cctv_add"><button class="btn btn-primary btn-block">Add CCTV</button></a>
                  </div>
                  <div class="table table-responsive">
                     <table class="table">
                        <thead class="thead-dark">
                           <tr>
                              <th>Name Of CCTV</th>
                              <th>Latitude</th>
                              <th>Longitude</th>
                              <th>Live Location</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <?php  foreach($result as $data){ ?>
                        <tbody>
                           <tr>
                              <td> 
                                 <?php 
                                    $cctv_name =  $data["cctv_name"]; 
                                    if (filter_var($cctv_name, FILTER_VALIDATE_URL)) {
                                    ?>
                                 <img src="<?= $data["cctv_name"]; ?>" style="width: 200px;">
                                 <?php
                                    } else {
                                    	echo $data["cctv_name"];
                                    }
                                    ?>
                              </td>
                              <td> 
                                 <?php 
                                    $latitude =  $data["latitude"]; 
                                    if (filter_var($latitude, FILTER_VALIDATE_URL)) {
                                    ?>
                                 <img src="<?= $data["latitude"]; ?>" style="width: 200px;">
                                 <?php
                                    } else {
                                    	echo $data["latitude"];
                                    }
                                    ?>
                              </td>
                              <td> 
                                 <?php 
                                    $longitude =  $data["longitude"]; 
                                    if (filter_var($longitude, FILTER_VALIDATE_URL)) {
                                    ?>
                                 <img src="<?= $data["longitude"]; ?>" style="width: 200px;">
                                 <?php
                                    } else {
                                    	echo $data["longitude"];
                                    }
                                    ?>
                              </td>
                              <td> 
                                 <?php 
                                    $location =  $data["location"]; 
                                    echo $data["location"];
                                    ?>
                              </td>
                              <td><a href="<?= base_url()?>Cctv/Cctv_view/<?= $data["id"]?>"><i class="fa fa-eye"></i></a> | <a href="<?= base_url()?>Cctv/Cctv_update/<?= $data["id"]?>"><i class="fa fa-edit"></i></a> | <a onclick="delete_item(<?= $data["id"]?>)" style="color: #ff9a18;"><i class="fa fa-trash"></i></a></td>
                           </tr>
                           <?php } ?>
                           <?php if(empty($result)){ ?>
                           <tr>
                              <td>No Data</td>
                              <td>No Data</td>
                              <td>No Data</td>
                              <td>No Data</td>
                              <td>No Data</td>
                           </tr>
                           <?php } ?>
                        </tbody>
                     </table>
                  </div>
                  <div style='margin-top: 30px; float: right; padding-right: 30px;'>
                     <?= $pagination; ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<script type="text/javascript">
   function delete_item(id)
   {
   	var r = confirm("Are you sure to delete ?");
   if (r == true) {
   
   var data =  {
                      "id":id, 
                      "<?php echo $this->security->get_csrf_token_name(); ?>" : "<?php echo $this->security->get_csrf_hash(); ?>"
              }
   
        $.ajax({
                    url: "<?= base_url() ?>Cctv/delete_item", 
                    type: "POST",
                    dataType: "html",
                    data: data,
                    beforeSend: function() {
                       
                    },
                    success: function(response){
   
                    	location.reload();
   
   		}
     });
   
   } else {
   
   }
   }
</script>
<style type="text/css">
   iframe{
   width: 200px;
   height: 200px;
   }
</style>