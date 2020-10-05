<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dbase_lookup extends CI_Model
{
	function __construct()
	{
	    // Call the Model constructor
	    parent::__construct();
	}

	/* ENGINE BUILDER */
	function html_field($id_form)
	{
	    $this->db->where('id_form',$id_form);
    	$query =  $this->db->get('field_set')->result();
		foreach ($query as $data) 
		{
			echo $data->html_code;
		}
	}  


	function get_role()
	{
		$project_id = $this->session->userdata('project_id');
		//$this->db->group_by('project_id');
    	$this->db->where('project_id',$project_id);
    	$query =  $this->db->get('project_role')->result();
    	$data_role='';
		foreach ($query as $data) 
		{
			echo "<option value='".$data->role."'>".$data->role."</option>";
		}	
	}


	function lookup_table()
	{
		$project_id = $this->session->userdata('project_id');
		$this->db->where('project_id',$project_id);
	    $query2 =  $this->db->get('project_table')->result();
		foreach ($query2 as $data2) 
		{
			$data = $data2->table_name;
			echo '<option value="'.$data.'">'.$data.'</option>';
		}
	}  



	function lookup_helper_name()
	{
		$project_id = $this->session->userdata('project_id');
		//$this->db->group_by('project_id');
    	$this->db->where('project_id',$project_id);
    	$query =  $this->db->get('project_lookup_helper')->result();
    	$data_role='';
		foreach ($query as $data) 
		{
			echo "<option value='<?= ".$data->function_name."()?>'>".$data->function_name."</option>";
		}	
	}


	function lookup_module()
	{
		$project_id = $this->session->userdata('project_id');
		$this->db->where('project_id',$project_id);
		$this->db->group_by('table_name');
		$this->db->order_by('table_name','asc');
	    $query2 =  $this->db->get('project_file')->result();
		foreach ($query2 as $data2) 
		{
			$data = $data2->table_name;
			echo '<option value="'.$data.'">'.$data.'</option>';
		}
	}


	function project_name()
	{
		$project_id = $this->session->userdata('project_id');
		//$this->db->where('project_id',$project_id);
    	$query =  $this->db->get('project_login')->result();
    	$project_name='CPANEL';
		foreach ($query as $data) 
		{
			$project_name = $data->project_name;
		}

		return $project_name;
	}


	function lookup_module_sub_module()
	{
		$this->db->group_by('module');
		$project_id = $this->session->userdata('project_id');
		$this->db->where('project_id',$project_id);
    	$query =  $this->db->get('project_file')->result();
    	$i='1';
		foreach ($query as $data) 
		{
			$module = $data->module;
			$description_name = $data->description_name;

			$module = $data->module;

			$id_form = $data->id_form;

			echo '
					<li id="nav_'.$id_form.'">
						<span class="num">'.$i.'</span>
						<a href="#" title="'.$description_name.'">'.$module.'</a>
						<ol>
				 ';

			$this->db->where('module',$module);
	    	$query2 =  $this->db->get('project_file')->result();
	    	$y='1';
			foreach ($query2 as $data2) 
			{
				$sub_module = $data2->sub_module;
				$controller_name = $data2->controller_name;
				$insert_file = $data2->insert_file;
				$update_file = $data2->update_file;
				$list_file = $data2->list_file;
				$description_name = $data2->description_name;
				$xid_form = $data2->id_form;


				$this->db->where('id_form',$xid_form);
		    	$query3 =  $this->db->get('field_session')->result();
		    	$user = '';
				foreach ($query3 as $data3) 
				{
					$role = $data3->role;
					$user .= ', '.$role;
				}

				echo '
						<li>
						 <span class="num">'.$i.'.'.$y.'</span>
						 <a href="#"><b>'.$sub_module.'</b></a>
						 <br>
						 <a style="padding-left:45px;"><i>'.$description_name.'</li></a>
						 <a style="padding-left:45px;"><i>( Permission : Developer'.$user.' )</i></a>
						</li>
					 ';


				if($insert_file=='insert'){

					echo '
							<li>
							 	<ol>
							 		<span class="num">'.$controller_name.' : Insert</span>
							 		<a href="'.base_url().$controller_name.'/'.$controller_name.'_add" target="_blank">'.base_url().$controller_name.'/'.$controller_name.'_add</a>
							 	</ol>
							</li>
						 ';

				}

				if($update_file=='update'){

					echo '
							<li>
							 	<ol>
							 		<span class="num">'.$controller_name.' : Update</span>
							 		<a href="'.base_url().$controller_name.'/'.$controller_name.'_update/1" target="_blank">'.base_url().$controller_name.'/'.$controller_name.'_update</a>
							 	</ol>
							</li>
						 ';

				}

				if(($list_file=='list')||($list_file=='list_w_delete')){

					echo '
							<li>
							 	<ol>
							 		<span class="num">'.$controller_name.' : List</span>
							 		<a href="'.base_url().$controller_name.'/'.$controller_name.'_list" target="_blank">'.base_url().$controller_name.'/'.$controller_name.'_list</a>
							 	</ol>
							</li>
						 ';

				}

				


				$y++;
			}


			echo '
						</ol>
					</li>

					<hr>
				 ';

			$i++;
		}


	}


	function lookup_find_module()
	{
		$this->db->group_by('module');
		$project_id = $this->session->userdata('project_id');
		$this->db->where('project_id',$project_id);
    	$query =  $this->db->get('project_file')->result();
    	$i='1';
		foreach ($query as $data) 
		{
			$module = $data->module;
			$description_name = $data->description_name;

			$module = $data->module;

			$id_form = $data->id_form;

			echo '<option value="'.$id_form.'">'.$module.'</option>';
		}
	}


	function filename_page($id_view)
	{
		$project_id = $this->session->userdata('project_id');
		$this->db->where('id_view',$id_view);
		$this->db->where('project_id',$project_id);
    	$query =  $this->db->get('extra_page')->result();
    	$name_function='';
		foreach ($query as $data) 
		{
			$name_function = $data->name_function;
		}
		return $name_function;
	}


	function show_all_field($table_name)
    {
        $fields = $this->db->field_data($table_name);

        foreach ($fields as $field)
        {
           $table_name = $field->name;
           $type = $field->type;

           if(($table_name=='project_id')||($table_name=='uid')){

           } else {

           		echo '
	                    <tr>
	                      <td scope="col">'.$table_name.'</td>
	                      <td scope="col">'.$type.'</td>
	                    </tr>
	                ';

           }

           
        }
    }


    function list_developer()
    {
    	$project_id = $this->session->userdata('project_id');
		$this->db->where('team_member',1);
		$this->db->where('project_id',$project_id);
    	$query =  $this->db->get('project_login')->result();
    	$name_function='';
		foreach ($query as $data) 
		{
			$first_name = $data->first_name;
			$email = $data->email;
			$id = $data->id;

			echo '
	                    <tr>
	                      <td scope="col">'.$first_name.'</td>
	                      <td scope="col">'.$email.'</td>
	                    </tr>
	                ';
		}


		if(empty($query)){
			$nodata = 'No Data';
			echo '
					<tr>
                      <td scope="col">'.$nodata.'</td>
                      <td scope="col">'.$nodata.'</td>
                    </tr>
				 ';
		}
    }


    function check_name_controller($filename)
    {
    	$where = "
    				SELECT count(*) as Total FROM graph_create as a 
    				Where a.graph_name='$filename'
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
	
	function map_view($id)
	{
		$this->db->where('id',$id);
    	$query =  $this->db->get('cctv')->result();
		foreach ($query as $data) 
		{
			echo $data->location;
		}
	}
}



	
		