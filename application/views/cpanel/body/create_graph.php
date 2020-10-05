<div class="breadcrumb-holder">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="">Graph Visual</a></li>
      <li class="breadcrumb-item active">Create Graph</li>
    </ul>
  </div>
</div>

<form action="<?= base_url()?>cpanel/build_graph" method="post">
	<input type="hidden" name="id_graph" id="id_graph" value="<?= rand()?>">
	<section class="forms">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-3" style="padding-top: 30px;">
					<label>Type Graph</label>
					<select class="form-control" name="graph_type" required>
						<option value="">Select Graph</option>
						<option value="line">Line Graph</option>
						<option value="horizontalBar">Horinzontal Graph</option>
						<option value="pie">Pie Graph</option>
						<option value="doughnut">Doughnut Graph</option>
						<option value="bar">Bar Graph</option>
					</select>
				</div>
				<div class="col-lg-3" style="padding-top: 30px;">
					<label>Graph Operation</label>
					<select class="form-control" name="graph_operation" required>
						<option value="">Select Operation</option>
						<option value="COUNT">Count</option>   
						<option value="SUM">Sum</option>
					</select>
				</div>
				<div class="col-lg-3" style="padding-top: 30px;">
					<label>Name Function</label>
					<input type="text" class="form-control" name="graph_name" id="graph_name" required onkeypress="return event.charCode != 32" onkeyup="check_graph_name();">
					<span id="alert_html" style="font-size: 12px;"></span>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-lg-12" style="padding-top: 30px;">
					<label>Graph Description</label>
					<textarea class="form-control" name="graph_desc" required></textarea>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-lg-3" style="padding-top: 30px;">
					<label>Choose Table</label>
					<select class="form-control" name="tbl" id="tbl" onchange="get_column_by_tbl();" required>
						<option value="">Select Table</option>
						<?= lookup_table()?>
					</select>
				</div>
				<div class="col-lg-3" style="padding-top: 30px;">
					<label>Choose Column </label>
					<select class="form-control" name="column" id="column" required>
	                    <option value="">-- Choose Column --</option>
	                </select>
				</div>
				<div class="col-lg-3" style="padding-top: 30px;">
					<label>Title</label>
					<input type="text" class="form-control" name="graph_title" required>
				</div>
				<div class="col-lg-3" style="padding-top: 30px;">
					<label>Label Data</label>
					<input type="text" class="form-control" name="graph_label" required>
				</div>
			</div>
			<div class="form-group" style="padding-top: 30px; padding-bottom: 30px; float: right">       
	            <input type="submit" value="Build" class="btn btn-primary">
	        </div>
		</div>
	</section>
</form>


<script type="text/javascript">
	function get_column_by_tbl()
	{
	  var tbl = $("#tbl").val();
	  var data = 
	                {   
	                    'table':tbl,
	                    '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
	                }

	                
	                $.ajax({
	                        url: '<?= base_url() ?>cpanel/get_column_table',
	                        type: 'POST',
	                        dataType: 'html',
	                        data: data,
	                        beforeSend: function() {

	                        },
	                        success: function(response){
	                        	$("#column").html('<option value="">-- Choose Column --</option>'+response);
	                        }
	                });
	}


	function check_graph_name()
	{
	  var graph_name = $("#graph_name").val();
	  var data = 
	                {   
	                    'graph_name':graph_name,
	                    '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
	                }

	                
	                $.ajax({
	                        url: '<?= base_url() ?>cpanel/check_graph_name',
	                        type: 'POST',
	                        dataType: 'html',
	                        data: data,
	                        beforeSend: function() {

	                        },
	                        success: function(response){
	                        	if(response>0){
	                        		$("#alert_html").html('<font color="red">You naming is exiting on your system. Auto replaced your text. </font>');
	                        	} else {
	                        		$("#alert_html").html('');
	                        	}
	                        }
	                });
	}
</script>