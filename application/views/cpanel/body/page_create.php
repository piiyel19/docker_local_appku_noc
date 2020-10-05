<div class="breadcrumb-holder">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="">Main Page</a></li>
      <li class="breadcrumb-item active">Page Create</li>
    </ul>
  </div>
</div>




<form action="<?= base_url()?>cpanel/create_extra_page" method="post" enctype="multipart/form-data">
  <section class="forms">
    <div class="container-fluid">
      <div class="row">


        <div class="col-lg-12" style="padding-top: 30px;">
          <div class="card">
            <div class="card-header">
              <h4>Page Create</h4>
            </div>
            <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <label>File Name</label>
                    <input type="type" class="form-control" name="name_function" id="name_function" required onkeyup="check_name_controller();" onkeypress="return event.charCode != 32">
                    <span id="alert_controller"></span>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label>Description</label>
                    <textarea class="form-control" name="name_description" id="name_description" cols="5" rows="5" required></textarea>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <label>Code Editor</label>
                    <textarea class="form-control" name="code_editor" id="code_editor" cols="20" rows="20" required></textarea>
                  </div>
                  
                </div>
                <span style="float: right; padding-top: 30px; padding-bottom: 30px;">
                  <button class="btn btn-primary" onclick="save();">Create Page</button></span>
                </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</form>


<script type="text/javascript">
  function check_name_controller()
  {
    var controller_name = $("#name_function").val();

    var data = 
                    {   'controller_name':controller_name,
                        '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
                    }

                    
                    $.ajax({
                            url: '<?= base_url() ?>cpanel/check_name_controller',
                            type: 'POST',
                            dataType: 'html',
                            data: data,
                            beforeSend: function() {
                               // alert('Sila Tunggu');
                               $("#alert_controller").hide();
                            },
                            success: function(response){

                                if(response>0){
                                  $("#alert_controller").show();
                                  //alert('Existing Naming Of Function');
                                  $("#alert_controller").html('<span style="color:red">* You naming is exiting on your system. Auto replaced your text.</red>');
                                } else {
                                  check_name_page();
                                }
                            }
                    });

  }


  function check_name_page()
  {
    var controller_name = $("#name_function").val();

    var data = 
                    {   'controller_name':controller_name,
                        '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
                    }

                    
                    $.ajax({
                            url: '<?= base_url() ?>cpanel/check_name_page',
                            type: 'POST',
                            dataType: 'html',
                            data: data,
                            beforeSend: function() {
                               // alert('Sila Tunggu');
                               $("#alert_controller").hide();
                            },
                            success: function(response){

                                if(response>0){
                                  $("#alert_controller").show();
                                  //alert('Existing Naming Of Function');
                                  $("#alert_controller").html('<span style="color:red">* You naming is exiting on your system. Auto replaced your text.</red>');
                                } else {
                                  $("#alert_controller").html('');
                                }
                            }
                    });
  }
</script>