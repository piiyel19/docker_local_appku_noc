
<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class map extends CI_Controller  {

	    public function __construct()
	    {

	      parent::__construct();
	      $this->load->database();
	      $this->load->library('session');
	      $this->load->helper('Lookup_helper');
	    }

	    function index()
	    {
	    	$this->load->view('public/page/map');
	    }

	    function view()
	    {
	    	$this->load->view('public/page/view');
	    }
	}