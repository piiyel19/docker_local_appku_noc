
<!DOCTYPE html>
<html>
<head>
  
  <title>Quick Start - Leaflet</title>

  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>



    <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  <!-- Latest compiled and minified JavaScript -->
<!--   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
 -->

 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js" integrity="sha512-WNLxfP/8cVYL9sj8Jnp6et0BkubLP31jhTG9vhL/F5uEZmg5wEzKoXp1kJslzPQWwPT1eyMiSxlKCgzHLOTOTQ==" crossorigin="anonymous"></script>
  
</head>
<body style="background: #000;">



<div class="row" style="float-right:0px; ">
  <div class="col-md-4" style="overflow-y: scroll; max-height:760px;">
    <div class="row" >
      <form method="post" action="<?= base_url()?>map">
        <div class="col-md-12" style="padding-bottom: 30px;">
          <h1 style="color: #fff; padding-left: 15px;">Smart City CCTV</h1>
      
            <div class="col-md-10 col-sm-10 col-xs-10">
              <input type="text" class="form-control" name="location" id="location">
            </div>
            <div class="col-md-2 col-sm-2 col-xs-2">
              <button class="btn btn-default">Search</button>
            </div>
        </div>
      </form>

      <div id="load_data">
      </div>
      <div id="load_data_message"></div>



      
    </div>
  </div>
  <div class="col-md-8" >
    <div id="mapid" style="width: 100%; height: 760px;"></div>
  </div>
</div>



<script>

  

  




  // L.circle([51.508, -0.11], 500, {
  //  color: 'red',
  //  fillColor: '#f03',
  //  fillOpacity: 0.5
  // }).addTo(mymap).bindPopup("I am a circle.");

  // L.polygon([
  //  [51.509, -0.08],
  //  [51.503, -0.06],
  //  [51.51, -0.047]
  // ]).addTo(mymap).bindPopup("I am a polygon.");


  // var popup = L.popup();

  // function onMapClick(e) {
  //  popup
  //    .setLatLng(e.latlng)
  //    .setContent("You clicked the map at " + e.latlng.toString())
  //    .openOn(mymap);
  // }

  // mymap.on('click', onMapClick);

</script>



</body>
</html>


<style type="text/css">
  html {
      overflow: scroll;
      overflow-x: hidden;
  }
  ::-webkit-scrollbar {
      width: 0px;  /* Remove scrollbar space */
      background: transparent;  /* Optional: just make scrollbar invisible */
  }
  /* Optional: show position indicator in red */
  ::-webkit-scrollbar-thumb {
      background: #FF0000;
  }
</style>



<script>
  $(document).ready(function(){
    var limit = 7;
    var start = 0;
    var action = 'inactive';


    <?php if(!empty($_POST['location'])){ ?>
      var location = "<?= $_POST['location'] ?>";
    <?php } else { ?>
      var location = '';
    <?php } ?>



    function load_data(limit, start)
    {
      $.ajax({
        url:"<?php echo base_url(); ?>cctv/fetch",
        method:"POST",
        data:{limit:limit, start:start, location:location},
        cache: false,
        success:function(data)
        {
          if(data == '')
          {
            $('#load_data_message').html('<h3>No More Result Found</h3>');
            action = 'active';
          }
          else
          {
            $('#load_data').append(data);
            $('#load_data_message').html("");
            action = 'inactive';
          }
        }
      })
    }

    if(action == 'inactive')
    {
      action = 'active';
      load_data(limit, start);
    }

    $(window).scroll(function(){
      if($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive')
      {
        // lazzy_loader(limit);
        action = 'active';
        start = start + limit;
        setTimeout(function(){
          load_data(limit, start);
        }, 1000);
      }
    });




    


    $.ajax({
            url:"<?php echo base_url(); ?>cctv/fetch_map",
            method:"POST",
            data:{limit:limit, start:start, location:location},
            dataType: "JSON",
            cache: false,
            success:function(data)
            {
              // console.log(data);
              var latitude = data[0]['latitude'];
              var longitude = data[0]['longitude'];
              if(latitude)
              {
                var mymap = L.map('mapid').setView([latitude, longitude], 17);

                L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                  maxZoom: 18,
                  attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                    '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                    'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                  id: 'mapbox/streets-v11',
                  tileSize: 512,
                  zoomOffset: -1
                }).addTo(mymap);
              }

              for(var key in data) {
                var latitude = data[key]['latitude'];
                var longitude = data[key]['longitude'];
                var cctv_name = data[key]['cctv_name'];
                var id = data[key]['id'];

                console.log(latitude+" "+longitude+" "+cctv_name);

                L.marker([latitude, longitude]).addTo(mymap).bindPopup("<b>"+cctv_name+"</b><br /><a href='<?= base_url()?>map/view/"+id+"' target='_blank'>Open Location.</a>").openPopup();

              }
               
            }
          })



  });
</script>


<style type="text/css">
  iframe{
    width: 100%;
    height: 200px;
  }
</style>