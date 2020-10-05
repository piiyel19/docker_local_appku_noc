<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


    /* ENGINE BUILDER */
    function get_html_code_by_id($id_form)
    {
        $CI =& get_instance();
        $CI->load->helper('url');
        //$id = $CI->uri->segment('3');
        $CI->load->model('Dbase_lookup','lookup');
        $item = $CI->lookup->html_field($id_form);

        return $item;
    }



    function get_role()
    {
        $CI =& get_instance();
        $CI->load->helper('url');
        //$id = $CI->uri->segment('3');
        $CI->load->model('Dbase_lookup','lookup');
        $item = $CI->lookup->get_role();

        return $item;
    }



    function lookup_table()
    {
        $CI =& get_instance();
        $CI->load->helper('url');
        //$id = $CI->uri->segment('3');
        $CI->load->model('Dbase_lookup','lookup');
        $item = $CI->lookup->lookup_table();

        return $item;
    }
	
	
   
    function lookup_helper_name()
    {
    	$CI =& get_instance();
        $CI->load->helper('url');
        //$id = $CI->uri->segment('3');
        $CI->load->model('Dbase_lookup','lookup');
        $item = $CI->lookup->lookup_helper_name();

        return $item;
    }



    function lookup_module()
    {
    	$CI =& get_instance();
        $CI->load->helper('url');
        //$id = $CI->uri->segment('3');
        $CI->load->model('Dbase_lookup','lookup');
        $item = $CI->lookup->lookup_module();

        return $item;
    }
	
		
	function project_name()
	{
		$CI =& get_instance();
        $CI->load->helper('url');
        //$id = $CI->uri->segment('3');
        $CI->load->model('Dbase_lookup','lookup');
        $item = $CI->lookup->project_name();

        return $item;
	}




	function lookup_module_sub_module()
	{
		$CI =& get_instance();
        $CI->load->helper('url');
        //$id = $CI->uri->segment('3');
        $CI->load->model('Dbase_lookup','lookup');
        $item = $CI->lookup->lookup_module_sub_module();

        return $item;
	}


	function lookup_find_module()
	{
		$CI =& get_instance();
        $CI->load->helper('url');
        //$id = $CI->uri->segment('3');
        $CI->load->model('Dbase_lookup','lookup');
        $item = $CI->lookup->lookup_find_module();

        return $item;
	}
    

	function filename_page($id_view)
	{
		$CI =& get_instance();
        $CI->load->helper('url');
        //$id = $CI->uri->segment('3');
        $CI->load->model('Dbase_lookup','lookup');
        $item = $CI->lookup->filename_page($id_view);

        return $item;
	}
			


	function show_all_field($table_name)
	{
		$CI =& get_instance();
        $CI->load->helper('url');
        //$id = $CI->uri->segment('3');
        $CI->load->model('Dbase_lookup','lookup');
        $item = $CI->lookup->show_all_field($table_name);

        return $item;
	}


	function list_developer()
	{
		$CI =& get_instance();
        $CI->load->helper('url');
        //$id = $CI->uri->segment('3');
        $CI->load->model('Dbase_lookup','lookup');
        $item = $CI->lookup->list_developer();

        return $item;
	}
	


	function check_name_controller($filename)
	{
		$CI =& get_instance();
        $CI->load->helper('url');
        //$id = $CI->uri->segment('3');
        $CI->load->model('Dbase_lookup','lookup');
        $item = $CI->lookup->check_name_controller($filename);

        return $item;
	}

    function map_view($id)
    {
        $CI =& get_instance();
        $CI->load->helper('url');
        //$id = $CI->uri->segment('3');
        $CI->load->model('Dbase_lookup','lookup');
        $item = $CI->lookup->map_view($id);

        return $item;
    }







	
