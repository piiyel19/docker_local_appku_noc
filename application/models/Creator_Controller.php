<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Creator_Controller extends CI_Model
{
    function __construct()
    {
      // Call the Model constructor
      parent::__construct();
    }


    function create_file_controller($id_form,$controller_name,$table_name,$insert_file,$update_file,$list_file)
    {

      // get session 
	  $this->db->where('id_form',$id_form);
	  $query_session =  $this->db->get('field_session')->result();
	  $permission = '';
	  foreach ($query_session as $data_session) 
	  {
	  		$role = $data_session->role;
	  		$permission .= "|| (\$this->session->userdata('role')=='".$role."')";
	  }


	  $start_permission = "if((\$this->session->userdata('role')=='developer')".$permission."){";
	  $end_permission = "}";


      $model_name = $controller_name.'_model';

      $this->create_model($id_form,$controller_name,$table_name,$insert_file,$update_file,$list_file);

    	// Create Controller
	  $controller = fopen(APPPATH.'controllers/'.$controller_name.'.php', "a")
	  or die("Unable to open file!");

	  $start ="<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class $controller_name extends CI_Controller  {

	    public function __construct()
	    {

	      parent::__construct();
	      \$this->load->database();
	      \$this->load->library('session');
	      \$this->load->model('$model_name','$controller_name');
	      \$this->load->helper('Lookup_helper');
	    }


	    function ".$controller_name."_view()
	    {	
	    	".$start_permission."
		    	\$this->load->view('project/header/header.php');
		    	\$this->load->view('project/body/".$controller_name."/".$controller_name."_view.php');
		    	\$this->load->view('project/footer/footer.php');
		    ".$end_permission."
	    }


	    function ".$controller_name."_details()
		{

			".$start_permission."
				\$id = \$this->input->post('id');
				\$query = \$this->".$controller_name."->".$controller_name."_details(\$id);

				if(empty(\$query)){
					echo 'Tiada Data Ditemui';
				} else {
				foreach (\$query as \$data) 
				{

				}
					echo json_encode(\$data);
				}
			".$end_permission."
		}

	 ";


	 if($insert_file=='insert'){

		 	$insert_view = 	"
		 						function ".$controller_name."_add()
							    {
							    	".$start_permission."
								    	\$this->load->view('project/header/header.php');
								    	\$this->load->view('project/body/".$controller_name."/".$controller_name."_add.php');
								    	\$this->load->view('project/footer/footer.php');
								    ".$end_permission."
							    }

		 					";	


		 	$data_field = '';
			$data_array = '';

			$data_file = '';

		 	$this->db->where('id_form',$id_form);
			$query2 =  $this->db->get('field_set')->result();

			$x=rand();
			foreach ($query2 as $data2) 
			{
				$id_name = $data2->id_name;
				$type_field = $data2->type_field;

				if(($type_field=='Multiple Checkboxes')||($type_field=='Inline Checkboxes')){

					$this->db->where('id_field',$id_name);
			    	$this->db->where('id_form',$id_form);
			    	$query3 =  $this->db->get('field_data')->result();
			    	$output='';
					foreach ($query3 as $data2) 
					{	
						$data_name = $data2->data_name;
			            $id_data = preg_replace('/\s+/', '_', $data_name);

						$data_field .= "
										 \$".$id_data." = \$this->input->post('".$id_data."');
								       ";

						$symbol = '=>';

						$data_array .= "
										'".$id_data."' ".$symbol." \$".$id_data.",
									  ";
					}

				} else if($type_field=='File'){


					$data_field .= "
								 \$".$id_name." = \$".$id_name.";
						       ";

					$symbol = '=>';

					$data_array .= "
									'".$id_name."' ".$symbol." \$".$id_name.",
								  ";


					$data_file .= "
									\$this->load->helper('file');  
							        \$config['upload_path']          = './source/all_file';
							        \$config['allowed_types']        = 'gif|jpg|png|jpeg|tif';
							        \$config['max_size']             = 0;
							        \$config['max_width']            = 0;
							        \$config['max_height']           = 0;
							        \$config['encrypt_name'] = TRUE;
							        \$config['remove_spaces'] = TRUE;

							        \$this->load->library('upload', \$config);
							        \$this->upload->initialize(\$config);

							        if ( ! \$this->upload->do_upload('".$id_name."'))
							        {
							            \$error = array('error' => \$this->upload->display_errors());
							            //var_dump(\$error); exit();
							            \$this->session->set_flashdata('error', 'Ralat ! Sila semak format gambar yang anda muat naik. Pastikan format gambar .gif, .jpg, .png, .jpeg, .tif dan pastikan saiz gambar tidak melebihi 500 mb.');
							            //echo 'Error'; exit();
							            \$".$id_name." = '';
							        }
							        else
							        {
							            \$data = array('upload_data' => \$this->upload->data());
							            \$new_name".$x." = \$this->upload->data('file_name');
							            \$".$id_name." = base_url().'source/all_file/'.\$new_name".$x.";

							        }


								  ";

				} else {

					$data_field .= "
								 \$".$id_name." = \$this->input->post('".$id_name."');
						       ";

					$symbol = '=>';

					$data_array .= "
									'".$id_name."' ".$symbol." \$".$id_name.",
								  ";

				}

				$x++;

			}

			
			// set session project_id
			$id_name = 'project_id';
			$data_field .= "
						 \$".$id_name." = \$this->session->userdata('project_id');
				       ";

			$symbol = '=>';

			$data_array .= "
							'".$id_name."' ".$symbol." \$".$id_name.",
						  ";



			// set session user id
			$id_name = 'uid';
			$data_field .= "
						 \$".$id_name." = \$this->session->userdata('id');
				       ";

			$symbol = '=>';

			$data_array .= "
							'".$id_name."' ".$symbol." \$".$id_name.",
						  ";


			if($list_file=='list'){
				$redirect = "redirect('".$controller_name."/".$controller_name."_list');";
			} else {
				$redirect = "redirect('".$controller_name."/".$controller_name."_add');";
			}


			$insert_view_submit = "
									
									function add_".$controller_name."_submit()
									{
										".$start_permission."

											".$data_file."

											".$data_field."

											\$data = array(".$data_array.");

											\$this->db->insert('".$table_name."',\$data);

											".$redirect."
										".$end_permission."
									}
									
								";


	 }	else {
		 	$insert_view = "";
		 	$insert_view_submit = "";
	 }





	 if($update_file=='update'){

		 	$update_view = 	"
			 						function ".$controller_name."_update()
								    {
								    	".$start_permission."
									    	\$this->load->view('project/header/header.php');
									    	\$this->load->view('project/body/".$controller_name."/".$controller_name."_update.php');
									    	\$this->load->view('project/footer/footer.php');
									    ".$end_permission."
								    }

			 					";

			$data_field = '';
			$data_array = '';


		 	$this->db->where('id_form',$id_form);
			$query2 =  $this->db->get('field_set')->result();

			$x=rand();
			foreach ($query2 as $data2) 
			{
				$id_name = $data2->id_name;

				$type_field = $data2->type_field;

				if(($type_field=='Multiple Checkboxes')||($type_field=='Inline Checkboxes')){

					$this->db->where('id_field',$id_name);
			    	$this->db->where('id_form',$id_form);
			    	$query3 =  $this->db->get('field_data')->result();
			    	$output='';
					foreach ($query3 as $data2) 
					{	
						$data_name = $data2->data_name;
			            $id_data = preg_replace('/\s+/', '_', $data_name);

						$data_field .= "
										 \$".$id_data." = \$this->input->post('".$id_data."');
								       ";

						$symbol = '=>';

						$data_array .= "
										'".$id_data."' ".$symbol." \$".$id_data.",
									  ";
					}

				} else if($type_field=='File'){


					$data_field .= "
								 \$".$id_name." = \$".$id_name.";
						       ";

					$symbol = '=>';

					$data_array .= "
									'".$id_name."' ".$symbol." \$".$id_name.",
								  ";


					$data_file .= "
									\$this->load->helper('file');  
							        \$config['upload_path']          = './source/all_file';
							        \$config['allowed_types']        = 'gif|jpg|png|jpeg|tif';
							        \$config['max_size']             = 0;
							        \$config['max_width']            = 0;
							        \$config['max_height']           = 0;
							        \$config['encrypt_name'] = TRUE;
							        \$config['remove_spaces'] = TRUE;

							        \$this->load->library('upload', \$config);
							        \$this->upload->initialize(\$config);

							        if ( ! \$this->upload->do_upload('".$id_name."'))
							        {
							            \$error = array('error' => \$this->upload->display_errors());
							            //var_dump(\$error); exit();
							            \$this->session->set_flashdata('error', 'Ralat ! Sila semak format gambar yang anda muat naik. Pastikan format gambar .gif, .jpg, .png, .jpeg, .tif dan pastikan saiz gambar tidak melebihi 500 mb.');
							            //echo 'Error'; exit();
							            \$".$id_name." = '';
							        }
							        else
							        {
							            \$data = array('upload_data' => \$this->upload->data());
							            \$new_name".$x." = \$this->upload->data('file_name');
							            \$".$id_name." = base_url().'source/all_file/'.\$new_name".$x.";

							        }


								  ";


				} else {

					$data_field .= "
								 \$".$id_name." = \$this->input->post('".$id_name."');
						       ";

					$symbol = '=>';

					$data_array .= "
									'".$id_name."' ".$symbol." \$".$id_name.",
								  ";

				}

				$x++;

			}


			if($list_file=='list'){
				$redirect = "redirect('".$controller_name."/".$controller_name."_list');";
			} else {
				$redirect = "redirect('".$controller_name."/".$controller_name."_update/1');";
			}

			$update_view_submit = 	"
										function update_".$controller_name."_submit()
										{
											".$start_permission."

												".$data_file."

												".$data_field."

												\$data = array(".$data_array.");

												\$id = \$this->uri->segment(3);

												\$this->db->where('id',\$id);

												\$this->db->update('".$table_name."',\$data);

												".$redirect."
											".$end_permission."
										}




										
									";


	 } else {

		 	$update_view = "";
		 	$update_view_submit = 	"";
	 }



	 if(($list_file=='list')||($list_file=='list_w_delete')){

	 	$setting1 = '"pagination"';
		$setting2 = '"paginate_button page-item"';
		$setting3 = '"paginate_button page-item prev"';
		$setting4 = '"paginate_button page-item active"';
		$setting5 = '"#"';


		$list_view = "
					function ".$controller_name."_list(\$rowno=0)
					{
						".$start_permission."
							\$this->load->library('pagination');

							\$search_text = '';
					  		if(\$this->input->post('submit') != NULL ){
					  			\$search_text = \$this->input->post('search');
					  			\$this->session->set_userdata(array('search'=>\$search_text));
					  		} else {
					  			if(\$this->session->userdata('search') != NULL){
									\$search_text = \$this->session->userdata('search');
								}
					  		}

					  		\$rowperpage = 10;
					  		if(\$rowno != 0){
						      \$rowno = (\$rowno-1) * \$rowperpage;
						    }

						    \$this->load->model('".$controller_name."_Model','".$controller_name."');

						    \$allcount = \$this->".$controller_name."->list_".$controller_name."_model_Count(\$search_text);
						    \$users_record = \$this->".$controller_name."->list_".$controller_name."_model_Data(\$rowno,\$rowperpage,\$search_text);


						    \$segment1 = \$this->uri->segment(1);
							\$segment2 = \$this->uri->segment(2);


						    \$config['base_url'] = base_url().\$segment1.'/'.\$segment2;
						    \$config['use_page_numbers'] = TRUE;
						    \$config['total_rows'] = \$allcount;
						    \$config['per_page'] = \$rowperpage;


						    // integrate bootstrap pagination
					        \$config['full_tag_open'] = '<ul class=".$setting1.">';
					        \$config['full_tag_close'] = '</ul>';
					        \$config['first_link'] = false;
					        \$config['last_link'] = false;
					        \$config['first_tag_open'] = '<li class=".$setting2.">';
					        \$config['first_tag_close'] = '</li>';
					        \$config['prev_link'] = '«';
					        \$config['prev_tag_open'] = '<li class=".$setting3.">';
					        \$config['prev_tag_close'] = '</li>';
					        \$config['next_link'] = '»';
					        \$config['next_tag_open'] = '<li paginate_button page-item >';
					        \$config['next_tag_close'] = '</li>';
					        \$config['last_tag_open'] = '<li paginate_button page-item >';
					        \$config['last_tag_close'] = '</li>';
					        \$config['cur_tag_open'] = '<li class=".$setting4."><a href=".$setting5.">';
					        \$config['cur_tag_close'] = '</a></li>';
					        \$config['num_tag_open'] = '<li paginate_button page-item >';
					        \$config['num_tag_close'] = '</li>';

						    \$this->pagination->initialize(\$config);


						    \$data['pagination'] = \$this->pagination->create_links();
						    \$data['result'] = \$users_record;
						    \$data['row'] = \$rowno;
						    \$data['search'] = \$search_text;

						    \$this->load->view('project/header/header.php');
					    	\$this->load->view('project/body/".$controller_name."/".$controller_name."_list.php',\$data);
					    	\$this->load->view('project/footer/footer.php');
					    ".$end_permission."
					}
				";

	 } else {
	 	$list_view = "";
	 }

	 if(($list_file=='list')||($list_file=='list_w_delete')||($update_file=='update')){
		 $delete = 	"
		 				function delete_item()
						{
							".$start_permission."
								\$id = \$this->input->post('id');
								\$this->db->where('id',\$id);
								\$this->db->delete('".$table_name."');
							".$end_permission."
						}
		 			";
     } else {
     	$delete = "";
     }


	 $end = "}";

	  $controller_content = $start.$insert_view.$insert_view_submit.$update_view.$update_view_submit.$list_view.$delete.$end;

	  fwrite($controller, "\n". $controller_content);
	  fclose($controller);
    }



    function create_model($id_form,$controller_name,$table_name,$insert_file,$update_file,$list_file)
    {
    	// Create Model
		  $controller = fopen(APPPATH.'models/'.$controller_name.'_model'.'.php', "a") 
		  or die("Unable to open file!");

		   $start ="<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

		class ".$controller_name."_model"." extends CI_Model
		{
		    function __construct()
		    {
		      // Call the Model constructor
		      parent::__construct();
		    }



		
		  ";


		$id2 = "'.\$id.'";
		$data = "	
		
				function ".$controller_name."_details(\$id)
				{
					\$select='SELECT * FROM ".$table_name." WHERE id=".$id2."';
				  	\$query= \$this->db->query(\$select);
				    if (\$query->num_rows() >0){ 
				        foreach (\$query->result() as \$data) {
				            
				            \$result[] = \$data;

				        }
				    	return \$result;
				    } 
				}
				
			";


		if(($list_file=='list')||($list_file=='list_w_delete')){

			$this->db->where('id_form',$id_form);
			$query2 =  $this->db->get('field_set')->result();
			$i=0;
			$data_search = '';
			foreach ($query2 as $data2) 
			{
				$id_name = $data2->id_name;
				if($i==0){

					$data_search .="
									\$this->db->like('".$id_name."', \$search);

							   ";

				} else {

					$data_search .="
									\$this->db->or_like('".$id_name."', \$search);

							   ";

				}
				
				$i++;
			}


			$data_list = "
				
					function list_".$controller_name."_model_Data(\$rowno,\$rowperpage,\$search)
					{
						\$this->db->order_by('id','desc');

						\$this->db->select('*');
					    \$this->db->from('".$table_name."');

					    if(\$search != ''){
					      ".$data_search."
					    }


					    \$this->db->limit(\$rowperpage, \$rowno); 
					    \$query = \$this->db->get();
					 
					    return \$query->result_array();
					}


					public function list_".$controller_name."_model_Count(\$search = '') {

					    \$this->db->select('count(*) as allcount');
					    \$this->db->from('".$table_name."');
					 
					    if(\$search != ''){
					      ".$data_search."
					    }


					    \$query = \$this->db->get();
					    \$result = \$query->result_array();
					 
					    return \$result[0]['allcount'];
					}
					
				";

		} else {
			$data_list = '';
		}








		$end = "}";


		$controller_content = $start.$data.$data_list.$end;

		fwrite($controller, "\n". $controller_content);
	  	fclose($controller);
    }



    function create_api_controller($id_form,$controller_name,$table_name,$api_id)
    {
        // Create Controller
	  $controller = fopen(APPPATH.'controllers/'.$controller_name.'_api_'.$api_id.'.php', "a")
	  or die("Unable to open file!");

	  $file = 	"
	  				<?php
	  				require APPPATH . 'libraries/REST_Controller.php';
     
					class ".$controller_name."_api_".$api_id." extends REST_Controller {
					    
						  /**
					     * Get All Data from this method.
					     *
					     * @return Response
					    */
					    public function __construct() {
					       parent::__construct();
					       \$this->load->database();
					    }
					       
					    /**
					     * Get All Data from this method.
					     *
					     * @return Response
					    */
						public function index_get(\$id = 0)
						{
					        if(!empty(\$id)){
					            \$data = \$this->db->get_where('".$table_name."', ['id' => \$id])->row_array();
					        }else{
					            \$data = \$this->db->get('".$table_name."')->result();
					        }
					     
					        \$this->response(\$data, REST_Controller::HTTP_OK);
						}
					      
					    /**
					     * Get All Data from this method.
					     *
					     * @return Response
					    */
					    public function index_post()
					    {
					        \$input = \$this->input->post();
					        \$this->db->insert('".$table_name."',\$input);
					     
					        \$this->response(['Item created successfully.'], REST_Controller::HTTP_OK);
					    } 
					     
					    /**
					     * Get All Data from this method.
					     *
					     * @return Response
					    */
					    public function index_put(\$id)
					    {
					        \$input = \$this->put();
					        \$this->db->update('".$table_name."', \$input, array('id'=>\$id));
					     
					        \$this->response(['Item updated successfully.'], REST_Controller::HTTP_OK);
					    }
					     
					    /**
					     * Get All Data from this method.
					     *
					     * @return Response
					    */
					    public function index_delete(\$id)
					    {
					        \$this->db->delete('".$table_name."', array('id'=>\$id));
					       
					        \$this->response(['Item deleted successfully.'], REST_Controller::HTTP_OK);
					    }
					}
	  			";

	  	fwrite($controller, "\n". $file);
	  	fclose($controller);

    }
}