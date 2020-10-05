<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {


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
		if($this->session->userdata('logged_in')){
			//$this->load->view('project/header/header');
			$this->load->view('project/dashboard_public.php');
			//$this->load->view('project/footer/footer');
		} else {
			redirect('login/logout');
		}
	}


	// function dashboard_test()
	// {
	// 	if($this->session->userdata('logged_in')){
	// 		//$this->load->view('project/header/header');
	// 		$this->load->view('project/dashboard_public.php');
	// 		//$this->load->view('project/footer/footer');
	// 	} else {
	// 		redirect('login/logout');
	// 	}
	// }
}