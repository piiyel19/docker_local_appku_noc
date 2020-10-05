<div class="breadcrumb-holder">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="">Data Management</a></li>
      <li class="breadcrumb-item active">Create Table</li>
    </ul>
  </div>
</div>



<form action="<?= base_url()?>cpanel/new_table" method="post">
    <section class="forms">
      <div class="container-fluid">
        <div class="row">


          <div class="col-lg-12" style="padding-top: 30px;">
            <div class="card">
              <div class="card-header">
                <h4>Create Table
                </h4>
              </div>
              <div class="card-body">
                  <div class="row">
                    <div class="col-md-4">  
                      <label>Name Table</label>
                      <input type="text" class="form-control" name="name_table" required>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">  
                      <label>Description</label>
                      <textarea class="form-control" name="desc_table" required rows="5" cols="5"></textarea>
                    </div>
                  </div>
                  <span style="float: right; padding-top: 30px; padding-bottom: 30px;">
                    <button class="btn btn-primary" type="submit">Create Table</button></span>
                  </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </form>