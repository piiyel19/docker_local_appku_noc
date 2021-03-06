

                    <section class="">
                        <div class="container-fluid">

                          <div class="chart-container">
                            <div class="data-chart-container">
                              <canvas id="data-chart"></canvas>
                            </div>
                          </div>


                          <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
                          <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> 


                            <script>
                              $(function(){
                                  //get the data chart canvas
                                  var cData = JSON.parse('<?php echo $chart_data; ?>');
                                  var ctx = $("#data-chart");
                             
                                  //visual chart data
                                  var data = {
                                    labels: cData.label,
                                    datasets: [
                                      {
                                        label: "CCTV",
                                        data: cData.data,
                                        backgroundColor: [
                                          "#DEB887",
                                          "#A9A9A9",
                                          "#DC143C",
                                          "#F4A460",
                                          "#2E8B57",
                                          "#1D7A46",
                                          "#CDA776",
                                        ],
                                        borderColor: [
                                          "#CDA776",
                                          "#989898",
                                          "#CB252B",
                                          "#E39371",
                                          "#1D7A46",
                                          "#F4A460",
                                          "#CDA776",
                                        ],
                                        borderWidth: [1, 1, 1, 1, 1,1,1]
                                      }
                                    ]
                                  };
                             
                                  //options
                                  var options = {
                                    responsive: true,
                                    title: {
                                      display: true,
                                      position: "top",
                                      text: "Total Of CCTV - <?php echo $title; ?>",
                                      fontSize: 18,
                                      fontColor: "#111"
                                    },
                                    legend: {
                                      display: true,
                                      position: "bottom",
                                      labels: {
                                        fontColor: "#333",
                                        fontSize: 16
                                      }
                                    }
                                  };
                             
                                  //create Graph Chart class object
                                  var chart1 = new Chart(ctx, {
                                    type: "doughnut",
                                    data: data,
                                    options: options
                                  });
                             
                              });
                            </script>

                            <form action="<?= base_url()?>Graph_Bill_CCTV" method="post">
                              <div class="row">
                                <div class="col-md-3">
                                  <label>Date</label>
                                  <div class="form-group">
                                     <div class="input-group date" >                                                
                                      <input type="text" class="form-control" name="datepicker" id="datepicker" value="" />
                                     </div>
                                  </div>
                                </div> 
                                <div class="col-md-3">
                                  <label>Month</label>
                                  <div class="form-group">
                                     <div class="input-group date" >                                     
                                      <select class="form-control" name="monthpicker" id="monthpicker">
                                        <option value="">-- Select Month --</option>
                                        <option value="01">Januari</option>
                                        <option value="02">February</option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                      </select>
                                     </div>
                                  </div>
                                </div>   
                                <div class="col-md-3">
                                  <label>Year</label>
                                  <div class="form-group">
                                     <div class="input-group date" >                                     
                                      <select class="form-control" name="yearpicker" id="yearpicker">
                                        <option value="">-- Select Year --</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                      </select>
                                     </div>
                                  </div>
                                </div> 
                                <div class="col-md-3">
                                  <label>Action</label>
                                  <div class="form-group">
                                     <div class="input-group date" >                                                
                                      <button type="submit" class="btn btn-primary">Submit</button> <button class="btn btn-default" onclick="window.load();"><i class="fa fa-refresh"></i></button>
                                     </div>
                                  </div>
                                </div> 
                              </div>
                            </form>

                            <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
                            <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

                            <script>
                                $("#datepicker").datepicker({
                                    uiLibrary: "bootstrap4",
                                    change: function (e) {
                                       $("#monthpicker").prop("disabled",true);
                                       $("#yearpicker").prop("disabled",true);
                                   }

                                    // format: "dd"
                                });
                                $("#monthpicker").change(function (){
                                      $("#datepicker").prop("disabled",true);
                                      $("#yearpicker").prop("disabled",false);
                                      $("#monthpicker").prop("required",true);
                                      $("#yearpicker").prop("required",true);
                                });

                                $("#yearpicker").change(function (){
                                      $("#datepicker").prop("disabled",true);
                                      $("#monthpicker").prop("disabled",false);
                                      $("#yearpicker").prop("required",true);
                                });
                            </script>


                        </div>
                    </section>
                