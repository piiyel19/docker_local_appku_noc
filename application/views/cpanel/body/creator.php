<div class="breadcrumb-holder">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="">Home</a></li>
      <li class="breadcrumb-item active">Creator</li>
    </ul>
  </div>
</div>




<form action="<?= base_url()?>cpanel/create_file" method="post" enctype="multipart/form-data">
  <section class="forms">
    <div class="container-fluid">
      <div class="row">

        <header style="padding-left: 18px;"> 
          <h1 class="h3 display">Configuration Database</h1>
        </header>

        <div class="col-lg-12">
          <div class="card">
            <div class="card-header d-flex align-items-center">
              <h4>Database</h4>
            </div>
            <div class="card-body">
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>* Table Name</label>
                      <input type="text" placeholder="" id="tbl" name="tbl" class="form-control" required onkeypress="return event.charCode != 32" onkeyup="data_show_list();">
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>


        <header style="padding-left: 18px;"> 
          <h1 class="h3 display">Configuration Controller</h1>
        </header>

        <div class="col-lg-12">
          <div class="card">
            <div class="card-header d-flex align-items-center">
              <h4>Module Creator</h4>
            </div>
            <div class="card-body">
            
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>* Module</label>
                      <input type="text" placeholder="" class="form-control" name="module" id="module" required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">       
                      <label>* Sub Module</label>
                      <input type="text" placeholder="" class="form-control" name="sub_module" id="sub_module" required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">       
                      <label>* Function Name</label>
                      <input type="text" placeholder="" class="form-control" name="controller_name" id="controller_name" required onkeypress="return event.charCode != 32" onkeyup="check_name_controller();">
                      <span id="alert_controller" style="font-size: 12px;"></span>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">       
                      <label>* Description</label>
                      <textarea class="form-control" id="description" name="description" required></textarea>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Upload Image Module</label>
                      <input type="file" placeholder="" class="form-control" name="module_avatar" id="module_avatar">
                    </div>
                  </div>


                </div>

                <hr>
                <div class="row">
                    <label class="col-md-2 col-form-label">Update Menu & Dashboard</label>
                    <div class="col-md-8">
                        <div class="radio">
                            <label for="radios-0">
                                <input type="radio" name="navbar_show" id="navbar_show-0" value="show" checked="checked">
                                Show
                            </label>
                        </div>
                        <div class="radio">
                            <label for="radios-1">
                                <input type="radio" name="navbar_show" id="navbar_show-1" value="not_show">
                                Not Show
                            </label>
                        </div>
                    </div>
                </div>


                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Icon (<a href="https://www.w3schools.com/icons/icons_reference.asp" target="_blank">Find at Font-Awesome</a>)</label>
                      <input class="form-control" name="icon" id="icon"></input>
                    </div>
                  </div>
                </div>


             
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header d-flex align-items-center">
              <h4>Set Item</h4>
            </div>
            <div class="card-body">
           
                
              <div class="row">
                <div class="col-md-6">
                  <div class="tabbable">
                    <ul class="nav nav-tabs" id="formtabs">
                        <!-- Tab nav -->
                      <li class="nav-item"><a class="nav-link p-1 active" href="#input" data-toggle="tab" aria-expanded="true">Input</a></li>
                      <li class="nav-item"><a class="nav-link p-1" href="#radioscheckboxes" data-toggle="tab" aria-expanded="false">Radios / Checkboxes</a></li>
                      <li class="nav-item"><a class="nav-link p-1" href="#select" data-toggle="tab" aria-expanded="false">Select</a></li>
                    </ul>

                    
                    <fieldset>
                      <div class="tab-content" style="padding-top: 30px;">
                          
                          <p>Note : You just click what field on left site and setting on right site.</p>
                          <div class="tab-pane active" id="input" aria-expanded="false">
                            <div class="component">
                              <div class="form-group row" onclick="set_fields('Text'); return false;">
                                  <label class="col-md-4 col-form-label" for="textinput">Text Input</label>
                                  <div class="col-md-8">
                                      <input aria-describedby="textinputHelpBlock" id="textinput" name="textinput" type="text" placeholder="placeholder" class="form-control input-md" disabled>
                                  </div>
                              </div>
                              <div class="form-group row" onclick="set_fields('Number'); return false;">
                                  <label class="col-md-4 col-form-label" for="textinput">Number Input</label>
                                  <div class="col-md-8">
                                      <input aria-describedby="textinputHelpBlock" id="textinput" name="textinput" type="number" placeholder="placeholder" class="form-control input-md" disabled>
                                  </div>
                              </div>
                              <div class="form-group row" onclick="set_fields('Email'); return false;">
                                  <label class="col-md-4 col-form-label" for="textinput">Email Input</label>
                                  <div class="col-md-8">
                                      <input aria-describedby="textinputHelpBlock" id="textinput" name="textinput" type="text" placeholder="placeholder" class="form-control input-md" disabled>
                                  </div>
                              </div>
                              <div class="form-group row" onclick="set_fields('Password'); return false;">
                                  <label class="col-md-4 col-form-label" for="textinput">Password Input</label>
                                  <div class="col-md-8">
                                      <input aria-describedby="textinputHelpBlock" id="textinput" name="textinput" type="text" placeholder="placeholder" class="form-control input-md" disabled>
                                  </div>
                              </div>
                              <div class="form-group row" onclick="set_fields('Textarea'); return false;">
                                  <label class="col-md-4 col-form-label" for="textarea">Text Area</label>
                                  <div class="col-md-8">
                                      <textarea class="form-control" id="textarea" name="textarea" disabled>default text</textarea>
                                  </div>
                              </div>
                              <div class="form-group row" onclick="set_fields('File'); return false;">
                                  <label class="col-md-4 col-form-label" for="textinput">Input File</label>
                                  <div class="col-md-8">
                                      <input aria-describedby="textinputHelpBlock" id="textinput" name="textinput" type="file" placeholder="placeholder" class="form-control input-md" disabled>
                                  </div>
                              </div>
                              <div class="form-group row" onclick="set_fields('Date'); return false;">
                                  <label class="col-md-4 col-form-label" for="textinput">Date</label>
                                  <div class="col-md-8">
                                      <input aria-describedby="textinputHelpBlock" id="textinput" name="textinput" type="text" placeholder="placeholder" class="form-control input-md" disabled>
                                  </div>
                              </div>
                            </div>
                          </div>


                          <div class="tab-pane" id="radioscheckboxes" aria-expanded="false">
                            <div class="component">

                              <div class="form-group row" onclick="set_fields('Multiple Radio'); return false;">
                                  <label class="col-md-4 col-form-label">Multiple Radios</label>
                                  <div class="col-md-8">
                                      <div class="radio">
                                          <label for="radios-0">
                                              <input type="radio" name="radios" id="radios-0" value="1" checked="checked" disabled>
                                              Option one
                                          </label>
                                      </div>
                                      <div class="radio">
                                          <label for="radios-1">
                                              <input type="radio" name="radios" id="radios-1" value="2" disabled>
                                              Option two
                                          </label>
                                      </div>
                                  </div>
                              </div>

                              <div class="form-group row" onclick="set_fields('Inline Radio'); return false;">
                                  <label class="col-md-4 col-form-label">Inline Radios</label>
                                  <div class="col-md-8">
                                      <label class="radio-inline" for="radios-0">
                                          <input type="radio" name="radios" id="radios-0" value="1" checked="checked" disabled>
                                          1
                                      </label>
                                      <label class="radio-inline" for="radios-1">
                                          <input type="radio" name="radios" id="radios-1" value="2" disabled>
                                          2
                                      </label>
                                      <label class="radio-inline" for="radios-2">
                                          <input type="radio" name="radios" id="radios-2" value="3" disabled>
                                          3
                                      </label>
                                      <label class="radio-inline" for="radios-3">
                                          <input type="radio" name="radios" id="radios-3" value="4" disabled>
                                          4
                                      </label>
                                  </div>
                              </div>


                              <div class="form-group row" onclick="set_fields('Multiple Checkboxes'); return false;">
                                  <label class="col-md-4 col-form-label">Multiple Checkboxes</label>
                                  <div class="col-md-8">
                                      <div class="checkbox">
                                          <label for="checkboxes-0">
                                              <input type="checkbox" name="checkboxes" id="checkboxes-0" value="1" disabled>
                                              Option one
                                          </label>
                                      </div>
                                      <div class="checkbox">
                                          <label for="checkboxes-1">
                                              <input type="checkbox" name="checkboxes" id="checkboxes-1" value="2" disabled>
                                              Option two
                                          </label>
                                      </div>
                                  </div>
                              </div>



                              <div class="form-group row" onclick="set_fields('Inline Checkboxes'); return false;">
                                <label class="col-md-4 col-form-label">Inline Checkboxes</label>
                                <div class="col-md-8">
                                  <label class="checkbox-inline" for="checkboxes-0">
                                    <input type="checkbox" name="checkboxes" id="checkboxes-0" value="1" disabled>
                                    1
                                  </label>
                                  <label class="checkbox-inline" for="checkboxes-1">
                                    <input type="checkbox" name="checkboxes" id="checkboxes-1" value="2" disabled>
                                    2
                                  </label>
                                  <label class="checkbox-inline" for="checkboxes-2">
                                    <input type="checkbox" name="checkboxes" id="checkboxes-2" value="3" disabled>
                                    3
                                  </label>
                                  <label class="checkbox-inline" for="checkboxes-3">
                                    <input type="checkbox" name="checkboxes" id="checkboxes-3" value="4" disabled>
                                    4
                                  </label>
                                </div>
                              </div>

                            </div>
                          </div>



                          <div class="tab-pane" id="select" aria-expanded="false">
                            <div class="component">
                              <div class="form-group row" onclick="set_fields('Dropdown'); return false;">
                                  <label class="col-md-4 col-form-label" for="selectbasic">Dropdown</label>
                                  <div class="col-md-8">
                                      <select id="selectbasic" name="selectbasic" class="form-control" disabled>
                                          <option value="1">Option one</option>
                                          <option value="2">Option two</option>
                                      </select>
                                  </div>
                              </div>
                            </div>
                          </div>


                    </fieldset>
                    

                  </div>
                </div>
                <div class="col-md-6">
                  <div class="">
                    <div class="col-md-12">
                      <label><b>Field Type : <span id="field_selected"></span> </b></label>
                    </div>
                    <div class="col-md-4">
                      <label>* ID/Name</label>
                      <input type="text" class="form-control" name="id_name" id="id_name" onkeypress="return event.charCode != 32" onkeyup="check_id_name();">
                      <span id="alert_id_name"></span>
                    </div>
                    <div class="col-md-4">
                      <label>* Label</label>
                      <input type="text" class="form-control" name="label" id="label">
                    </div>
                    <div class="col-md-4">
                      <label>* Placeholder</label>
                      <input type="text" class="form-control" name="placeholder" id="placeholder">
                    </div>
                    <div class="col-md-4">
                      <label class="checkbox-inline" for="checkboxes-0">
                        <input type="checkbox" name="required_field" id="required_field" value="" onclick="select_required_field();"> Required
                      </label>
                    </div>

                    <div class="col-md-4">
                      <label class="checkbox-inline" for="checkboxes-0">
                        <input type="checkbox" name="break_line" id="break_line" value="" onclick="select_break_line();"> Break Line
                      </label>
                    </div>

                    <hr>

                    <div class="col-md-4" id="div_add_data" style="display: none">
                      <div class="row">
                        <div class="col-md-12">
                          <label><b>Add Data </b></label>
                        </div>
                        <div class="col-md-10">
                          <input type="text" class="form-control" name="id_data" id="id_data" placeholder="Label">
                        </div>
                        <div class="col-md-2">
                          <button class="btn btn-primary" onclick="add_data_to_fields();return false;">Add</button>
                        </div>
                      </div>
                    </div>


                    <div class="col-md-4" style="padding-top: 30px; padding-bottom: 30px; display: none" id="div_data_set">
                      <div class="row">
                        <div class="col-md-12">

                          <table class="table">
                            <thead class="thead-dark">
                              <tr>
                                <th scope="col">ID Name</th>
                                <th scope="col">Data</th>
                                <th scope="col">Remove</th>
                              </tr>
                            </thead>
                            <tbody id="table_list_data">
                              <tr>
                                <th scope="row">No Data</th>
                                <td>No Data</td>
                                <td>No Data</td>
                              </tr>
                            </tbody>
                          </table>

                        </div>
                      </div>
                    </div>

                    <div class="col-md-4" style="display: none" id="div_data_lookup">
                        <div class="col-md-4">
                          <label class="checkbox-inline" for="checkboxes-0">
                            <input type="checkbox" name="dt_lookup" id="dt_lookup" value="" onclick="select_data_lookup();"> Using Data Lookup
                          </label>
                        </div>
                    </div>

                    <div id="action_data_lookup" style="display: none">
                      <div class="col-md-4">
                        <label>Data Lookup</label>
                        <select class="form-control" name="id_data_lookup" id="id_data_lookup">
                          <option value="">--Select Data Lookup --</option>
                          <?= lookup_helper_name()?>
                        </select>
                      </div>
                    </div>


                    <div class="col-md-12" style="padding-top: 30px; padding-bottom: 30px;">
                      <div class="row">
                        <div class="col-md-4">
                          <button class="btn btn-primary" onclick="create_field();return false;">Create Field</button>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>

        <hr>

        <div class="col-lg-12">
          <div class="card">
            <div class="card-header d-flex align-items-center">
              <h4>List <span>Item</span></h4>
            </div>
            <div class="card-body">

              <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Type</th>
                    <th scope="col">Label</th>
                    <th scope="col">ID Name</th>
                  </tr>
                </thead>
                <tbody id="table_list">
                  <tr>
                    <th scope="row">No Data</th>
                    <td>No Data</td>
                    <td>No Data</td>
                    <td>No Data</td>
                  </tr>
                </tbody>
              </table>

            </div>
          </div>
        </div>


        <header style="padding-left: 18px;"> 
          <h1 class="h3 display">Configuration File</h1>
        </header>

        <div class="col-lg-12">
          <div class="card">
            <div class="card-header d-flex align-items-center">
              <h4>Set <span>Role</span></h4>
            </div>
            <div class="card-body">
              

              <div class="row" style="padding-top: 30px; padding-bottom: 30px;">
                <div class="col-md-12">
                  <label><b>Add Role </b></label>
                </div>
                <div class="col-md-10">
                  <select class="form-control" name="role" id="role">
                    <option value="">-- Set Permission --</option>
                    <?= get_role()?>
                  </select>
                </div>
                <div class="col-md-2">
                  <button class="btn btn-primary" onclick="add_role();return false;">Add</button>
                </div>
              </div>

              <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Role</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody id="table_role">
                  <tr>
                    <th scope="row">No Data</th>
                    <td>No Data</td>
                  </tr>
                </tbody>
              </table>

            </div>
          </div>
        </div>

        


        <div class="col-lg-12">
          <div class="card">
            <div class="card-header d-flex align-items-center">
              <h4>API Data</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <label class="col-md-12 col-form-label">Do you want to create an API for this module ?</label>
                    <div class="col-md-12">
                        <div class="radio">
                            <label for="radios-0">
                                <input type="radio" name="api" id="api-0" value="No" checked="checked">
                                No
                            </label>
                        </div>
                        <div class="radio">
                            <label for="radios-1">
                                <input type="radio" name="api" id="api-1" value="Yes">
                                Yes
                            </label>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>


        <div class="col-lg-12">
          <div class="card">
            <div class="card-header d-flex align-items-center">
              <h4>Functional</h4>
            </div>
            <div class="card-body">

              <div class="form-group row">
                  <label class="col-md-2 col-form-label">Insert</label>
                  <div class="col-md-2">
                      <div class="radio">
                          <label for="radios-0">
                              <input type="radio" name="insert" id="radios-0" value="insert" checked="checked">
                              Insert
                          </label>
                      </div>
                      <div class="radio">
                          <label for="radios-0">
                              <input type="radio" name="insert" id="radios-0" value="no_insert">
                              No Insert
                          </label>
                      </div>
                  </div>
              </div>


              <hr>

              <div class="form-group row">
                  <label class="col-md-2 col-form-label">Update</label>
                  <div class="col-md-2">
                      <div class="radio">
                          <div class="radio">
                          <label for="radios-0">
                              <input type="radio" name="update" id="radios-0" value="update" checked="checked">
                              Update
                          </label>
                      </div>
                      <div class="radio">
                          <label for="radios-0">
                              <input type="radio" name="update" id="radios-3" value="no_update">
                              No Update
                          </label>
                      </div>
                      </div>
                  </div>
              </div>

              <hr>

              <div class="form-group row">
                  <label class="col-md-2 col-form-label">List</label>
                  <div class="col-md-2">
                      <div class="radio">
                          <label for="radios-0">
                              <input type="radio" name="list" id="radios-0" value="list" checked="checked">
                              List
                          </label>
                      </div>
                      <div class="radio">
                          <label for="radios-1">
                              <input type="radio" name="list" id="radios-1" value="list_w_delete">
                              List With Delete
                          </label>
                      </div>
                      <div class="radio">
                          <label for="radios-0">
                              <input type="radio" name="list" id="radios-3" value="no_list">
                              No List
                          </label>
                      </div>
                  </div>
              </div>


              <div class="form-group row col-md-6">
                <table class="table">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col">Show</th>
                      <th scope="col">Item</th>
                    </tr>
                  </thead>
                  <tbody id="table_show_list">
                    <tr>
                      <th scope="row">No Data</th>
                      <td>No Data</td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <input type="hidden" name="id_form" id="id_form" value="<?= rand()?>">


              <div class="form-group" style="padding-top: 30px; padding-bottom: 30px; float: right">       
                <input type="submit" value="Build" class="btn btn-primary">
              </div>

            </div>
          </div>
        </div>




      </div>
    </div>
  </section>
</form>

<style type="text/css">
  .container {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    /*gap: 10px;*/
  }

  .box {
    /*border: 3px solid #666;*/
    /*background-color: #ddd;*/
    border-radius: .5em;
    /*padding: 10px;*/
    cursor: move;
    width: 100%;
  }

  .col-md-4 {
      -ms-flex: 0 0 33.333333%;
      flex: 0 0 33.333333%;
      max-width: 103.333333%;
  }


</style>

<script type="text/javascript">
function save_view()
{
  var code = $("#view_display").html();
  alert(code);
}
</script>


<!-- <script src="<?= base_url()?>creator_code/builder.js"></script> -->





<script type="text/javascript">
  function add_role()
  {
    var url_go = "<?= base_url()?>cpanel/";
    var role = $("#role").val();
    var id_form = $("#id_form").val();

    if(role==''){

    } else {

      var data = 
                {
                    'role':role,
                    'id_form':id_form,
                    '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
                }

                
        $.ajax({
                url: url_go+'add_role_creator',
                type: 'POST',
                dataType: 'html',
                data: data,
                beforeSend: function() {
                   // alert('Sila Tunggu');

                },
                success: function(response){
                  $("#role").val('');
                  alert('Success Add Permission Role');
                  call_role();
                }
        });

    }
  }

  function call_role()
  {
    var url_go = "<?= base_url()?>cpanel/";
    var id_form = $("#id_form").val();

    var data = 
                {
                    'id_form':id_form,
                    '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
                }

                
        $.ajax({
                url: url_go+'call_role_creator',
                type: 'POST',
                dataType: 'html',
                data: data,
                beforeSend: function() {
                   // alert('Sila Tunggu');

                },
                success: function(response){
                  $("#table_role").html(response);
                }
        });
  }

  function delete_role(id)
  {
    var id_form = $("#id_form").val();
    var url_go = "<?= base_url()?>cpanel/";
    var data = 
                {
                    'id':id,
                    'id_form':id_form,
                    '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
                }

                
        $.ajax({
                url: url_go+'delete_role_creator',
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




<script type="text/javascript">
  function set_fields(type)
{
  //alert(type);
  $("#field_selected").html(type);
  create_fields(type);

} 


function create_fields(type)
{
 //alert(type);
  if((type=='Multiple Radio')||(type=='Inline Radio')||(type=='Multiple Checkboxes')||(type=='Inline Checkboxes')){
    $("#div_add_data").show();
    $("#div_data_set").show();
    $("#div_data_lookup").hide();
  } else if(type=='Dropdown'){
    $("#div_add_data").hide();
    $("#div_data_set").hide();
    $("#div_data_lookup").show();
  } else {
    $("#div_add_data").hide();
    $("#div_data_set").hide();
    $("#div_data_lookup").hide();
  }
}



function select_data_lookup()
{
  var dt_lookup = $("#dt_lookup").val();
  if(dt_lookup=='1'){
    $("#action_data_lookup").hide();
    $("#div_add_data").hide();
    $("#dt_lookup").val(0);
    $("#div_data_set").hide();
  } else {
    $("#action_data_lookup").show();
    $("#div_add_data").hide();
    $("#dt_lookup").val(1);
    $("#div_data_set").hide();
  }
}



function select_required_field()
{
  var required_field = $("#required_field").val();
  if(required_field=='1'){
    $("#required_field").val(0);
  } else {
    $("#required_field").val(1);
  }
}


function select_break_line()
{
  var break_line = $("#break_line").val();
  if(break_line=='1'){
    $("#break_line").val(0);
  } else {
    $("#break_line").val(1);
  }
}


function create_field()
{
  var type_field = $("#field_selected").html();
  var id_name = $("#id_name").val();
  var label = $("#label").val();
  var placeholder = $("#placeholder").val();
  var required_field = $("#required_field").val();
  var break_line = $("#break_line").val();
  var dt_lookup = $("#dt_lookup").val();

  var id_form = $("#id_form").val();

  var tbl = $("#tbl").val();


  var id_data_lookup = $("#id_data_lookup").val();


  var protocol = window.location.protocol;
  // var url_go = protocol+'//'+document.domain+'/cpanel/';
  var url_go = "<?= base_url()?>cpanel/";

  if((type_field=='')||(id_name=='')||(label=='')||(tbl=='')){

    alert('Please fill up required * fields');

  } else {

    var data = 
              {
                  'type_field':type_field,
                  'id_name':id_name,
                  'label':label,
                  'placeholder':placeholder,
                  'required_field':required_field,
                  'break_line':break_line,
                  'dt_lookup':dt_lookup,
                  'id_form':id_form,
                  'tbl':tbl,
                  'id_data_lookup':id_data_lookup,
                  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
              }

              
    $.ajax({
            url: url_go+'create_field',
            type: 'POST',
            dataType: 'html',
            data: data,
            beforeSend: function() {
               // alert('Sila Tunggu');

            },
            success: function(response){
                data_show_list();
                alert('Success add fields');
                field_html();

                $("#field_selected").html('');
                $("#id_name").val('');
                $("#label").val('');
                $("#placeholder").val('');


                var $this = $("#required_field");
                if ($this.is(":checked"))
                {
                    $("#required_field").trigger('click');
                }


                var $this = $("#break_line");
                if ($this.is(":checked"))
                {
                    $("#break_line").trigger('click');
                }



                var $this = $("#dt_lookup");
                if ($this.is(":checked"))
                {
                    $("#dt_lookup").trigger('click');
                } 


                $("#id_data_lookup").val('');
               
            }
    });

  }
  
}



function field_html()
{
  var protocol = window.location.protocol;
  // var url_go = protocol+'//'+document.domain+'/cpanel/';
  var url_go = "<?= base_url()?>cpanel/";

  var id_form = $("#id_form").val();
  var data = 
              {
                  'id_form':id_form,
                  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
              }

              
    $.ajax({
            url: url_go+'html_field',
            type: 'POST',
            dataType: 'html',
            data: data,
            beforeSend: function() {
               // alert('Sila Tunggu');

            },
            success: function(response){
                //alert(response);
                $("#table_list").html(response);

               
            }
    });
}


function check_name_controller()
{
  var controller_name = $("#controller_name").val();

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
                                $("#alert_controller").html('');
                              }
                          }
                  });

}


function check_id_name()
{
  var id_name = $("#id_name").val();
  var id_form = $("#id_form").val();

  var data = 
                  {   'id_name':id_name,
                      'id_form':id_form,
                      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
                  }

                  
                  $.ajax({
                          url: '<?= base_url() ?>cpanel/check_id_name',
                          type: 'POST',
                          dataType: 'html',
                          data: data,
                          beforeSend: function() {
                             // alert('Sila Tunggu');
                             $("#alert_id_name").hide();
                          },
                          success: function(response){

                              if(response>0){
                                $("#alert_id_name").show();
                                //alert('Existing Naming Of ID Name');
                                $("#alert_id_name").html('<span style="color:red">* You naming is exiting on your system. Auto replaced your text.</red>');
                              } else {
                                $("#alert_id_name").html('');
                              }
                          }
                  });
}


function add_data_to_fields()
{
  var id_data = $("#id_data").val();
  var id_form = $("#id_form").val();
  var id_name = $("#id_name").val();

  if(id_name==''){
    alert('Please insert ID Name');
  } else {

    var data = 
                  {   'id_data':id_data,
                      'id_form':id_form,
                      'id_name':id_name,
                      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
                  }

                  
                  $.ajax({
                          url: '<?= base_url() ?>cpanel/add_data_to_fields',
                          type: 'POST',
                          dataType: 'html',
                          data: data,
                          beforeSend: function() {

                          },
                          success: function(response){

                            $("#div_data_set").show();

                            alert('Success add');
                            $("#id_data").val('');
                            call_data_set();

                             
                          }
                  });

  }

  
}

function call_data_set()
{
  var id_form = $("#id_form").val();
  var data = 
                {   
                    'id_form':id_form,
                    '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
                }

                
                $.ajax({
                        url: '<?= base_url() ?>cpanel/call_data_set',
                        type: 'POST',
                        dataType: 'html',
                        data: data,
                        beforeSend: function() {

                        },
                        success: function(response){

                          $("#table_list_data").html(response);
                           
                        }
                });
}

function delete_data_set_lookup(id)
{
  var data = 
                {   
                    'id':id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
                }

                
                $.ajax({
                        url: '<?= base_url() ?>cpanel/delete_data_set',
                        type: 'POST',
                        dataType: 'html',
                        data: data,
                        beforeSend: function() {

                        },
                        success: function(response){

                          call_data_set();
                           
                        }
                });
}



function data_show_list()
{
  var id_form = $("#id_form").val();
  var tbl = $("#tbl").val();
  var data = 
                {   
                    'id_form':id_form,
                    'tbl':tbl,
                    '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
                }

                
                $.ajax({
                        url: '<?= base_url() ?>cpanel/data_show_list',
                        type: 'POST',
                        dataType: 'html',
                        data: data,
                        beforeSend: function() {

                        },
                        success: function(response){
                          $("#table_show_list").html(response);
                        }
                });
}
</script>