<div class="breadcrumb-holder">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="">Main Page</a></li>
      <li class="breadcrumb-item active">Login Editor</li>
    </ul>
  </div>
</div>




  <section class="forms">
    <div class="container-fluid">
      <div class="row">


        <div class="col-lg-12" style="padding-top: 30px;">
          <div class="card">
            <div class="card-header">
              <h4>Login Editor 
                <span style="float: right">
                  
                  <button class="btn btn-primary" onclick="save();">Commit Code</button></span>
              </h4>
            </div>
            <div class="card-body">
                <div class="row">
                  <div class="col-md-4">
                      <a href="http://beautifytools.com/php-beautifier.php" target="_blank"><button class="btn btn-primary" style="float: left">Beauty PHP</button></a>
                      <a href="https://www.freeformatter.com/html-formatter.html#ad-output" target="_blank"><button class="btn btn-primary" style="float: left">Beauty HTML</button></a>
                      <a href="<?= base_url()?>login"><button class="btn btn-primary" style="float: left">Live Page</button></a>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">

                      <textarea id="demo" class="form-control" name="history"cols="80" label="notes" rows="50" wrap="virtual">
                        
                        <?php 

                          $path_helper = $_SERVER['DOCUMENT_ROOT'].'/application/views/project/login.php';
                          //$path_helper = $_SERVER['DOCUMENT_ROOT'].'/application/views/project/login.php';

                          //var_dump($path_helper); exit();
                          $file = fopen($path_helper, "r");

                          //Output lines until EOF is reached
                          while(! feof($file)) {
                            $line = fgets($file);
                            echo htmlentities($line);
                          }

                          fclose($file);

                        ?>

                      </textarea>

                      <span style="float: right; padding-top: 30px; padding-bottom: 30px;">
                        <button class="btn btn-primary" onclick="save();">Commit Code</button></span>
                      </span>

                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


<script type="text/javascript">
  function save()
  {
    var r = confirm("Are you sure to update new code ?");
    if (r == true) {
      var code = $("#demo").val();
      var data =  {
                          'code':code,
                          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
                  }

      $.ajax({
                  url: '<?= base_url() ?>cpanel/update_login_page',
                  type: 'POST',
                  dataType: 'html',
                  data: data,
                  beforeSend: function() {
                     
                  },
                  success: function(response){
                      alert('Success Save');
                      location.reload();
                  }
            })
    }
  }
</script>