<div class="breadcrumb-holder">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="">Home</a></li>
      <li class="breadcrumb-item active">Forms</li>
    </ul>
  </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" integrity="sha512-UDJtJXfzfsiPPgnI5S1000FPLBHMhvzAMX15I+qG2E2OAzC9P1JzUwJOfnypXiOH7MRPaqzhPbBGDNNj7zBfoA==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js" integrity="sha512-ueNXF8tuPFVg1phQMcmpRunNtnVseyjeP1kVdA9YdVoRjB4ePFTS6Pg5+j5VVcOhaYYOiYdKAO+jVtrIOrhkjA==" crossorigin="anonymous"></script>

<section class="forms">
  <div class="container-fluid">
    <!-- Page Header-->
    <header> 
      <h1 class="h3 display">Forms</h1>
    </header>
    <div class="row">

      <div class="col-lg-12">
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <h4>Sort Form</h4>
          </div>
          <div class="card-body">
            <p>Lorem ipsum dolor sit amet consectetur.</p>

            <div class="container" id="view_display">
              <div class="row">
                <?= get_html_code_by_id($this->uri->segment(3))?>
              </div>
            </div>


          
            <div class="form-group" style="padding-top: 30px; padding-bottom: 30px; float: right">       
              <input type="submit" value="Commit" class="btn btn-primary" onclick="save_view();">
            </div>

        </div>
      </div>

    </div>
  </div>
</section>


<style type="text/css">
 

  .col-md-4 {
      -ms-flex: 0 0 33.333333%;
      flex: 0 0 33.333333%;
      max-width: 103.333333%;
  }
</style>
<script src="<?= base_url()?>creator_code/sort.js"></script>