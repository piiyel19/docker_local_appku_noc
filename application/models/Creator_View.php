<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Creator_View extends CI_Model
{
    function __construct()
    {
      // Call the Model constructor
      parent::__construct();
    }

    //create folder
    function makeDir($path)
	{
	     return is_dir($path) || mkdir($path);
	}

    function create_file_insert($id_form,$controller_name,$table)
	{


		  //create folder 
		  $path = APPPATH.'views/project/body/'.$controller_name;
		  $this->makeDir($path);

		  // Create Controller
		  $path_helper = fopen(APPPATH.'views/project/body/'.$controller_name.'/'.$controller_name.'_add.php', "a")
		  or die("Unable to open file!");

		  	$code = '';
		  	$data = '';


		  	$this->db->where('id_form',$id_form);
	    	$query2 =  $this->db->get('project_file')->result();
	    	$title = '';
			foreach ($query2 as $data2) 
			{
				$module = $data2->module;
				$sub_module = $data2->sub_module;
				$title = $module.' > Add '.$sub_module;
			}



		  	$check_have_file_form = $this->check_have_file_form($id_form);

		  	if($check_have_file_form>0){
		  		$start_form = '<form action="<?=base_url()?>'.$controller_name.'/add_'.$controller_name.'_submit" method="POST" enctype="multipart/form-data">';
		  	} else {
		  		$start_form = '<form action="<?=base_url()?>'.$controller_name.'/add_'.$controller_name.'_submit" method="POST">';
		  	}


		  	$button = '	
		  				<div class="col-lg-12" style="padding-top: 30px; padding-bottom: 30px;">
		  					<input type="hidden" name="id_form" value="'.$id_form.'"><div style="float: right"><button class="btn btn-primary" type="submit">Submit</div>
		  				</div>';
		  	$end = '</form>';


		  	$start_body = '
		  				<section class="forms">
						    <div class="container-fluid">
						      <div class="row">

						        <header style="padding-left: 18px;"> 
						          <h1 class="h3 display">'.$title.'</h1>
						        </header>

						        <div class="col-lg-12">
						          <div class="card">
						            <div class="card-header d-flex align-items-center">
						              <h4>Add Data</h4>
						            </div>
						            <div class="card-body">
						            	<div class="row">
		  			';		


		  	$end_body = '
		  								</div>
			  					 </div>
								</div>
							  </div>
							</div>
						</section>
		  				';


		  	$this->db->where('id_form',$id_form);
			$query2 =  $this->db->get('field_set')->result();
			foreach ($query2 as $data2) 
			{
				$html_code = $data2->html_code;

				$code .= $html_code;
			}


			$data = $start_form.$start_body.$code.$button.$end_body.$end;

		  $controller_content = $data;
		  fwrite($path_helper, "\n". $controller_content);
		  fclose($path_helper);
	}

	function create_file_update($id_form,$controller_name,$table)
	{

		//create folder 
		$path = APPPATH.'views/project/body/'.$controller_name;
		$this->makeDir($path);

		
		// Create Controller
		$path_helper = fopen(APPPATH.'views/project/body/'.$controller_name.'/'.$controller_name.'_update.php', "a")
		  or die("Unable to open file!");



		$this->db->where('id_form',$id_form);
    	$query2 =  $this->db->get('project_file')->result();
    	$title = '';
		foreach ($query2 as $data2) 
		{
			$module = $data2->module;
			$sub_module = $data2->sub_module;
			$title = $module.' > Update '.$sub_module;
		}
		


		$style_1 = '
		  				<section class="forms">
						    <div class="container-fluid">
						      <div class="row">

						        <header style="padding-left: 18px;"> 
						          <h1 class="h3 display">'.$title.'</h1>
						        </header>

						        <div class="col-lg-12">
						          <div class="card">
						            <div class="card-header d-flex align-items-center">
						              <h4>Update Data</h4>
						            </div>
						            <div class="card-body">
						            	<div class="row">
		  			';		


	  	$style_2 = '					


	  								</div>
		  					 </div>
							</div>
						  </div>
						</div>
					</section>
	  				';


	  	$check_have_file_form = $this->check_have_file_form($id_form);

	  	if($check_have_file_form>0){
	  		$start_form = '<form action="<?=base_url()?>'.$controller_name.'/update_'.$controller_name.'_submit/<?= $this->uri->segment(3)?>" method="POST" enctype="multipart/form-data">';
	  	} else {
	  		$start_form = '<form action="<?=base_url()?>'.$controller_name.'/update_'.$controller_name.'_submit/<?= $this->uri->segment(3)?>" method="POST">';
	  	}


	  	$button = '	
	  				<div class="col-lg-12" style="padding-top: 30px; padding-bottom: 30px;">
	  					<input type="hidden" name="id_form" value="'.$id_form.'"><div style="float: right"><button class="btn btn-primary" type="submit">Submit</div>
	  				</div>';
	  	$end = '</form>';


	  	$code = '';
	  	$this->db->where('id_form',$id_form);
		$query2 =  $this->db->get('field_set')->result();
		foreach ($query2 as $data2) 
		{
			$html_code = $data2->html_code;

			$code .= $html_code;
		}


		$form_id_field = '';
		$this->db->where('id_form',$id_form);
		$query2 =  $this->db->get('field_set')->result();
		foreach ($query2 as $data2) 
		{
			$id_field = $data2->id_name;

			$type_field = $data2->type_field;

			$checked = "'checked'";

			if(($type_field=='Multiple Radio')||($type_field=='Inline Radio')){
				
				//$form_id_field .= '$("input[name='.$id_field.']").prop('.$checked.',true);';
				$form_id_field .=  '
										if(response.'.$id_field.'){
											$("input[value=" + response.'.$id_field.' + "]").prop("checked", true);
										} 
								   ';

			} else if(($type_field=='Multiple Checkboxes')||($type_field=='Inline Checkboxes')){

				// get data as id & column in database
				$this->db->where('id_form',$id_form);
				$this->db->where('id_field',$id_field);
				$query3 =  $this->db->get('field_data')->result();
				foreach ($query3 as $data3) 
				{
					$data_name = $data3->data_name;
					$id_data = preg_replace('/\s+/', '_', $data_name);
					//$form_id_field .= '$("input[name='.$id_data.']").prop('.$checked.',true);';
					$form_id_field .=  '
											if(response.'.$id_data.'){
												$("input[value=" + response.'.$id_data.' + "]").prop("checked", true);
											} 
									   ';
				}

			}	else {
				$form_id_field .= '$("#'.$id_field.'").val(response.'.$id_field.');';
			}

			
		}

		$javascript = '

							<script type="text/javascript">
						   		$(document).ready(function (){
						   			var id = "<?= $this->uri->segment(3)?>";
			
									var data =  {
									                    "id":id, //declare variable dalam data 
									                    "<?php echo $this->security->get_csrf_token_name(); ?>" : "<?php echo $this->security->get_csrf_hash(); ?>"
									            }

							        $.ajax({
							                    url: "<?= base_url() ?>'.$controller_name.'/'.$controller_name.'_details", 
							                    type: "POST",
							                    dataType: "json",
							                    data: data,
							                    beforeSend: function() {
							                       
							                    },
							                    success: function(response){

							                    	'.$form_id_field.'

												}
										  });
						   		});
						   </script>

					  ';



		$data = $start_form.$style_1.$code.$button.$style_2.$end.$javascript;

		$controller_content = $data;
		fwrite($path_helper, "\n". $controller_content);
		fclose($path_helper);
	}

	function create_file_list($id_form,$controller_name,$table_name,$show_list,$insert_file,$update_file,$list_file)
	{

		//create folder 
		$path = APPPATH.'views/project/body/'.$controller_name;
		$this->makeDir($path);

		
		// Create Controller
		$path_helper = fopen(APPPATH.'views/project/body/'.$controller_name.'/'.$controller_name.'_list.php', "a")
		  or die("Unable to open file!");

		$header_table = '';
		$body_table = '';
		$body_table_last = '';
		$nodata = '';

		if(!empty($show_list)){
			for ($x = 0; $x <= count($show_list)-1; $x++) {
				$show_list2 = $show_list[$x];

				$header_table .= '<th>'.$this->label_name($show_list2,$id_form).'</th>';
				$body_table .= '<td> 
									<?php 
										$'.$show_list2.' =  $data["'.$show_list2.'"]; 
										if (filter_var($'.$show_list2.', FILTER_VALIDATE_URL)) {
									?>
											<img src="<?= $data["'.$show_list2.'"]; ?>" style="width: 200px;">
									
									<?php
										} else {
											echo $data["'.$show_list2.'"];
										}
									?>
							    </td>
							   ';
				$nodata .= '<td>No Data</td>';
			}
		}


		$header_table .= '<th>Action</th>';

		if($update_file=='update'){

			$body_table .='<td><a href="<?= base_url()?>'.$controller_name.'/'.$controller_name.'_view/<?= $data["id"]?>">View</a> | <a href="<?= base_url()?>'.$controller_name.'/'.$controller_name.'_update/<?= $data["id"]?>">Update</a></td>';
			

		} else {

			$body_table .='<td><a href="<?= base_url()?>'.$controller_name.'/'.$controller_name.'_view/<?= $data["id"]?>">View</a></td>';

		}
		$nodata .= '<td>No Data</td>';



		$this->db->where('id_form',$id_form);
    	$query2 =  $this->db->get('project_file')->result();
    	$title = '';
		foreach ($query2 as $data2) 
		{
			$module = $data2->module;
			$sub_module = $data2->sub_module;
			$title = $module.' > List '.$sub_module;
		}
		

		$style_1 = '
		  				<section class="forms">
						    <div class="container-fluid">
						      <div class="row">

						        <header style="padding-left: 18px;"> 
						          <h1 class="h3 display">'.$title.'</h1>
						        </header>

						        <div class="col-lg-12">
						          <div class="card">
						            <div class="card-header d-flex align-items-center">
						              <h4>List Data</h4>
						            </div>
						            <div class="card-body">
						            	<div class="row">
		  			';		

		if($insert_file=='insert'){

			$search_session = "'search'";
			$search = '
						<div class="col-md-10" style="padding-left: 0px;">
	            			<form method="post" action="<?= base_url()?><?= $this->uri->segment(1)?>/<?= $this->uri->segment(2)?>" id="form_reset">
		            			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
	                              <div class="input-group">
	                                <input type="text" class="form-control" name="search" id="btn_search" placeholder="Find Something" value="<?= $this->session->userdata('.$search_session.')?>">
	                                <input type="hidden" name="submit" value="submit">
	                                <div class="input-group-btn">
	                                  <button class="btn btn-primary" type="submit">
	                                    <i class="material-icons">search</i>
	                                  </button>
	                                </div>
	                              </div>
	                        </form>
	            		</div>
	            		<div class="col-md-2" style="padding-bottom: 10px; padding-right: 0px; padding-top: 30px;">
	            			<a href="<?= base_url()?>'.$controller_name.'/'.$controller_name.'_add"><button class="btn btn-primary btn-block">Add Data</button></a>
	            		</div>
					  ';

		} else {

			$search_session = "'search'";
			$search = '
						<div class="col-md-10" style="padding-left: 0px;">
	            			<form method="post" action="<?= base_url()?><?= $this->uri->segment(1)?>/<?= $this->uri->segment(2)?>" id="form_reset">
		            			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
	                              <div class="input-group">
	                                <input type="text" class="form-control" name="search" id="btn_search" placeholder="Find Something" value="<?= $this->session->userdata('.$search_session.')?>">
	                                <input type="hidden" name="submit" value="submit">
	                                <div class="input-group-btn">
	                                  <button class="btn btn-primary" type="submit">
	                                    <i class="material-icons">search</i>
	                                  </button>
	                                </div>
	                              </div>
	                        </form>
	            		</div>
	            		<div class="col-md-2" style="padding-bottom: 10px; padding-right: 0px;">
	            		</div>
					  ';
		}



	  	$style_2 = '					


	  								</div>
		  					 </div>
							</div>
						  </div>
						</div>
					</section>
	  				';


	  	$table_start = '<div class="table table-responsive"><table class="table">';

		$header = '<thead class="thead-dark"><tr>'.$header_table.'</tr></thead>';

		$foreach_start = "<?php  foreach(\$result as \$data){ ?>";

		$tbody1 = '<tbody>';

		$body = '
					<tr>
						'.$body_table.'
					</tr>
				';

		$tbody2 = '</tbody>';

		$foreach_end = "<?php } ?>";

		$table_end = '</table></div>';

		$pagination = "
							<div style='margin-top: 30px; float: right; padding-right: 30px;'>
				              <?= \$pagination; ?>
				            </div>
					  ";


		$nodt = "
					<?php if(empty(\$result)){ ?>
                    <tr>
                        ".$nodata."
                    </tr>
                    <?php } ?>
				";


		$data = $style_1.$search.$table_start.$header.$foreach_start.$tbody1.$body.$foreach_end.$nodt.$tbody2.$table_end.$pagination.$style_2;


		$controller_content = $data;
		fwrite($path_helper, "\n". $controller_content);
		fclose($path_helper);

	}

	function create_file_list_w_delete($id_form,$controller_name,$table_name,$show_list,$insert_file,$update_file,$list_file)
	{
		//create folder 
		$path = APPPATH.'views/project/body/'.$controller_name;
		$this->makeDir($path);

		
		// Create Controller
		$path_helper = fopen(APPPATH.'views/project/body/'.$controller_name.'/'.$controller_name.'_list.php', "a")
		  or die("Unable to open file!");

		$header_table = '';
		$body_table = '';
		$body_table_last = '';
		$nodata = '';

		if(!empty($show_list)){
			for ($x = 0; $x <= count($show_list)-1; $x++) {
				$show_list2 = $show_list[$x];

				$header_table .= '<th>'.$this->label_name($show_list2,$id_form).'</th>';
				$body_table .= '<td> 
									<?php 
										$'.$show_list2.' =  $data["'.$show_list2.'"]; 
										if (filter_var($'.$show_list2.', FILTER_VALIDATE_URL)) {
									?>
											<img src="<?= $data["'.$show_list2.'"]; ?>" style="width: 200px;">
									
									<?php
										} else {
											echo $data["'.$show_list2.'"];
										}
									?>
							    </td>
							   ';
				$nodata .= '<td>No Data</td>';
			}
		}

		$id1 = '"id"';
		$header_table .= '<th>Action</th>';
		
		if($update_file=='update'){

			$body_table .='<td><a href="<?= base_url()?>'.$controller_name.'/'.$controller_name.'_view/<?= $data["id"]?>">View</a> | <a href="<?= base_url()?>'.$controller_name.'/'.$controller_name.'_update/<?= $data["id"]?>">Update</a> | <a onclick="delete_item(<?= $data["id"]?>)">Delete</a></td>';
			

		} else {

			$body_table .='<td><a href="<?= base_url()?>'.$controller_name.'/'.$controller_name.'_view/<?= $data["id"]?>">View</a> | <a onclick="delete_item(<?= $data["id"]?>)">Delete</a></td>';

		}
		$nodata .= '<td>No Data</td>';

		$style_1 = '
		  				<section class="forms">
						    <div class="container-fluid">
						      <div class="row">

						        <header style="padding-left: 18px;"> 
						          <h1 class="h3 display">Configuration Database</h1>
						        </header>

						        <div class="col-lg-12">
						          <div class="card">
						            <div class="card-header d-flex align-items-center">
						              <h4>List Data</h4>
						            </div>
						            <div class="card-body">
						            	<div class="row">



		  			';		

		if($insert_file=='insert'){

			$search_session = "'search'";
			$search = '
						<div class="col-md-10" style="padding-left: 0px;">
	            			<form method="post" action="<?= base_url()?><?= $this->uri->segment(1)?>/<?= $this->uri->segment(2)?>" id="form_reset">
		            			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
	                              <div class="input-group">
	                                <input type="text" class="form-control" name="search" id="btn_search" placeholder="Find Something" value="<?= $this->session->userdata('.$search_session.')?>">
	                                <input type="hidden" name="submit" value="submit">
	                                <div class="input-group-btn">
	                                  <button class="btn btn-primary" type="submit">
	                                    <i class="material-icons">search</i>
	                                  </button>
	                                </div>
	                              </div>
	                        </form>
	            		</div>
	            		<div class="col-md-2" style="padding-bottom: 10px; padding-right: 0px; padding-top: 30px;">
	            			<a href="<?= base_url()?>'.$controller_name.'/'.$controller_name.'_add"><button class="btn btn-primary btn-block">Add Data</button></a>
	            		</div>
					  ';

		} else {

			$search_session = "'search'";
			$search = '
						<div class="col-md-10" style="padding-left: 0px;">
	            			<form method="post" action="<?= base_url()?><?= $this->uri->segment(1)?>/<?= $this->uri->segment(2)?>" id="form_reset">
		            			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
	                              <div class="input-group">
	                                <input type="text" class="form-control" name="search" id="btn_search" placeholder="Find Something" value="<?= $this->session->userdata('.$search_session.')?>">
	                                <input type="hidden" name="submit" value="submit">
	                                <div class="input-group-btn">
	                                  <button class="btn btn-primary" type="submit">
	                                    <i class="material-icons">search</i>
	                                  </button>
	                                </div>
	                              </div>
	                        </form>
	            		</div>
	            		<div class="col-md-2" style="padding-bottom: 10px; padding-right: 0px;">
	            		</div>
					  ';

		}



	  	$style_2 = '					


	  								</div>
		  					 </div>
							</div>
						  </div>
						</div>
					</section>
	  				';


	  	$table_start = '<div class="table table-responsive"><table class="table">';

		$header = '<thead class="thead-dark"><tr>'.$header_table.'</tr></thead>';

		$foreach_start = "<?php  foreach(\$result as \$data){ ?>";

		$tbody1 = '<tbody>';

		$body = '
					<tr>
						'.$body_table.'
					</tr>
				';

		$tbody2 = '</tbody>';

		$foreach_end = "<?php } ?>";

		$table_end = '</table></div>';

		$pagination = "
							<div style='margin-top: 30px; float: right; padding-right: 30px;'>
				              <?= \$pagination; ?>
				            </div>
					  ";


		$nodt = "
					<?php if(empty(\$result)){ ?>
                    <tr>
                        ".$nodata."
                    </tr>
                    <?php } ?>
				";


		$javascript = '
								<script type="text/javascript">
								   	function delete_item(id)
								   	{
								   		var r = confirm("Are you sure to delete ?");
										if (r == true) {

											var data =  {
											                    "id":id, 
											                    "<?php echo $this->security->get_csrf_token_name(); ?>" : "<?php echo $this->security->get_csrf_hash(); ?>"
											            }

									        $.ajax({
									                    url: "<?= base_url() ?>'.$controller_name.'/delete_item", 
									                    type: "POST",
									                    dataType: "html",
									                    data: data,
									                    beforeSend: function() {
									                       
									                    },
									                    success: function(response){

									                    	location.reload();

														}
												  });

										} else {

										}
								   	}
								</script>
						  ';


		$data = $style_1.$search.$table_start.$header.$foreach_start.$tbody1.$body.$foreach_end.$nodt.$tbody2.$table_end.$pagination.$style_2.$javascript;


		$controller_content = $data;
		fwrite($path_helper, "\n". $controller_content);
		fclose($path_helper);
	}


	function create_file_view_only($id_form,$controller_name,$table_name,$show_list)
	{

		//create folder 
		$path = APPPATH.'views/project/body/'.$controller_name;
		$this->makeDir($path);

		
		// Create Controller
		$path_helper = fopen(APPPATH.'views/project/body/'.$controller_name.'/'.$controller_name.'_view.php', "a")
		  or die("Unable to open file!");




		


		$style_1 = '
		  				<section class="forms">
						    <div class="container-fluid">
						      <div class="row">

						        <header style="padding-left: 18px;"> 
						          <h1 class="h3 display">Configuration Database</h1>
						        </header>

						        <div class="col-lg-12">
						          <div class="card">
						            <div class="card-header d-flex align-items-center">
						              <h4>View Data</h4>
						            </div>
						            <div class="card-body">
						            	<div class="row">
		  			';		


	  	$style_2 = '					


	  								</div>
		  					 </div>
							</div>
						  </div>
						</div>
					</section>
	  				';


	  	$check_have_file_form = $this->check_have_file_form($id_form);

	  	// kalau kosong item field | amik data yg existing register
	  	// sambung sok 

	  	if($check_have_file_form>0){
	  		$start_form = '';
	  	} else {
	  		$start_form = '';
	  	}


	  	$button = '';
	  	$end = '';


	  	$code = '';
	  	$this->db->where('id_form',$id_form);
		$query2 =  $this->db->get('field_set')->result();
		foreach ($query2 as $data2) 
		{
			$html_code = $data2->html_code;
			$type_field = $data2->type_field;
			$label = $data2->label;

			if($type_field=='File'){
				$html_code = '
								<div class="col-md-4" draggable="true">
									<label>'.$label.'</label>
									<br>
				                  	<img id="img_'.$data2->id.'" src="" style="width:300px;">
				                </div>
							 ';
				$code .= $html_code;
			} else {
				$code .= $html_code;
			}

			
		}


		$form_id_field = '';
		$this->db->where('id_form',$id_form);
		$query2 =  $this->db->get('field_set')->result();
		foreach ($query2 as $data2) 
		{
			$id_field = $data2->id_name;

			$type_field = $data2->type_field;

			$checked = "'checked'";

			if(($type_field=='Multiple Radio')||($type_field=='Inline Radio')){
				//$form_id_field .= '$("input[name='.$id_field.']").prop('.$checked.',true);';
				
				$form_id_field .=  '
										if(response.'.$id_field.'){
											$("input[value=" + response.'.$id_field.' + "]").prop("checked", true);
										} 
								   ';
			} else if($type_field=='File'){

				$form_id_field .=  '
										if(response.'.$id_field.'){
											$("#img_'.$data2->id.'").attr("src", response.'.$id_field.');
										} 
								   ';

			} else if(($type_field=='Multiple Checkboxes')||($type_field=='Inline Checkboxes')){

				// get data as id & column in database
				$this->db->where('id_form',$id_form);
				$this->db->where('id_field',$id_field);
				$query3 =  $this->db->get('field_data')->result();
				foreach ($query3 as $data3) 
				{
					$data_name = $data3->data_name;
					$id_data = preg_replace('/\s+/', '_', $data_name);
					//$form_id_field .= '$("input[name='.$id_data.']").prop('.$checked.',true);';
					
					$form_id_field .=  '
											if(response.'.$id_data.'){
												$("input[value=" + response.'.$id_data.' + "]").prop("checked", true);
											} 
									   ';

				}

			}	else {
				$form_id_field .= '$("#'.$id_field.'").val(response.'.$id_field.');';
			}

			
		}

		$javascript = '

							<script type="text/javascript">
						   		$(document).ready(function (){
						   			var id = "<?= $this->uri->segment(3)?>";
			
									var data =  {
									                    "id":id, //declare variable dalam data 
									                    "<?php echo $this->security->get_csrf_token_name(); ?>" : "<?php echo $this->security->get_csrf_hash(); ?>"
									            }

							        $.ajax({
							                    url: "<?= base_url() ?>'.$controller_name.'/'.$controller_name.'_details", 
							                    type: "POST",
							                    dataType: "json",
							                    data: data,
							                    beforeSend: function() {
							                       
							                    },
							                    success: function(response){

							                    	'.$form_id_field.'

												}
										  });
						   		});
						   </script>

					  ';



		$data = $start_form.$style_1.$code.$button.$style_2.$end.$javascript;

		$controller_content = $data;
		fwrite($path_helper, "\n". $controller_content);
		fclose($path_helper);
	}


	function check_have_file_form($id_form)
	{
		$where = "
    				SELECT count(*) as Total FROM field_set as a 
    				Where a.id_form='$id_form' AND a.type_field='File'
    			 ";
    	$query = $this->db->query($where);
        if ($query->num_rows() >0){ 
            foreach ($query->result() as $data) {
                return $data->Total;
            }
        } else {
        	return '0';
        }
	}


	function label_name($show_list,$id_form)
	{
		$this->db->where('id_name',$show_list);
		$this->db->where('id_form',$id_form);
        $query =  $this->db->get('field_set')->result();
        $label ='';
        foreach ($query as $data) 
        {   
            $label = $data->label;
        }


        if(empty($label)){


        	$label = ucwords(str_replace("_", " ", $show_list));

        }

        return $label;
	}


}