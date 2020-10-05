<div class="breadcrumb-holder">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="">Data Management</a></li>
      <li class="breadcrumb-item active">Create Field</li>
    </ul>
  </div>
</div>



<form action="<?= base_url()?>cpanel/alter_field/<?= $this->uri->segment(3)?>" method="post">
  <section class="forms">
    <div class="container-fluid">
      <div class="row">


        <div class="col-lg-12" style="padding-top: 30px;">
          <div class="card">
            <div class="card-header">
              <h4>Create Field
              </h4>
            </div>
            <div class="card-body">
                <div class="row">
                  <div class="col-md-4">  
                    <label>Name Field</label>
                    <input type="text" class="form-control" name="name_field" required>
                  </div>
                  <div class="col-md-4">  
                    <label>Type Field</label>
                    <select class="form-control" name="type_field" required>
                      <option value="">-- Type Field --</option>
                      <option value="INT">INT</option>
                      <option value="VARCHAR">VARCHAR</option>
                      <option value="TEXT">TEXT</option>
                      <option value="TIMESTAMP">TIMESTAMP (auto date)</option>
                    </select>
                  </div>
                  <div class="col-md-6" style="padding-top: 30px;">  
                    <button class="btn btn-primary" type="submit">Create Field</button>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>



  <section class="forms">
      <div class="container-fluid">
        <div class="row">


          <div class="col-lg-12" style="padding-top: 30px;">
            <div class="card">
              <div class="card-header">
                <h4>List Field
                </h4>
              </div>
              <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <table class="table">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">Column Name</th>
                            <th scope="col">Type Field</th>
                          </tr>
                        </thead>
                        <tbody id="table_list_data">
                          
                          <?= show_all_field($this->uri->segment(3))?>
                        </tbody>
                      </table>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>
</form>