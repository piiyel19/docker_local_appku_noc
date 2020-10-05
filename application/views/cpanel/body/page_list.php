<div class="breadcrumb-holder">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="">Main Page</a></li>
      <li class="breadcrumb-item active">Page List</li>
    </ul>
  </div>
</div>





<section class="forms">
  <div class="container-fluid">
    <div class="row">


      <div class="col-lg-12" style="padding-top: 30px;">
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <h4>Extra Page List</h4>
          </div>
          <div class="card-body">
              <div class="row" style="padding-bottom: 10px;">
                <div class="col-md-10" >
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
              </div>

              <div class="row">
                <div class="col-md-12">


                  <table class="table">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">File Name</th>
                        <th scope="col">Code Editor</th>
                      </tr>
                    </thead>
                    <?php  foreach($result as $data){ ?>
                    <tbody id="table_list_data">
                      <tr>
                        <th scope="row"><?= $data["name_function"]?></th>
                        <td><a href="<?= base_url()?>cpanel/extra_page_edit/<?= $data["id_view"]?>">Edit</a></td>
                      </tr>
                    </tbody>
                    <?php } ?>
                    <?php if(empty($result)){ ?>
                      <tr>
                        <td>No Data</td>
                        <td>No Data</td>
                      </tr>
                    <?php } ?>
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
  </div>
</section>