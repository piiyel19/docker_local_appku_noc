 <?php

  function create_new_page($class_name, $controller_name){


  $model = $class_name.'_model';

  // Create Controller
  $controller = fopen(APPPATH.'controllers/'.$controller_name.'.php', "a")
  or die("Unable to open file!");

  $controller_content ="<?php defined('BASEPATH') OR exit('No direct script access allowed');

class $controller_name extends CI_Controller  {

    public function __construct()
    {

      parent::__construct();
      \$this->load->database();
      \$this->load->library('session');
      \$this->load->model('$model','$model');
      \$this->load->helper('Lookup_helper');
    }

 }";
  fwrite($controller, "\n". $controller_content);
  fclose($controller);

  // Create Model
  $model = fopen(APPPATH.'models/'.$class_name.'_model'.'.php', "a") 
  or die("Unable to open file!");

   $model_content ="<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ".$class_name."_model"." extends CI_Model
{
    function __construct()
    {
      // Call the Model constructor
      parent::__construct();
    }

}
  ";
  fwrite($model, "\n". $model_content);
  fclose($model);

   }