<div class="breadcrumb-holder">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="">List Module</a></li>
      <li class="breadcrumb-item active">Sub Module</li>
    </ul>
  </div>
</div>



<section class="forms">
    <div class="container-fluid">
      <div class="row">

        <div class="col-lg-12" style="padding-top: 30px;">
          <div class="card">
            <div class="card-header ">
              <h4>List Module 
                  <span style="float: right">
                    <select class="form-control" name="find" id="find" onchange="find_module();">
                        <option value="">-- Find Module --</option>
                        <?= lookup_find_module(); ?>
                    </select>
                  </span>

              </h4>
            </div>
            <div class="card-body">

              <div class="container">
                <div class="row">
                  <div class="col-md-12">
                      <ol class="tree-structure">
                        <?= lookup_module_sub_module()?>
                      </ol>
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
  function find_module()
  {
    var find = $("#find").val();
    // $("#link").attr("href", "#nav_"+find);
    // $("#link").trigger('click');
    window.location.href="<?= base_url()?>cpanel/list_module/#nav_"+find;
  }
</script>


<style type="text/css">
  *{
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    -o-box-sizing: border-box;
    -ms-box-sizing: border-box;
    box-sizing: border-box;
  }
  .tree-structure{
    list-style: none;
    clear: both;
    padding-left: 15px;
  }
  .tree-structure li {
    position: relative;
  }
  .tree-structure li a{
    font-weight: normal;
    color: red;
    text-decoration: none;
    font-weight: 700;
    vertical-align: middle;
    -webkit-transition: all 0.5s ease-in-out;
    -moz-transition: all 0.5s ease-in-out;
    -ms-transition: all 0.5s ease-in-out;
    -o-transition: all 0.5s ease-in-out;
    transition: all 0.2s ease-in-out;
    display: inline-block;
    max-width: calc(100% - 50px);
    vertical-align: top;
  }
  .tree-structure li a:hover{
    padding-left: 5px;
  }
  .tree-structure > li > .num{
    display: inline-block;
    background: #333;
    min-width: 24px;
    padding-left: 0px;
    padding-right: 0px;
    text-align: center;
    padding: 3px 9px;
    margin-right: 10px;
    color: #fff;
    font-weight: 700;
    font-size: 12px;
  }
  .tree-structure > li > .num:after{
    position: absolute;
    content: "";
    width: 1px;
    height: 100%;
    background-color: #939393;
    top: 5px;
    left: 12px;
    z-index: -1;
  }
  .tree-structure > li:last-child > .num:after{ 
    height: calc(100% - 44px);
  }
  .tree-structure ol{
    padding: 20px 0 20px 45px;
  }
  .tree-structure ol li{
    list-style-type: none;
    padding: 8px 0
  }
  .tree-structure ol li .num{
    position: relative;
  }
  .tree-structure ol li a{
    color: #000;
    font-weight: normal;
  }
  .tree-structure .num{
    background-color: #666;
    min-width: 24px;
    padding-left: 0px;
    padding-right: 0px;
    text-align: center;
    padding: 3px 9px;
    margin-right: 10px;
    color: #fff;
    font-weight: 700;
    font-size: 12px;
    display: inline-block;
    vertical-align: middle;
  }
  .tree-structure  ol  li .num:before{
    position: absolute;
    content: "";
    top: 0;
    bottom: 0;
    right: 100%;
    margin: auto;
    width: 33px;
    height: 1px;
    background-color: #939393;
  }
</style>