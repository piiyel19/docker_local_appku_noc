<div class="breadcrumb-holder">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item active">Forms</li>
    </ul>
  </div>
</div>


<section class="forms">
  <div class="container-fluid">
    <!-- Page Header-->
    <header> 
      <h1 class="h3 display">Forms</h1>
    </header>
    <div class="row">
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <h4>Basic Form</h4>
          </div>
          <div class="card-body">
            <p>Lorem ipsum dolor sit amet consectetur.</p>
            <form>
              <div class="form-group">
                <label>Email</label>
                <input type="email" placeholder="Email Address" class="form-control">
              </div>
              <div class="form-group">       
                <label>Password</label>
                <input type="password" placeholder="Password" class="form-control">
              </div>
              <div class="form-group">       
                <input type="submit" value="Signin" class="btn btn-primary">
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <h4>Horizontal Form</h4>
          </div>
          <div class="card-body">
            <p>Lorem ipsum dolor sit amet consectetur.</p>
            <form class="form-horizontal">
              <div class="form-group row">
                <div class="col-sm-2"> 
                  <label>Email</label>
                </div>
                <div class="col-sm-10">
                  <input id="inputHorizontalSuccess" type="email" placeholder="Email Address" class="form-control form-control-success"><small class="form-text">Example help text that remains unchanged.</small>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-2"> 
                  <label>Password</label>
                </div>
                <div class="col-sm-10">
                  <input id="inputHorizontalWarning" type="password" placeholder="Pasword" class="form-control form-control-warning"><small class="form-text">Example help text that remains unchanged.</small>
                </div>
              </div>
              <div class="form-group row">       
                <div class="col-sm-10 offset-sm-2">
                  <input type="submit" value="Signin" class="btn btn-primary">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>