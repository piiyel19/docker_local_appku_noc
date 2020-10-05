<div class="breadcrumb-holder">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="">Data Management</a></li>
      <li class="breadcrumb-item active">List Table</li>
    </ul>
  </div>
</div>




  <section class="forms">
    <div class="container-fluid">
      <div class="row">


        <div class="col-lg-12" style="padding-top: 30px;">
          <div class="card">
            <div class="card-header">
              <h4>List Table
              </h4>
            </div>
            <div class="card-body">

                

                <div class="row">



                  <div class="col-md-12">
                    <table class="table">
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col">Table Name</th>
                          <th scope="col">Description</th>
                          <th scope="col"><center>Download</center></th>
                          <th scope="col"><center>Upload</center></th>
                          <th scope="col"><center>Action</center></th>
                        </tr>
                      </thead>
                      
                      <tbody id="table_list_data">
                        <?php  foreach($result as $data){ ?>
                        <tr>
                          <td scope="col"><?= $data['tbl']?></td>
                          <td scope="col" width="500px;"><?= $data['d_tbl']?></td>
                          <?php $tbl = '"'.$data['d_tbl'].'"';?>
                          <td scope="col"><center><a onclick='xdownload(<?= $tbl ?>)' style="color: #ff9a18"><i class="fa fa-download"></i></a></center></td>
                          <td scope="col"><center><a href="<?= base_url()?>cpanel/upload_data/<?= $data['tbl']?>"><i class="fa fa-upload"></i></a></center></td>
                          <td scope="col"><center><a href="<?= base_url()?>cpanel/create_column/<?= $data['tbl']?>"><i class="fa fa-eye"></i></a></center></td>
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


  <script type="text/javascript">
    function xdownload(tbl)
    {
      $("#tbl").val(tbl);
      $("#formx").attr("action", "<?= base_url()?>cpanel/download_csv");
      $("#btn").trigger('click');
    }
  </script>

  <form action="" method="post" id="formx" style="display: none">
    <input type="hidden" name="tbl" id="tbl">
    <button type="submit" id="btn"></button>
  </form>