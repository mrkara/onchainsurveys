<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		echo '<!--';
		pre($this->session->userdata());
		echo '-->';

		$this->load->view('onchainsurveys/common/header');
		$this->load->view('onchainsurveys/home/home');
		$this->load->view('onchainsurveys/common/footer');
	}

}

 