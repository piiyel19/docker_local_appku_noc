
<?php defined('BASEPATH') OR exit('No direct script access allowed');

		class Register extends CI_Controller  {

		    public function __construct()
		    {

		      parent::__construct();
		      $this->load->database();
		      $this->load->library('session');
		      $this->load->helper('Lookup_helper');
		    }

		    function index()
			{
				$this->load->view('project/register.php');
			}

			function register_user()
			{
				
									$this->load->helper('file');  
							        $config['upload_path']          = './source/avatar';
							        $config['allowed_types']        = 'gif|jpg|png|jpeg|tif';
							        $config['max_size']             = 0;
							        $config['max_width']            = 0;
							        $config['max_height']           = 0;
							        $config['encrypt_name'] = TRUE;
							        $config['remove_spaces'] = TRUE;

							        $this->load->library('upload', $config);
							        $this->upload->initialize($config);

							        if ( ! $this->upload->do_upload('avatar'))
							        {
							            $error = array('error' => $this->upload->display_errors());
							            //var_dump($error); exit();
							            $this->session->set_flashdata('error', 'Ralat ! Sila semak format gambar yang anda muat naik. Pastikan format gambar .gif, .jpg, .png, .jpeg, .tif dan pastikan saiz gambar tidak melebihi 500 mb.');
							            //echo 'Error'; exit();
							            $image = '';
							        }
							        else
							        {
							            $data = array('upload_data' => $this->upload->data());
							            $new_name = $this->upload->data('file_name');
							            $image = base_url().'source/avatar/'.$new_name;

							        }
								;

				
								 $first_name= $this->input->post('first_name');
						       
								 $avatar= $this->input->post('avatar');
						       
								 $email= $this->input->post('email');
					       
								 $password= $this->input->post('password');
					       
								 $project_id= '994985805';
					       
								 $random_id= rand();
					       
								 $role= $this->input->post('role');
					       

				$data = array(
									'first_name' => $first_name,
								  
									'avatar' => $image,
								  
								'email' => $email,
							  
								'password' => $password,
							  
								'project_id' => $project_id,
							  
								'random_id' => $random_id,
							  
								'role' => $role,
							  );

				$this->db->insert('project_user',$data);

				redirect('login');
			}

		 }