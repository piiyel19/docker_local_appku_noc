<div class="breadcrumb-holder">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="">Home</a></li>
      <li class="breadcrumb-item active">Forms</li>
    </ul>
  </div>
</div>



<section class="forms">
    <div class="container-fluid">
      <div class="row">

        <header style="padding-left: 18px;"> 
          <h1 class="h3 display">Setup Helper</h1>
        </header>

        <div class="col-lg-12">
          <div class="card">
            <div class="card-header d-flex align-items-center">
              <h4>Add Lookup Helper</h4>
            </div>
            <div class="card-body">
              <p>Lorem ipsum dolor sit amet consectetur.</p>
                <form action="<?= base_url()?>cpanel/create_lookup_helper" method="post">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>* Table Name</label>
                        <select class="form-control" onchange="get_column_table();" id="table" name="table" required>
                          <option value="">-- Table Name --</option>
                          <?= lookup_table()?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>* Column Name</label>
                        <select class="form-control" name="column" id="column" required>
                          <option value="">-- Column Name --</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>* Validate By</label>
                        <select class="form-control" onchange="validate_by_2();" name="validate_by" id="validate_by">
                          <option value="">Not Set</option>
                          <option value="Session">Session</option>
                          <option value="Segment">Segment</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-3 segment_div" style="display: none;">
                      <label>Where Segment</label>
                      <input type="number" name="segment_url" id="segment_url" class="form-control" placeholder="Where Segment">
                    </div>

                    <div class="col-md-3 segment_div" style="display: none;">
                      <label>Column Segment</label>
                      <select class="form-control" name="segment_column" id="segment_column">
                        <option value="">Select Column Segment</option>
                      </select>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label>* Function Name</label>
                        <input type="text" class="form-control" name="function_name" id="function_name" onkeyup="check_function_name();" onkeypress="return event.charCode != 32" required>
                        <span id="alert_function_name"></span>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <button class="btn btn-primary" style="float: right">Add Data</button>
                    </div>

                  </div>
                </form>
            </div>
          </div>
        </div>


        <header style="padding-left: 18px;"> 
          <h1 class="h3 display">List Helper</h1>
        </header>

        <div class="col-lg-12">
          <div class="card">
            <div class="card-header d-flex align-items-center">
              <h4>Module Creator</h4>
            </div>
            <div class="card-body">
              <div class="row">


                  <div class="col-md-10" style="padding-left: 0px; padding-bottom: 30px;">
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
                  <div class="col-md-2" style="padding-bottom: 10px; padding-right: 0px;">
                   
                  </div>

                <table class="table">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col">Table Name</th>
                      <th scope="col">Column Name</th>
                      <th scope="col">Validate By</th>
                      <th scope="col">Function Name</th>
                    </tr>
                  </thead>
                  <tbody id="table_list">
                    <?php  foreach($result as $data){ ?>
                      <tr>
                        <td> <?= $data["table_name"] ?></td>
                        <td> <?= $data["column_name"] ?></td>
                        <td> <?= $data["validate_by"] ?></td>
                        <td> <?= $data["function_name"] ?></td>
                      </tr>
                    <?php } ?>
                    <?php if(empty($result)){ ?>
                    <tr>
                      <td>No Data</td>
                      <td>No Data</td>
                      <td>No Data</td>
                      <td>No Data</td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>

                <div style='margin-top: 30px; float: right; padding-right: 30px;'>
                  <?= $pagination; ?>
                </div>

              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
</section>



<script type="text/javascript">
  function get_column_table()
  {
    var table = $("#table").val();

    if(table==''){
      $("#column").html('<option value="">Select Column</option>');
      $("#segment_column").html('<option value="">Select Column</option>');
    } else {

      var data = 
                      {   'table':table,
                          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
                      }

                      
                      $.ajax({
                              url: '<?= base_url() ?>cpanel/get_column_table',
                              type: 'POST',
                              dataType: 'html',
                              data: data,
                              beforeSend: function() {
                                 
                              },
                              success: function(response){
                                $("#column").html('<option value="">Select Column</option>'+response);
                                $("#segment_column").html('<option value="">Select Column Segment</option>'+response);
                              }
                      });

    }
  }


  function validate_by_2()
  {
    var validate_by = $("#validate_by").val();
    if(validate_by=='Segment'){
      $(".segment_div").show();
      $("#segment_url").prop('required',true);
      $("#segment_column").prop('required',true);
    } else {
      $(".segment_div").hide();
      $("#segment_url").prop('required',false);
      $("#segment_column").prop('required',false);
    }

  }
</script>



<script type="text/javascript">
  function check_function_name()
  {
    var function_name = $("#function_name").val();

    var data = 
                    {   'function_name':function_name,
                        '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
                    }

                    
                    $.ajax({
                            url: '<?= base_url() ?>cpanel/check_function_name_helper',
                            type: 'POST',
                            dataType: 'html',
                            data: data,
                            beforeSend: function() {
                               // alert('Sila Tunggu');
                               $("#alert_1").hide();
                            },
                            success: function(response){

                                if(response>0){
                                  alert('Existing Naming Of Function');
                                  $("#alert_function_name").html('<span style="color:red">* You naming is exiting on your system.</red>');
                                } else {
                                  $("#alert_function_name").html('');
                                }
                            }
                    });
  }
</script>