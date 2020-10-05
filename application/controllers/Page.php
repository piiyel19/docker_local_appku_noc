<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

	function index()
	{
		$this->load->view('public/main_page.php');
	}
}