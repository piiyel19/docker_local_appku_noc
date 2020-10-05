
	
						<?php defined('BASEPATH') OR exit('No direct script access allowed');

						class Login extends CI_Controller  {

						    public function __construct()
						    {

						      parent::__construct();
						      $this->load->database();
						      $this->load->library('session');
						      $this->load->helper('Lookup_helper');
						    }


						    function index()
						    {
						    	$this->session->sess_destroy();
						    	$this->load->view('project/login');
						    }


							function access(){
								$email = $this->input->post('email');
								$password = $this->input->post('password');
								$check = $this->check_user_access($email,$password);

								if($check==0){
									redirect('login');
								} else {
									$this->create_session_user($email);
									$role = $this->session->userdata('role');
									if(($role=='Admin')||($role=='developer')){
										redirect('dashboard');
									} else {
										redirect('map');
									}
									

								}
							}


							function check_user_access($email,$password)
							{
								$where = '
						    				SELECT count(*) as Total FROM project_user as a 
						    				Where a.email="'.$email.'" AND a.password="'.$password.'"
						    			 ';
						    	$query = $this->db->query($where);
						        if ($query->num_rows() >0){ 
						            foreach ($query->result() as $data) {
						                return $data->Total;
						            }
						        } else {
						        	return '0';
						        }
							}


							function create_session_user($email)
							{
								$where = '
						    				SELECT project_id, id,role,avatar  FROM project_user as a 
						    				where a.email="'.$email.'"
						    			 ';
						    	$query = $this->db->query($where);
						        if ($query->num_rows() >0){ 
						            foreach ($query->result() as $data) {
						                $project_id = $data->project_id;
						                $id = $data->id;
						                $role = $data->role;
						                $avatar = $data->avatar;

										$data = array(
														'role'=>$role,
														'project_id'=>$project_id,
														'avatar'=>$avatar,
														'id'=>$id,
														'logged_in'=>TRUE
													);


										$this->session->set_userdata($data);

										return true;
						            }
						        } else {
						        	return false;
						        }
							}


							function logout()
							{
								$this->session->sess_destroy();
								redirect('login');
							}
						}
					