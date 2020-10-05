<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cpanel extends CI_Controller {


	public function __construct()
	{

		parent::__construct();
		$this->load->helper('Lookup_helper');
		$this->load->library('pagination');
		$this->load->library('session');
		$this->load->model('Cpanel_Model','cpanel');
		$this->load->model('Creator_View','creator');
		$this->load->model('Creator_Controller','controller');

		if( ! ini_get('date.timezone') )
        {
           date_default_timezone_set('GMT');
        }
	}

	public function index()
	{

		

		if($this->session->userdata('role')=='developer'){
			$this->load->view('cpanel/header/header');
			$this->load->view('cpanel/body/creator.php');
			$this->load->view('cpanel/footer/footer');
		} else {

			$check_already_main_page = $this->cpanel->check_already_main_page();

			//var_dump($check_already_main_page); exit();
			if($check_already_main_page>0){
				redirect('page');
			} else {

				$check_already_create_client = $this->check_already_create_client();
			
				if($check_already_create_client>0){
					redirect('login');
				} else {

					$check_developer = $this->check_developer();
					if($check_developer>0){
						$this->load->view('cpanel/login.php');
					} else {
						$this->load->view('cpanel/login_nosetup.php');
					}
				}

			}

			

			
		}
	}


	public function login()
	{
		if($this->session->userdata('role')=='developer'){
			redirect('cpanel/menu_project');
		} else {
			$this->load->view('cpanel/login.php');
		}
		
	}



	public function start_project()
	{
		if($this->session->userdata('role')=='developer'){
			$this->load->view('cpanel/register.php');
		} else {
			redirect('cpanel/login');
		}
	}



	public function set_session()
	{
		if($this->session->userdata('role')=='developer'){
			$this->load->view('cpanel/set_session.php');
		} else {
			redirect('cpanel/login');
		}
		
	}


	public function menu_project()
	{
		if($this->session->userdata('role')=='developer'){
			$this->load->view('cpanel/menu_project.php');
		} else {
			redirect('cpanel/login');
		}
		
	}


	function creator()
	{
		if($this->session->userdata('role')=='developer'){

			$this->load->view('cpanel/header/header');
			$this->load->view('cpanel/body/creator.php');
			$this->load->view('cpanel/footer/footer');
		} else {
			redirect('cpanel/login');
		}
	}



	function list_module()
	{
		if($this->session->userdata('role')=='developer'){

			$this->load->view('cpanel/header/header');
			$this->load->view('cpanel/body/list_module.php');
			$this->load->view('cpanel/footer/footer');
		} else {
			redirect('cpanel/login');
		}
	}


	function sort_view()
	{
		if($this->session->userdata('role')=='developer'){
			$this->load->view('cpanel/header/header');
			$this->load->view('cpanel/body/sort_view.php');
			$this->load->view('cpanel/footer/footer');
		} else {
			redirect('cpanel/login');
		}
	}


	function text_editor()
	{
		if($this->session->userdata('role')=='developer'){
			$this->load->view('cpanel/header/header');
			$this->load->view('cpanel/body/text_editor.php');
			$this->load->view('cpanel/footer/footer');
		} else {
			redirect('cpanel/login');
		}
			
	}



	function lookup_helper($rowno=0)
	{
		if($this->session->userdata('role')=='developer'){

			$this
            ->load
            ->library('pagination');

	        $search_text = '';
	        if ($this
	            ->input
	            ->post('submit') != NULL)
	        {
	            $search_text = $this
	                ->input
	                ->post('search');
	            $this
	                ->session
	                ->set_userdata(array(
	                'search' => $search_text
	            ));
	        }
	        else
	        {
	            if ($this
	                ->session
	                ->userdata('search') != NULL)
	            {
	                $search_text = $this
	                    ->session
	                    ->userdata('search');
	            }
	        }

	        $rowperpage = 10;
	        if ($rowno != 0)
	        {
	            $rowno = ($rowno - 1) * $rowperpage;
	        }


	        $allcount = $this
	            ->cpanel
	            ->lookup_helper_Count($search_text);
	        $users_record = $this
	            ->cpanel
	            ->lookup_helper_Data($rowno, $rowperpage, $search_text);

	        $segment1 = $this
	            ->uri
	            ->segment(1);
	        $segment2 = $this
	            ->uri
	            ->segment(2);

	        $config['base_url'] = base_url() . $segment1 . '/' . $segment2;
	        $config['use_page_numbers'] = true;
	        $config['total_rows'] = $allcount;
	        $config['per_page'] = $rowperpage;

	        // integrate bootstrap pagination
	        $config['full_tag_open'] = '<ul class="pagination">';
	        $config['full_tag_close'] = '</ul>';
	        $config['first_link'] = false;
	        $config['last_link'] = false;
	        $config['first_tag_open'] = '<li class="paginate_button page-item">';
	        $config['first_tag_close'] = '</li>';
	        $config['prev_link'] = '«';
	        $config['prev_tag_open'] = '<li class="paginate_button page-item prev">';
	        $config['prev_tag_close'] = '</li>';
	        $config['next_link'] = '»';
	        $config['next_tag_open'] = '<li paginate_button page-item >';
	        $config['next_tag_close'] = '</li>';
	        $config['last_tag_open'] = '<li paginate_button page-item >';
	        $config['last_tag_close'] = '</li>';
	        $config['cur_tag_open'] = '<li class="paginate_button page-item active"><a href="#">';
	        $config['cur_tag_close'] = '</a></li>';
	        $config['num_tag_open'] = '<li paginate_button page-item >';
	        $config['num_tag_close'] = '</li>';

	        $this
	            ->pagination
	            ->initialize($config);

	        $data['pagination'] = $this
	            ->pagination
	            ->create_links();
	        $data['result'] = $users_record;
	        $data['row'] = $rowno;
	        $data['search'] = $search_text;

			$this->load->view('cpanel/header/header');
			$this->load->view('cpanel/body/helper.php',$data);
			$this->load->view('cpanel/footer/footer');


		} else {
			redirect('cpanel/login');
		}
	}


	function save_code()
	{
		if($this->session->userdata('role')=='developer'){
			$code = $this->input->post('code');

			//$path_helper = $_SERVER['DOCUMENT_ROOT'].'/application/controllers/test.php';
			$path_helper = $this->input->post('file');
			$data = $code;
			$f=fopen($path_helper,'w');
			fwrite($f,$data);
			fclose($f);
		} else {
			//redirect('cpanel/login');
		}
	}



	function create_field()
	{
		if($this->session->userdata('role')=='developer'){
			$table_name = $this->input->post('tbl');
			$type_field = $this->input->post('type_field');
			$id_name = $this->input->post('id_name');
			$label = $this->input->post('label');
			$placeholder = $this->input->post('placeholder');
			$required = $this->input->post('required_field');
			$breakline = $this->input->post('break_line');
			$dt_lookup = $this->input->post('dt_lookup');
			$id_form = $this->input->post('id_form');

			$id_name = strtolower($id_name);
			
			$data_hardcode=0;
			$option_multiple_radio = '';
			$option_inline_radio = '';
			$option_multiple_checkboxes = '';
			$option_inline_checkboxes = '';
			$option_dropdown = '';


			$id_data_lookup = $this->input->post('id_data_lookup');


			if($dt_lookup>0){

			} else {
				$check_data_set = $this->cpanel->check_data_set($id_name,$id_form);

				//var_dump($check_data_set); exit();
				if($check_data_set>0){
					$data_hardcode=1;
					$dt_lookup=0;

					$option_multiple_radio = $this->cpanel->option_multiple_radio($id_name,$id_form);
					$option_inline_radio = $this->cpanel->option_inline_radio($id_name,$id_form);
					$option_multiple_checkboxes = $this->cpanel->option_multiple_checkboxes($id_name,$id_form,$table_name);
					$option_inline_checkboxes = $this->cpanel->option_inline_checkboxes($id_name,$id_form,$table_name);
					$option_dropdown = $this->cpanel->option_dropdown($id_name,$id_form);

				} else {
					$data_hardcode=0;
					$dt_lookup=1;
				}

			}

			$check_id_name = $this->cpanel->check_id_name($id_name,$id_form);
			if($check_id_name>0){
				$id_name = $id_name.rand();
			}

			if($required=='1'){
				$required_html = 'required';
			} else {
				$required_html = '';
			}

			if($breakline=='1'){
				$breakline_html = '<div class="col-md-12"></div>';
			} else {
				$breakline_html = '';
			}

			if($type_field=='Text'){
				$html_code = '
								
					                <div class="col-md-4" draggable="true">
					                  <label>'.$label.'</label>
					                  <input type="text" class="form-control" name="'.$id_name.'" id="'.$id_name.'" placeholder="'.$placeholder.'" '.$required_html.'>
					                </div>
					            
					            '.$breakline_html.'

							 ';
			} else if($type_field=='Date'){
				$html_code = '
								
					                <div class="col-md-4" draggable="true">
					                  <label>'.$label.'</label>
					                  <input type="text" class="form-control datepicker" name="'.$id_name.'" id="'.$id_name.'" placeholder="'.$placeholder.'" '.$required_html.'>
					                </div>
					            
					            '.$breakline_html.'

							 ';
			} else if($type_field=='Number'){
				$html_code = '
								
					                <div class="col-md-4" draggable="true">
					                  <label>'.$label.'</label>
					                  <input type="number" class="form-control" name="'.$id_name.'" id="'.$id_name.'" placeholder="'.$placeholder.'" '.$required_html.' step="0.1">
					                </div>
					            
					            '.$breakline_html.'

							 ';
			} else if($type_field=='Email'){

				$html_code = '
								
					                <div class="col-md-4" draggable="true">
					                  <label>'.$label.'</label>
					                  <input type="email" class="form-control" name="'.$id_name.'" id="'.$id_name.'" placeholder="'.$placeholder.'" '.$required_html.'>
					                </div>
					       
					            '.$breakline_html.'

							 ';
			} else if($type_field=='Textarea'){

				$html_code = '
								
					                <div class="col-md-4" draggable="true">
					                  <label>'.$label.'</label>
					                  <textarea class="form-control" id="'.$id_name.'" name="'.$id_name.'" placeholder="'.$placeholder.'" '.$required_html.'></textarea>
					                </div>
					       
					            '.$breakline_html.'

							 ';
			} else if($type_field=='Password'){

				$html_code = '
							
					                <div class="col-md-4" draggable="true">
					                  <label>'.$label.'</label>
					                  <input type="password" class="form-control" name="'.$id_name.'" id="'.$id_name.'" placeholder="'.$placeholder.'" '.$required_html.'>
					                </div>
					          
					            '.$breakline_html.'

							 ';

			} else if($type_field=='File'){
				$html_code = '
							
					                <div class="col-md-4" draggable="true">
					                  <label>'.$label.'</label>
					                  <input type="file" class="form-control" name="'.$id_name.'" id="'.$id_name.'" placeholder="'.$placeholder.'" '.$required_html.'>
					                </div>
					         
					            '.$breakline_html.'

							 ';
			} else if($type_field=='Multiple Radio'){

				if(!empty($option_multiple_radio)){

					$html_code = '
								
					                <div class="col-md-4" draggable="true" style="padding-left: 0px;">
							            <label class="col-md-4 ">'.$label.'</label>
			                            <div class="col-md-8">
			                                '.$option_multiple_radio.'
			                            </div>
			                        </div>
			                    
	                            '.$breakline_html.'

							 ';

				} else {

					$html_code = '
								
					                <div class="col-md-4" draggable="true" style="padding-left: 0px;">
							            <label class="col-md-4 ">'.$label.'</label>
			                            <div class="col-md-8">
			                                <div class="radio">
			                                    <label for="radios-0">
			                                        <input type="radio" name="'.$id_name.'" id="radios-0" value="1" checked="checked">
			                                        Option one
			                                    </label>
			                                </div>
			                                <div class="radio">
			                                    <label for="radios-1">
			                                        <input type="radio" name="'.$id_name.'" id="radios-1" value="2">
			                                        Option two
			                                    </label>
			                                </div>
			                            </div>
			                        </div>
			                   
	                            '.$breakline_html.'

							 ';

				}

				

			} else if($type_field=='Inline Radio'){


				if(!empty($option_inline_radio)){

					$html_code = '
									
						                <div class="col-md-4" draggable="true" style="padding-left: 0px;">
											<label class="col-md-4 ">'.$label.'</label>
				                            <div class="col-md-8">
				                                '.$option_inline_radio.'
				                            </div>
				                        </div>
				                   
						            '.$breakline_html.'
								 ';
				} else {

					$html_code = '
									
						                <div class="col-md-4" draggable="true" style="padding-left: 0px;">
											<label class="col-md-4 ">'.$label.'</label>
				                            <div class="col-md-8">
				                                <label class="radio-inline" for="radios-0">
				                                    <input type="radio" name="'.$id_name.'" id="radios-0" value="1" checked="checked">
				                                    1
				                                </label>
				                                <label class="radio-inline" for="radios-1">
				                                    <input type="radio" name="'.$id_name.'" id="radios-1" value="2">
				                                    2
				                                </label>
				                                <label class="radio-inline" for="radios-2">
				                                    <input type="radio" name="'.$id_name.'" id="radios-2" value="3">
				                                    3
				                                </label>
				                                <label class="radio-inline" for="radios-3">
				                                    <input type="radio" name="'.$id_name.'" id="radios-3" value="4">
				                                    4
				                                </label>
				                            </div>
				                        </div>
				                   
						            '.$breakline_html.'

								 ';
				}


			} else if($type_field=='Multiple Checkboxes'){

				if(!empty($option_multiple_checkboxes)){
					$html_code = '
									
						                <div class="col-md-4" draggable="true" style="padding-left: 0px;">
											<label class="col-md-4 ">'.$label.'</label>
			                                <div class="col-md-8">
			                                    '.$option_multiple_checkboxes.'
			                                </div>
				                        </div>
				                    
						            '.$breakline_html.'

								 ';
				} else {
					$html_code = '
									
						                <div class="col-md-4" draggable="true" style="padding-left: 0px;">
											<label class="col-md-4 ">'.$label.'</label>
			                                <div class="col-md-8">
			                                    <div class="checkbox">
			                                        <label for="">
			                                            <input type="checkbox" name="'.$id_name.'" id="" value="1">
			                                            Option one
			                                        </label>
			                                    </div>
			                                    <div class="checkbox">
			                                        <label for="checkboxes-1">
			                                            <input type="checkbox" name="'.$id_name.'" id="checkboxes-1" value="2">
			                                            Option two
			                                        </label>
			                                    </div>
			                                </div>
				                        </div>
				                    
						            '.$breakline_html.'

								 ';
				}

			} else if($type_field=='Inline Checkboxes'){

				if(!empty($option_inline_checkboxes)){
					$html_code = '
									
						                <div class="col-md-4" draggable="true" style="padding-left: 0px;">
											<label class="col-md-4 ">'.$label.'</label>
				                              <div class="col-md-8">
				                                '.$option_inline_checkboxes.'
				                              </div>
				                            </div>
				                        </div>
				                    
						            '.$breakline_html.'

								 ';
				} else {
					$html_code = '
									
						                <div class="col-md-4" draggable="true" style="padding-left: 0px;">
											<label class="col-md-4 ">'.$label.'</label>
				                              <div class="col-md-8">
				                                <label class="checkbox-inline" for="">
				                                  <input type="checkbox" name="'.$id_name.'" id="" value="1">
				                                  1
				                                </label>
				                                <label class="checkbox-inline" for="checkboxes-1">
				                                  <input type="checkbox" name="'.$id_name.'" id="checkboxes-1" value="2">
				                                  2
				                                </label>
				                                <label class="checkbox-inline" for="checkboxes-2">
				                                  <input type="checkbox" name="'.$id_name.'" id="checkboxes-2" value="3">
				                                  3
				                                </label>
				                                <label class="checkbox-inline" for="checkboxes-3">
				                                  <input type="checkbox" name="'.$id_name.'" id="checkboxes-3" value="4">
				                                  4
				                                </label>
				                              </div>
				                            </div>
				                        </div>
				                    
						            '.$breakline_html.'

								 ';
				}

			} else if($type_field=='Dropdown'){

				if(!empty($option_dropdown)){

					if(!empty($id_data_lookup)){

						$html_code = '
									
						                <div class="col-md-4" draggable="true">
											<label class="col-md-12 " for="selectbasic">'.$label.'</label>
			                                <div class="col-md-12">
			                                    <select id="'.$id_name.'" name="'.$id_name.'" class="form-control">
			                                    	<option value="">-- Please Select --</option>
			                                        '.$id_data_lookup.'
			                                    </select>
			                                </div>
				                        </div>
				                 
						            '.$breakline_html.'

								 ';

					} else {

						$html_code = '
									
						                <div class="col-md-4" draggable="true">
											<label class="col-md-12 " for="selectbasic">'.$label.'</label>
			                                <div class="col-md-12">
			                                    <select id="'.$id_name.'" name="'.$id_name.'" class="form-control">
			                                    	<option value="">-- Please Select --</option>
			                                        '.$option_dropdown.'
			                                    </select>
			                                </div>
				                        </div>
				                 
						            '.$breakline_html.'

								 ';

					}

					
				} else {

					if(!empty($id_data_lookup)){

						$html_code = '
									
						                <div class="col-md-4" draggable="true">
											<label class="col-md-12 " for="selectbasic">'.$label.'</label>
			                                <div class="col-md-12">
			                                    <select id="'.$id_name.'" name="'.$id_name.'" class="form-control">
			                                    	<option value="">-- Please Select --</option>
			                                        '.$id_data_lookup.'
			                                    </select>
			                                </div>
				                        </div>
				                    
						            '.$breakline_html.'

								 ';

					} else {

						$html_code = '
									
						                <div class="col-md-4" draggable="true">
											<label class="col-md-12 " for="selectbasic">'.$label.'</label>
			                                <div class="col-md-12">
			                                    <select id="'.$id_name.'" name="'.$id_name.'" class="form-control">
			                                    	<option value="">-- Please Select --</option>
			                                        <option value="Test 1">Test 1</option>
			                                        <option value="Test 2">Test 2</option>
			                                    </select>
			                                </div>
				                        </div>
				                    
						            '.$breakline_html.'

								 ';

					}
					
				}

			} else {	
				$html_code = '';
			}

			$field_set = array(
										'type_field'=>$type_field,
										'id_name'=>$id_name,
										'label'=>$label,
										'placeholder'=>$placeholder,
										'required'=>$required,
										'breakline'=>$breakline,
										'html_code'=>$html_code,
										'id_form'=>$id_form,
										'data_lookup'=>$dt_lookup,
										'data_hardcode'=>$data_hardcode,
										'project_id'=>$this->session->userdata('project_id')
									 );

			$this->db->insert('field_set',$field_set);



			if(!empty($id_data_lookup)){
				$register_lookup = array(
											'id_form'=>$id_form,
											'id_field'=>$id_name,
											'lookup_name'=>$id_data_lookup,
											'project_id'=>$this->session->userdata('project_id')
										);
				$this->db->insert('field_data_lookup',$register_lookup);
			}
		}
	}


	function html_field()
	{
		$id_form = $this->input->post('id_form');
		$this->cpanel->html_field($id_form);
	}


	function sso()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$check = $this->check_user($email,$password);

		if($check==0){
			redirect('cpanel/login');
		} else {
			$this->create_session($email);
			$setup_role = $this->get_id_project($email);

			if($setup_role==1){
				redirect('cpanel/menu_project');
			} else {
				redirect('cpanel/start_project');
			}

		}


	}



	function check_user($email,$password)
	{
		$where = "
    				SELECT count(*) as Total FROM project_login as a 
    				Where a.email='$email' AND a.password='$password'
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



	function get_id_project($email)
	{
		$where = "
    				SELECT setup_register  FROM project_login as a 
    				where a.email='$email'
    			 ";
    	$query = $this->db->query($where);
        if ($query->num_rows() >0){ 
            foreach ($query->result() as $data) {
                $setup_register = $data->setup_register;

                return $setup_register;

            }
        }
    }


	function create_session($email)
	{
		$where = "
    				SELECT project_id, id,first_name  FROM project_login as a 
    				where a.email='$email'
    			 ";
    	$query = $this->db->query($where);
        if ($query->num_rows() >0){ 
            foreach ($query->result() as $data) {
                $project_id = $data->project_id;
                $id = $data->id;
                $first_name = $data->first_name;
                // set session user
				$data = array(
								'role'=>'developer',
								'project_id'=>$project_id,
								'id'=>$id,
								'first_name'=>$first_name,
								'logged_in'=>TRUE
							);

				//var_dump($data); exit();

				$this->session->set_userdata($data);

				return true;
            }
        } else {
        	return false;
        }
	}


	function logout()
	{
		//$id = $this->session->userdata('id');
		//$this->update_offline($uid);
		$this->session->sess_destroy();
		redirect('cpanel/login');
	}


	function setup_register()
	{
		$first_name = $this->input->post('first_name');
		$last_name = $this->input->post('last_name');
		$phone_number = $this->input->post('phone_number');
		$address = $this->input->post('address');
		$avatar = $this->input->post('avatar');
		$user_id = $this->input->post('user_id');

		$project_id = $this->session->userdata('project_id');

		$data = array(
						'first_name'=>$first_name,
						'last_name'=>$last_name,
						'phone_number'=>$phone_number,
						'address'=>$address,
						'avatar'=>$avatar,
						'user_id'=>$user_id,
						'email'=>1,
						'password'=>1,
						'project_id'=>$project_id
					 );

		$this->db->insert('project_user_required',$data);


		$data_start = array('setup_register'=>1);
		$this->db->where('project_id',$project_id);
		$this->db->update('project_login',$data_start);


		$this->create_view_register($project_id);
		$this->create_controller_register($project_id);
		$this->create_controller_login($project_id);

		$save_url = array(
							'controller'=>'login',
							'url'=>base_url().'login',
							'project_id'=>$this->session->userdata('project_id')
						 );

		$this->db->insert('project_url',$save_url);


		$save_url = array(
							'controller'=>'register',
							'url'=>base_url().'register',
							'project_id'=>$this->session->userdata('project_id')
						 );

		$this->db->insert('project_url',$save_url);

		redirect('login');



	}
	

	function add_role()
	{
		$role = $this->input->post('role');
		$project_id = $this->session->userdata('project_id');


		$data = array(
						'role'=>$role,
						'project_id'=>$project_id
					 );

		$this->db->insert('project_role',$data);


	}





	function create_view_register($project_id)
	{


		  // Create Controller
		  $path_helper = fopen(APPPATH.'views/project/register.php', "w")
		  or die("Unable to open file!");


		  	$this->db->where('project_id',$project_id);
			$query2 =  $this->db->get('project_user_required')->result();
			foreach ($query2 as $data2) 
			{
				$first_name = $data2->first_name;
				$last_name = $data2->last_name;
				$phone_number = $data2->phone_number;
				$avatar = $data2->avatar;
				$address = $data2->address;
				$user_id = $data2->user_id;


				$default_code = '
									<!DOCTYPE html>
									<html lang="en">
									<head>
										<meta charset="utf-8">
										<meta name="author" content="Kodinger">
										<meta name="viewport" content="width=device-width,initial-scale=1">
										<title>Creator</title>
										<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
										<link rel="stylesheet" type="text/css" href="<?= base_url()?>shop_asset/login/css/my-login.css">

										<link href="<?= base_url()?>asset_cpanel/img/favicon.png" rel="icon">
										<link href="<?= base_url()?>asset_cpanel/img/favicon.png" rel="apple-touch-icon">
									</head>

									<body class="my-login-page">
										<section class="h-100">
											<div class="container h-100">
												<div class="row justify-content-md-center h-100">
													<div class="card-wrapper">
														<div class="" align="center" style="padding-top: 100px; padding-bottom: 40px;">
															<h4>Register To System</h4>
															<p>“Experience is the name everyone gives to their mistakes.”</p>
														</div>
														<div class="card fat">
															<div class="card-body">
																<h4 class="card-title">Set Login Page</h4>
								';



				$end_default = 	'
																		</div>
														</div>
														<div class="footer">
															Copyright &copy; 2020 &mdash; APPKU
														</div>
													</div>
												</div>
											</div>
										</section>

										

										
									</body>
									</html>


									<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js" integrity="sha512-WNLxfP/8cVYL9sj8Jnp6et0BkubLP31jhTG9vhL/F5uEZmg5wEzKoXp1kJslzPQWwPT1eyMiSxlKCgzHLOTOTQ==" crossorigin="anonymous"></script>
								';


				$email = '
							<div class="">
                                <label for="">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" required>
                            </div>
					     ';


				$password = '
								<div class="">
	                                <label for="">Password</label>
	                                    <input type="password" class="form-control" name="password" id="password" required>
	                            </div>
							';


				if($first_name==1){
					$first_name = '
									<div class="">
                                        <label for="">First Name</label>
                                            <input type="text" class="form-control" name="first_name" id="first_name" required>
                                    </div>
								  ';
				} else {
					$first_name='';
				}



				if($last_name==1){
					$last_name = '
									<div class="">
                                        <label for="">Last Name</label>
                                            <input type="text" class="form-control" name="last_name" id="last_name" required>
                                    </div>
								 ';
				} else {
					$last_name='';
				}



				if($phone_number==1){
					$phone_number = '
										<div class="">
	                                        <label for="">Phone Number</label>
	                                            <input type="number" class="form-control" name="phone_number" id="phone_number" required>
	                                    </div>
									';
				} else {
					$phone_number='';
				}



				if($avatar==1){
					$avatar = '
								<div class="">
                                    <label for="">User Photo</label>
                                        <input type="file" class="form-control" name="avatar" id="avatar" required>
                                </div>
							  ';

					$form = '
								<form method="POST" action="'.base_url().'register/register_user" enctype="multipart/form-data">
							';

					$end_form = '</form>';


				} else {
					$avatar='';

					$form = '
								<form method="POST" action="'.base_url().'register/register_user">
							';

					$end_form = '</form>';
				}



				if($address==1){
					$address = '
									<div class="">
                                        <label for="">Address</label>
                                        <textarea class="form-control" name="address" id="address" required rows="5"></textarea>
                                    </div>
							   ';
				} else {
					$address='';
				}



				if($user_id==1){
					$user_id = '
									<div class="">
                                        <label for="">User ID</label>
                                        <input type="text" class="form-control" name="user_id" id="user_id" required>
                                    </div>
							   ';
				} else {
					$user_id='';
				}


			}


			$this->db->where('role !=','admin');
	    	$this->db->where('project_id',$project_id);
	    	$query2 =  $this->db->get('project_role')->result();
	    	$data_role='';
			foreach ($query2 as $data2) 
			{
				$data_role .= "<option value='".$data2->role."'>".$data2->role."</option>";
			}


			$role = '
						<div class="">
                            <label for="">Role</label>
                            <select class="form-control" name="role" id="role" required>
                            	<option value="Admin">Admin</option>
                            	'.$data_role.'
                            </select>
                        </div>
					';


			$button = '
						<div class="col-md-12" style="padding-top: 30px; padding-bottom: 30px;">
		                    <div class="row">
		                      <div class="col-md-8"></div>
		                      <div class="col-md-4">
		                        <button class="btn btn-success" type="submit">Create</button>
		                      </div>
		                    </div>
		                </div>
					  ';


			$data = $role.$email.$password.$first_name.$last_name.$phone_number.$address.$avatar.$user_id.$button;


			$html = '
						<div class="row">
							<div class="col-md-12">
								'.$data.'
							</div>
						</div>
					';


			$complete = $default_code.$form.$html.$end_form.$end_default;

		  	

		  $controller_content = $complete;
		  fwrite($path_helper, "\n". $controller_content);
		  fclose($path_helper);
	}


	function create_controller_register($project_id)
	{
		$controller_name = 'Register';
		// Create Controller
		  $controller = fopen(APPPATH.'controllers/'.$controller_name.'.php', "a")
		  or die("Unable to open file!");




		  $this->db->where('project_id',$project_id);
			$query2 =  $this->db->get('project_user_required')->result();
			foreach ($query2 as $data2) 
			{
				$first_name = $data2->first_name;
				$last_name = $data2->last_name;
				$phone_number = $data2->phone_number;
				$avatar = $data2->avatar;
				$address = $data2->address;
				$user_id = $data2->user_id;

				$data_field = '';
				$data_array = '';

				if($first_name==1){

					$data_field .= "
								 \$first_name= \$this->input->post('first_name');
						       ";

					$symbol = '=>';

					$data_array .= "
									'first_name' ".$symbol." \$first_name,
								  ";

				} 


				if($last_name==1){

					$data_field .= "
								 \$last_name= \$this->input->post('last_name');
						       ";

					$symbol = '=>';

					$data_array .= "
									'last_name' ".$symbol." \$last_name,
								  ";

				} 



				if($phone_number==1){

					$data_field .= "
								 \$phone_number= \$this->input->post('phone_number');
						       ";

					$symbol = '=>';

					$data_array .= "
									'phone_number' ".$symbol." \$phone_number,
								  ";

				} 


				if($avatar==1){

					$data_field .= "
								 \$avatar= \$this->input->post('avatar');
						       ";

					$symbol = '=>';

					$data_array .= "
									'avatar' ".$symbol." \$image,
								  ";


					$save_img = "
									\$this->load->helper('file');  
							        \$config['upload_path']          = './source/avatar';
							        \$config['allowed_types']        = 'gif|jpg|png|jpeg|tif';
							        \$config['max_size']             = 0;
							        \$config['max_width']            = 0;
							        \$config['max_height']           = 0;
							        \$config['encrypt_name'] = TRUE;
							        \$config['remove_spaces'] = TRUE;

							        \$this->load->library('upload', \$config);
							        \$this->upload->initialize(\$config);

							        if ( ! \$this->upload->do_upload('avatar'))
							        {
							            \$error = array('error' => \$this->upload->display_errors());
							            //var_dump(\$error); exit();
							            \$this->session->set_flashdata('error', 'Ralat ! Sila semak format gambar yang anda muat naik. Pastikan format gambar .gif, .jpg, .png, .jpeg, .tif dan pastikan saiz gambar tidak melebihi 500 mb.');
							            //echo 'Error'; exit();
							            \$image = '';
							        }
							        else
							        {
							            \$data = array('upload_data' => \$this->upload->data());
							            \$new_name = \$this->upload->data('file_name');
							            \$image = base_url().'source/avatar/'.\$new_name;

							        }
								";

				}  else {
					$save_img = "
									\$image = '';
								";
				}


				if($address==1){

					$data_field .= "
								 \$address= \$this->input->post('address');
						       ";

					$symbol = '=>';

					$data_array .= "
									'address' ".$symbol." \$address,
								  ";

				} 



				if($user_id==1){

					$data_field .= "
								 \$user_id= \$this->input->post('user_id');
						       ";

					$symbol = '=>';

					$data_array .= "
									'user_id' ".$symbol." \$user_id,
								  ";

				} 



				$data_field .= "
								 \$email= \$this->input->post('email');
					       ";

				$symbol = '=>';

				$data_array .= "
								'email' ".$symbol." \$email,
							  ";



				$data_field .= "
								 \$password= \$this->input->post('password');
					       ";

				$symbol = '=>';

				$data_array .= "
								'password' ".$symbol." \$password,
							  ";



				$data_field .= "
								 \$project_id= '".$this->session->userdata('project_id')."';
					       ";

				$symbol = '=>';

				$data_array .= "
								'project_id' ".$symbol." \$project_id,
							  ";



				$data_field .= "
								 \$random_id= rand();
					       ";

				$symbol = '=>';

				$data_array .= "
								'random_id' ".$symbol." \$random_id,
							  ";



				$data_field .= "
								 \$role= \$this->input->post('role');
					       ";

				$symbol = '=>';

				$data_array .= "
								'role' ".$symbol." \$role,
							  ";
			}



		  $controller_content ="<?php defined('BASEPATH') OR exit('No direct script access allowed');

		class $controller_name extends CI_Controller  {

		    public function __construct()
		    {

		      parent::__construct();
		      \$this->load->database();
		      \$this->load->library('session');
		      \$this->load->helper('Lookup_helper');
		    }

		    function index()
			{
				\$this->load->view('project/register.php');
			}

			function register_user()
			{
				".$save_img.";

				".$data_field."

				\$data = array(".$data_array.");

				\$this->db->insert('project_user',\$data);

				redirect('login');
			}

		 }";
		  fwrite($controller, "\n". $controller_content);
		  fclose($controller);

	}



	function create_controller_login($project_id)
	{
		$controller_name = 'Login';
		// Create Controller
		  $path_helper = fopen(APPPATH.'controllers/'.$controller_name.'.php', "a")
		  or die("Unable to open file!");


		  	$space = '"';
			$space2 = '"';

			$comma = "'";

			$data = "	
						<?php defined('BASEPATH') OR exit('No direct script access allowed');

						class $controller_name extends CI_Controller  {

						    public function __construct()
						    {

						      parent::__construct();
						      \$this->load->database();
						      \$this->load->library('session');
						      \$this->load->helper('Lookup_helper');
						    }


						    function index()
						    {
						    	\$this->session->sess_destroy();
						    	\$this->load->view('project/login');
						    }


							function access(){
								\$email = \$this->input->post('email');
								\$password = \$this->input->post('password');
								\$check = \$this->check_user_access(\$email,\$password);

								if(\$check==0){
									redirect('login');
								} else {
									\$this->create_session_user(\$email);

									redirect('dashboard');

								}
							}


							function check_user_access(\$email,\$password)
							{
								\$where = '
						    				SELECT count(*) as Total FROM project_user as a 
						    				Where a.email=".$space.$comma.".\$email.".$comma.$space2." AND a.password=".$space.$comma.".\$password.".$comma.$space2."
						    			 ';
						    	\$query = \$this->db->query(\$where);
						        if (\$query->num_rows() >0){ 
						            foreach (\$query->result() as \$data) {
						                return \$data->Total;
						            }
						        } else {
						        	return '0';
						        }
							}


							function create_session_user(\$email)
							{
								\$where = '
						    				SELECT project_id, id,role  FROM project_user as a 
						    				where a.email=".$space.$comma.".\$email.".$comma.$space2."
						    			 ';
						    	\$query = \$this->db->query(\$where);
						        if (\$query->num_rows() >0){ 
						            foreach (\$query->result() as \$data) {
						                \$project_id = \$data->project_id;
						                \$id = \$data->id;
						                \$role = \$data->role;

										\$data = array(
														'role'=>\$role,
														'project_id'=>\$project_id,
														'id'=>\$id,
														'logged_in'=>TRUE
													);


										\$this->session->set_userdata(\$data);

										return true;
						            }
						        } else {
						        	return false;
						        }
							}


							function logout()
							{
								\$this->session->sess_destroy();
								redirect('login');
							}
						}
					";

			$controller_content = $data;
			fwrite($path_helper, "\n". $controller_content);
			fclose($path_helper);

	}

	function call_role()
	{
		$project_id = $this->session->userdata('project_id');
		$this->cpanel->call_role($project_id);
	}


	function delete_role()
	{
		$id = $this->input->post('id');
		$project_id = $this->session->userdata('project_id');
		$this->db->where('id',$id);
		$this->db->where('project_id',$project_id);
		$this->db->delete('project_role');

	}



	function add_role_creator()
	{
		$id_form = $this->input->post('id_form');
		$role = $this->input->post('role');
		$project_id = $this->session->userdata('project_id');

		$check_existing_role = $this->check_existing_role($role,$id_form);
		if($check_existing_role>0){

		} else {

			$data = array(
							'role'=>$role,
							'id_form'=>$id_form,
							'project_id'=>$project_id
						 );

			$this->db->insert('field_session',$data);

		}

		
	}


	function call_role_creator()
	{
		$id_form = $this->input->post('id_form');
		$project_id = $this->session->userdata('project_id');
		$this->cpanel->call_role_creator($project_id,$id_form);
	}


	function delete_role_creator()
	{
		$id_form = $this->input->post('id_form');
		$id = $this->input->post('id');
		$project_id = $this->session->userdata('project_id');
		$this->db->where('id',$id);
		$this->db->where('project_id',$project_id);
		$this->db->where('id_form',$id_form);
		$this->db->delete('field_session');

	}


	function check_existing_role($role,$id_form)
	{
		$where = "
    				SELECT count(*) as Total FROM field_session as a 
    				Where a.role='$role' AND a.id_form='$id_form'
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



	function create_file()
	{
		$id_form = $this->input->post('id_form');
		
		$table_name = $this->input->post('tbl');
		$module = $this->input->post('module');
		$sub_module = $this->input->post('sub_module');
		$controller_name = $this->input->post('controller_name');
		$description = $this->input->post('description');
		$insert_file = $this->input->post('insert');
		$update_file = $this->input->post('update');
		$list_file = $this->input->post('list');


		$controller_name = strtolower($controller_name);
		$controller_name = ucwords($controller_name);


		// check file name is exisitng or not
		$check_controller = $this->cpanel->check_name_controller($controller_name);
		if($check_controller>0){
			$controller_name = $controller_name.rand();
		} else {

		}

		$navbar_show = $this->input->post('navbar_show');

		


		$icon = $this->input->post('icon');

		if(!empty($icon)){
			$icon = '<i class="'.$icon.'"></i>';
		} else {
			$icon = '<i class="fa fa-angle-right"></i>';
		}



		//module_avatar
		$this->load->helper('file');  
        $config['upload_path']          = './source/all_file';
        $config['allowed_types']        = 'gif|jpg|png|jpeg|tif';
        $config['max_size']             = 0;
        $config['max_width']            = 0;
        $config['max_height']           = 0;
        $config['encrypt_name'] = TRUE;
        $config['remove_spaces'] = TRUE;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ( ! $this->upload->do_upload('module_avatar'))
        {
            $error = array('error' => $this->upload->display_errors());
            //var_dump($error); exit();
            $this->session->set_flashdata('error', 'Ralat ! Sila semak format gambar yang anda muat naik. Pastikan format gambar .gif, .jpg, .png, .jpeg, .tif dan pastikan saiz gambar tidak melebihi 500 mb.');
            //echo 'Error'; exit();
            $img = '';
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $new_name28094 = $this->upload->data('file_name');
            $img = base_url().'source/all_file/'.$new_name28094;

        }

        $api = $this->input->post('api');
        $api_id = rand();

		$data_file = array(
							'id_form'=>$id_form,
							'table_name'=>$table_name,
							'module'=>$module,
							'sub_module'=>$sub_module,
							'controller_name'=>$controller_name,
							'description_name'=>$description,
							'insert_file'=>$insert_file,
							'update_file'=>$update_file,
							'list_file'=>$list_file,
							'navbar_show'=>$navbar_show,
							'icon'=>$icon,
							'project_id'=>$this->session->userdata('project_id'),
							'module_avatar'=>$img,
							'api'=>$api,
							'api_id'=>$api_id
						  );

		$this->db->insert('project_file',$data_file);


		if($navbar_show){
			//auto generate menu
			$this->menu_public_generate();
			$this->dashboard_public_generate();
			$this->dashboard_public_generate_2();
		}
		

		// check table is existing or not 
		// if not exist create new one table & no added is exising

		$check_table = $this->cpanel->check_name_table($table_name);
		//var_dump($table_name);

		if($check_table>0){


		} else {

			$data_table = array(
								'table_name'=>$table_name,
								'project_id'=>$this->session->userdata('project_id')

							   );
			$this->db->insert('project_table',$data_table);

			
			//create table 
			$this->load->dbforge();
			$this->dbforge->add_field('id');
		    $this->dbforge->create_table($table_name);


		    $fields = array(
		        'project_id' => array('type' => 'TEXT')
		    );
		    $this->dbforge->add_column($table_name, $fields, 'id');


		    $fields = array(
                'uid' => array('type' => 'TEXT')
            );
            $this->dbforge->add_column($table_name, $fields, 'project_id');


            $fields = array(
                'datetime' => array('type' => 'TIMESTAMP')
            );
            $this->dbforge->add_column($table_name, $fields, 'project_id');

		}

		
		$create_column_table = $this->cpanel->create_column_table($id_form,$table_name);


		// create file view , controller and model base on permission

		// file view
		if($insert_file=='insert'){
			$this->creator->create_file_insert($id_form,$controller_name,$table_name);
		}


		if($update_file=='update'){
			$this->creator->create_file_update($id_form,$controller_name,$table_name);
		}


		if($list_file=='list'){
			$show_list = $this->input->post('show_list');
			$this->creator->create_file_list($id_form,$controller_name,$table_name,$show_list,$insert_file,$update_file,$list_file);
		}


		if($list_file=='list_w_delete'){
			$show_list = $this->input->post('show_list');
			$this->creator->create_file_list_w_delete($id_form,$controller_name,$table_name,$show_list,$insert_file,$update_file,$list_file);
		}


		$this->creator->create_file_view_only($id_form,$controller_name,$table_name,$show_list);
		$this->controller->create_file_controller($id_form,$controller_name,$table_name,$insert_file,$update_file,$list_file);


		
		if($api=='Yes'){
			$this->controller->create_api_controller($id_form,$controller_name,$table_name,$api_id);
		}

		//redirect($controller_name.'/'.$controller_name.'_list');
		redirect('cpanel/list_module');
	}

	function check_name_controller()
	{
		$controller = $this->input->post('controller_name');
		$check_controller = $this->cpanel->check_name_controller($controller);
		echo $check_controller;
	}


	function check_id_name()
	{
		$id_name = $this->input->post('id_name');
		$id_form = $this->input->post('id_form');
		$check_id_name = $this->cpanel->check_id_name($id_name,$id_form);
		echo $check_id_name;
	}


	function add_data_to_fields()
	{
		$id_name = $this->input->post('id_name');
		$id_form = $this->input->post('id_form');
		$id_data = $this->input->post('id_data');

		$check_data_existing = $this->cpanel->check_data_existing($id_data,$id_name,$id_form);

		if($check_data_existing>0){

		} else {

			$data = array(
							'data_name'=>$id_data,
							'id_field'=>$id_name,
							'id_form'=>$id_form,
							'project_id'=>$this->session->userdata('project_id')
						 );

			$this->db->insert('field_data',$data);

		}

		
	}


	function call_data_set()
	{
		$id_form = $this->input->post('id_form');
		echo $this->cpanel->call_data_set($id_form);
	}


	function delete_data_set()
	{
		$id = $this->input->post('id');
		$this->db->where('id',$id);
		$this->db->where('project_id',$this->session->userdata('project_id'));
		$this->db->delete('field_data');
	}


	function test()
	{
		// $this->load->view('cpanel/header/header');
		// $this->load->view('project/body/Upu/Upu_update.php');
		// $this->load->view('cpanel/footer/footer');

		$show_list = array('su','ali','ahmad');
		for ($x = 0; $x <= count($show_list)-1; $x++) {
				$show_list2 = $show_list[$x];
				var_dump($show_list2);
		}
	}


	function data_show_list()
	{
		$id_form = $this->input->post('id_form');
		$table_name = $this->input->post('tbl');
		echo $this->cpanel->data_show_list($id_form,$table_name);
	}


	function get_column_table()
	{
		$table = $this->input->post('table');
		echo $this->cpanel->get_column_table($table);
	}


	function check_function_name_helper()
	{
		$function_name = $this->input->post('function_name');
		$check_function_name = $this->cpanel->check_function_name_helper($function_name);
		echo $check_function_name;
	}


	function create_lookup_helper()
	{
		$table = $this->input->post('table');
		$column = $this->input->post('column');
		$function_name = $this->input->post('function_name');

		$validate_by = $this->input->post('validate_by');
		$segment_url = $this->input->post('segment_url');
		$segment_column = $this->input->post('segment_column');


		$check = $this->cpanel->check_function_name_helper($function_name);
		if($check>0){

		} else {

		if($function_name==''){

		} else {


			$data = array(
							'table_name'=>$table,
							'column_name'=>$column,
							'function_name'=>$function_name,
							'validate_by'=>$validate_by,
							'segment'=>$segment_url,
							'column_segment'=>$segment_column,
							'project_id'=>$this->session->userdata('project_id'),
							'uid'=>$this->session->userdata('id'),
						 );
			$this->db->insert('project_lookup_helper',$data);


	// lookup helper
	$path_helper = $_SERVER['DOCUMENT_ROOT'].'/application/helpers/lookup_helper.php';

	$data1 = "
	
	function ".$function_name."()
	{
		\$CI =& get_instance();
		\$item = ".$function_name."_model();
		return \$item;
    }
   
		";

	// remove last bracket



	// add model function
	$space = "'";
	$space2 = '"';
	$opt = '';


	if($validate_by=='Session')
	{

		$data2 = "
	
	function ".$function_name."_model($opt)
	{
		\$CI =& get_instance();
		\$opt=".$space.$space2.$space.";
		\$column = '".$column."';
	    \$query2 =  \$CI->db->get('".$table."')->result();

	    \$CI->db->where('uid', \$CI->session->userdata('id'));

		foreach (\$query2 as \$data2) 
		{
			\$display = \$data2->\$column;
			\$val = \$opt.\$data2->\$column.\$opt;
			echo '<option value='.\$val.'>'.\$display.'</option>';
		}
    }
   

	
		";


	} else if($validate_by=='Segment')
	{

		$data2 = "

	function ".$function_name."_model($opt)
	{
		\$CI =& get_instance();
		\$opt=".$space.$space2.$space.";
		\$column = '".$column."';
	    \$query2 =  \$CI->db->get('".$table."')->result();

	    \$CI->db->where('".$segment_column."', \$CI->uri->segment('".$segment_url."'));

		foreach (\$query2 as \$data2) 
		{
			\$display = \$data2->\$column;
			\$val = \$opt.\$data2->\$column.\$opt;
			echo '<option value='.\$val.'>'.\$display.'</option>';
		}
    }
  
	
		";

	} else {


		$data2 = "

	function ".$function_name."_model($opt)
	{
		\$CI =& get_instance();
		\$opt=".$space.$space2.$space.";
		\$column = '".$column."';
	    \$query2 =  \$CI->db->get('".$table."')->result();
		foreach (\$query2 as \$data2) 
		{
			\$display = \$data2->\$column;
			\$val = \$opt.\$data2->\$column.\$opt;
			echo '<option value='.\$val.'>'.\$display.'</option>';
		}
    }



	
		";

	}

	
	$content = $data1.$data2;
	file_put_contents($path_helper, $content, FILE_APPEND);

	} 

	}

	redirect('cpanel/lookup_helper');

	}


	function module_selected()
	{
		$module = $this->input->post('module');
		$this->cpanel->module_selected($module);
	}


	function get_file_editor()
	{
		$module = $this->input->post('module');
		$sub_module = $this->input->post('sub_module');
		$type_mvc = $this->input->post('type_mvc');
		$this->cpanel->get_file_editor($module,$sub_module,$type_mvc);
	}


	function file_selected()
	{

	}



	function menu_public_generate()
	{
		$project_id = $this->session->userdata('project_id');
		$this->db->where('project_id',$project_id);
		$this->db->group_by('module');
		$this->db->order_by('module','asc');
	    $query2 =  $this->db->get('project_file')->result();

	    $data_1 = '';
	    $data_2 = '';
	    $data_3 = '';
	    $data_4 = '';
	    $code = '';

	    $i=100;
		foreach ($query2 as $data2) 
		{
			$module = $data2->module;
			$sub_module = $data2->sub_module;

			$id_form = $data2->id_form;



			//var_dump($module);  

			// get session 
			$this->db->where('id_form',$id_form);
			$query_session =  $this->db->get('field_session')->result();
			$permission = '';
			foreach ($query_session as $data_session) 
			{
					$role = $data_session->role;
					$permission .= "|| (\$this->session->userdata('role')=='".$role."')";
			}


			$tag1 = "<?php ";
			$tag2 = " ?>";
			$start_permission = $tag1."if((\$this->session->userdata('role')=='developer')".$permission."){ ".$tag2;
			$end_permission = $tag1."}".$tag2;


			$check_module = $this->check_module($module);
			if($check_module>1)
			{

				$data_1 = $start_permission;
				$data_2 = "	<ul id='side-main-menu' class='side-menu list-unstyled'>
							<li> 
							<a href='#exampledropdownDropdown".$i."' aria-expanded='false' data-toggle='collapse'> <i class='icon-interface-windows'></i>".$module."</a>
							<ul id='exampledropdownDropdown".$i."' class='collapse list-unstyled '>

						  ";


				$this->db->where('module',$module);
				$this->db->where('project_id',$project_id);
				$this->db->group_by('sub_module');
				$this->db->order_by('sub_module','asc');
			    $query4 =  $this->db->get('project_file')->result();
			    $data_x = '';
				foreach ($query4 as $data4) 
				{
					$sub_module = $data4->sub_module;
					$insert_file = $data4->insert_file;
					$update_file = $data4->update_file;
					$list_file = $data4->list_file;

					$icon = $data4->icon;

					$controller_name = $data4->controller_name;

					if($list_file=='list'){
						$url = "<?= base_url()?>".$controller_name."/".$controller_name."_list";
					} else {

						if($update_file=='update'){
							$url = "<?= base_url()?>".$controller_name."/".$controller_name."_add";
						} else if($insert_file=='insert'){
							$url = "<?= base_url()?>".$controller_name."/".$controller_name."_update";
						} else {
							$url = "#";
						}
					}


					$data_x .= "<li><a href='".$url."'> ".$icon." ".$sub_module."</a></li>";
				}



				$data_3 = "			</ul>
								</li>
							</ul>
				     ";

				$data_4 = $end_permission;

				$code .= $data_1.$data_2.$data_x.$data_3.$data_4;

			} else {

				$insert_file = $data2->insert_file;
				$update_file = $data2->update_file;
				$list_file = $data2->list_file;

				$icon = $data2->icon;

				$controller_name = $data2->controller_name;

				if($list_file=='list'){
					$url = "<?= base_url()?>".$controller_name."/".$controller_name."_list";
				} else {

					if($update_file=='update'){
						$url = "<?= base_url()?>".$controller_name."/".$controller_name."_add";
					} else if($insert_file=='insert'){
						$url = "<?= base_url()?>".$controller_name."/".$controller_name."_update";
					} else {
						$url = "#";
					}
				}
				
				$data_1 = $start_permission;
				$data_2 = '	
							<ul id="side-main-menu" class="side-menu list-unstyled"> 
								<li><a href="'.$url.'"> '.$icon.''.$module.'</a></li>
							</ul>';
				$data_3 = '';
				$data_4 = $end_permission;

				$code .= $data_1.$data_2.$data_3.$data_4;

			}

			$i++;
		}

		

		$path_helper = $_SERVER['DOCUMENT_ROOT'].'/application/views/project/header/navbar.php';
		$data = $code;
		$f=fopen($path_helper,'w');
		fwrite($f,$data);
		fclose($f);
	}



	function check_module($module)
	{
		$where = "
    				SELECT count(*) as Total FROM project_file as a 
    				Where a.module='$module'
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



	function check_already_create_client()
	{
		$where = "
    				SELECT count(*) as Total FROM project_login as a 
    				Where a.setup_register='1'
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


	function dashboard_public_generate()
	{
		$project_id = $this->session->userdata('project_id');
		$this->db->where('project_id',$project_id);
		$this->db->group_by('module');
		$this->db->order_by('module','asc');
	    $query2 =  $this->db->get('project_file')->result();

	    $data_1 = '';
	    $data_2 = '';
	    $data_3 = '';
	    $data_4 = '';
	    $code = '';

	    $i=100;
		foreach ($query2 as $data2) 
		{
			$module = $data2->module;
			$sub_module = $data2->sub_module;

			$id_form = $data2->id_form;

			$icon_pickup = $data2->icon;

			//var_dump($module);  

			// get session 
			$this->db->where('id_form',$id_form);
			$query_session =  $this->db->get('field_session')->result();
			$permission = '';
			foreach ($query_session as $data_session) 
			{
					$role = $data_session->role;
					$permission .= "|| (\$this->session->userdata('role')=='".$role."')";
			}


			$tag1 = "<?php ";
			$tag2 = " ?>";
			$start_permission = $tag1."if((\$this->session->userdata('role')=='developer')".$permission."){ ".$tag2;
			$end_permission = $tag1."}".$tag2;

				

			$check_module = $this->check_module($module);
			if($check_module>0)
			{
				// $data_1 = $start_permission.$permission;
				$data_1 = $start_permission;
				$data_2 = '
							<div class="col-md-12">
						  	<div class="card">
							    <div class="card-header">
							      <a class="card-link" data-toggle="collapse" href="#collapse'.$i.'">
							         '.$module.'
							      </a>
							    </div>
						    <div id="collapse'.$i.'" class="collapse show" data-parent="#accordion">
						    <div class="card-body">
						  ';

				$this->db->where('module',$module);
				$this->db->where('project_id',$project_id);
				$this->db->group_by('sub_module');
				$this->db->order_by('sub_module','asc');
			    $query4 =  $this->db->get('project_file')->result();
			    $data_x = '';
				foreach ($query4 as $data4) 
				{
					$sub_module = $data4->sub_module;
					$insert_file = $data4->insert_file;
					$update_file = $data4->update_file;
					$list_file = $data4->list_file;

					//$icon = $data4->icon;	
					$icon = '<i class="fa fa-angle-right"></i>';

					$controller_name = $data4->controller_name;

					if($list_file=='list'){
						$url = "<?= base_url()?>".$controller_name."/".$controller_name."_list";
					} else {

						if($update_file=='update'){
							$url = "<?= base_url()?>".$controller_name."/".$controller_name."_add";
						} else if($insert_file=='insert'){
							$url = "<?= base_url()?>".$controller_name."/".$controller_name."_update";
						} else {
							$url = "#";
						}
					}


					$data_x .= "<a href='".$url."'> ".$icon." ".$sub_module."</a> <br>";
				}



				$data_3 = "			
					     	  	</div>
							    </div>
							  </div>
							</div>
				     	  ";

				$data_4 = $end_permission;

				$code .= $data_1.$data_2.$data_x.$data_3.$data_4;

			} 

			//var_dump($code);

			$i++;
		}


		$path_helper = $_SERVER['DOCUMENT_ROOT'].'/application/views/project/dashboard_menu.php';
		$data = $code;
		$f=fopen($path_helper,'w');
		fwrite($f,$data);
		fclose($f);
	}


	

	function dashboard_public_generate_2()
	{
		$project_id = $this->session->userdata('project_id');
		$this->db->where('project_id',$project_id);
		$this->db->group_by('module');
		$this->db->order_by('module','asc');
	    $query2 =  $this->db->get('project_file')->result();

	    $data_1 = '';
	    $data_2 = '';
	    $data_3 = '';
	    $data_4 = '';
	    $code = '';

	    $i=100;
		foreach ($query2 as $data2) 
		{
			$module = $data2->module;
			$sub_module = $data2->sub_module;

			$id_form = $data2->id_form;

			$icon_pickup = $data2->icon;


			$description_name = $data2->description_name;

			$module_avatar = $data2->module_avatar;

			if(empty($module_avatar)){
				$avatar = '
							<img class="card-img-top" src="https://www.rajnathsingh.in/wp-content/uploads/2016/09/noImg.png" alt="Card image cap">
						  ';
			} else {
				$avatar = '
							<img class="card-img-top" src="'.$module_avatar.'" alt="Card image cap">
						  ';
			}

			//var_dump($module);  

			// get session 
			$this->db->where('id_form',$id_form);
			$query_session =  $this->db->get('field_session')->result();
			$permission = '';
			foreach ($query_session as $data_session) 
			{
					$role = $data_session->role;
					$permission .= "|| (\$this->session->userdata('role')=='".$role."')";
			}


			$tag1 = "<?php ";
			$tag2 = " ?>";
			$start_permission = $tag1."if((\$this->session->userdata('role')=='developer')".$permission."){ ".$tag2;
			$end_permission = $tag1."}".$tag2;

				

			$check_module = $this->check_module($module);
			if($check_module>0)
			{
				// $data_1 = $start_permission.$permission;
				$data_1 = $start_permission;
				// $data_2 = '
				// 			<div class="col-md-12">
				// 		  	<div class="card">
				// 			    <div class="card-header">
				// 			      <a class="card-link" data-toggle="collapse" href="#collapse'.$i.'">
				// 			         '.$module.'
				// 			      </a>
				// 			    </div>
				// 		    <div id="collapse'.$i.'" class="collapse show" data-parent="#accordion">
				// 		    <div class="card-body">
				// 		  ';

				$data_2 = '
								<aside class="col-sm-4" style="padding-bottom:30px;">
									<p><b>Module : '.$module.'</b></p>
										<div class="card">
											'.$avatar.'

											<div class="card-body">
											    <p class="card-text">'.$description_name.'</p>
											</div>
											<ul class="list-group list-group-flush">
						  ';

				$this->db->where('module',$module);
				$this->db->where('project_id',$project_id);
				$this->db->group_by('sub_module');
				$this->db->order_by('sub_module','asc');
			    $query4 =  $this->db->get('project_file')->result();
			    $data_x = '';
				foreach ($query4 as $data4) 
				{
					$sub_module = $data4->sub_module;
					$insert_file = $data4->insert_file;
					$update_file = $data4->update_file;
					$list_file = $data4->list_file;

					//$icon = $data4->icon;	
					$icon = '<i class="fa fa-angle-right"></i>';

					$controller_name = $data4->controller_name;

					if($list_file=='list'){
						$url = "<?= base_url()?>".$controller_name."/".$controller_name."_list";
					} else {

						if($update_file=='update'){
							$url = "<?= base_url()?>".$controller_name."/".$controller_name."_add";
						} else if($insert_file=='insert'){
							$url = "<?= base_url()?>".$controller_name."/".$controller_name."_update";
						} else {
							$url = "#";
						}
					}


					// $data_x .= "<a href='".$url."'> ".$icon." ".$sub_module."</a> <br>";
					$data_x .= "<li class='list-group-item'><a href='".$url."'> ".$icon." ".$sub_module."</a></li>";
				}



				$data_3 = "			
					     	  		</ul>
								</div>
							</aside>
				     	  ";

				$data_4 = $end_permission;

				$code .= $data_1.$data_2.$data_x.$data_3.$data_4;

			} 

			//var_dump($code);

			$i++;
		}



		$header = '
						<!DOCTYPE html>
						<html>
						  <head>
						    <meta charset="utf-8">
						    <meta http-equiv="X-UA-Compatible" content="IE=edge">
						    <title><?= project_name()?></title>
						    <meta name="description" content="">
						    <meta name="viewport" content="width=device-width, initial-scale=1">
						    <meta name="robots" content="all,follow">

						  </head>

						<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
						<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
						<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
						<!------ Include the above in your HEAD tag ---------->

						 <body>

						<div class="container">
						<br>  <p class="text-center"><b><?= project_name()?></b> | <a href="<?= base_url()?>login/logout"> <b>Logout</b></a></p>
						<hr>

						<div class="row" style="padding-bottom:30px;">
				  ';


		$footer = '

						</div>
						</div> 
						</body>
						</html>
				  ';



		$code = $header.$code.$footer;


		//var_dump($code);
		$path_helper = $_SERVER['DOCUMENT_ROOT'].'/application/views/project/dashboard_public.php';
		$data = $code;
		$f=fopen($path_helper,'w');
		fwrite($f,$data);
		fclose($f);
	}


	//create page 
	function set_theme()
	{
		if($this->session->userdata('role')=='developer'){
			$this->load->view('cpanel/header/header');
			$this->load->view('cpanel/body/page_theme_set.php');
			$this->load->view('cpanel/footer/footer');
		} else {
			redirect('cpanel/login');
		}
	}


	function theme_editor()
	{
		if($this->session->userdata('role')=='developer'){
			$this->load->view('cpanel/header/header');
			$this->load->view('cpanel/body/page_theme_editor.php');
			$this->load->view('cpanel/footer/footer');
		} else {
			redirect('cpanel/login');
		}
	}


	function create_page()
	{
		if($this->session->userdata('role')=='developer'){
			$this->load->view('cpanel/header/header');
			$this->load->view('cpanel/body/page_create.php');
			$this->load->view('cpanel/footer/footer');
		} else {
			redirect('cpanel/login');
		}
	}


	function list_page($rowno=0)
	{
		if($this->session->userdata('role')=='developer'){

			$this->load->library('pagination');

			$search_text = '';
	  		if($this->input->post('submit') != NULL ){
	  			$search_text = $this->input->post('search');
	  			$this->session->set_userdata(array('search'=>$search_text));
	  		} else {
	  			if($this->session->userdata('search') != NULL){
					$search_text = $this->session->userdata('search');
				}
	  		}

	  		$rowperpage = 10;
	  		if($rowno != 0){
		      $rowno = ($rowno-1) * $rowperpage;
		    }


		    $allcount = $this->cpanel->list_extra_page_Count($search_text);
		    $users_record = $this->cpanel->list_extra_page_Data($rowno,$rowperpage,$search_text);


		    $segment1 = $this->uri->segment(1);
			$segment2 = $this->uri->segment(2);


		    $config['base_url'] = base_url().$segment1.'/'.$segment2;
		    $config['use_page_numbers'] = TRUE;
		    $config['total_rows'] = $allcount;
		    $config['per_page'] = $rowperpage;


		    // integrate bootstrap pagination
	        $config['full_tag_open'] = '<ul class="pagination">';
	        $config['full_tag_close'] = '</ul>';
	        $config['first_link'] = false;
	        $config['last_link'] = false;
	        $config['first_tag_open'] = '<li class="paginate_button page-item">';
	        $config['first_tag_close'] = '</li>';
	        $config['prev_link'] = '«';
	        $config['prev_tag_open'] = '<li class="paginate_button page-item prev">';
	        $config['prev_tag_close'] = '</li>';
	        $config['next_link'] = '»';
	        $config['next_tag_open'] = '<li paginate_button page-item >';
	        $config['next_tag_close'] = '</li>';
	        $config['last_tag_open'] = '<li paginate_button page-item >';
	        $config['last_tag_close'] = '</li>';
	        $config['cur_tag_open'] = '<li class="paginate_button page-item active"><a href="#">';
	        $config['cur_tag_close'] = '</a></li>';
	        $config['num_tag_open'] = '<li paginate_button page-item >';
	        $config['num_tag_close'] = '</li>';

		    $this->pagination->initialize($config);


		    $data['pagination'] = $this->pagination->create_links();
		    $data['result'] = $users_record;
		    $data['row'] = $rowno;
		    $data['search'] = $search_text;

			$this->load->view('cpanel/header/header');
			$this->load->view('cpanel/body/page_list.php',$data);
			$this->load->view('cpanel/footer/footer');
		} else {
			redirect('cpanel/login');
		}
	}



	function set_theme_proceed()
	{
		if($this->session->userdata('role')=='developer'){
			$theme = $this->input->post('theme');

			if($theme=='Captivate_Theme'){

				$code = '
							<!doctype html>
							<html lang="en">

							<head>

							  <!-- Required meta tags -->
							  <meta charset="utf-8">
							  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
							  <title>Captivate a Corporate Category Bootstrap Responsive Website Template | Home :: W3layouts</title>
							  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400&display=swap" rel="stylesheet">

							  <!-- Template CSS -->
							  <link rel="stylesheet" href="<?= base_url()?>theme/captivate_theme/assets/css/style-starter.css">

							</head>

							<body>
							<!-- site header -->
							<header id="site-header" class="fixed-top">
							  <nav class="navbar navbar-expand-lg navbar-dark">
							      <a class="navbar-brand" href="index.html">
							          <span class="fa fa-shield"></span> Captivate
							      </a>
							      <button class="navbar-toggler bg-gradient" type="button" data-toggle="collapse"
							          data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
							          aria-label="Toggle navigation">
							          <span class="navbar-toggler-icon"></span>
							      </button>

							      <div class="collapse navbar-collapse" id="navbarNav">
							          <ul class="navbar-nav m-auto">
							              <li class="nav-item active">
							                  <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
							              </li>
							              <li class="nav-item">
							                  <a class="nav-link" href="#">About</a>
							              </li>
							              <li class="nav-item">
							                  <a class="nav-link" href="#">Services</a>
							              </li>
							              <li class="nav-item">
							                  <a class="nav-link" href="#">Contact</a>
							              </li>
							          </ul>
							          <ul class="navbar-nav">
							              <li class="nav-item">
							                  <a href="<?= base_url()?>login" class="btn btn-primary btn-style">Login</a>
							                  <a href="<?= base_url()?>register" class="btn btn-primary btn-style">Register</a>
							              </li>
							          </ul>
							      </div>
							  </nav>
							</header>
							<!-- //site header -->

							<!-- banner section -->
							<section id="home" class="banner">
							    <div id="banner-bg-effect" class="banner-effect"></div>
							    <div class="container">
							        <div class="row align-items-center">
							            <div class="col-lg-7 col-md-12 col-sm-12 order-lg-first mt-lg-0 mt-4">
							                <h1 class="mb-4 title"><strong>Doing </strong>the right thing, <br>at the <strong>right time.</strong>
							                </h1>
							                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident, excepturi.
							                    Distinctio accusantium fugit odit? Fugit ipsam nostrum minus alias, expedita voluptatem
							                    illo quis id eos quae odio, nobis deleniti delectus? Lorem ipsum dolor sit amet consectetur
							                    adipisicing
							                    elit.</p>
							                <div class="mt-5">
							                    <a class="btn btn-primary btn-style mr-2" href="#">Read More </a>
							                    <a class="btn btn-outline btn-outline-style" href="#">Our Services </a>
							                </div>
							            </div>
							            <div class="col-lg-5 col-md-12 col-sm-12 order-first text-lg-left text-center">
							                <div>
							                    <img src="<?= base_url()?>theme/captivate_theme/assets/images/banner-round.png" alt="" class="rounded-circle img-fluid">
							                </div>
							            </div>
							        </div>
							    </div>
							</section>
							<!-- //banner section -->

							<!-- home page about -->
							<section class="w3l-about">
							    <div class="container">
							        <div class="row about-content">
							            <div class="col-lg-6 info mb-lg-0 mb-sm-5 mb-4 align-center">
							                <h3 class="title">About Us</h3>
							                <h6>Business planning, Strategy and Execution. A problem-solving philosophy that leads to
							                    products people actually want to use.</h6>
							                <p class="mt-md-4 mt-3 mb-0"> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Animi
							                    recusandae, ducimus vel rerum accusamus odit provident nobis ratione quisquam obcaecati atque
							                    fuga maiores! Tenetur aspernatur alias unde facilis eveniet? Eius! Lorem ipsum dolor sit amet,
							                    Fugit ipsam nostrum minus alias, expedita.</p>
							            </div>
							            <div class="col-lg-6">
							                <img src="<?= base_url()?>theme/captivate_theme/assets/images/about.png" class="img-fluid img-shadow" alt="about">
							            </div>
							        </div>
							    </div>
							</section>
							<!-- //home page about -->

							<!-- home page service grids -->
							<section id="services" class="bg-light">
							  <div class="container">
							    <div class="row align-items-center">
							      <div class="col-lg-8 offset-lg-2 col-md-12 col-sm-12">
							        <h4 class="section-title">Meet Our Solution For You</h4>
							        <p class="text-center">Lorem ipsum dolor, sit amet consectet et adipis icing elit. Ab commodi iure minus
							          laboriosam placeat quia, dolorem animi. Eveniet repudiandae, iure et.</p>
							      </div>
							    </div>
							    <div class="row mt-lg-5">
							      <div class="col-lg-4 col-md-6 col-sm-12">
							        <div class="box-wrap">
							          <div class="icon">
							            <span class="fa fa-briefcase"></span>
							          </div>
							          <h4><a href="#url">Business Services</a></h4>
							          <p>Lorem ipsum dolor sit amet sed consectetur adipisicing elit.
							            doloret quas saepe autem, dolor set.</p>
							        </div>
							      </div>
							      <div class="col-lg-4 col-md-6 col-sm-12">
							        <div class="box-wrap">
							          <div class="icon">
							            <span class="fa fa-shield"></span>
							          </div>
							          <h4><a href="#url">Product Consulting</a></h4>
							          <p>Lorem ipsum dolor sit amet sed consectetur adipisicing elit.
							            doloret quas saepe autem, dolor set.</p>
							        </div>
							      </div>
							      <div class="col-lg-4 col-md-6 col-sm-12">
							        <div class="box-wrap">
							          <div class="icon">
							            <span class="fa fa-dollar"></span>
							          </div>
							          <h4><a href="#url">Financial Consulting</a></h4>
							          <p>Lorem ipsum dolor sit amet sed consectetur adipisicing elit.
							            doloret quas saepe autem, dolor set.</p>
							        </div>
							      </div>
							      <div class="col-lg-4 col-md-6 col-sm-12">
							        <div class="box-wrap">
							          <div class="icon">
							            <span class="fa fa-industry"></span>
							          </div>
							          <h4><a href="#url">Investment Planning</a></h4>
							          <p>Lorem ipsum dolor sit amet sed consectetur adipisicing elit.
							            doloret quas saepe autem, dolor set.</p>
							        </div>
							      </div>
							      <div class="col-lg-4 col-md-6 col-sm-12">
							        <div class="box-wrap">
							          <div class="icon">
							            <span class="fa fa-lightbulb-o"></span>
							          </div>
							          <h4><a href="#url">Business Growth</a></h4>
							          <p>Lorem ipsum dolor sit amet sed consectetur adipisicing elit.
							            doloret quas saepe autem, dolor set.</p>
							        </div>
							      </div>
							      <div class="col-lg-4 col-md-6 col-sm-12">
							        <div class="box-wrap">
							          <div class="icon">
							            <span class="fa fa-picture-o"></span>
							          </div>
							          <h4><a href="#url">Projects Worldwide</a></h4>
							          <p>Lorem ipsum dolor sit amet sed consectetur adipisicing elit.
							            doloret quas saepe autem, dolor set.</p>
							        </div>
							      </div>
							    </div>
							  </div>
							</section>
							<!-- //home page service grids -->

							<!-- testimonials section -->
							<section id="slider" class="testimonials">
							    <div class="container">
							        <div class="row align-items-center">
							            <div class="col-lg-8 offset-lg-2 col-md-12 col-sm-12">
							                <h4 class="section-title">What they said about us</h4>
							                <p class="text-center">There are many variations of passages of Lorem Ipsum available, but the majority
							                    have
							                    suffered alteration in some form, by injected humour</p>
							            </div>
							        </div>
							        <div class="large-12 columns mt-5">
							            <div class="owl-carousel owl-theme">
							                <div class="item">
							                    <div class="w3l-customers-7">
							                        <div class="customers_sur">
							                            <div class="customers-left_sur">
							                                <div class="customers_grid">
							                                    <div class="custo-img-res">
							                                        <img src="<?= base_url()?>theme/captivate_theme/assets/images/testi1.jpg" alt=" " class="">
							                                    </div>
							                                    <div class="ratings my-4 my-4">
							                                        <span class="fa fa-star"></span>
							                                        <span class="fa fa-star"></span>
							                                        <span class="fa fa-star"></span>
							                                        <span class="fa fa-star"></span>
							                                        <span class="fa fa-star"></span>
							                                    </div>
							                                    <p>Lorem ipsum dolor, sit amet consect adipis icing elit. Ab commodi iure minus
							                                        placeat quia, animi. Eveniet, iure et. ipsum dolor sed ut init et.</p>
							                                    <div class="customers-bottom_sur">
							                                        <div class="custo_grid">
							                                            <h5>Tanguy De</h5>
							                                            <span>Designation</span>
							                                        </div>
							                                    </div>
							                                </div>
							                            </div>
							                        </div>
							                    </div>
							                </div>
							                <div class="item">
							                    <div class="w3l-customers-7">
							                        <div class="customers_sur">
							                            <div class="customers-left_sur">
							                                <div class="customers_grid">
							                                    <div class="custo-img-res">
							                                        <img src="<?= base_url()?>theme/captivate_theme/assets/images/testi2.jpg" alt=" " class="img-fluid">
							                                    </div>
							                                    <div class="ratings my-4">
							                                        <span class="fa fa-star"></span>
							                                        <span class="fa fa-star"></span>
							                                        <span class="fa fa-star"></span>
							                                        <span class="fa fa-star"></span>
							                                        <span class="fa fa-star"></span>
							                                    </div>
							                                    <p>Lorem ipsum dolor, sit amet consect adipis icing elit. Ab commodi iure minus
							                                        placeat quia, animi. Eveniet, iure et. ipsum dolor sed ut init et.</p>
							                                    <div class="customers-bottom_sur">
							                                        <div class="custo_grid">
							                                            <h5>Christopher</h5>
							                                            <span>Designation</span>
							                                        </div>
							                                    </div>
							                                </div>
							                            </div>
							                        </div>
							                    </div>
							                </div>
							                <div class="item">
							                    <div class="w3l-customers-7">
							                        <div class="customers_sur">
							                            <div class="customers-left_sur">
							                                <div class="customers_grid">
							                                    <div class="custo-img-res">
							                                        <img src="<?= base_url()?>theme/captivate_theme/assets/images//testi3.jpg" alt=" " class="img-fluid">
							                                    </div>
							                                    <div class="ratings my-4">
							                                        <span class="fa fa-star"></span>
							                                        <span class="fa fa-star"></span>
							                                        <span class="fa fa-star"></span>
							                                        <span class="fa fa-star"></span>
							                                        <span class="fa fa-star"></span>
							                                    </div>
							                                    <p>Lorem ipsum dolor, sit amet consect adipis icing elit. Ab commodi iure minus
							                                        placeat quia, animi. Eveniet, iure et. ipsum dolor sed ut init et.</p>
							                                    <div class="customers-bottom_sur">
							                                        <div class="custo_grid">
							                                            <h5>Edward</h5>
							                                            <span>Designation</span>
							                                        </div>
							                                    </div>
							                                </div>
							                            </div>
							                        </div>
							                    </div>
							                </div>
							                <div class="item">
							                    <div class="w3l-customers-7">
							                        <div class="customers_sur">
							                            <div class="customers-left_sur">
							                                <div class="customers_grid">
							                                    <div class="custo-img-res">
							                                        <img src="<?= base_url()?>theme/captivate_theme/assets/images//testi4.jpg" alt=" " class="img-fluid">
							                                    </div>
							                                    <div class="ratings my-4">
							                                        <span class="fa fa-star"></span>
							                                        <span class="fa fa-star"></span>
							                                        <span class="fa fa-star"></span>
							                                        <span class="fa fa-star"></span>
							                                        <span class="fa fa-star"></span>
							                                    </div>
							                                    <p>Lorem ipsum dolor, sit amet consect adipis icing elit. Ab commodi iure minus
							                                        placeat quia, animi. Eveniet, iure et. ipsum dolor sed ut init et.</p>
							                                    <div class="customers-bottom_sur">
							                                        <div class="custo_grid">
							                                            <h5>Abigail</h5>
							                                            <span>Designation</span>
							                                        </div>
							                                    </div>
							                                </div>
							                            </div>
							                        </div>
							                    </div>
							                </div>
							                <div class="item">
							                    <div class="w3l-customers-7">
							                        <div class="customers_sur">
							                            <div class="customers-left_sur">
							                                <div class="customers_grid">
							                                    <div class="custo-img-res">
							                                        <img src="<?= base_url()?>theme/captivate_theme/assets/images//testi5.jpg" alt=" " class="img-fluid">
							                                    </div>
							                                    <div class="ratings my-4">
							                                        <span class="fa fa-star"></span>
							                                        <span class="fa fa-star"></span>
							                                        <span class="fa fa-star"></span>
							                                        <span class="fa fa-star"></span>
							                                        <span class="fa fa-star"></span>
							                                    </div>
							                                    <p>Lorem ipsum dolor, sit amet consect adipis icing elit. Ab commodi iure minus
							                                        placeat quia, animi. Eveniet, iure et. ipsum dolor sed ut init et.</p>
							                                    <div class="customers-bottom_sur">
							                                        <div class="custo_grid">
							                                            <h5>Abigail</h5>
							                                            <span>Designation</span>
							                                        </div>
							                                    </div>
							                                </div>
							                            </div>
							                        </div>
							                    </div>
							                </div>
							            </div>
							        </div>
							    </div>
							</section>
							<!--//testimonials section -->

							<!-- stats section -->
							<section id="stats" class="stats">
							    <div class="container">
							        <div class="row">
							            <div class="col-lg-5 margin-md-60">
							                <h2 class="left-title">Some of Our Company Real Facts.</h2>
							                <p class="white">Lorem ipsum dolor, sit amet consectet et adipis icing elit. Ab commodi iure minus
							                    laboriosam placeat quia, dolorem animi. Eveniet repudiandae, iure et.</p>
							            </div>
							            <div class="col-lg-7 mt-lg-0 mt-5">
							                <div class="d-sm-flex justify-content-lg-around justify-content-between counter-main">
							                    <div class="counter">
							                        <div class="icon">
							                            <span class="fa fa-folder-open-o"></span>
							                        </div>
							                        <p class="value">385</p>
							                        <p class="title white">Projects</p>
							                    </div>
							                    <div class="counter">
							                        <div class="icon">
							                            <span class="fa fa-headphones"></span>
							                        </div>
							                        <p class="value">260</p>
							                        <p class="title white">Consultant</p>
							                    </div>
							                    <div class="counter">
							                        <div class="icon">
							                            <span class="fa fa-trophy"></span>
							                        </div>
							                        <p class="value">150</p>
							                        <p class="title white">Awards</p>
							                    </div>
							                </div>
							            </div>
							        </div>
							    </div>
							</section>
							<!-- //stats section -->

							<!-- homepage blog grids -->
							<section id="blog">
							    <div class="container">
							        <div class="row align-items-center">
							            <div class="col-lg-8 offset-lg-2 col-md-12 col-sm-12">
							                <h4 class="section-title">Company News</h4>
							                <p class="text-center">There are many variations of passages of Lorem Ipsum available, but the majority
							                    have
							                    suffered alteration in some form, by injected humour</p>
							            </div>
							        </div>
							        <div class="blog-grids row mt-5">
							            <div class="col-lg-4 col-md-6 col-sm-12 blog-grid" id="zoomIn">
							                <a href="#">
							                    <figure><img src="<?= base_url()?>theme/captivate_theme/assets/images/blog.jpg" class="img-fluid" alt=""></figure>
							                </a>
							                <div class="blog-info">
							                    <h3><a href="#">4 Steps To Consider Before You Start</a> </h3>
							                    <ul>
							                        <li><a href="#author"><span class="fa fa-user-o mr-2"></span>Johnson smith</a></li>
							                        <li><span class="fa fa-calendar mr-2"></span>Jan 16, 2020</li>
							                    </ul>
							                </div>
							            </div>
							            <div class="col-lg-4 col-md-6 col-sm-12 mt-md-0 mt-4 blog-grid" id="zoomIn">
							                <a href="#">
							                    <figure><img src="<?= base_url()?>theme/captivate_theme/assets/images/blog1.jpg" class="img-fluid" alt=""></figure>
							                </a>
							                <div class="blog-info">
							                    <h3><a href="#">Strategic Plan Execution Management</a> </h3>
							                    <ul>
							                        <li><a href="#author"><span class="fa fa-user-o mr-2"></span>Alexander</a></li>
							                        <li><span class="fa fa-calendar mr-2"></span>Jan 19, 2020</li>
							                    </ul>
							                </div>
							            </div>
							            <div class="col-lg-4 col-md-6 col-sm-12 mt-lg-0 mt-4 blog-grid" id="zoomIn">
							                <a href="#">
							                    <figure><img src="<?= base_url()?>theme/captivate_theme/assets/images/blog2.jpg" class="img-fluid" alt=""></figure>
							                </a>
							                <div class="blog-info">
							                    <h3><a href="#">Business planning, strategy and execution</a> </h3>
							                    <ul>
							                        <li><a href="#author"><span class="fa fa-user-o mr-2"></span>Elizabeth ker</a></li>
							                        <li><span class="fa fa-calendar mr-2"></span>Jan 21, 2020</li>
							                    </ul>
							                </div>
							            </div>
							        </div>
							    </div>
							</section>
							<!-- //homepage blog grids -->

							<!-- site footer -->
							<footer id="site-footer">
							  <div class="top-footer">
							    <div class="container my-md-5 my-4">
							      <div class="row">
							        <div class="col-lg-4">
							          <div class="footer-logo mb-3">
							            <a href="index.html">
							              <span class="fa fa-shield"></span> Captivate
							            </a>
							          </div>
							          <div>
							            <p class="">Lorem ipsum dolor, sit amet consectet et adipis icing elit. Ab commodi iure minus
							              laboriosam
							              placeat quia, dolorem animi. Eveniet repudiandae, perferendis nesciunt deserunt iure et, consequatur
							              optio!</p>
							          </div>
							        </div>
							        <!-- Quick Links -->
							        <div class="col-lg-3 col-md-4 mt-lg-0 mt-5">
							          <h4 class="footer-title">Quick Links</h4>
							          <ul class="footer-list">
							            <li><a href="about.html"> About company</a></li>
							            <li><a href=""> Explore services</a></li>
							            <li><a href="#work"> How does we Work?</a></li>
							            <li><a href="#projects"> View projects</a></li>
							          </ul>
							        </div>
							        <!-- Newsletter -->
							        <div class="col-lg-5 col-md-8 mt-lg-0 mt-5">
							          <h4 class="footer-title">Newsletter</h4>
							          <p class="mb-4">By subscribing to our mailing list you will always be updated with the latest news from us.
							          </p>
							          <form class="newsletter-form">
							            <input class="input-rounded" type="text" required="" placeholder="Enter Email Address">
							            <button type="submit" title="Subscribe" class="btn btn-primary btn-style" name="submit" value="Submit">
							              Subscribe
							            </button>
							          </form>
							        </div>
							      </div>
							    </div>
							  </div>
							  <div class="bottom-footer">
							    <div class="container">
							      <div class="row">
							        <div class="col-lg-8 text-lg-left text-center mb-lg-0 mb-3">
							          <p class="copyright">© 2020 Captivate. All Rights Reserved. Design by <a
							            href="https://w3layouts.com/">W3Layouts</a></p>
							        </div>
							        <div class="col-lg-4 align-center text-lg-right text-center">
							          <a href="#facebook" class="social-item"><span class="fa fa-facebook-f"></span></a>
							          <a href="#twitter" class="social-item"><span class="fa fa-twitter"></span></a>
							          <a href="#linkedin" class="social-item"><span class="fa fa-linkedin"></span></a>
							        </div>
							      </div>
							    </div>
							  </div>
							</footer>
							<!-- //site footer -->

							<!-- move top -->
							<button onclick="topFunction()" id="movetop" class="bg-primary" title="Go to top">
							  <span class="fa fa-angle-up"></span>
							</button>

							<script>
							  // When the user scrolls down 20px from the top of the document, show the button
							  window.onscroll = function () {
							    scrollFunction()
							  };
							  function scrollFunction() {
							    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
							      document.getElementById("movetop").style.display = "block";
							    } else {
							      document.getElementById("movetop").style.display = "none";
							    }
							  }
							  // When the user clicks on the button, scroll to the top of the document
							  function topFunction() {
							    document.body.scrollTop = 0;
							    document.documentElement.scrollTop = 0;
							  }
							</script>
							<!-- //move top -->

							<!-- javascript -->
							<script src="<?= base_url()?>theme/captivate_theme/assets/js/jquery-3.3.1.min.js"></script>

							<!-- libhtbox -->
							<script src="<?= base_url()?>theme/captivate_theme/assets/js/lightbox-plus-jquery.min.js"></script>

							<!-- particles -->
							<script href="<?= base_url()?>theme/captivate_theme/assets/js/particles.min.js"></script>
							<script src="<?= base_url()?>theme/captivate_theme/assets/js/script.js"></script>
							<!-- //particles -->

							<!-- owl carousel -->
							<script src="<?= base_url()?>theme/captivate_theme/assets/js/owl.carousel.js"></script>
							<script>
							  $(document).ready(function () {
							    var owl = $(".owl-carousel");
							    owl.owlCarousel({
							      margin: 10,
							      nav: true,
							      loop: false,
							      responsive: {
							        0: {
							          items: 1
							        },
							        767: {
							          items: 2
							        },
							        1000: {
							          items: 3
							        }
							      }
							    })
							  })
							</script>

							<!-- disable body scroll which navbar is in active -->
							<script>
							  $(function () {
							    $(".navbar-toggler").click(function () {
							      $("body").toggleClass("noscroll");
							    })
							  });
							</script>
							<!-- disable body scroll which navbar is in active -->

							<!-- bootstrap -->
							<script src="<?= base_url()?>theme/captivate_theme/assets/js/bootstrap.min.js"></script>

							</body>
							</html>

						';

			} else if($theme=='Source_Theme'){

				$code = '
							<!DOCTYPE HTML>
							<html>
							<head>
							<title>Source  A Corporate Category Flat Bootstarp Resposive Website Template | Home :: w3layouts</title>
							<link href="<?= base_url()?>theme/source_theme/css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
							<link href="<?= base_url()?>theme/source_theme/css/style.css" rel="stylesheet" type="text/css" media="all" />
							<meta name="viewport" content="width=device-width, initial-scale=1">
							<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
							<meta name="keywords" content="Source Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
							Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
							<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
							<link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900" rel="stylesheet" type="text/css">
							<link rel="stylesheet" href="<?= base_url()?>theme/source_theme/css/flexslider.css" type="text/css" media="screen" />
							<script src="<?= base_url()?>theme/source_theme/js/jquery.min.js"></script>
							</head>
							<body>
							<!-- header -->
								<div class="header">
							  	    <div class="container">					
										<div class="logo">
											<a href="#"><img src="<?= base_url()?>theme/source_theme/images/logo.png" class="img-responsive" alt="" /></a>
										</div>
										<div class="hader-top">
											<div class="head-nav">
												<span class="menu"> </span>
													<ul class="cl-effect-16">
														<li><a href="#"  data-hover="WHAT WE DO">what we do</a></li>
														<li><a href="#"  data-hover="OUR WORK">our work</a></li>
														<li><a href="#"  data-hover="ABOUT US">about us</a></li>
															<div class="clearfix"> </div>
													</ul>
														<!-- script-for-nav -->
													<script>
														$( "span.menu" ).click(function() {
														  $( ".head-nav ul" ).slideToggle(300, function() {
															// Animation complete.
														  });
														});
													</script>
												<!-- script-for-nav --> 
											</div>
											<div class="head-right">
												<P><a href="<?= base_url()?>login">LOGIN</a> <a href="<?= base_url()?>register">REGISTER</a></P>
											</div>
											<div class="clearfix"> </div>
										</div> 
											<div class="clearfix"> </div>
									</div> 
								</div> 

							<!-- header -->
							<!-- thought -->
								<div class="thought">
									<div class="container">
										<h1>The thought and consideration we put into our products go well beyond desing.</h1>
									</div>
									<div class="wmuSlider example1 section" id="section-1">
										   <article style="position: absolute; width: 100%; opacity: 0;"> 
										   	   	<div class="banner-info">
												<div class="container">
													<div class="col-md-5 thought-left">
														<img src="<?= base_url()?>theme/source_theme/images/img1.png" class="img-responsive" alt="" />
													</div>
													<div class="col-md-7 thought-right">
														<div class="communt">
															<div class="communt-left">
																<i class="man"></i>
															</div>
															<div class="communt-right">
																<h4>Community</h4>
																<p>More than <span>2 millon people</span>use products built by the Source community.</p>
																<a href="#" class="link">Get Involved</a>
															</div>
															<div class="clearfix"> </div>
														</div>
														<div class="communt">
															<div class="communt-left">
																<i class="bulb"></i>
															</div>
															<div class="communt-right">
																<h4>Design & Performance</h4>
																<p>Creating an entirely new design meantinventing an entirely new techonology with a level of precision you’d excepet.</p>
																<a href="#" class="link">Get Involved</a>
															</div>
															<div class="clearfix"> </div>
														</div>
														<div class="communt">
															<div class="communt-left">
																<i class="bar"></i>
															</div>
															<div class="communt-right">
																<h4>Accurate results</h4>
																<p>We give you - easy to understand, real time data on your smarthphone.</p>
																<a href="#" class="link">Get Involved</a>
															</div>
															<div class="clearfix"> </div>
														</div>
													</div>
													<div class="clearfix"> </div>
												</div>
												</div>
											</article>
											 <article style="position: absolute; width: 100%; opacity: 0;"> 
												<div class="banner-info">
												<div class="container">
													<div class="col-md-5 thought-left">
														<img src="<?= base_url()?>theme/source_theme/images/phone.png" class="img-responsive" alt="" />
													</div>
													<div class="col-md-7 thought-right">
														<div class="communt">
															<div class="communt-left">
																<i class="man"></i>
															</div>
															<div class="communt-right">
																<h4>Community</h4>
																<p>More than <span>2 millon people</span> use products built by the Source community.</p>
																<a href="#" class="link">Get Involved</a>
															</div>
															<div class="clearfix"> </div>
														</div>
														<div class="communt">
															<div class="communt-left">
																<i class="bulb"></i>
															</div>
															<div class="communt-right">
																<h4>Design & Performance</h4>
																<p>Creating an entirely new design meantinventing an entirely new techonology with a level of precision you’d excepet.</p>
																<a href="#" class="link">Get Involved</a>
															</div>
															<div class="clearfix"> </div>
														</div>
														<div class="communt">
															<div class="communt-left">
																<i class="bar"></i>
															</div>
															<div class="communt-right">
																<h4>Accurate results</h4>
																<p>More than 2 millon people use products built by the Source community.</p>
																<a href="#" class="link">Get Involved</a>
															</div>
															<div class="clearfix"> </div>
														</div>
													</div>
													<div class="clearfix"> </div>
												</div>
												</div>
											</article>
											 <article style="position: absolute; width: 100%; opacity: 0;"> 
												<div class="banner-info">
												<div class="container">
													<div class="col-md-5 thought-left">
														<img src="<?= base_url()?>theme/source_theme/images/img1.png" class="img-responsive" alt="" />
													</div>
													<div class="col-md-7 thought-right">
														<div class="communt">
															<div class="communt-left">
																<i class="man"></i>
															</div>
															<div class="communt-right">
																<h4>Community</h4>
																<p>More than <span>2 millon people</span> use products built by the Source community.</p>
																<a href="#" class="link">Get Involved</a>
															</div>
															<div class="clearfix"> </div>
														</div>
														<div class="communt">
															<div class="communt-left">
																<i class="bulb"></i>
															</div>
															<div class="communt-right">
																<h4>Design & Performance</h4>
																<p>Creating an entirely new design meantinventing an entirely new techonology with a level of precision you’d excepet.</p>
																<a href="#" class="link">Get Involved</a>
															</div>
															<div class="clearfix"> </div>
														</div>
														<div class="communt">
															<div class="communt-left">
																<i class="bar"></i>
															</div>
															<div class="communt-right">
																<h4>Accurate results</h4>
																<p>More than 2 millon people use products built by the Source community.</p>
																<a href="#" class="link">Get Involved</a>
															</div>
															<div class="clearfix"> </div>
														</div>
													</div>
													<div class="clearfix"> </div>
												</div>
												</div>
											</article>
											<ul class="wmuSliderPagination">
							                	<li><a href="#" class="">0</a></li>
							                	<li><a href="#" class="">1</a></li>
							                	<li><a href="#" class="">2</a></li>
							                </ul>
									  </div>		
									
									<!-- script -->
							          <script src="<?= base_url()?>theme/source_theme/js/jquery.wmuSlider.js"></script> 
										<script>
							       			$(".example1").wmuSlider();         
							   		    </script>
										<!-- script -->		
								</div>
							<!-- thought -->
							<!-- why-so -->
								<div class="why-so">
									<div class="container">
										<section class="slider">
													<div class="flexslider">
														<ul class="slides">
															<li>
																<div class="tittle">
																	<h4>Why Source is awsome?</h4>
																	<p>Our workshop, methodologies, and practices help us confidentlyand collaboratively solve complex business challenges.</p>
																</div>
															</li>
															<li>
																<div class="tittle">
																	<h4>Lorem Ipsum is that it?</h4>
																	<p>Our workshop, methodologies, and practices help us confidentlyand collaboratively solve complex business challenges.</p>
																</div>
															</li>
															<li>	
																<div class="tittle">
																	
																	<h4>There are many variations?</h4>
																	<p>Our workshop, methodologies, and practices help us confidentlyand collaboratively solve complex business challenges.</p>
																</div>
															</li>
															<li>
																<div class="tittle">
																	
																	<h4>Contrary to popular belief?</h4>
																	<p>Our workshop, methodologies, and practices help us confidentlyand collaboratively solve complex business challenges.</p>
																</div>
															</li>
															<li>
																<div class="tittle">
																	
																	<h4>Why Source is awsome?</h4>
																	<p>Our workshop, methodologies, and practices help us confidentlyand collaboratively solve complex business challenges.</p>
																</div>
															</li>
														</ul>
													</div>
												</section>
												<!-- FlexSlider -->
														  <script defer src="<?= base_url()?>theme/source_theme/js/jquery.flexslider.js"></script>
														  <script type="text/javascript">
															$(function(){
															  SyntaxHighlighter.all();
															});
															$(window).load(function(){
															  $(".flexslider").flexslider({
																animation: "slide",
																start: function(slider){
																  $("body").removeClass("loading");
																}
															  });
															});
														  </script>
													<!-- FlexSlider -->


									</div>
								</div>
							<!-- why-so -->
							<!-- bull -->
								<div class="bull">
									<div class="container">
										<li><a href="#"><img src="<?= base_url()?>theme/source_theme/images/m1.png" class="img-responsive" alt="" /></a></li>
										<li><a href="#"><img src="<?= base_url()?>theme/source_theme/images/m2.png" class="img-responsive" alt="" /></a></li>
										<li><a href="#"><img src="<?= base_url()?>theme/source_theme/images/m3.png" class="img-responsive" alt="" /></a></li>
										<li><a href="#"><img src="<?= base_url()?>theme/source_theme/images/m4.png" class="img-responsive" alt="" /></a></li>
										<li><a href="#"><img src="<?= base_url()?>theme/source_theme/images/m5.png" class="img-responsive" alt="" /></a></li>
									</div>
								</div>
							<!-- bull -->
							<!-- our-ne -->
								<div class="our-ne">
									<div class="container">
										<h3>Our Newsletter</h3>
										<h4>It is for me?  Source is used by over 1.000 users</h4>
										<form>
											<input type="text" class="text" value="Your email" onfocus="">
										</form>
										<label></label>
									</div>
								</div>
							<!-- our-ne -->
							<!-- footer -->
								<div class="footer">
									<div class="container">
										<div class="col-md-4">
											<p>Copyrights © 2015 Source All rights reserved | Template by <a href="http://w3layouts.com/">W3layouts</a></p>
										</div>
										<div class="col-md-4 footlo">
											<a href="#"><img src="<?= base_url()?>theme/source_theme/images/footlogo.png" class="img-responsive" alt="" /></a>
										</div>
										<div class="col-md-4 twt">
											<div class="like">
								   				  	<div id="fb-root"></div>
														<div id="fb-root"></div>
														<script>(function(d, s, id) {
														  var js, fjs = d.getElementsByTagName(s)[0];
														  if (d.getElementById(id)) return;
														  js = d.createElement(s); js.id = id;
														  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
														  fjs.parentNode.insertBefore(js, fjs);
														}(document, "script", "facebook-jssdk"));</script>
								   						
								   						<div class="fb-like" data-href="https://www.facebook.com/w3layouts" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
												<div class="clearfix"> </div>
											</div>
											<div class="follow">
												<li><a href="#"><img src="<?= base_url()?>theme/source_theme/images/twt.png" class="img-responsive" alt="" /></a></li>
												<li><h4><a href="#">Follow@twitter</a></h4></li>
											</div>
												<div class="clearfix"> </div>
										</div>
										<div class="clearfix"> </div>
									</div>
								</div>
							<!-- footer -->
							</body>
							</html>
						';

			} else if($theme=='Save_Poor_Theme'){

				$code = '
							<!doctype html>
							<html lang="en">
							  <head>
							    <!-- Required meta tags -->
							    <meta charset="utf-8">
							    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

							    <title>Save Poor - Charity Category Responsive Website Template | Home : W3layouts</title>

							    <link href="//fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&display=swap" rel="stylesheet">
							    
							    <!-- Template CSS -->
							    <link rel="stylesheet" href="<?=base_url()?>theme/save_poor_theme/assets/css/style-starter.css">
							  </head>
							  <body>
							<!--header-->
							<header id="site-header" class="fixed-top">
							  <div class="container">
							    <nav class="navbar navbar-expand-lg stroke">
							      <h1><a class="navbar-brand mr-lg-5" href="index.html">
							        <img src="<?=base_url()?>theme/save_poor_theme/assets/images/logo.png" alt="Your logo" title="Your logo" />Save Poor
							        </a></h1>
							      <!-- if logo is image enable this   
							    <a class="navbar-brand" href="#index.html">
							        <img src="image-path" alt="Your logo" title="Your logo" style="height:35px;" />
							    </a> -->
							      <button class="navbar-toggler  collapsed bg-gradient" type="button" data-toggle="collapse"
							        data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false"
							        aria-label="Toggle navigation">
							        <span class="navbar-toggler-icon fa icon-expand fa-bars"></span>
							        <span class="navbar-toggler-icon fa icon-close fa-times"></span>
							        </span>
							      </button>

							      <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
							        <ul class="navbar-nav w-100">
							          <li class="nav-item active">
							            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
							          </li>
							          <li class="nav-item @@about__active">
							            <a class="nav-link" href="#">About</a>
							          </li>
							          <li class="nav-item @@causes__active">
							            <a class="nav-link" href="#">Causes</a>
							          </li>
							          <li class="nav-item @@contact__active">
							            <a class="nav-link" href="#">Contact</a>
							          </li>
							          <li class="ml-lg-auto mr-lg-0 m-auto">
							            <!--/search-right-->
							            <div class="search-right">
							              <a href="#search" title="search"><span class="fa fa-search" aria-hidden="true"></span></a>
							              <!-- search popup -->
							              <div id="search" class="pop-overlay">
							                  <div class="popup">
							                      <h4 class="mb-3">Search here</h4>
							                      <form action="" method="GET" class="search-box">
							                          <input type="search" placeholder="Enter Keyword" name="search" required="required"
							                              autofocus="">
							                          <button type="submit" class="btn btn-style btn-primary">Search</button>
							                      </form>

							                  </div>
							                  <a class="close" href="#close">×</a>
							              </div>
							              <!-- /search popup -->
							          </div>
							          <!--//search-right-->
							          </li>
							          <li class="align-self">
							            <a href="<?= base_url()?>login" class="btn btn-style btn-primary ml-lg-3 mr-lg-2"><span class="fa fa-user mr-1"></span> Login</a>
							          	<a href="<?= base_url()?>register" class="btn btn-style btn-primary ml-lg-3 mr-lg-2"><span class="fa fa-users mr-1"></span> Register</a>
							          </li>
							        </ul>
							      </div>
							      <!-- toggle switch for light and dark theme -->
							      <div class="mobile-position">
							        <nav class="navigation">
							          <div class="theme-switch-wrapper">
							            <label class="theme-switch" for="checkbox">
							              <input type="checkbox" id="checkbox">
							              <div class="mode-container">
							                <i class="gg-sun"></i>
							                <i class="gg-moon"></i>
							              </div>
							            </label>
							          </div>
							        </nav>
							      </div>
							      <!-- //toggle switch for light and dark theme -->
							    </nav>
							  </div>
							</header>
							<!-- //header -->
							<!-- main-slider -->
							<section class="w3l-main-slider" id="home">
							    <div class="companies20-content">
							        <div class="owl-one owl-carousel owl-theme">
							            <div class="item">
							                <li>
							                    <div class="slider-info banner-view bg bg2">
							                        <div class="banner-info">
							                            <div class="container">
							                                <div class="banner-info-bg text-left">
							                                    <p>Charity Life</p>
							                                    <h5>Charity, Faith and Hope. Help the Homeless. Charity life.</h5>
							                                    <a href="about.html" class="btn btn-primary btn-style">Read More</a>
							                                </div>
							                            </div>
							                        </div>
							                    </div>
							                </li>
							            </div>
							            <div class="item">
							                <li>
							                    <div class="slider-info  banner-view banner-top1 bg bg2">
							                        <div class="banner-info">
							                            <div class="container">
							                                <div class="banner-info-bg text-left">
							                                    <p>Save Children</p>
							                                    <h5>Donate with Kindness. Every amount Donated by you Counts.</h5>
							                                    <a href="about.html" class="btn btn-primary btn-style">Read More</a>
							                                </div>
							                            </div>
							                        </div>
							                    </div>
							                </li>
							            </div>
							            <div class="item">
							                <li>
							                    <div class="slider-info banner-view banner-top2 bg bg2">
							                        <div class="banner-info">
							                            <div class="container">
							                                <div class="banner-info-bg text-left">
							                                    <p>Unconditional Help</p>
							                                    <h5>Give a Helping hand. We all need to come together. Our Mission.</h5>
							                                    <a href="about.html" class="btn btn-primary btn-style">Read More</a>
							                                </div>
							                            </div>
							                        </div>
							                    </div>
							                </li>
							            </div>
							            <div class="item">
							                <li>
							                    <div class="slider-info banner-view banner-top3 bg bg2">
							                        <div class="banner-info">
							                            <div class="container">
							                                <div class="banner-info-bg text-left">
							                                    <p>Unconditional Help</p>
							                                    <h5>Should Children suffer this way? Dont leave Orphans alone</h5>
							                                    <a href="about.html" class="btn btn-primary btn-style">Read More</a>
							                                </div>
							                            </div>
							                        </div>
							                    </div>
							                </li>
							            </div>
							        </div>
							    </div>
							</section>
							<!-- /main-slider -->
							<!-- banner image bottom shape -->
							<div class="position-relative">
							    <div class="shape overflow-hidden">
							        <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
							            <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor">
							            </path>
							        </svg>
							    </div>
							</div>
							<!-- //banner image bottom shape -->
							<!-- home page block1 -->
							<section class="homeblock1">
							    <div class="container">
							        <div class="row">
							            <div class="col-lg-4 col-md-6 col-sm-12">
							                <div class="box-wrap">
							                    <h4><a href="#mission">View our Mission</a></h4>
							                </div>
							            </div>
							            <div class="col-lg-4 col-md-6 col-sm-12 mt-md-0 mt-sm-4 mt-3">
							                <div class="box-wrap">
							                    <h4><a href="#team">Top Founders</a></h4>
							                </div>
							            </div>
							            <div class="col-lg-4 col-md-6 col-sm-12 mt-lg-0 mt-sm-4 mt-3">
							                <div class="box-wrap">
							                    <h4><a href="contact.html">Requst a Quote</a></h4>
							                </div>
							            </div>
							        </div>
							    </div>
							</section>
							<!-- //home page block1 -->
							<!-- middle -->
								<div class="middle py-5" id="facts">
									<div class="container pt-lg-3">
										<div class="welcome-left text-center py-md-5 py-3">
							                <h3 class="title-big">Over 93% of all Donations go directly to Projects.</h3>
							                <p class="my-3">Under 7% for admin, fundraising, and salaries.</p>
							                <h4>Thank you for your continued Support </h4>
											<a href="#donate" class="btn btn-style btn-primary mt-sm-5 mt-4"><span class="fa fa-heart mr-1"></span> Donate Now</a>
										</div>
									</div>
								</div>
								<!-- //middle -->

							<!-- /bottom-grids-->
							<section class="w3l-bottom-grids-6 py-5">
							    <div class="container py-lg-5 py-md-4 py-2">
							        <div class="grids-area-hny main-cont-wthree-fea row">
							            <div class="col-lg-4 col-md-6 grids-feature">
							                <div class="area-box">
							                    <img src="<?=base_url()?>theme/save_poor_theme/assets/images/donate.png" alt="">
							                    <h4><a href="#feature" class="title-head">Give Donation.</a></h4>
							                    <p class="mb-3">Vivamus a ligula quam. Ut blandit eu leo non. Duis sed dolor amet ipsum primis in faucibus orci dolor sit et amet.</p>
							                    <a href="#donate" class="btn btn-text">Donate Now </a>
							                </div>
							            </div>
							            <div class="col-lg-4 col-md-6 grids-feature mt-md-0 mt-5">
							                <div class="area-box">
							                    <img src="<?=base_url()?>theme/save_poor_theme/assets/images/volunteer.png" alt="">
							                    <h4><a href="#feature" class="title-head">Become a Volunteer.</a></h4>
							                    <p class="mb-3">Vivamus a ligula quam. Ut blandit eu leo non. Duis sed dolor amet ipsum primis in faucibus orci dolor sit et amet.</p>
							                    <a href="contact.html" class="btn btn-text">Join Now </a>
							                </div>
							            </div>
							            <div class="col-lg-4 col-md-6 grids-feature mt-lg-0 mt-5">
							                <div class="area-box">
							                    <img src="<?=base_url()?>theme/save_poor_theme/assets/images/child.png" alt="" width="52px"> 
							                    <h4><a href="#feature" class="title-head">Help the Children.</a></h4>
							                    <p class="mb-3">Vivamus a ligula quam. Ut blandit eu leo non. Duis sed dolor amet ipsum primis in faucibus orci dolor sit et amet.</p>
							                    <a href="#donate" class="btn btn-text">Help Now </a>
							                </div>
							            </div>
							        </div>
							    </div>
							</section>
							<!-- //bottom-grids-->
							<!-- stats -->
							<section class="w3_stats py-5" id="stats">
							    <div class="container py-lg-5 py-md-4 py-2">
							        <div class="title-content text-center">
							            <h3 class="title-big">Our mission is to help people by distributing Money and Service globally.</h3>
							        </div>
							        <div class="w3-stats text-center">
							            <div class="row">
							                <div class="col-md-3 col-6">
							                    <div class="counter">
							                        <span class="fa fa-users"></span>
							                        <div class="timer count-title count-number mt-3" data-to="1500" data-speed="1500"></div>
							                        <p class="count-text ">Total Volunteers</p>
							                    </div>
							                </div>
							                <div class="col-md-3 col-6">
							                    <div class="counter">
							                        <span class="fa fa-cutlery"></span>
							                        <div class="timer count-title count-number mt-3" data-to="2256" data-speed="1500"></div>
							                        <p class="count-text ">Meals Served</p>
							                    </div>
							                </div>
							                <div class="col-md-3 col-6">
							                    <div class="counter">
							                        <span class="fa fa-home"></span>
							                        <div class="timer count-title count-number mt-3" data-to="1000" data-speed="1500"></div>
							                        <p class="count-text ">Got Shelter</p>
							                    </div>
							                </div>
							                <div class="col-md-3 col-6">
							                    <div class="counter">
							                        <span class="fa fa-male"></span>
							                        <div class="timer count-title count-number mt-3" data-to="260" data-speed="1500"></div>
							                        <p class="count-text ">Adapted Children</p>
							                    </div>
							                </div>
							            </div>
							        </div>
							    </div>
							</section>
							<!-- //stats -->
							<!-- bg -->
							<div class="w3l-bg py-5">
							    <div class="container py-lg-5 py-md-4">
							        <div class="welcome-left text-center py-lg-4">
							            <span class="fa fa-heart-o"></span>
							            <h3 class="title-big">Help the Homeless & Hungry People.</h3>
							            <a href="#donate" class="btn btn-style btn-primary mt-sm-5 mt-4">Donate Now</a>
							        </div>
							    </div>
							</div>
							<!-- //bg -->
							<section class="w3l-index5 py-5" id="causes">
							    <div class="container py-lg-5 py-md-4">
							        <div class="row">
							            <div class="col-lg-4">
							                <div class="header-section">
							                    <h3 class="title-big">Our Charity Causes </h3>
							                    <h4>If you want to work with for Save Poor charity? <a href="#url">Send your Details.</a></h4>
							                    <p class="mt-3 mb-lg-5 mb-4"> Lorem ipsum dolorus animi obcaecati vel ipsum. Vivamus a ligula quam.
							                        Ut blandit eu leo non. Duis sed dolor amet ipsum primis in faucibus orci dolor sit et amet igula quam.</p>
							                </div>
							                <a href="contact.html" class="btn btn-outline-primary btn-style">Contact Us</a>
							            </div>
							            <div class="col-lg-4 col-md-6 mt-lg-0 mt-5">
							                <div class="img-block">
							                    <a href="causes.html">
							                        <img src="<?=base_url()?>theme/save_poor_theme/assets/images/blog5.jpg" class="img-fluid radius-image-full" alt="image" />
							                        <span class="title">Food for Hungry</span>
							                    </a>
							                </div>
							                <div class="img-block mt-4">
							                    <a href="causes.html"> <img src="<?=base_url()?>theme/save_poor_theme/assets/images/blog2.jpg" class="img-fluid radius-image-full"
							                            alt="image" />
							                        <span class="title">Help from Injuries</span>
							                    </a>
							                </div>
							            </div>
							            <div class="col-lg-4 col-md-6 mt-lg-0 mt-md-5 mt-4">
							                <div class="img-block">
							                    <a href="causes.html"> <img src="<?=base_url()?>theme/save_poor_theme/assets/images/blog3.jpg" class="img-fluid radius-image-full"
							                            alt="image" />
							                        <span class="title">Education for all</span>
							                    </a>
							                </div>
							                <div class="img-block mt-4">
							                    <a href="causes.html">
							                        <img src="<?=base_url()?>theme/save_poor_theme/assets/images/blog4.jpg" class="img-fluid radius-image-full" alt="image" />
							                        <span class="title">Clean water for all</span>
							                    </a>
							                </div>
							            </div>
							        </div>
							    </div>
							</section>

							<section class="w3-services-ab py-5" id="mission">
							    <div class="container py-lg-5 py-md-4">
							        <h3 class="title-big text-center mb-5">Our Mission and Goals</h3>
							        <div class="w3-services-grids">
							            <div class="fea-gd-vv row">
							                <div class="col-lg-4 col-md-6">
							                    <div class="float-lt feature-gd">
							                        <div class="icon">
							                            <img src="<?=base_url()?>theme/save_poor_theme/assets/images/home.png" alt="" class="img-fluid">
							                        </div>
							                        <div class="icon-info">
							                            <h5>Homeless Charities.</h5>
							                            <p> Lorem ipsum dolor sit amet, dolor elit, sed eiusmod init
							                                tempor primis in init.</p>

							                        </div>
							                    </div>
							                </div>
							                <div class="col-lg-4 col-md-6 mt-md-0 mt-4">
							                    <div class="float-mid feature-gd">
							                        <div class="icon">
							                            <img src="<?=base_url()?>theme/save_poor_theme/assets/images/education.png" alt="" class="img-fluid">
							                        </div>
							                        <div class="icon-info">
							                            <h5>Education Charities.</h5>
							                            <p> Lorem ipsum dolor sit amet, dolor elit, sed eiusmod init
							                                tempor primis in init.</p>
							                        </div>
							                    </div>
							                </div>
							                <div class="col-lg-4 col-md-6 mt-lg-0 mt-4">
							                    <div class="float-rt feature-gd">
							                        <div class="icon">
							                            <img src="<?=base_url()?>theme/save_poor_theme/assets/images/health.png" alt="" class="img-fluid">
							                        </div>
							                        <div class="icon-info">
							                            <h5>Health Charities.</h5>
							                            <p> Lorem ipsum dolor sit amet, dolor elit, sed eiusmod init
							                                tempor primis in init.</p>
							                        </div>
							                    </div>
							                </div>
							                <div class="col-lg-4 col-md-6 mt-4 pt-md-2">
							                    <div class="float-lt feature-gd">
							                        <div class="icon">
							                            <img src="<?=base_url()?>theme/save_poor_theme/assets/images/icon1.png" alt="" class="img-fluid">
							                        </div>
							                        <div class="icon-info">
							                            <h5>Animal Charities.</h5>
							                            <p> Lorem ipsum dolor sit amet, dolor elit, sed eiusmod init
							                                tempor primis in init.</p>

							                        </div>
							                    </div>
							                </div>
							                <div class="col-lg-4 col-md-6 mt-4 pt-md-2">
							                    <div class="float-lt feature-gd">
							                        <div class="icon">
							                            <img src="<?=base_url()?>theme/save_poor_theme/assets/images/food.png" alt="" class="img-fluid">
							                        </div>
							                        <div class="icon-info">
							                            <h5>Food Charities.</h5>
							                            <p> Lorem ipsum dolor sit amet, dolor elit, sed eiusmod init
							                                tempor primis in init.</p>

							                        </div>
							                    </div>
							                </div>
							                <div class="col-lg-4 col-md-6 mt-4 pt-md-2">
							                    <div class="float-lt feature-gd">
							                        <div class="icon">
							                            <img src="<?=base_url()?>theme/save_poor_theme/assets/images/eco.png" alt="" class="img-fluid">
							                        </div>
							                        <div class="icon-info">
							                            <h5>Eco Charities.</h5>
							                            <p> Lorem ipsum dolor sit amet, dolor elit, sed eiusmod init
							                                tempor primis in init.</p>

							                        </div>
							                    </div>
							                </div>
							            </div>
							        </div>
							    </div>
							</section>

							<section class="w3l-clients py-5" id="clients">
							    <div class="call-w3 py-lg-5 py-md-4">
							        <div class="container">
							            <h3 class="title-big text-center">Whom we work with</h3>
							            <div class="company-logos text-center mt-5">
							                <div class="row logos">
							                    <div class="col-lg-2 col-md-3 col-4">
							                        <img src="<?=base_url()?>theme/save_poor_theme/assets/images/brand1.png" alt="" class="img-fluid">
							                    </div>
							                    <div class="col-lg-2 col-md-3 col-4">
							                        <img src="<?=base_url()?>theme/save_poor_theme/assets/images/brand2.png" alt="" class="img-fluid">
							                    </div>
							                    <div class="col-lg-2 col-md-3 col-4">
							                        <img src="<?=base_url()?>theme/save_poor_theme/assets/images/brand3.png" alt="" class="img-fluid">
							                    </div>
							                    <div class="col-lg-2 col-md-3 col-4 mt-md-0 mt-4">
							                        <img src="<?=base_url()?>theme/save_poor_theme/assets/images/brand4.png" alt="" class="img-fluid">
							                    </div>
							                    <div class="col-lg-2 col-md-3 col-4 mt-lg-0 mt-4">
							                        <img src="<?=base_url()?>theme/save_poor_theme/assets/images/brand5.png" alt="" class="img-fluid">
							                    </div>
							                    <div class="col-lg-2 col-md-3 col-4 mt-lg-0 mt-4">
							                        <img src="<?=base_url()?>theme/save_poor_theme/assets/images/brand6.png" alt="" class="img-fluid">
							                    </div>
							                </div>
							            </div>
							        </div>
							    </div>
							</section>
							<!-- footer 14 -->
							<div class="w3l-footer-main">
							  <div class="w3l-sub-footer-content">
							      <section class="_form-3">
							          <div class="form-main">
							              <div class="container">
							                  <div class="middle-section grid-column top-bottom">
							                      <div class="image grid-three-column">
							                          <img src="<?=base_url()?>theme/save_poor_theme/assets/images/subscribe.png" alt="" class="img-fluid radius-image-full">
							                      </div>
							                      <div class="text-grid grid-three-column">
							                          <h2>Subscribe our Newsletter to receive latest updates from us</h2>
							                          <p>We won’t give you spam mails.</p>
							                      </div>
							                      <div class="form-text grid-three-column">
							                          <form action="/" method="GET">
							                              <input type="email" name=" placeholder" placeholder="Enter Your Email" required="">
							                              <button type="submit" class="btn btn-style btn-primary">Submit</button>
							                          </form>
							                      </div>
							                  </div>
							              </div>
							          </div>
							      </section>
							      <!-- Footers-14 -->
							      <footer class="footer-14">
							          <div id="footers14-block">
							              <div class="container">
							                  <div class="footers20-content">
							                      <div class="d-grid grid-col-4 grids-content">
							                          <div class="column">
							                              <h4>Our Address</h4>
							                                <p>235 Terry, 10001 20C Trolley Square,
							                                  DE 19806  U.S.A.</p>
							                          </div>
							                          <div class="column">
							                              <h4>Call Us</h4>
							                              <p>Mon - Fri 10:30 -18:00</p>
							                              <p><a href="tel:+44-000-888-999">+44-000-888-999</a></p>
							                          </div>
							                          <div class="column">
							                              <h4>Mail Us</h4>
							                              <p><a href="mailto:info@example.com">info@example.com</a></p>
							                              <p><a href="mailto:no.reply@example.com">no.reply@example.com</a></p>
							                          </div>
							                          <div class="column">
							                              <h4>Follow Us On</h4>
							                              <ul>
							                                  <li><a href="#facebook"><span class="fa fa-facebook"
							                                              aria-hidden="true"></span></a>
							                                  </li>
							                                  <li><a href="#linkedin"><span class="fa fa-linkedin"
							                                              aria-hidden="true"></span></a>
							                                  </li>
							                                  <li><a href="#twitter"><span class="fa fa-twitter"
							                                              aria-hidden="true"></span></a>
							                                  </li>
							                                  <li><a href="#google"><span class="fa fa-google-plus"
							                                              aria-hidden="true"></span></a>
							                                  </li>
							                                  <li><a href="#github"><span class="fa fa-github" aria-hidden="true"></span></a>
							                                  </li>
							                              </ul>
							                          </div>
							                      </div>
							                  </div>
							                  <div class="footers14-bottom d-flex">
							                      <div class="copyright">
							                          <p>© 2020 Save Poor. All rights reserved. Design by <a href="https://w3layouts.com/"
							                                  target="_blank">W3Layouts</a></p>
							                      </div>
							                      <div class="language-select d-flex">
							                          <span class="fa fa-language" aria-hidden="true"></span>
							                          <select>
							                              <option>English</option>
							                              <option>Estonina</option>
							                              <option>Deutsch</option>
							                              <option>Nederlan;ds</option>
							                          </select>
							                      </div>
							                  </div>
							              </div>
							          </div>
							          <!-- move top -->
							          <button onclick="topFunction()" id="movetop" title="Go to top">
							              &uarr;
							          </button>
							          <script>
							              // When the user scrolls down 20px from the top of the document, show the button
							              window.onscroll = function () {
							                  scrollFunction()
							              };

							              function scrollFunction() {
							                  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
							                      document.getElementById("movetop").style.display = "block";
							                  } else {
							                      document.getElementById("movetop").style.display = "none";
							                  }
							              }

							              // When the user clicks on the button, scroll to the top of the document
							              function topFunction() {
							                  document.body.scrollTop = 0;
							                  document.documentElement.scrollTop = 0;
							              }
							          </script>
							          <!-- /move top -->

							      </footer>
							      <!-- Footers-14 -->
							  </div>
							</div>
							<!-- //footer 14 -->

							<script src="<?=base_url()?>theme/save_poor_theme/assets/js/jquery-3.3.1.min.js"></script> <!-- Common jquery plugin -->

							<script src="<?=base_url()?>theme/save_poor_theme/assets/js/theme-change.js"></script><!-- theme switch js (light and dark)-->
							<script src="<?=base_url()?>theme/save_poor_theme/assets/js/owl.carousel.js"></script>

							<!-- script for banner slider-->
							<script>
							  $(document).ready(function () {
							    $(".owl-one").owlCarousel({
							      loop: true,
							      dots: false,
							      margin: 0,
							      nav: true,
							      responsiveClass: true,
							      autoplay: true,
							      autoplayTimeout: 5000,
							      autoplaySpeed: 1000,
							      autoplayHoverPause: false,
							      responsive: {
							        0: {
							          items: 1
							        },
							        480: {
							          items: 1
							        },
							        667: {
							          items: 1
							        },
							        1000: {
							          items: 1
							        }
							      }
							    })
							  })
							</script>
							<!-- //script -->

							<!-- script for tesimonials carousel slider -->
							<script>
							  $(document).ready(function () {
							    $("#owl-demo1").owlCarousel({
							      loop: true,
							      margin: 20,
							      nav: false,
							      responsiveClass: true,
							      responsive: {
							        0: {
							          items: 1
							        },
							        736: {
							          items: 1
							        },
							        1000: {
							          items: 2,
							          loop: false
							        }
							      }
							    })
							  })
							</script>
							<!-- //script for tesimonials carousel slider -->

							<script src="<?=base_url()?>theme/save_poor_theme/assets/js/counter.js"></script>

							<!--/MENU-JS-->
							<script>
							  $(window).on("scroll", function () {
							    var scroll = $(window).scrollTop();

							    if (scroll >= 80) {
							      $("#site-header").addClass("nav-fixed");
							    } else {
							      $("#site-header").removeClass("nav-fixed");
							    }
							  });

							  //Main navigation Active Class Add Remove
							  $(".navbar-toggler").on("click", function () {
							    $("header").toggleClass("active");
							  });
							  $(document).on("ready", function () {
							    if ($(window).width() > 991) {
							      $("header").removeClass("active");
							    }
							    $(window).on("resize", function () {
							      if ($(window).width() > 991) {
							        $("header").removeClass("active");
							      }
							    });
							  });
							</script>
							<!--//MENU-JS-->

							<!-- disable body scroll which navbar is in active -->
							<script>
							  $(function () {
							    $(".navbar-toggler").click(function () {
							      $("body").toggleClass("noscroll");
							    })
							  });
							</script>
							<!-- //disable body scroll which navbar is in active -->

							<!--bootstrap-->
							<script src="<?=base_url()?>theme/save_poor_theme/assets/js/bootstrap.min.js"></script>
							<!-- //bootstrap-->
							</body>

							</html>
						';

			} else if($theme=='Medpill_Theme'){

				$code = '
							<!doctype html>
							<html lang="en">
							  <head>
							    <!-- Required meta tags -->
							    <meta charset="utf-8">
							    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

							    <title>Medpill a Medical Category Responsive Web Template - Home : W3Layouts</title>

							    <link href="https://fonts.googleapis.com/css?family=Muli:400,600,700&display=swap" rel="stylesheet">

							    <!-- Template CSS -->
							    <link rel="stylesheet" href="<?= base_url()?>theme/medpill_theme/assets/css/style-starter.css">
							  </head>
							  <body>
							<section class="w3l-bootstrap-header">
							  <nav class="navbar navbar-expand-md navbar-light py-3">
							    <div class="container">
							      <a class="navbar-brand" href="index.html"><img src="<?= base_url()?>theme/medpill_theme/assets/images/award.png" class="img-fluid" width="52px">
							        Medpill</a>
							      <!-- if logo is image enable this   
							    <a class="navbar-brand" href="#index.html">
							        <img src="image-path" alt="Your logo" title="Your logo" style="height:35px;" />
							    </a> -->
							      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
							        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
							        Menu
							      </button>

							      <div class="collapse navbar-collapse" id="navbarSupportedContent">
							        <ul class="navbar-nav ml-auto">
							          <li class="nav-item active">
							            <a class="nav-link" href="#">Home</a>
							          </li>
							          <li class="nav-item">
							            <a class="nav-link" href="#">About</a>
							          </li>
							          <li class="nav-item">
							            <a class="nav-link" href="#">Services</a>
							          </li>
							          <li class="nav-item">
							            <a class="nav-link" href="#">Contact</a>
							          </li>
							          <li class="nav-item">
							            <a class="nav-link" href="<?= base_url()?>login">Login</a>
							          </li>
							          <li class="nav-item">
							            <a class="nav-link" href="<?= base_url()?>register">Register</a>
							          </li>
							        </ul>
							      </div>
							      <a href="#domain" class="domain ml-3" data-toggle="modal" data-target="#DomainModal">
							        <div class="hamburger1">
							          <div></div>
							          <div></div>
							          <div></div>
							        </div>
							      </a>
							    </div>
							  </nav>
							</section>


							<!-- Domain Modal -->
							<div class="modal right fade" id="DomainModal" tabindex="-1" role="dialog" aria-labelledby="DomainModalLabel2">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">

							      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
							          aria-hidden="true">&times;</span></button>

							      <div class="modal-body">
							        <div class="modal__content">
							          <h2 class="logo"><img src="<?= base_url()?>theme/medpill_theme/assets/images/award.png" class="img-fluid"> Medpill</h2>
							          <!-- if logo is image enable this   
							          <h2 class="logo">
							            <img src="image-path" alt="Your logo" title="Your logo" style="height:35px;" />
							          </h2> -->
							          <p class="mt-md-3 mt-2">Lorem ipsum dolor sit amet, elit. Eos expedita ipsam at fugiat ab.</p>
							          <div class="widget-menu-items mt-sm-5 mt-4">
							            <h5 class="widget-title">Menu Items</h5>
							            <nav class="navbar p-0">
							              <ul class="navbar-nav">
							                <li class="nav-item active">
							                  <a class="nav-link" href="#">Home</a>
							                </li>
							                <li class="nav-item">
							                  <a class="nav-link" href="#">About</a>
							                </li>
							                <li class="nav-item">
							                  <a class="nav-link" href="#">Services</a>
							                </li>
							                <li class="nav-item">
							                  <a class="nav-link" href="#">Contact</a>
							                </li>
							              </ul>
							            </nav>
							          </div>
							          <div class="widget-social-icons mt-sm-5 mt-4">
							            <h5 class="widget-title">Contact Us</h5>
							            <ul class="icon-rounded address">
							              <li>
							                <p> #135 block, Barnard St. Brooklyn, <br>NY 10036, USA</p>
							              </li>
							              <li class="mt-3">
							                <p><span class="fa fa-phone"></span> <a href="tel:+404-11-22-89">+1-2345-345-678-11</a></p>
							              </li>
							              <li class="mt-2">
							                <p><span class="fa fa-envelope"></span> <a
							                    href="mailto:medpillhospital@mail.com">medpillhospital@mail.com</a></p>
							              </li>
							              <li class="top_li1 mt-2">
							                <p><span class="fa fa-clock-o"></span> <a href="mailto:medpillhospital@mail.com">Mon - Sun 09:00 - 21:00
							                  </a></p>
							              </li>
							            </ul>
							          </div>
							          <div class="widget-social-icons mt-sm-5 mt-4">
							            <h5 class="widget-title">Follow Us</h5>
							            <ul class="icon-rounded">
							              <li><a class="social-link twitter" href="#url" target="_blank"><i class="fa fa-twitter"></i></a></li>
							              <li><a class="social-link linkedin" href="#url" target="_blank"><i class="fa fa-linkedin"></i></a></li>
							              <li><a class="social-link tumblr" href="#url" target="_blank"><i class="fa fa-tumblr"></i></a></li>
							            </ul>
							          </div>


							        </div>
							      </div>
							    </div>
							    <!-- //modal-content -->
							  </div>
							  <!-- //modal-dialog -->
							</div>
							<!-- //Domain modal -->
							<section class="w3l-main-slider" id="home">
							  <!-- main-slider -->
							  <div class="companies20-content">
							   
							    <div class="owl-one owl-carousel owl-theme">
							      <div class="item">
							        <li>
							          <div class="slider-info banner-view bg bg2">
							            <div class="banner-info">
							              <div class="container">
							                <div class="banner-info-bg">
							                  <h5>We Provide total Health care solution</h5>
							                  <p>Donec maximus erat quis magna tincidunt, et ullamcorper ex condimentum. Pellentesque 
							                    volutpat lectus felis, sit amet dapibus tortor convallis sit amet. Quisque egestas sem quis 
							                    augue porta, et iaculis massa consequat.</p>
							                  <a class="btn btn-style btn-style-outline mt-sm-5 mt-4" href="services.html"> Our Services</a>
							                </div>
							              </div>
							            </div>
							          </div>
							        </li>
							      </div>
							      <div class="item">
							        <li>
							          <div class="slider-info  banner-view banner-top1 bg bg2">
							            <div class="banner-info">
							              <div class="container">
							                <div class="banner-info-bg">
							                  <h5>Helping you to stay Happy one</h5>
							                  <p>Donec maximus erat quis magna tincidunt, et ullamcorper ex condimentum. Pellentesque 
							                    volutpat lectus felis, sit amet dapibus tortor convallis sit amet. Quisque egestas sem quis 
							                    augue porta, et iaculis massa consequat.</p>
							                    <a class="btn btn-style btn-style-outline mt-sm-5 mt-4" href="services.html"> Our Services</a>
							                </div>
							              </div>
							            </div>
							          </div>
							        </li>
							      </div>
							      <div class="item">
							        <li>
							          <div class="slider-info banner-view banner-top2 bg bg2">
							            <div class="banner-info">
							              <div class="container">
							                <div class="banner-info-bg">
							                  <h5>1 Lakh+ Patients trusted in our Hospital.</h5>
							                  <p>Donec maximus erat quis magna tincidunt, et ullamcorper ex condimentum. Pellentesque 
							                    volutpat lectus felis, sit amet dapibus tortor convallis sit amet. Quisque egestas sem quis 
							                    augue porta, et iaculis massa consequat.</p>
							                    <a class="btn btn-style btn-style-outline mt-sm-5 mt-4" href="services.html"> Our Services</a>
							                </div>
							              </div>
							            </div>
							          </div>
							        </li>
							      </div>
							      <div class="item">
							        <li>
							          <div class="slider-info banner-view banner-top3 bg bg2" >
							            <div class="banner-info">
							              <div class="container">
							                <div class="banner-info-bg">
							                  <h5>The Largest and most respected Agencies</h5>
							                  <p>Donec maximus erat quis magna tincidunt, et ullamcorper ex condimentum. Pellentesque 
							                    volutpat lectus felis, sit amet dapibus tortor convallis sit amet. Quisque egestas sem quis 
							                    augue porta, et iaculis massa consequat.</p>
							                    <a class="btn btn-style btn-style-outline mt-sm-5 mt-4" href="services.html"> Our Services</a>
							                </div>
							              </div>
							            </div>
							          </div>
							        </li>
							      </div>
							    </div>
							  </div>
							</div>
							  <!-- /main-slider -->
							</section>
							  <!-- w3l-features-photo-7 -->
							  <section class="w3l-features-photo-7 py-5">
							      <div class="w3l-features-photo-7_sur py-lg-5 py-sm-3">
							          <div class="container">
							              <div class="row">
							                  <div class="col-lg-8 w3l-features-photo-7_top-left">
							                      <h2>Dr.Thomas Saint</h2>
							                      <p class="mb-lg-5 mb-4">Doctor of Transplant Surgery (PHD)</p>
							                      <h4>I Offer a full range of Professional mental Health services to children, Adults,
							                          Couples, and Families.</h4>
							                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. orci urna. In et augue ornare,
							                          tempor massa in, luctus sapien. Proin a diam et dui fermentum dolor molestie vel id
							                          neque. Donec sed tempus enim, a congue risus. Pellen tesqu
							                      </p>
							                      <div class="feat_top">
							                          <div class="w3l-features-photo-7-box">
							                              <div class="icon">
							                                <img src="<?= base_url()?>theme/medpill_theme/assets/images/heart.png" class="img-fluid"/>
							                              </div>
							                              <div class="info-feature">
							                                  <h5 class="w3l-features-photo-7-box-txt"><a href="#url">Heart Attack</a></h5>
							                                  <p>Proin a diam et dui elit, orci urna vel id neque. Donec sed enim</p>
							                              </div>
							                          </div>
							                          <div class="w3l-features-photo-7-box">
							                            <div class="icon">
							                              <img src="<?= base_url()?>theme/medpill_theme/assets/images/icon1.png" class="img-fluid"/>
							                            </div>
							                              <div class="info-feature">
							                                  <h5 class="w3l-features-photo-7-box-txt"><a href="#url">Transplant Surgery</a></h5>
							                                  <p>Proin a diam et dui elit, orci urna vel id neque. Donec sed enim</p>
							                              </div>
							                          </div>
							                          <div class="w3l-features-photo-7-box">
							                            <div class="icon">
							                              <img src="<?= base_url()?>theme/medpill_theme/assets/images/sthethoscope.png" class="img-fluid"/>
							                            </div>
							                              <div class="info-feature">
							                                  <h5 class="w3l-features-photo-7-box-txt"><a href="#url">Surgery specialist</a></h5>
							                                  <p>Proin a diam et dui elit, orci urna vel id neque. Donec sed enim</p>
							                              </div>
							                          </div>
							                          <div class="w3l-features-photo-7-box">
							                            <div class="icon">
							                              <img src="<?= base_url()?>theme/medpill_theme/assets/images/ambulance.png" class="img-fluid"/>
							                            </div>
							                              <div class="info-feature">
							                                  <h5 class="w3l-features-photo-7-box-txt"><a href="#url">Physiotheraphy</a></h5>
							                                  <p>Proin a diam et dui elit, orci urna vel id neque. Donec sed enim</p>
							                              </div>
							                          </div>
							                      </div>
							                  </div>
							                  <div class="col-lg-4 w3l-features-photo-7_top-right mt-lg-0 mt-4">
							                      <img src="<?= base_url()?>theme/medpill_theme/assets/images/doctor1.jpg" class="img-fluid" alt="" />
							                  </div>
							              </div>
							          </div>
							      </div>
							  </section>
							  <!-- //w3l-features-photo-7 -->
							<section class="w3l-video-sec">
								<div class="video-inner py-5">
									<div class="overlay1 py-lg-5 py-sm-3">
										<div class="container">
											<div class="video-content">
												<img src="<?= base_url()?>theme/medpill_theme/assets/images/heart-big.png" class="img-fluid" alt="" />
												<h4><a href="#url">We Provide High Quality Services.</a></h4>
												<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed obcaecati natus illum, placeat nam
													consequatur! Proin a diam et dui fermentum dolor.</p>
												<a href="#notify" class="play-button btn"><span class="fa fa-play pl-1" aria-hidden="true">

													</span></a>

												<!-- notify-popup-->
												<div id="notify" class="notify-pop-overlay">
													<div class="notify-popup">
														<h5>Excellent Health Care Systems</h5>
														<iframe src="https://player.vimeo.com/video/180825357" frameborder="0"
															allow="autoplay; fullscreen" allowfullscreen></iframe>
														<a class="close" href="#close">&times;</a>
													</div>
												</div>
												<!-- //notify-popup -->
											</div>
										</div>
									</div>
								</div>
							</section>
							<!-- services page block 1 -->
							<section class="w3l-features py-5">
							    <div class="container py-lg-5 py-3">
							        <div class="row main-cont-wthree-2">
							            <div class="col-lg-6 feature-grid-right">
							                <img src="<?= base_url()?>theme/medpill_theme/assets/images/healthcare.jpg" class="img-fluid" alt="healthcare">
							            </div>
							            <div class="col-lg-6 feature-grid-left mt-lg-0 mt-sm-5 mt-4">
							                <h4 class="title-left">We are Providing Excellent Health Care</h4>
							                <p class="text-para">Curabitur id gravida risus. Fusce eget ex fermentum, ultricies nisi ac sed, lacinia est.
							                    Quisque ut lectus consequat, venenatis eros et, commodo risus. Nullam sit amet laoreet elit. </p>
							                <div class="stats_main text-center">
							                    <div class="w3l-stats">
							                        <div class="">
							                            <img src="<?= base_url()?>theme/medpill_theme/assets/images/patients.png" class="img-fluid">
							                        </div>
							                        <div class="info-feature mt-3">
							                            <h5 class="w3l-stats-txt"><a href="#url">1,754</a></h5>
							                            <p class="stats-text">Patients</p>
							                        </div>
							                    </div>
							                    <div class="w3l-stats">
							                        <div class="">
							                            <img src="<?= base_url()?>theme/medpill_theme/assets/images/services.png" class="img-fluid">
							                        </div>
							                        <div class="info-feature mt-3">
							                            <h5 class="w3l-stats-txt"><a href="#url">457</a></h5>
							                            <p class="stats-text">Services</p>
							                        </div>
							                    </div>
							                    <div class="w3l-stats">
							                        <div class="">
							                            <img src="<?= base_url()?>theme/medpill_theme/assets/images/award.png" class="img-fluid">
							                        </div>
							                        <div class="info-feature mt-3">
							                            <h5 class="w3l-stats-txt"><a href="#url">1,395</a></h5>
							                            <p class="stats-text">Awards</p>
							                        </div>
							                    </div>
							                </div>
							            </div>
							        </div>
							    </div>
							</section>
							<!-- services page block 1 -->
							<section class="w3l-apply-6" id="appointment">
								<!-- /apply-6-->
								<div class="apply-info py-5">
									<div class="container py-lg-5 py-sm-3">
										<div class="apply-grids-info row">
											<div class="apply-gd-left col-lg-5">
												<h4>Make an appointment</h4>
												<p class="para-apply">We will send you a confirmation within 24 hours.
													<br><strong>Emergency?</strong> Call 1-2554-2356-33
												</p>
												<div class="mt-lg-5 mt-4">
													<div class="sub-apply mt-5">
														<div class="apply-sec-info">
															<div class="icon">
																<img src="<?= base_url()?>theme/medpill_theme/assets/images/icon1.png" class="img-fluid">
															</div>
															<div class="appyl-sub-icon-info">
																<h5><a href="blog-single.html">Immune system</a></h5>
																<p>Lorem ipsum dolor sit amet,Ea a diam et dui elit, orci urna vel id neque. Donec
																	sed enim.</p>
																<a href="#url" class="learn">Learn More <i class="fa fa-long-arrow-right ml-2"></i></a>
															</div>
														</div>
													</div>
													<div class="sub-apply mt-5">
														<div class="apply-sec-info">
															<div class="icon">
																<img src="<?= base_url()?>theme/medpill_theme/assets/images/sthethoscope.png" class="img-fluid">
															</div>
															<div class="appyl-sub-icon-info">
																<h5><a href="blog-single.html">Nutrition</a></h5>
																<p>Lorem ipsum dolor sit amet,Ea a diam et dui elit, orci urna vel id neque. Donec
																	sed enim.</p>
																<a href="#url" class="learn">Learn More <i class="fa fa-long-arrow-right ml-2"></i></a>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="apply-gd-right offset-lg-1 col-lg-6 mt-lg-0 mt-5">
												<div class="apply-form p-sm-5 p-4">
													<h5>Fill the form for appointment</h5>
													<form action="#" method="post">
														<div class="admission-form">
															<div class="form-group">
																<input type="text" class="form-control" placeholder="Full Name*" required="">
															</div>
															<div class="form-group">
																<input type="text" class="form-control" placeholder="Phone Number*" required="">
															</div>
															<div class="form-group">
																<input type="email" class="form-control" placeholder="Email*" required="">
															</div>
															<select class="form-control">
																<option>Select Disease</option>
																<option>Lung disease</option>
																<option>Others</option>
															</select>
														</div>
														<div class="form-group">
															<textarea name="Comment" class="form-control" placeholder="Message*" required=""></textarea>
														</div>
														<button type="submit" class="btn btn-primary submit">Submit Now</button>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>
							<!-- //apply-6-->
							<section class="w3l-call-to-action_9 py-5">
							    <div class="call-w3">
							        <div class="container">
							            <div class=" main-cont-wthree-2">
							                <div class="left-contect-calls text-center">
							                    <h3 class="title mb-sm-5 mb-4">Certificates & Standards</h3>
							                  <div class="call-grids-w3 ">
							                        <a href="#url" class="">
							                            <img src="<?= base_url()?>theme/medpill_theme/assets/images/logo1.png" class="img-fluid" alt="">
							                        </a>

							                        <a href="#url" class="">
							                            <img src="<?= base_url()?>theme/medpill_theme/assets/images/logo2.png" class="img-fluid" alt="">
							                        </a>
							                        <a href="#url" class="">
							                            <img src="<?= base_url()?>theme/medpill_theme/assets/images/logo3.png" class="img-fluid" alt="">
							                        </a>
							                        <a href="#url" class="">
							                            <img src="<?= base_url()?>theme/medpill_theme/assets/images/logo4.png" class="img-fluid" alt="">
							                        </a>
							                        <a href="#url" class="">
							                            <img src="<?= base_url()?>theme/medpill_theme/assets/images/logo5.png" class="img-fluid" alt="">
							                        </a>
							                    </div>
							                </div>
							            </div>
							        </div>
							    </div>
							</section>
							  <!-- footer-28 block -->
							  <section class="w3l-medpill-footer ">
							    <footer class="footer-28">
							      <div class="footer-bg-layer">
							        <div class="container py-lg-3">
							          <div class="row footer-top-28">
							            <div class="col-lg-4 col-md-6 col-sm-7 footer-list-28 mt-sm-5 mt-4">
							              <h6 class="footer-title-28">Contact information</h6>
							              <ul class="address">
							                <li>
							                  <p> #135 block, Barnard St. Brooklyn, <br>NY 10036, USA</p>
							                </li>
							                <li class="mt-4">
							                  <p><span class="fa fa-phone"></span> <a href="tel:+404-11-22-89">+1-2345-345-678-11</a></p>
							                </li>
							                <li>
							                  <p><span class="fa fa-envelope"></span> <a
							                      href="mailto:medpillhospital@mail.com">medpillhospital@mail.com</a></p>
							                </li>
							              </ul>
							            </div>
							            <div class="col-lg-3 col-md-6 col-sm-5 footer-list-28 mt-sm-5 mt-4">
							              <h6 class="footer-title-28">Company</h6>
							              <ul>
							                <li><a href="#url">Mission and values</a></li>
							                <li><a href="#url">Publications and reports</a></li>
							                <li><a href="#url">Ladership and Awards</a></li>
							                <li><a href="#url">Diversity is Our Specialty</a></li>
							                <li><a href="#url">Policies & Procedures</a></li>
							              </ul>
							            </div>
							            <div class="col-lg-2 col-md-6 col-sm-4 footer-list-28 mt-sm-5 mt-4">
							              <h6 class="footer-title-28">Our Services</h6>
							              <ul>
							                <li><a href="#url">Orthopaedic</a></li>
							                <li><a href="#url">Dental Service</a></li>
							                <li><a href="#url">Lung Diseases</a></li>
							                <li><a href="#url">Heart Attact</a></li>
							                <li><a href="#url">Sport Injury</a></li>
							              </ul>
							            </div>
							            <div class="col-lg-3 col-md-6 col-sm-8 footer-list-28 mt-sm-5 mt-4">
							              <h6 class="footer-title-28">Hospital hours</h6>
							              <ul class="timing mb-lg-4">
							                <li><a href="#URL"><span class="fa fa-clock-o"></span>Mon to Fri : <span>08:00 - 20:00</span></a></li>
							                <li><a href="#URL"><span class="fa fa-clock-o"></span>Saturday : <span>08:00 - 20:00</span></a></li>
							                <li><a href="#URL"><span class="fa fa-clock-o"></span>Sunday : <span>08:00 - 20:00</span></a></li>
							              </ul>
							            </div>
							          </div>
							        </div>
							      </div>
							      <div class="midd-footer-28 align-center py-lg-4 py-3 mt-md-5 mt-3">
							        <div class="container">
							          <p class="copy-footer-28 text-center"> &copy; 2020 Medpill. All Rights Reserved. Design by <a
							              href="https://w3layouts.com/">W3Layouts</a></p>
							        </div>
							      </div>
							      </div>
							    </footer>

							    <!-- move top -->
							    <button onclick="topFunction()" id="movetop" title="Go to top">
							      &#10548;
							    </button>
							    <script>
							      // When the user scrolls down 20px from the top of the document, show the button
							      window.onscroll = function () {
							        scrollFunction()
							      };

							      function scrollFunction() {
							        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
							          document.getElementById("movetop").style.display = "block";
							        } else {
							          document.getElementById("movetop").style.display = "none";
							        }
							      }

							      // When the user clicks on the button, scroll to the top of the document
							      function topFunction() {
							        document.body.scrollTop = 0;
							        document.documentElement.scrollTop = 0;
							      }
							    </script>
							    <!-- /move top -->

							    <script src="<?= base_url()?>theme/medpill_theme/assets/js/jquery-3.3.1.min.js"></script>
							    
							    <script src="<?= base_url()?>theme/medpill_theme/assets/js/green-audio-player.js"></script>

							    <script>
							        document.addEventListener("DOMContentLoaded", function() {
							            new GreenAudioPlayer(".ready-player-1", { stopOthersOnPlay: true });
							        });
							    </script>

							    <!-- video popup -->
							    <script>
							      $("#notify").change(function () {
							        if ($("#notify").is("Active")) {
							          $("body").css("overflow", "hidden");
							        } else {
							          $("body").css("overflow", "auto");
							        }
							      });
							    </script>
							    <!-- //video popup -->

							    <script src="<?= base_url()?>theme/medpill_theme/assets/js/owl.carousel.js"></script>
							    <!-- script for banner slider-->
							    <script>
							      $(document).ready(function () {
							        $(".owl-one").owlCarousel({
							          loop: true,
							          margin: 0,
							          nav: false,
							          responsiveClass: true,
							          autoplay: false,
							          autoplayTimeout: 5000,
							          autoplaySpeed: 1000,
							          autoplayHoverPause: false,
							          responsive: {
							            0: {
							              items: 1,
							              nav: false
							            },
							            480: {
							              items: 1,
							              nav: false
							            },
							            667: {
							              items: 1,
							              nav: true
							            },
							            1000: {
							              items: 1,
							              nav: true
							            }
							          }
							        })
							      })
							    </script>
							    <!-- //script -->
							    
							  <!-- disable body scroll which navbar is in active -->
							  <script>
							    $(function () {
							      $(".navbar-toggler").click(function () {
							        $("body").toggleClass("noscroll");
							      })
							    });
							  </script>
							  <!-- disable body scroll which navbar is in active -->

							    <script src="<?= base_url()?>theme/medpill_theme/assets/js/bootstrap.min.js"></script>

							    </body>

							    </html>
						';

			} else if($theme=='Corpo_Theme'){

				$code = '
							<!DOCTYPE html>
							<html lang="zxx">

							<head>
							  <title>Corpo Corporate Category Flat Bootstrap Responsive Website Template | Home :: W3layouts</title>
							  <!-- Meta tag Keywords -->
							  <meta name="viewport" content="width=device-width, initial-scale=1">
							  <meta charset="UTF-8" />
							  <meta name="keywords" content="Corpo Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
							  <script>
							    addEventListener("load", function () {
							      setTimeout(hideURLbar, 0);
							    }, false);

							    function hideURLbar() {
							      window.scrollTo(0, 1);
							    }
							  </script>
							  <!--// Meta tag Keywords -->

							  <!-- Custom-Files -->
							  <link rel="stylesheet" href="<?= base_url()?>theme/corpo_theme/css/bootstrap.css">
							  <!-- Bootstrap-Core-CSS -->
							  <link rel="stylesheet" href="<?= base_url()?>theme/corpo_theme/css/style.css" type="text/css" media="all" />
							  <!-- Style-CSS -->
							  <link href="<?= base_url()?>theme/corpo_theme/css/font-awesome.min.css" rel="stylesheet">
							  <!-- Font-Awesome-Icons-CSS -->
							  <!-- //Custom-Files -->

							  <!-- Web-Fonts -->
							  <link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese"
							   rel="stylesheet">
							  <link href="//fonts.googleapis.com/css?family=Sarabun:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i&amp;subset=latin-ext,thai,vietnamese"
							   rel="stylesheet">
							  <link href="//fonts.googleapis.com/css?family=Courgette&amp;subset=latin-ext" rel="stylesheet">
							  <!-- //Web-Fonts -->
							</head>

							<body>
							  <!-- main -->
							  <div class="d-flex">
							    <!-- header -->
							    <header>
							      <nav class="nav-top">
							        <!-- Created By Bogdan Nagorniy -->
							        <div class="logo">
							          <h1>
							            <a href="index.html">Corpo</a>
							          </h1>
							        </div>
							        <ul class="nav_links list-unstyled">
							          <li class="nav-link-list">
							            <a href="index.html">
							              <span class="fa fa-home"></span>
							              <p>Home</p>
							            </a>
							          </li>
							          <li>
							            <a href="#about">
							              <span class="fa fa-question"></span>
							              <p>About</p>
							            </a>
							          </li>
							          <li>
							            <a href="#services">
							              <span class="fa fa-cog"></span>
							              <p>Services</p>
							            </a>
							          </li>
							          <li>
							            <a href="#blog">
							              <span class="fa fa-clipboard"></span>
							              <p>Blog</p>
							            </a>
							          </li>
							          <li>
							            <a href="#team">
							              <span class="fa fa-users"></span>
							              <p>Team</p>
							            </a>
							          </li>
							          <li>
							            <a href="#testi">
							              <span class="fa fa-coffee"></span>
							              <p>Clients</p>
							            </a>
							          </li>
							          <li>
							            <a href="#contact">
							              <span class="fa fa-map-marker"></span>
							              <p>Contact</p>
							            </a>
							          </li>
							        </ul>
							      </nav>
							    </header>
							    <!-- //header -->

							    <!-- left content -->
							    <div id="main-content">
							      <!-- home -->
							      <div id="home">
							        <!-- banner -->
							        <div class="banner_w3lspvt">
							          <div class="banner-top1">
							            <div class="container">
							              <div class="banner-text text-center">
							                <h4>c</h4>
							                <h3 class="my-md-4 my-3">To Grow Your Business</h3>
							                <p class="movetxt text-bl">We Provide Best Services</p>
							              </div>
							            </div>
							          </div>
							        </div>
							        <!-- //banner -->
							      </div>
							      <!-- //home -->

							      <!-- about -->
							      <div class="welcome py-5" id="about">
							        <div class="container py-xl-5 py-lg-3">
							          <div class="row py-xl-4">
							            <div class="col-lg-6 welcome-left pr-lg-5">
							              <h3>Story About Us</h3>
							              <h4 class="mt-2 mb-3">Welcome to our company</h4>
							              <h6>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem
							                aperiam, eaque ipsa quae ab illo inventore</h6>
							              <p class="mt-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse porta erat sit amet eros
							                sagittis, quis
							                hendrerit
							                libero aliquam. Fusce semper augue ac dolor efficitur, a pretium metus pellentesque.</p>
							            </div>
							            <div class="col-lg-6 welcome-right text-center mt-lg-0 mt-5">
							              <div class="row">
							                <div class="col-sm-6">
							                  <div class="about-sty ml-sm-3">
							                    <span class="fa fa-bar-chart text-wh"></span>
							                    <p class="text-li mt-2">Business Strategy</p>
							                  </div>
							                </div>
							                <div class="col-sm-6 mt-sm-0 mt-4">
							                  <div class="about-sty-2 px-4 py-5">
							                    <span class="fa fa-line-chart text-wh"></span>
							                    <p class="text-li mt-2">Business Growth</p>
							                  </div>
							                  <div class="about-sty-2 px-4 py-5 mt-4">
							                    <span class="fa fa-usd text-wh"></span>
							                    <p class="text-li mt-2">Financial Planning</p>
							                  </div>
							                </div>
							              </div>
							            </div>
							          </div>
							        </div>
							      </div>
							      <!-- //about -->

							      <!-- services -->
							      <div class="serives-w3pvt-web py-5" id="services">
							        <div class="container py-xl-5 py-lg-3">
							          <div class="row support-bottom text-center">
							            <div class="col-md-4 services-w3ls-grid">
							              <div class="serv-icon mx-auto">
							                <span class="fa fa-pie-chart"></span>
							              </div>
							              <h4 class="text-wh mt-md-4 mt-3 mb-3">Service 1</h4>
							              <p>Ut enim ad minima veniam, quis nostrum ullam corporis suscipit laboriosam.</p>
							            </div>
							            <div class="col-md-4 services-w3ls-grid my-md-0 my-4">
							              <div class="serv-icon clr-2 mx-auto">
							                <span class="fa fa-opencart"></span>
							              </div>
							              <h4 class="text-wh mt-md-4 mt-3 mb-3">Service 2</h4>
							              <p>Ut enim ad minima veniam, quis nostrum ullam corporis suscipit laboriosam.</p>
							            </div>
							            <div class="col-md-4 services-w3ls-grid">
							              <div class="serv-icon clr-3 mx-auto">
							                <span class="fa fa-ravelry"></span>
							              </div>
							              <h4 class="text-wh mt-md-4 mt-3 mb-3">Service 3</h4>
							              <p>Ut enim ad minima veniam, quis nostrum ullam corporis suscipit laboriosam.</p>
							            </div>
							          </div>
							        </div>
							      </div>
							      <!-- //services -->

							      <!-- middle -->
							      <div class="w3pvt-web-wthree-works py-5">
							        <div class="container py-xl-4 py-lg-3">
							          <div class="row">
							            <div class="col-lg-7 img-left-posi text-lg-left text-center">
							              <img src="<?= base_url()?>theme/corpo_theme/images/middle.jpg" alt="" class="img-fluid">
							            </div>
							            <div class="col-lg-5 grids-w3ls-right-2 mt-xl-5 mt-4">
							              <h3 class="title text-bl text-uppercase mb-lg-4 mb-3">Your Title Here</h3>
							              <ul class="list-unstyled">
							                <li>
							                  <span class="fa fa-check-square-o"></span>
							                  Masagni dolores eoquie
							                </li>
							                <li class="my-2">
							                  <span class="fa fa-check-square-o"></span>
							                  Ipsumquia dolor eiuse
							                </li>
							                <li>
							                  <span class="fa fa-check-square-o"></span>
							                  Ut laboreas dolore
							                </li>
							              </ul>
							              <h4 class="title text-bl mt-5 mb-sm-4 mb-3">Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut
							                fugit.</h4>
							              <p>sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad reprehenderit qui
							                inea voluptate velit esse. </p>
							            </div>
							          </div>
							        </div>
							      </div>
							      <!-- //middle -->

							      <!-- blog -->
							      <section class="blog_w3ls pt-3 pb-5" id="blog">
							        <div class="container pb-xl-5 pb-lg-3">
							          <h3 class="title text-uppercase text-center text-bl mb-5 pb-xl-3">Latest Blog</h3>
							          <div class="row">
							            <!-- blog grid -->
							            <div class="col-lg-4 col-md-6">
							              <div class="card border-0 med-blog">
							                <div class="card-header p-0">
							                  <a href="#">
							                    <img class="card-img-bottom" src="<?= base_url()?>theme/corpo_theme/images/blog1.jpg" alt="image">
							                  </a>
							                </div>
							                <div class="card-body border border-top-0">
							                  <div class="mb-3">
							                    <h5 class="blog-title card-title font-weight-bold m-0">
							                      <a href="#">Dictum porta auris</a>
							                    </h5>
							                    <div class="blog_w3icon">
							                      <span>
							                        Jan 12, 2019 - loremipsum</span>
							                    </div>
							                  </div>
							                  <p>Cras ultricies ligula sed magna dictum porta auris blandita. Nulla viverra pharetra se.</p>
							                </div>
							              </div>
							            </div>
							            <!-- //blog grid -->
							            <!-- blog grid -->
							            <div class="col-lg-4 col-md-6 mt-md-0 mt-5">
							              <div class="card border-0 med-blog">
							                <div class="card-header p-0">
							                  <a href="#">
							                    <img class="card-img-bottom" src="<?= base_url()?>theme/corpo_theme/images/blog2.jpg" alt="image">
							                  </a>
							                </div>
							                <div class="card-body border">
							                  <div class="mb-3">
							                    <h5 class="blog-title card-title font-weight-bold m-0">
							                      <a href="#">Sed do eiusmod</a>
							                    </h5>
							                    <div class="blog_w3icon">
							                      <span>
							                        Jan 14, 2019 - loremipsum</span>
							                    </div>
							                  </div>
							                  <p>Cras ultricies ligula sed magna dictum porta auris blandita. Nulla viverra pharetra se.</p>
							                </div>
							              </div>
							            </div>
							            <!-- //blog grid -->
							            <!-- blog grid -->
							            <div class="col-lg-4 col-md-6 mx-lg-0 mx-md-auto mt-lg-0 mt-5">
							              <div class="card border-0 med-blog">
							                <div class="card-header p-0">
							                  <a href="#">
							                    <img class="card-img-bottom" src="<?= base_url()?>theme/corpo_theme/images/blog3.jpg" alt="image">
							                  </a>
							                </div>
							                <div class="card-body border border-top-0">
							                  <div class="mb-3">
							                    <h5 class="blog-title card-title font-weight-bold m-0">
							                      <a href="#">Tempor inci didunt</a>
							                    </h5>
							                    <div class="blog_w3icon">
							                      <span>
							                        Jan 16, 2019 - loremipsum</span>
							                    </div>
							                  </div>
							                  <p>Cras ultricies ligula sed magna dictum porta auris blandita. Nulla viverra pharetra se.</p>
							                </div>
							              </div>
							            </div>
							            <!-- //blog grid -->
							          </div>
							        </div>
							      </section>
							      <!-- //blog -->

							      <!-- stats section -->
							      <div class="stats py-5" id="stats">
							        <div class="container py-xl-5 py-lg-3">
							          <div class="row text-center py-sm-3">
							            <div class="col-md-3 col-sm-6 w3layouts_stats_left">
							              <p class="counter">600</p>
							              <p class="para-text-w3ls text-li">Projects Complete</p>
							            </div>
							            <div class="col-md-3 col-sm-6 w3layouts_stats_left mt-sm-0 mt-4">
							              <p class="counter">800</p>
							              <p class="para-text-w3ls text-li">Awards</p>
							            </div>
							            <div class="col-md-3 col-sm-6 w3layouts_stats_left mt-md-0 mt-4">
							              <p class="counter">1200</p>
							              <p class="para-text-w3ls text-li">Happy Clients</p>
							            </div>
							            <div class="col-md-3 col-sm-6 w3layouts_stats_left mt-md-0 mt-4">
							              <p class="counter">500</p>
							              <p class="para-text-w3ls text-li">Mail Conversation</p>
							            </div>
							          </div>
							        </div>
							      </div>
							      <!-- //stats section -->

							      <!-- team -->
							      <section class="team py-5" id="team">
							        <div class="container py-xl-5 py-lg-3">
							          <h3 class="title text-uppercase text-center text-bl mb-5 pb-xl-3">Our Team</h3>
							          <div class="row inner-sec-w3layouts-w3pvt-lauinfo">
							            <div class="col-md-4 team-grids text-center">
							              <img src="<?= base_url()?>theme/corpo_theme/images/team1.jpg" class="img-fluid" alt="">
							              <div class="team-info">
							                <div class="caption mb-3">
							                  <h4>John Doe</h4>
							                </div>
							                <div class="social-icons-section">
							                  <a class="fac" href="#">
							                    <span class="fa fa-facebook"></span>
							                  </a>
							                  <a class="twitter mx-2" href="#">
							                    <span class="fa fa-twitter"></span>
							                  </a>
							                  <a class="google" href="#">
							                    <span class="fa fa-google-plus"></span>
							                  </a>
							                </div>
							              </div>
							            </div>
							            <div class="col-md-4 team-grids my-md-0 my-4 text-center">
							              <img src="<?= base_url()?>theme/corpo_theme/images/team2.jpg" class="img-fluid" alt="">
							              <div class="team-info">
							                <div class="caption mb-3">
							                  <h4>Adam Ster</h4>
							                </div>
							                <div class="social-icons-section">
							                  <a class="fac" href="#">
							                    <span class="fa fa-facebook"></span>
							                  </a>
							                  <a class="twitter mx-2" href="#">
							                    <span class="fa fa-twitter"></span>
							                  </a>
							                  <a class="google" href="#">
							                    <span class="fa fa-google-plus"></span>
							                  </a>
							                </div>
							              </div>
							            </div>
							            <div class="col-md-4 team-grids text-center">
							              <img src="<?= base_url()?>theme/corpo_theme/images/team3.jpg" class="img-fluid" alt="">
							              <div class="team-info">
							                <div class="caption mb-3">
							                  <h4>Chris Tina</h4>
							                </div>
							                <div class="social-icons-section">
							                  <a class="fac" href="#">
							                    <span class="fa fa-facebook"></span>
							                  </a>
							                  <a class="twitter mx-2" href="#">
							                    <span class="fa fa-twitter"></span>
							                  </a>
							                  <a class="google" href="#">
							                    <span class="fa fa-google-plus"></span>
							                  </a>
							                </div>
							              </div>
							            </div>
							          </div>
							        </div>
							      </section>
							      <!-- team -->

							      <!-- testimonials -->
							      <section class="testi text-center py-5" id="testi">
							        <div class="container pb-xl-5 pb-lg-3">
							          <div class="title-section mb-sm-5 mb-4 pb-xl-4 text-center">
							            <h4 class="text-bl mb-2">We have</h4>
							            <h3 class="w3ls-title text-bl text-uppercase let font-weight-bold">7630 happy users</h3>
							          </div>
							          <div class="row pb-4">
							            <div class="col-lg-6">
							              <div class="testi-cgrid">
							                <div class="testi-icon">
							                  <span class="fa fa-user text-wh" aria-hidden="true"></span>
							                </div>
							                <h6 class="b-w3ltxt mt-4">Steve Joe</h6>
							                <p class="mx-auto">Onec consequat sapien ut leo cursus
							                  rhoncus. Nullam dui mi, vulputate ac metus semper.</p>
							              </div>
							            </div>
							            <div class="col-lg-6 mt-lg-0 mt-sm-5 mt-4">
							              <div class="testi-cgrid">
							                <div class="testi-icon">
							                  <span class="fa fa-user text-wh" aria-hidden="true"></span>
							                </div>
							                <h6 class="b-w3ltxt mt-4">Petey Sty</h6>
							                <p class="mx-auto">Onec consequat sapien ut leo cursus
							                  rhoncus. Nullam dui mi, vulputate ac metus semper.</p>
							              </div>
							            </div>
							          </div>
							        </div>
							      </section>
							      <!-- testimonials -->

							      <!-- middle section -->
							      <section class="w3ls-bnrbtm py-5 text-center">
							        <div class="container py-xl-5 my-lg-5">
							          <div class="cont-w3pvt py-sm-5 py-4">
							            <span class="w3-line text-uppercase">Corpo</span>
							            <h3 class="w3pvt-web-title mt-2 mb-3">Our Mission is simple, deliver very honest financial products to every
							              customer.</h3>
							            <p class="text-botm">Donec consequat sapien ut leo cursus rhoncus. Nullam dui mi, vulputate ac metus at</p>
							            <a href="#about" class="btn button-style mt-sm-5 mt-4">Read More</a>
							          </div>
							        </div>
							      </section>
							      <!-- //middle section -->

							      <!-- contact -->
							      <section class="contact py-5" id="contact">
							        <div class="container py-xl-5 py-lg-3">
							          <h3 class="title text-uppercase text-center text-bl mb-5 pb-xl-3">Contact Us</h3>
							          <div class="row mail-w3l-w3pvt-web pt-xl-4">
							            <div class="col-md-5 contact-left-w3ls">
							              <h3>Contact Info</h3>
							              <div class="row visit">
							                <div class="col-md-2 col-sm-2 col-2 contact-icon-wthree">
							                  <span class="fa fa-home" aria-hidden="true"></span>
							                </div>
							                <div class="col-md-10 col-sm-10 col-10 contact-text-w3pvt-webinf0">
							                  <h4>Visit us</h4>
							                  <p>Parma Via Modena,BO, Italy</p>
							                  <p>Lorem ipsum dolor.</p>
							                </div>
							              </div>
							              <div class="row mail-w3 my-4">
							                <div class="col-md-2 col-sm-2 col-2 contact-icon-wthree">
							                  <span class="fa fa-envelope-o" aria-hidden="true"></span>
							                </div>
							                <div class="col-md-10 col-sm-10 col-10 contact-text-w3pvt-webinf0">
							                  <h4>Mail us</h4>
							                  <p><a href="mailto:info@example.com">info@example.com</a></p>
							                </div>
							              </div>
							              <div class="row call">
							                <div class="col-md-2 col-sm-2 col-2 contact-icon-wthree">
							                  <span class="fa fa-phone" aria-hidden="true"></span>
							                </div>
							                <div class="col-md-10 col-sm-10 col-10 contact-text-w3pvt-webinf0">
							                  <h4>Call us</h4>
							                  <p>+18044261149</p>
							                </div>
							              </div>
							            </div>
							            <div class="col-md-6 w3pvt-webinfo_mail_grid_right mt-md-0 mt-5">
							              <form action="#" method="post">
							                <div class="form-group">
							                  <input type="text" name="Name" class="form-control" placeholder="Name" required="">
							                </div>
							                <div class="form-group">
							                  <input type="email" name="Email" class="form-control" placeholder="Email" required="">
							                </div>
							                <div class="form-group">
							                  <textarea name="Message" placeholder="Message......." required=""></textarea>
							                </div>
							                <button type="submit" class="btn">Submit</button>
							              </form>
							            </div>
							          </div>
							        </div>
							      </section>
							      <!-- //contact -->
							      <!-- map -->
							      <div class="map p-2">
							        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d100949.24429313939!2d-122.44206553967531!3d37.75102885910819!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80859a6d00690021%3A0x4a501367f076adff!2sSan+Francisco%2C+CA%2C+USA!5e0!3m2!1sen!2sin!4v1472190196783"
							         class="map" style="border:0" allowfullscreen=""></iframe>
							      </div>
							      <!-- //map -->

							      <!-- partners -->
							      <section class="partners text-center py-5">
							        <div class="container py-xl-5 py-lg-3">
							          <h4 class="text-bl font-weight-bold mb-sm-5 mb-4">Trusted by the worlds best companies</h4>
							          <ul class="list-unstyled partners-icon pt-md-5 pt-4">
							            <li>
							              <span class="fa fa-ravelry clr1"></span>
							            </li>
							            <li>
							              <span class="fa fa-meetup clr2"></span>
							            </li>
							            <li>
							              <span class="fa fa-eercast clr3"></span>
							            </li>
							            <li>
							              <span class="fa fa-pied-piper clr4"></span>
							            </li>
							            <li>
							              <span class="fa fa-yoast clr5"></span>
							            </li>
							            <li>
							              <span class="fa fa-superpowers clr6"></span>
							            </li>
							          </ul>
							        </div>
							      </section>
							      <!-- //partners -->

							      <!-- footer -->
							      <footer class="py-5">
							        <div class="container py-xl-4">
							          <div class="row footer-top">
							            <div class="col-md-5 footer-grid_section_1its">
							              <div class="row">
							                <div class="col-lg-6 col-md-12 col-sm-6">
							                  <div class="row">
							                    <div class="col-2 foot-icon-w3">
							                      <span class="fa fa-user" aria-hidden="true"></span>
							                    </div>
							                    <div class="col-10">
							                      <h2 class="footer-title text-uppercase text-wh mb-lg-4 mb-3">About Us</h2>
							                      <p>Sed ut perspiciatis unde omnis iste natus error sit.</p>
							                    </div>
							                  </div>
							                </div>
							                <div class="col-lg-6 col-md-12 col-sm-6 mt-lg-0 mt-md-4 mt-sm-0 mt-4">
							                  <div class="row">
							                    <div class="col-2 foot-icon-w3">
							                      <span class="fa fa-hand-o-right" aria-hidden="true"></span>
							                    </div>
							                    <div class="col-10">
							                      <h3 class="footer-title text-uppercase text-wh mb-lg-4 mb-3">Who We Are</h3>
							                      <p>Error sit antium dolorts remq hymue laud.</p>
							                    </div>
							                  </div>
							                </div>
							              </div>
							              <div class="row mt-4">
							                <div class="col-lg-6 col-md-12 col-sm-6">
							                  <div class="row">
							                    <div class="col-2 foot-icon-w3">
							                      <span class="fa fa-ticket" aria-hidden="true"></span>
							                    </div>
							                    <div class="col-10">
							                      <h3 class="footer-title text-uppercase text-wh mb-lg-4 mb-3">We Offer</h3>
							                      <p>Sed ut perspiciatis unde omnis iste natus error sit.</p>
							                    </div>
							                  </div>
							                </div>
							                <div class="col-lg-6 col-md-12 col-sm-6 mt-lg-0 mt-md-4 mt-sm-0 mt-4">
							                  <div class="row">
							                    <div class="col-2 foot-icon-w3">
							                      <span class="fa fa-bullhorn" aria-hidden="true"></span>
							                    </div>
							                    <div class="col-10">
							                      <h3 class="footer-title text-uppercase text-wh mb-lg-4 mb-3">Popular In</h3>
							                      <p>Error sit antium dolorts remq hymue laud.</p>
							                    </div>
							                  </div>
							                </div>
							              </div>
							            </div>
							            <div class="col-md-3 footer-grid_section_1its my-md-0 my-5">
							              <h3 class="footer-title text-uppercase text-wh mb-lg-4 mb-md-3 mb-4">Contact Us</h3>
							              <div class="contact-info">
							                <div class="footer-style-w3ls">
							                  <h4 class="text-li mb-2">Phone</h4>
							                  <p>+121 098 8907 9987</p>
							                </div>
							                <div class="footer-style-w3ls my-4">
							                  <h4 class="text-li mb-2">Email </h4>
							                  <p><a href="mailto:info@example.com">info@example.com</a></p>
							                </div>
							                <div class="footer-style-w3ls">
							                  <h4 class="text-li mb-2">Location</h4>
							                  <p>Honey Avenue, New York City</p>
							                </div>
							              </div>
							            </div>
							            <div class="col-md-4 footer-grid_section_1its">
							              <h3 class="footer-title text-uppercase text-wh mb-lg-4 mb-3">Newsletter</h3>
							              <p>Be the first to get latest news and offers!<br>Sed ut perspiciatis unde omnis.</p>
							              <form action="#" method="post" class="subscribe_form mt-4">
							                <input class="form-control" type="email" name="email" placeholder="Enter your email..." required="">
							                <button type="submit" class="btn">Submit</button>
							              </form>
							              <!-- social icons -->
							              <div class="w3pvt-webinfo_social_icons mt-4 pt-md-0 pt-3">
							                <h3 class="footer-title text-uppercase text-wh mb-lg-4 mb-3">Connect With Social</h3>
							                <ul class="w3pvt-webits_social_list list-unstyled">
							                  <li class="w3_w3pvt-web_facebook">
							                    <a href="#">
							                      <span class="fa fa-facebook-f"></span>
							                    </a>
							                  </li>
							                  <li class="mx-2 w3pvt-web_twitter">
							                    <a href="#">
							                      <span class="fa fa-twitter"></span>
							                    </a>
							                  </li>
							                  <li class="w3_w3pvt-web_dribble">
							                    <a href="#">
							                      <span class="fa fa-dribbble"></span>
							                    </a>
							                  </li>
							                  <li class="ml-2 w3_w3pvt-web_google">
							                    <a href="#">
							                      <span class="fa fa-google-plus"></span>
							                    </a>
							                  </li>
							                </ul>
							              </div>
							              <!-- social icons -->
							            </div>
							          </div>
							        </div>
							      </footer>
							      <!-- //footer -->
							      <!-- copyright -->
							      <div class="cpy-right text-center py-3">
							        <p>© 2019 Corpo. All rights reserved | Design by
							          <a href="http://w3layouts.com"> W3layouts.</a>
							        </p>
							      </div>
							      <!-- //copyright -->
							      <!-- move top icon -->
							      <a href="#home" class="move-top text-center"></a>
							      <!-- //move top icon -->
							    </div>
							    <!-- //left content -->
							  </div>
							  <!-- //main -->

							</body>

							</html>
						';

			} else {
				$code = '';
			} 

			$check_theme = $this->cpanel->check_theme($theme);

			//var_dump($code);
			$path_helper = $_SERVER['DOCUMENT_ROOT'].'/application/views/public/main_page.php';
			//$path_helper = $_SERVER['DOCUMENT_ROOT'].'/application/views/project/dashboard_public.php';
			$data = $code;
			$f=fopen($path_helper,'w');
			fwrite($f,$data);
			fclose($f);
		} else {
			redirect('cpanel/login');
		}
	}


	function update_main_page()
	{
		if($this->session->userdata('role')=='developer'){
			//var_dump($code);
			$path_helper = $_SERVER['DOCUMENT_ROOT'].'/application/views/public/main_page.php';
			//$path_helper = $_SERVER['DOCUMENT_ROOT'].'/application/views/project/dashboard_public.php';

			$code = $this->input->post('code');
			$data = $code;
			$f=fopen($path_helper,'w');
			fwrite($f,$data);
			fclose($f);
		} else {
			redirect('cpanel/login');
		}
	}

	function page_dashboard()
	{
		if($this->session->userdata('role')=='developer'){
			$this->load->view('cpanel/header/header');
			$this->load->view('cpanel/body/page_edit_dashboard.php');
			$this->load->view('cpanel/footer/footer');
		} else {
			redirect('cpanel/login');
		}
	}

	function update_dashboard_page()
	{
		if($this->session->userdata('role')=='developer'){
			//var_dump($code);
			$path_helper = $_SERVER['DOCUMENT_ROOT'].'/application/views/project/dashboard_public.php';
			//$path_helper = $_SERVER['DOCUMENT_ROOT'].'/application/views/project/dashboard_public.php';

			$code = $this->input->post('code');
			$data = $code;
			$f=fopen($path_helper,'w');
			fwrite($f,$data);
			fclose($f);
		} else {
			redirect('cpanel/login');
		}
	}


	function page_login()
	{
		if($this->session->userdata('role')=='developer'){
			$this->load->view('cpanel/header/header');
			$this->load->view('cpanel/body/page_edit_login.php');
			$this->load->view('cpanel/footer/footer');
		} else {
			redirect('cpanel/login');
		}
	}


	function update_login_page()
	{
		if($this->session->userdata('role')=='developer'){
			//var_dump($code);
			$path_helper = $_SERVER['DOCUMENT_ROOT'].'/application/views/project/login.php';
			//$path_helper = $_SERVER['DOCUMENT_ROOT'].'/application/views/project/login.php';

			$code = $this->input->post('code');
			$data = $code;
			$f=fopen($path_helper,'w');
			fwrite($f,$data);
			fclose($f);
		} else {
			redirect('cpanel/login');
		}
	}


	function page_register()
	{
		if($this->session->userdata('role')=='developer'){
			$this->load->view('cpanel/header/header');
			$this->load->view('cpanel/body/page_edit_register.php');
			$this->load->view('cpanel/footer/footer');
		} else {
			redirect('cpanel/login');
		}
	}


	function update_register_page()
	{
		if($this->session->userdata('role')=='developer'){
			//var_dump($code);
			$path_helper = $_SERVER['DOCUMENT_ROOT'].'/application/views/project/register.php';
			//$path_helper = $_SERVER['DOCUMENT_ROOT'].'/application/views/project/register.php';

			$code = $this->input->post('code');
			$data = $code;
			$f=fopen($path_helper,'w');
			fwrite($f,$data);
			fclose($f);
		} else {
			redirect('cpanel/login');
		}
	}


	function create_extra_page()
	{
		$name_function = $this->input->post('name_function');
		$name_description = $this->input->post('name_description');
		$code_editor = $this->input->post('code_editor');

		$check_controller = $this->cpanel->check_name_controller($name_function);
		if($check_controller>0){
			$name_function = $name_function.'_'.rand();
		} else {
			$check_page = $this->cpanel->check_name_page($name_function);
			if($check_page>0){
				$name_function = $name_function.'_'.rand();
			} 
		}

		

		$data = array(
						'name_function'=>$name_function,
						'name_description'=>$name_description,
						'project_id'=>$this->session->userdata('project_id'),
						'id_view'=>rand()
					 );

		$this->db->insert('extra_page',$data);



		$path_helper = fopen(APPPATH.'views/public/page/'.$name_function.'.php', "a")
		  or die("Unable to open file!");

		$controller_content = $code_editor;
		fwrite($path_helper, "\n". $controller_content);
		fclose($path_helper);


		// Create Controller
	  $path_controller = fopen(APPPATH.'controllers/'.$name_function.'.php', "a")
	  or die("Unable to open file!");

	  $start ="<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class $name_function extends CI_Controller  {

	    public function __construct()
	    {

	      parent::__construct();
	      \$this->load->database();
	      \$this->load->library('session');
	      \$this->load->helper('Lookup_helper');
	    }

	    function index()
	    {
	    	\$this->load->view('public/page/$name_function');
	    }
	}";


		$controller_content = $start;
		fwrite($path_controller, "\n". $controller_content);
		fclose($path_controller);

		redirect('cpanel/list_page');

	}


	function extra_page_edit()
	{
		if($this->session->userdata('role')=='developer'){
			$this->load->view('cpanel/header/header');
			$this->load->view('cpanel/body/page_edit_extra_page.php');
			$this->load->view('cpanel/footer/footer');
		} else {
			redirect('cpanel/login');
		}
	}


	function update_extra_page()
	{
		if($this->session->userdata('role')=='developer'){
			$file = $this->input->post('file_name');
			//var_dump($code);
			$path_helper = $_SERVER['DOCUMENT_ROOT'].'/application/views/public/page/'.$file.'.php';
			//$path_helper = $_SERVER['DOCUMENT_ROOT'].'/application/views/project/register.php';

			$code = $this->input->post('code');
			$data = $code;
			$f=fopen($path_helper,'w');
			fwrite($f,$data);
			fclose($f);
		} else {
			redirect('cpanel/login');
		}
	}


	function check_name_page()
	{
		$controller = $this->input->post('controller_name');
		$check_controller = $this->cpanel->check_name_page($controller);
		echo $check_controller;
	}


	function create_table()
	{
		if($this->session->userdata('role')=='developer'){
			$this->load->view('cpanel/header/header');
			$this->load->view('cpanel/body/create_table.php');
			$this->load->view('cpanel/footer/footer');
		} else {
			redirect('cpanel/login');
		}
	}

	function create_column()
	{
		if($this->session->userdata('role')=='developer'){
			$this->load->view('cpanel/header/header');
			$this->load->view('cpanel/body/create_column.php');
			$this->load->view('cpanel/footer/footer');
		} else {
			redirect('cpanel/login');
		}
	}


	function list_table($rowno=0)
	{
		if($this->session->userdata('role')=='developer'){

			$this->load->library('pagination');

			$search_text = '';
	  		if($this->input->post('submit') != NULL ){
	  			$search_text = $this->input->post('search');
	  			$this->session->set_userdata(array('search'=>$search_text));
	  		} else {
	  			if($this->session->userdata('search') != NULL){
					$search_text = $this->session->userdata('search');
				}
	  		}

	  		$rowperpage = 10;
	  		if($rowno != 0){
		      $rowno = ($rowno-1) * $rowperpage;
		    }
		    

		    $allcount = $this->cpanel->list_table_Count($search_text);
		    $users_record = $this->cpanel->list_table_Data($rowno,$rowperpage,$search_text);


		    $segment1 = $this->uri->segment(1);
			$segment2 = $this->uri->segment(2);


		    $config['base_url'] = base_url().$segment1.'/'.$segment2;
		    $config['use_page_numbers'] = TRUE;
		    $config['total_rows'] = $allcount;
		    $config['per_page'] = $rowperpage;


		    // integrate bootstrap pagination
	        $config['full_tag_open'] = '<ul class="pagination">';
	        $config['full_tag_close'] = '</ul>';
	        $config['first_link'] = false;
	        $config['last_link'] = false;
	        $config['first_tag_open'] = '<li class="paginate_button page-item">';
	        $config['first_tag_close'] = '</li>';
	        $config['prev_link'] = '«';
	        $config['prev_tag_open'] = '<li class="paginate_button page-item prev">';
	        $config['prev_tag_close'] = '</li>';
	        $config['next_link'] = '»';
	        $config['next_tag_open'] = '<li paginate_button page-item >';
	        $config['next_tag_close'] = '</li>';
	        $config['last_tag_open'] = '<li paginate_button page-item >';
	        $config['last_tag_close'] = '</li>';
	        $config['cur_tag_open'] = '<li class="paginate_button page-item active"><a href="#">';
	        $config['cur_tag_close'] = '</a></li>';
	        $config['num_tag_open'] = '<li paginate_button page-item >';
	        $config['num_tag_close'] = '</li>';

		    $this->pagination->initialize($config);


		    $data['pagination'] = $this->pagination->create_links();
		    $data['result'] = $users_record;
		    $data['row'] = $rowno;
		    $data['search'] = $search_text;

			$this->load->view('cpanel/header/header');
			$this->load->view('cpanel/body/list_table.php',$data);
			$this->load->view('cpanel/footer/footer');
		} else {
			redirect('cpanel/login');
		}
	}

	function new_table()
	{
		if($this->session->userdata('role')=='developer'){

			$name_table = $this->input->post('name_table');
			$desc_table = $this->input->post('desc_table');

			$data = array(
							'name_table'=>$name_table,
							'desc_table'=>$desc_table,
							'project_id'=>$this->session->userdata('project_id')
						 );
			$this->db->insert('register_table',$data);

			if ($this->db->table_exists($name_table) )
			{
			  // table exists some code run query
			}
			else
			{
			  	// table does not exist
				//create table 
				$this->load->dbforge();
				$this->dbforge->add_field('id');
				$this->dbforge->create_table($name_table);


				$fields = array(
				    'project_id' => array('type' => 'TEXT')
				);
				$this->dbforge->add_column($name_table, $fields, 'id');


				$fields = array(
				    'uid' => array('type' => 'TEXT')
				);
				$this->dbforge->add_column($name_table, $fields, 'project_id');

			}

			redirect('Cpanel/list_table');

		} else {
			redirect('login');
		}
	}


	function alter_field()
	{
		if($this->session->userdata('role')=='developer'){
			$column = $this->input->post('name_field');
			$type = $this->input->post('type_field');

			$table_name = $this->uri->segment(3);

			if($table_name==''){

			} else {
				if ($this->db->field_exists($column, $table_name))
				{
					
				} else {

					$this->load->dbforge();
					if($type=='VARCHAR'){

						$fields = array(
					        $column => array('type' => $type,'constraint' => '100')
					    );

					} else if($type=='INT'){

						$fields = array(
					        $column => array('type' => $type,'null' => FALSE)
					    );

					} else if($type=='TEXT'){

						$fields = array(
					        $column => array('type' => $type,'null' => TRUE)
					    );

					} else {
						$fields = array(
					        $column => array('type' => $type)
					    );
					}
					

				    //var_dump($table_name); exit();
				    $this->dbforge->add_column($table_name, $fields, 'id');
				}
			}

			redirect('cpanel/create_column/'.$table_name);

		} else {
			redirect('login');
		}

	}


	function add_developer()
	{	if($this->session->userdata('role')=='developer'){
			$this->load->view('cpanel/add_developer');
		} else {
			redirect('login');
		}
	}

	function add_team()
	{
		if($this->session->userdata('role')=='developer'){
			$first_name = $this->input->post('first_name');
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$setup_role = $this->check_setup();
			$project_name = $this->project_name();

			$check_email = $this->check_member($email);

			if($check_email>0){

			} else {
				$data = array(
								'first_name'=>$first_name,
								'email'=>$email,
								'password'=>$password,
								'setup_register'=>$setup_role,
								'project_id'=>$this->session->userdata('project_id'),
								'project_name'=>$project_name,
								'team_member'=>1
							 );

				$this->db->insert('project_login',$data);
			}
			redirect('cpanel/add_developer');


		} else {
			redirect('login');
		}
	}

	function check_setup()
	{
		$project_id = $this->session->userdata('project_id');
		$where = "
    				SELECT setup_register  FROM project_login as a 
    				where a.project_id='$project_id'
    			 ";
    	$query = $this->db->query($where);
        if ($query->num_rows() >0){ 
            foreach ($query->result() as $data) {
                $setup_register = $data->setup_register;

                return $setup_register;

            }
        }
    }


    function project_name()
	{
		$project_id = $this->session->userdata('project_id');
		$where = "
    				SELECT project_name  FROM project_login as a 
    				where a.project_id='$project_id'
    			 ";
    	$query = $this->db->query($where);
        if ($query->num_rows() >0){ 
            foreach ($query->result() as $data) {
                $project_name = $data->project_name;

                return $project_name;

            }
        }
    }


    function check_member($email)
	{
		$project_id = $this->session->userdata('project_id');
		$where = "
    				SELECT COUNT(*) AS Total  FROM project_login as a 
    				where a.project_id='$project_id' AND a.email='$email'
    			 ";
    	$query = $this->db->query($where);
        $Total = 0;
        if ($query->num_rows() >0){ 
            foreach ($query->result() as $data) {
                $Total = $data->Total;
            }
        }

        return $Total;
    }
	//end 



	public function document()
	{
		if($this->session->userdata('role')=='developer'){
			$this->load->view('document/main');
		} else {
			$this->load->view('cpanel/login.php');
		}
		
	}

	public function document_backend()
	{
		if($this->session->userdata('role')=='developer'){
			$this->load->view('document/backend');
		} else {
			$this->load->view('cpanel/login.php');
		}
		
	}

	/* NEW FUNCTION */
	function create_graph()
	{
		if($this->session->userdata('role')=='developer'){

			$this->load->view('cpanel/header/header');
			$this->load->view('cpanel/body/create_graph.php');
			$this->load->view('cpanel/footer/footer');
		} else {
			redirect('cpanel/login');
		}
	}

	function form_graph()
	{
		if($this->session->userdata('role')=='developer'){

			$this->load->view('cpanel/header/header');
			$this->load->view('cpanel/body/form_graph.php');
			$this->load->view('cpanel/footer/footer');
		} else {
			redirect('cpanel/login');
		}
	}

	function list_graph($rowno=0)
	{
		if($this->session->userdata('role')=='developer'){

			$this->load->library('pagination');

			$search_text = '';
	  		if($this->input->post('submit') != NULL ){
	  			$search_text = $this->input->post('search');
	  			$this->session->set_userdata(array('search'=>$search_text));
	  		} else {
	  			if($this->session->userdata('search') != NULL){
					$search_text = $this->session->userdata('search');
				}
	  		}

	  		$rowperpage = 10;
	  		if($rowno != 0){
		      $rowno = ($rowno-1) * $rowperpage;
		    }


		    $allcount = $this->cpanel->list_graph_model_Count($search_text);
		    $users_record = $this->cpanel->list_graph_model_Data($rowno,$rowperpage,$search_text);


		    $segment1 = $this->uri->segment(1);
			$segment2 = $this->uri->segment(2);


		    $config['base_url'] = base_url().$segment1.'/'.$segment2;
		    $config['use_page_numbers'] = TRUE;
		    $config['total_rows'] = $allcount;
		    $config['per_page'] = $rowperpage;


		    // integrate bootstrap pagination
	        $config['full_tag_open'] = '<ul class="pagination">';
	        $config['full_tag_close'] = '</ul>';
	        $config['first_link'] = false;
	        $config['last_link'] = false;
	        $config['first_tag_open'] = '<li class="paginate_button page-item">';
	        $config['first_tag_close'] = '</li>';
	        $config['prev_link'] = '«';
	        $config['prev_tag_open'] = '<li class="paginate_button page-item prev">';
	        $config['prev_tag_close'] = '</li>';
	        $config['next_link'] = '»';
	        $config['next_tag_open'] = '<li paginate_button page-item >';
	        $config['next_tag_close'] = '</li>';
	        $config['last_tag_open'] = '<li paginate_button page-item >';
	        $config['last_tag_close'] = '</li>';
	        $config['cur_tag_open'] = '<li class="paginate_button page-item active"><a href="#">';
	        $config['cur_tag_close'] = '</a></li>';
	        $config['num_tag_open'] = '<li paginate_button page-item >';
	        $config['num_tag_close'] = '</li>';

		    $this->pagination->initialize($config);


		    $data['pagination'] = $this->pagination->create_links();
		    $data['result'] = $users_record;
		    $data['row'] = $rowno;
		    $data['search'] = $search_text;

			$this->load->view('cpanel/header/header');
			$this->load->view('cpanel/body/list_graph.php',$data);
			$this->load->view('cpanel/footer/footer');
		} else {
			redirect('cpanel/login');
		}
	}


	function add_column_graph()
	{
		if($this->session->userdata('role')=='developer'){
			$table = $this->input->post('table');
			$column = $this->input->post('column');
			$id_graph = $this->input->post('id_graph');

			$data = array('tbl'=>$table,'column_graph'=>$column,'id_graph'=>$id_graph);
			$this->db->insert('graph_column',$data);
		}
	}

	function build_graph()
	{
		if($this->session->userdata('role')=='developer'){
			$tbl = $this->input->post('tbl');
			$id_graph = $this->input->post('id_graph');
			$graph_type = $this->input->post('graph_type');
			$graph_operation = $this->input->post('graph_operation');
			$graph_name = $this->input->post('graph_name');
			$graph_duration = $this->input->post('graph_duration');
			$graph_desc = $this->input->post('graph_desc');
			$column = $this->input->post('column');


			$graph_title = $this->input->post('graph_title');
			$graph_label = $this->input->post('graph_label');

			$graph_name_check = $this->cpanel->check_graph_name($graph_name);
			if($graph_name_check>0){
				$graph_name = $graph_name.'_'.rand();
			}

			$data = array(
							'tbl'=>$tbl,
							'id_graph'=>$id_graph,
							'graph_type'=>$graph_type,
							'graph_operation'=>$graph_operation,
							'graph_name'=>$graph_name,
							'graph_desc'=>$graph_desc,
							'graph_column'=>$column,
							'graph_title'=>$graph_title,
							'graph_label'=>$graph_label,
						 );
			$this->db->insert('graph_create',$data);


			// CREATE FILE
			$this->cpanel->create_graph_function($tbl,$column,$graph_type,$graph_name,$graph_operation,$graph_title,$graph_label);


			redirect('cpanel/list_graph');
		}

	}


	function get_all_column_graph()
	{
		if($this->session->userdata('role')=='developer'){
			$id_graph = $this->input->post('id_graph');
			$this->cpanel->get_all_column_graph($id_graph);
		}
	}

	function deleteColumn()
	{
		if($this->session->userdata('role')=='developer'){
			$id = $this->input->post('id');
			$id_graph = $this->input->post('id_graph');
			$this->db->where('id',$id);
			$this->db->where('id_graph',$id_graph);
			$this->db->delete('graph_column');
		}
	}
	/* END */


	public function pie_chart_js() {
   
      // $query =  $this->db->query("SELECT created_at as y_date, DAYNAME(created_at) as day_name, COUNT(id) as count  FROM users WHERE date(created_at) > (DATE(NOW()) - INTERVAL 7 DAY) AND MONTH(created_at) = '" . date('m') . "' AND YEAR(created_at) = '" . date('Y') . "' GROUP BY DAYNAME(created_at) ORDER BY (y_date) ASC"); 

	  $datepicker = $this->input->post('datepicker');
	  $monthpicker = $this->input->post('monthpicker');
	  $yearpicker = $this->input->post('yearpicker');


	  if(empty($monthpicker)){

	  	if(!empty($yearpicker)){
	  		
	  		$query =  $this->db->query("SELECT datetime as y_date, CONCAT(MONTHNAME(datetime),' / ',YEAR(datetime)) as day_name, COUNT(table_name) as count  FROM project_file WHERE  YEAR(datetime) = '" . $yearpicker . "' GROUP BY MONTH(datetime) ORDER BY MONTH(datetime) ASC"); 
	  	} else {
	  		
	  		$query =  $this->db->query("SELECT datetime as y_date, DAYNAME(datetime) as day_name, COUNT(table_name) as count  FROM project_file WHERE date(datetime) > (DATE(NOW()) - INTERVAL 7 DAY) AND MONTH(datetime) = '" . date('m') . "' AND YEAR(datetime) = '" . date('Y') . "' GROUP BY DAYNAME(datetime) ORDER BY (y_date) ASC");

	  		

	  		
	  	}

	  	 
	  } else {
	  	
	  	$query =  $this->db->query("SELECT datetime as y_date, CONCAT(DAY(datetime),' / ',MONTH(datetime)) as day_name, COUNT(table_name) as count  FROM project_file WHERE MONTH(datetime) = '" . $monthpicker . "' AND YEAR(datetime) = '" . $yearpicker . "' GROUP BY DAY(datetime) ORDER BY DAY(datetime) ASC"); 
	  }



	  
	  
 
      $record = $query->result();
      $data = [];
 
      foreach($record as $row) {
            $data['label'][] = $row->day_name;
            $data['data'][] = (int) $row->count;
      }
      $data['chart_data'] = json_encode($data);

      //var_dump($data); exit();

      if(empty($monthpicker)){
      	if(!empty($yearpicker)){
      		$data['title']='Filter By Year';
      	} else {
      		$data['title']='Filter By Last 7 Days';
      	}
      } else {
      	$data['title']='Filter By Month';
      }

      //var_dump($data); exit();

      //var_dump($data); exit();
     //var_dump($data);
		$this->load->view('cpanel/header/header');
		// $this->load->view('pie_chart',$data);
		$this->load->view('line_chart',$data);
		$this->load->view('cpanel/footer/footer');
      
    }


    function check_graph_name()
    {
    	if($this->session->userdata('role')=='developer'){
	    	$graph_name = $this->input->post('graph_name');
	    	echo $this->cpanel->check_graph_name($graph_name);
	    }
    }

    /// all activities should have created date formate 24 hour



    /* NEW MODULE UPLOAD DATA TO EXCEL */
    function upload_data()
    {
    	if($this->session->userdata('role')=='developer'){
	    	$this->load->view('cpanel/header/header');
			$this->load->view('cpanel/body/upload.php');
			$this->load->view('cpanel/footer/footer');
		}
    }

    function getColumnLetter( $number ){
	    $prefix = '';
	    $suffix = '';
	    $prefNum = intval( $number/26 );
	    if( $number > 25 ){
	        $prefix = getColumnLetter( $prefNum - 1 );
	    }
	    $suffix = chr( fmod( $number, 26 )+65 );
	    return $prefix.$suffix;
	}


	function toNum($data) {
	    $alphabet = array( 'A', 'B', 'C', 'D', 'E',
	                       'F', 'G', 'H', 'I', 'J',
	                       'K', 'L', 'M', 'N', 'O',
	                       'P', 'Q', 'R', 'S', 'T',
	                       'U', 'V', 'W', 'X', 'Y',
	                       'Z'
	                       );
	    $alpha_flip = array_flip($alphabet);
	    $return_value = -1;
	    $length = strlen($data);
	    for ($i = 0; $i < $length; $i++) {
	        $return_value +=
	            ($alpha_flip[$data[$i]] + 1) * pow(26, ($length - $i - 1));
	    }
	    return $return_value;
	}

    function direct_data()
    {
    	if($this->session->userdata('role')=='developer'){
	    	$table = $this->input->post('tbl');
	    	if(!empty($table)){

	    		$check_table = $this->cpanel->check_name_table($table);
				//var_dump($table_name);

				if($check_table>0){

					date_default_timezone_set("Asia/Kuala_Lumpur");
			        $timeReg =date("h:i:s");
			        $dateReg =date("d/m/Y");//$dateReg =date("d/m/Y");
			        $datetime = $dateReg.' '.$timeReg;

			        $status = array();

					if ($this->input->post('submit')) {

						$path = 'source/excel/';
			            
						$this->load->library('excel');

			            $config['upload_path'] = $path;
			            $config['allowed_types'] = 'xlsx|xls|csv';
			            $config['remove_spaces'] = TRUE;

			            //var_dump($config);
			            $this->load->library('upload', $config);
			            $this->upload->initialize($config); 

			            if (!$this->upload->do_upload('uploadFile')) {
			                $error = array('error' => $this->upload->display_errors());
			                var_dump($error); exit();
			            } else {
			                $data = array('upload_data' => $this->upload->data());
			            }
			            if(empty($error)){
			              	if (!empty($data['upload_data']['file_name'])) {
				                $import_xls_file = $data['upload_data']['file_name'];
				            } else {
				                $import_xls_file = 0;
				            }
				            $inputFileName = $path . $import_xls_file;
				            try {
				                
				                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
				                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
				                $objPHPExcel = $objReader->load($inputFileName);
				                $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
				                $flag = true;
				                $i=0;
				                $sheet = $objPHPExcel->getSheet(0); 
								$highestRow = $sheet->getHighestRow(); 
								$highestColumn = $sheet->getHighestColumn();
								for ($row = 2; $row <= $highestRow; $row++){ 
								    //  Read a row of data into an array
								    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
								                                            NULL,
								                                            TRUE,
								                                            FALSE);

								    // echo '<pre>';
								    $char = $highestColumn;
								    $num = $this->toNum($char);
								    //var_dump($num);
								    $datax = array();
								    for($v=0;$v<=$num;$v++){
								    	//var_dump($rowData);
								    	$char = $this->getColumnLetter($v);
								    	//var_dump($char);
								    	$label = $allDataInSheet[1][$char];
								    	//var_dump($label);
								    	$datax['project_id'] = $this->session->userdata('project_id');
								    	$datax['uid'] = $this->session->userdata('id');
								    	$datax[$label] = $rowData[0][$v];
								    }

								    $this->db->insert($table,$datax);
								}

				                if(!empty($result)){
				                  $feedback = "Product Imported successfully";
				                  $status['feedback'] = $feedback;
				                }else{
				                  $feedback = "Product will be updated !";
				                  $status['feedback'] = $feedback;
				                }             

				          	} catch (Exception $e) {
				               die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
				                        . '": ' .$e->getMessage());
				            }



				       	} else {
				       		$feedback = $error['error'];
				       		$status['feedback'] = $feedback;
				       	}

					} else {
						$feedback = 'False';
						$status['feedback'] = $feedback;
					}

					$this->session->set_flashdata('feedback',$status);
					redirect("cpanel/list_table");

				}

			}
		}


	}


    function single_data()
    {
    	if($this->session->userdata('role')=='developer'){
	    	$tbl = $this->uri->segment(3);
	    	if(!empty($tbl)){

	    		$check_table = $this->cpanel->check_name_table($tbl);
				//var_dump($table_name);

				if($check_table>0){

		    		$csvData = array();
			    	$fields = $this->db->field_data($tbl);
			    	foreach ($fields as $field)
			    	{
			    		$data = $field->name;
			    		if(($data=='id')||($data=='datetime')||($data=='project_id')||($data=='uid')){

			    		} else {
			    			$csvData[] = $data;
			    		}
			    	}

			    	$csvData = array($csvData);
			    	// echo '<pre>';
			    	// var_dump($csvData); exit();
			    	// echo '</pre>';

			    	header("Pragma: public");
					header("Expires: 0");
					header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
					header("Content-Type: application/force-download");
					header("Content-Type: application/octet-stream");
					header("Content-Type: application/download");
					header("Content-Disposition: attachment;filename=follow_this_template_upload_csv_".$tbl."_".time().".csv");
					header("Content-Transfer-Encoding: binary");
					$df = fopen("php://output", 'w');
					array_walk($csvData, function($row) use ($df) {
					  fputcsv($df, $row);
					});
					fclose($df);

				}

	    	}

	    	
		}
    }



    function download_csv()
    {
    	if($this->session->userdata('role')=='developer'){
	    	$tbl = $this->input->post('tbl');

	    	if(!empty($tbl))
	    	{
	    		$this->load->dbutil();
		        $this->load->helper('file');
		        $this->load->helper('download');
		        $delimiter = ",";
		        $newline = "\r\n";
		        $filename = $tbl."_".rand().".csv";
		        $query = "SELECT * FROM ".$tbl; //USE HERE YOUR QUERY
		        $result = $this->db->query($query);
		        $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
		        force_download($filename, $data);
	    	}
	    }
    	
    }


    function Editor_Graph()
    {
    	if($this->session->userdata('role')=='developer'){
	    	$this->load->view('cpanel/header/header');
			$this->load->view('cpanel/body/editor_graph.php');
			$this->load->view('cpanel/footer/footer');
		}
    }


    function Commit_Graph()
    {
    	if($this->session->userdata('role')=='developer'){
			//var_dump($code);
    		$type = $this->input->post('type');
    		$tbl = $this->input->post('tbl');
			if($type=='2'){
				$path_helper = $_SERVER['DOCUMENT_ROOT'].'/application/views/project/body/Graph_'.$tbl.'/'.$tbl.'.php';
			} else {
				$path_helper = $_SERVER['DOCUMENT_ROOT'].'/application/controllers/Graph_'.$tbl.'.php';
			}

			//$path_helper = $_SERVER['DOCUMENT_ROOT'].'/application/views/project/dashboard_public.php';

			$code = $this->input->post('code');
			$data = $code;
			$f=fopen($path_helper,'w');
			fwrite($f,$data);
			fclose($f);
		} else {
			// redirect('cpanel/login');
		}
    }


    function create_project()
    {
    	$project_name = $this->input->post('project_name');
    	$first_name = $this->input->post('first_name');
    	$email = $this->input->post('email');
    	$password = $this->input->post('password');

    	$project_id = rand();

    	$data_db2 = array(
						'project_name'=>$project_name,
						'first_name'=>$first_name,
						'email'=>$email,
						'password'=>$password,
						'project_id'=>$project_id
					 );
		$this->db->insert('project_login',$data_db2);

		
		$data_db2_role = array(
						'role'=>'Admin',
						'project_id'=>$project_id
					 );
		$this->db->insert('project_role',$data_db2_role);


		redirect('Cpanel');
    }


    function check_developer()
	{
		$where = "
    				SELECT count(*) as Total FROM project_login as a 
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

}


// toole editor 
// https://www.freeformatter.com/html-formatter.html#ad-output
// http://beautifytools.com/php-beautifier.php