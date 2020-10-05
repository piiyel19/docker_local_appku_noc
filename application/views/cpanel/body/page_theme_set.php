<div class="breadcrumb-holder">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="">Main Page</a></li>
      <li class="breadcrumb-item active">Set Theme</li>
    </ul>
  </div>
</div>





<section class="forms">
  <div class="container-fluid">
    <div class="row">


      <div class="col-lg-12" style="padding-top: 30px;">
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <h4>Free Theme</h4>
          </div>
          <div class="card-body">
              <div class="row">
                <div class="col-md-4">
                  <div class="card">

                    <img src="<?= base_url()?>template/cover/Captivate.png" width="100%">

                    <div class="card-body">
                      <h5 class="card-title">Captivate Theme</h5>
                      <a onclick="set_theme('Captivate_Theme');" class="btn btn-primary" style="color: #fff">Set Theme</a>
                    </div>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="card" >
                    <img src="<?= base_url()?>template/cover/source.png" width="100%">
                    <div class="card-body">
                      <h5 class="card-title">Source Theme</h5>
                      <a onclick="set_theme('Source_Theme');" class="btn btn-primary" style="color: #fff">Set Theme</a>
                    </div>
                  </div>
                </div>


                <div class="col-md-4">
                  <div class="card" >
                    <img src="<?= base_url()?>template/cover/save_poor.png" width="100%">
                    <div class="card-body">
                      <h5 class="card-title">Save Poor Theme</h5>
                      <a onclick="set_theme('Save_Poor_Theme');" class="btn btn-primary" style="color: #fff">Set Theme</a>
                    </div>
                  </div>
                </div>


                <div class="col-md-4">
                  <div class="card" >
                    <img src="<?= base_url()?>template/cover/medpill.png" width="100%">
                    <div class="card-body">
                      <h5 class="card-title">Medpill Theme</h5>
                      <a onclick="set_theme('Medpill_Theme');" class="btn btn-primary" style="color: #fff">Set Theme</a>
                    </div>
                  </div>
                </div>


                <div class="col-md-4">
                  <div class="card" >
                    <img src="<?= base_url()?>template/cover/corpo.png" width="100%">
                    <div class="card-body">
                      <h5 class="card-title">Corpo Theme</h5>
                      <a onclick="set_theme('Corpo_Theme');" class="btn btn-primary" style="color: #fff">Set Theme</a>
                    </div>
                  </div>
                </div>


                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



<script type="text/javascript">
  function set_theme(theme)
  {
    var data =  {
                    "theme":theme, //declare variable dalam data 
                    "<?php echo $this->security->get_csrf_token_name(); ?>" : "<?php echo $this->security->get_csrf_hash(); ?>"
            }

    $.ajax({
                url: "<?= base_url() ?>Cpanel/set_theme_proceed", 
                type: "POST",
                dataType: "html",
                data: data,
                beforeSend: function() {
                   
                },
                success: function(response){
                  alert('Success set theme !');
                }
          });
  }
</script>