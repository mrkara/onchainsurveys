<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
 	
 		#load models
		$this->load->model('User_model');
		$this->load->library('form_validation');

		// application/config/custom_config.php tanımlı 
		//pre($this->config->app);

	}

	// profil page
	public function index()
	{
		login_control();
		
		$data['item'] = $this->User_model->get([
			'id' => $this->session->userdata('user_id')
		]);


		$data['countries'] = $this->db->get('countries')->result();

		$this->load->view('onchainsurveys/common/header');
		$this->load->view('onchainsurveys/user/profile',$data);
		$this->load->view('onchainsurveys/common/footer');

		// post user/update
	}

	// kullanıcı güncelleme	
	public function update()
	{
		// login_control();
		 

		if($this->input->method() == "post")
		{
			 $result_array = [];

			$this->form_validation->set_rules('user_name','Username','trim|required|min_length[3]|max_length[15]');
       	$this->form_validation->set_rules('email','Email','trim|required|valid_email');


	      # error
        	if($this->form_validation->run() == FALSE ){
	           $result_array = [
	                'error'         		=> true,
	                'user_name_error'	=> form_error('user_name'),
	                'email_error'   		=> form_error('email'),
	                'password_error'   	=> form_error('password'),
	                'confirm_password_error'   	=> form_error('confirm_password'),
 	                'gender_error'   	=> form_error('gender'),
	             ];

             $result_array['message'] = '<div class="text-primary">Please check the form. <i class="fas fa-times"></i> </div>';

	        }else{

	        	# kullanıcı hariç, bu emaili kullanan başka kullanıcı var mı 
		        $email_check = $this->User_model->get([
		        	'email' => $this->input->post('email',true),
		        	'id !=' => $this->session->userdata('user_id'),
		        ]);

		        if($email_check){
		        	$result_array['email_error'] = '<div class="text-primary">This email address is being used. <i class="fas fa-times"></i> </div>';
		        	$result_array['error'] = true;
		        }

		        # kullanıcı hariç, bu user_name i kullanan başka kullanıcı var mı 
		        $user_name_check = $this->User_model->get([
		        	'user_name' => $this->input->post('user_name',true),
		        	'id !=' => $this->session->userdata('user_id'),
		        ]);

		        if($user_name_check){
		        	$result_array['user_name_error'] = '<div class="text-primary">This username is used. <i class="fas fa-times"></i> </div>';
		        	$result_array['error'] = true;
		        }

		        # kullanıcı hariç, bu casper_key i kullanan başka kullanıcı var mı 
		        if($this->input->post('casper_key',true)){
		        		$casper_key_check = $this->User_model->get([
			        	'casper_key' => $this->input->post('casper_key',true),
			        	'id !=' => $this->session->userdata('user_id'),
			        ]);
			        
			        if($casper_key_check){
			        	$result_array['casper_key_error'] = '<div class="text-primary">This casper address is used. <i class="fas fa-times"></i> </div>';
			        	$result_array['error'] = true;
			        }
		        }
		         
 
		        #hata yoksa
		        if(!@$result_array['error']){
		        	 	
		        	$data = [
		        		'name' => strip_tags(trim($this->input->post('name',true))),
		        		'casper_key' => strip_tags(trim($this->input->post('casper_key',true))),
		        		'surname' => strip_tags(trim($this->input->post('surname',true))),
		        		'user_name' => strip_tags(trim($this->input->post('user_name',true))),	
 		        		'email' => strip_tags(trim($this->input->post('email',true))),	
 		        		'country' => strip_tags(trim($this->input->post('country',true))),	
		        		'birth_year' => strip_tags(trim($this->input->post('birth_year',true))),	
		        		'gender' => strip_tags(trim($this->input->post('gender',true))),	
 		         	];

		         	$update = $this->User_model->update([
		         		'id' => $this->session->userdata('user_id')
		         	], $data);


 
		         	if($update){
		         		$result_array['success'] = true;
		 					$result_array['message'] = '<div class="text-success">Profile Updated <i class="fas fa-check"></i> </div>';
		         	}else{
		         		$result_array['error'] = true;
		 					$result_array['message'] = '<div class="text-primary"> An error occurred while updating the profile. <i class="fas fa-times"></i> </div>';
		         	}


		        }else{
		        	$result_array['message'] = '<div class="text-primary"> Please check the form <i class="fas fa-times"></i> </div>';
	 	        }

	        }

         	echo json_encode($result_array);
 
		} 

	}

	// login view
	public function login()
	{
		$this->load->view('onchainsurveys/common/header');
		$this->load->view('onchainsurveys/user/login');
		$this->load->view('onchainsurveys/common/footer');

		// post user/login_in 
	}

	// login yap 
	public function login_in()
	{
		#formdan post edilmiş ise
		if($this->input->method() == "post"){

			$this->form_validation->set_rules('user_name','Username','trim|required');
         $this->form_validation->set_rules('password','Password','trim|required');

        	 # hata varsa
	        if($this->form_validation->run() == FALSE ){
	           $result_array = [
	                'error'         			=> true,
	                'user_name_error'		=> form_error('user_name'),
 	                'password_error'   		=> form_error('password'),
 	             ];
	             
	             $result_array['message'] = '<div class="text-primary">Please check the form. <i class="fas fa-times"></i> </div>';

	        }else{

	        	// $query = $this->User_model->get([
	        	// 	'user_name' =>		strip_tags(trim($this->input->post('user_name',true))),
	        	// 	'password' 	=> 	strip_tags(trim(sha1(md5($this->input->post('password',true)))))
	        	// ]);

	        		$query = $this->User_model->login(
	        			$this->input->post('user_name',true),
	        			$this->input->post('password',true)
	        		);



	        		# login start 
		        	if($query){

		        		$this->session->set_userdata([
		        			//'login' 		=> true,
		        			'login' 		=> id_encode($query->id),
		        			'user_id' 	=>	$query->id,
		        			'user_name' =>	$query->user_name,
		        			'email' 		=>	$query->email,
		        			'authority' =>	$query->authority
		        		]);

		        		$result_array['success'] = true;
		        		$result_array['message'] = '<div class="text-success"> Success <i class="fas fa-check"></i> </div>';

		        	}else{
		        		  $result_array['error'] = true;
		        		  $result_array['message'] = '<div class="text-primary">Incorrect password or username. <i class="fas fa-times"></i> </div>';
		        	}

	        }

 			echo json_encode($result_array);

		}
		
	}


	// kayıt formu
	public function register()
	{
		$data['countries'] = $this->db->get('countries')->result();

		$this->load->view('onchainsurveys/common/header');
		$this->load->view('onchainsurveys/user/register',$data);
		$this->load->view('onchainsurveys/common/footer');

		// post user/create
	}

	// kullanıcı kayıt
	public function create()
	{

		$this->form_validation->set_rules('user_name','Username','trim|required|min_length[3]|max_length[100]|is_unique[users.user_name]');
        $this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password','Password','trim|required|min_length[8]');
        $this->form_validation->set_rules('confirm_password','Password Confirmation','trim|required|matches[password]');
 
          
        $this->form_validation->set_message('is_unique', "This {field} is used. ");
 

        # hata varsa
        if($this->form_validation->run() == FALSE ){
           $result_array = [
                'error'         			=> true,
                'user_name_error'		=> form_error('user_name'),
                'email_error'   			=> form_error('email'),
                'password_error'   		=> form_error('password'),
                'confirm_password_error'   	=> form_error('confirm_password'),
                'education_error'   	=> form_error('education'),
                'country_error'   		=> form_error('country'),
                'birth_year_error'   	=> form_error('birth_year'),
              ];

             $result_array['message'] = '<div class="text-primary">Please check the form. </div>';

        }else{

        	# form bilgilerini al
        	$formData = $this->input->post();


        	$data = [
        		'name' => strip_tags(trim($this->input->post('name',true))),
        		'surname' => strip_tags(trim($this->input->post('surname',true))),
        		'user_name' => strip_tags(trim($this->input->post('user_name',true))),	
        		'password' => sha1(md5(strip_tags(trim($this->input->post('password',true))))),	
        		'email' => strip_tags(trim($this->input->post('email',true))),	
        		'education' => strip_tags(trim($this->input->post('education',true))),	
        		'country' => strip_tags(trim($this->input->post('country',true))),	
        		'birth_year' => strip_tags(trim($this->input->post('birth_year',true))),	
        		'gender' => strip_tags(trim($this->input->post('gender',true))),	
        		'casper_key' => strip_tags(trim($this->input->post('casper_key',true))),	
         	'authority' => 1,
        		'is_active' => 1,
        		'create_date' => date('Y-m-d H:i:s'),
        		'rank' => 1,
        	];


        	if($this->User_model->create($data)){
  				$result_array['success'] = true;
 				$result_array['message'] = '<div class ="alert-success"> Saved Record. You are redirected...</div>';
        	}else{
        		$result_array['error'] = true;
 				$result_array['message'] = '<div class="text-primary">Error occurred while recording.</div>';
         	}
        	  
        }

       echo json_encode($result_array);
 
 
 
	}

	 
 

	// şifremi unuttum
	public function forgotPassword()
	{
		$this->load->view('onchainsurveys/common/header');
		$this->load->view('onchainsurveys/user/forgotpassword');
		$this->load->view('onchainsurveys/common/footer');

		// post user/recoverPassword
	}

	// şifre unuttum post 
	public function recoverPassword()
	{

		if($this->input->method() == "post"){

			$this->form_validation->set_rules('email','Email','trim|required|valid_email');

			# hata varsa
	        if($this->form_validation->run() == FALSE ){
	           $result_array = [
	                'error'  			=> true,
	                'email_error'		=> form_error('email'),
  	             ];
	             
	             $result_array['message'] = '<div class="text-primary">Please check the form.</div>';

	        }else{

	        		$email = strip_tags(trim($this->input->post('email',true)));

	        		$query = $this->User_model->get([
	        			'email' =>		$email,
 	        		]);

	        		# eğer email sistemde kayıt işe kullanıcıya kurtarma linki gönder
 	        		if($query){

	        		// $this->session->set_userdata([
	        		// 	'login' 	=> true,
	        		// 	'user_id' 	=>	$query->id,
	        		// 	'user_name' =>	$query->user_name,
	        		// 	'email' 	=>	$query->email,
	        		// 	'authority' =>	$query->authority
	        		// ]);

 	        			

	        		$result_array['success'] = true;
	        		$result_array['email_send'] = recoverEmailSend($email);

	        		if($result_array['email_send']){
	        			$result_array['email_success'] = true;
	        			$result_array['message'] = 'Email adresinize şifre yenileme bağlantısı gönderildi.';
	        		}else{
	        			$result_array['message'] = '<div class="text-primary"> An error occurred while sending a password reset link to your email address.</div>';
	        		}

	        	}else{
	        		  $result_array['error'] = true;
	        		  $result_array['message'] = '<div class="text-primary">This email address is not registered in the system.</div>';
	        	}


	        }


			$formData = $this->input->post();

			// pre($formData);

			echo json_encode($result_array);

		}
	}

	// şifremi unuttum post
	public function resetPassword() 
	{
		
		if($this->input->method() == "post")
		{

			$this->form_validation->set_rules('password','Password','trim|required|min_length[8]');
	        $this->form_validation->set_rules('confirm_password','Password Confirmation','trim|required|matches[password]');

	        # hata varsa
	        if($this->form_validation->run() == FALSE ){
	           $result_array = [
	                'error'         		=> true,
 	                'password_error'   		=> form_error('password'),
	                'confirm_password_error'   	=> form_error('confirm_password'),
 	             ];

	             $result_array['message'] = 'Lütfen formu kontrol ediniz';

	        }else{

        	# form bilgilerini al
        	// $formData = $this->input->post();


        	$data = [
         		'password' => sha1(md5(strip_tags(trim($this->input->post('password',true))))),	
         		//'update_date' => date('Y-m-d H:i:s'),
         	];

         	$update = $this->User_model->update([
         		'id' => $this->session->userdata('user_id')
         	], $data);


         	if($update){
         		$result_array['success'] = true;
 				$result_array['message'] = 'Password Updated';
         	}else{
         		$result_array['error'] = true;
 				$result_array['message'] = 'An error occurred while updating the password.';
         	}
 
        }

       	echo json_encode($result_array);



		}
	}


	// logout
	public function logout()
	{
		$this->session->sess_destroy();

		redirect(base_url(),'refresh');

	}


	// user list
	public function userList()
	{
		superUser_control();

		$data['list'] = $this->User_model->getAll([],'id DESC');

		 //pre($data);

		$this->load->view('onchainsurveys/common/header');
		$this->load->view('onchainsurveys/user/userlist',$data);
		$this->load->view('onchainsurveys/common/footer');

 
	}
	  

	
	public function edit($user_id = false)
	{
		superUser_control();

		$user_id = id_decode($user_id);

		$data['item'] = $this->User_model->get([
			'id' => $user_id
		]);

		//pre($data);

		$this->load->view('onchainsurveys/common/header');
		$this->load->view('onchainsurveys/user/edit',$data);
		$this->load->view('onchainsurveys/common/footer');

	}


	public function detail($user_id = false)
	{
		superUser_control();

		$user_id = id_decode($user_id);

		$data['item'] = $this->User_model->get([
			'id' => $user_id
		]);

		//pre($data);

		$this->load->view('onchainsurveys/common/header');
		$this->load->view('onchainsurveys/user/detail',$data);
		$this->load->view('onchainsurveys/common/footer');

	}



}