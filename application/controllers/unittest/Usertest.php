<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usertest extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
		$this->load->library('unit_test');

		$this->load->model('User_model');
 
	}


	public function login()
	{
		$list = $this->User_model->getAll();

		$data = $this->User_model->login('john97','11111111');
		if($data->user_name == 'john97'){
			$result = true;
		}
 
		$expected_result = true;

		$test_name = "Login Process";

		$this->unit->use_strict(TRUE);

		echo $this->unit->run($result, $expected_result, $test_name);


	}



}
 