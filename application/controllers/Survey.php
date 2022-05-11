<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Survey extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		//Load Dependencies

		#login ve yetki kontrol
		login_control();

		$this->load->model('Survey_model');

		$this->load->library('form_validation');
	}

	// all survey
	public function index()
	{
		$this->all();
	}

	// all survey
	public function all($user_id = false)
	{
  
 		if($user_id){

 			$user_id = id_decode($user_id);
 			
 			$user_info = $this->db->where('id',$user_id)->get('users')->row();

 			$where = [
 				'is_approved' => 1,
 				'user_id' => $user_id
 			];

 			$data['title'] = 'All Surveys | '. @$user_info->user_name;

 		}else{
 			$where = [
 				'is_approved' => 1
 			];

 			$data['title'] = 'All Surveys';
 		}

 		$data['list'] = $this->Survey_model->getAll($where,'survey_id DESC');

		
		 
 		$this->load->view('onchainsurveys/common/header');
		$this->load->view('onchainsurveys/survey/surveys_list',$data);
		$this->load->view('onchainsurveys/common/footer');
	}


	// open survey
	public function open()
	{
 		# current time
		$now = date('Y-m-d H:i:s');
		
 		$data['list'] = $this->Survey_model->getAll([
 			'is_approved' => 1,
 			'end_date >=' => $now
		],'survey_id DESC');
		
		$data['title'] = 'Open Surveys';

 		$this->load->view('onchainsurveys/common/header');
		$this->load->view('onchainsurveys/survey/surveys_list',$data);
		$this->load->view('onchainsurveys/common/footer');
	}


	// create survey form
	public function create()
	{
		$this->load->view('onchainsurveys/common/header');
		$this->load->view('onchainsurveys/survey/create_survey');
		$this->load->view('onchainsurveys/common/footer');
	}

	// survey save
	public function save()
	{
 	
		sleep(1);
 
		if($this->input->method() == "post")
		{
			#form data
			$formData = $this->input->post();

			# question 
			$questionData = array();

			# array create for options array key
			$alphas = range('A', 'Z');
 
			# result parameters
			$result_array = [];
 			
			# data control 
 			if($formData['form']['start_date'] >= $formData['form']['end_date']) {
 				$result_array['error'] = true;
 				$result_array['message'] = '<div class="text-primary">  Please check the dates. The start date cannot be greater than the end date. <i class="fas fa-times"></i> </div>';
 				$result_array['date_error'] = '<p> Please check the dates </p>';

 				echo json_encode($result_array);
 				exit;
 			} 

			$data = [
				'title' 		=> strip_tags(trim($formData['form']['title'])),
				'start_date' 	=> strip_tags(trim($formData['form']['start_date'])),
				'end_date' 		=> strip_tags(trim($formData['form']['end_date'])),
				'user_id' 		=> $this->session->userdata('user_id'), 	
				'create_date' 	=> date('Y-m-d h:i:s'),
				'is_approved'	=> 0
			];


			if($this->db->insert('surveys', $data)){

				# get last id
	 			$insert_id = $this->db->insert_id();

	 			#remove formdata['form'] 
	 			unset($formData['form']);

	 			foreach ($formData as $key => $value) {
	 				$options = json_encode($value['options']);
	 
	 				$options_alpha = [];
	 				foreach ($value['options'] as $key_sub => $value_sub) {
	  					$alphas_key = $alphas[$key_sub];
	 					$options_alpha[$alphas_key] = $value_sub;
	 				}
	 				$options_alpha_json = json_encode($options_alpha);
					   
					 $questionData[] = array(
					 	'survey_id' => $insert_id,
					 	'text'		=> strip_tags(trim($value['text'])),
	 				 	'options' 	=> $options_alpha_json, 
					 );
				}


				if($this->db->insert_batch('questions', $questionData)){
	 				$result_array['success'] = true;
	 				$result_array['message'] = '<div class="text-success"> The survey has been created. <i class="fas fa-check"></i> <br>Added questions. You are being redirected. </div>';
				}else{
					$result_array['error'] = true;
	 				$result_array['message'] = '<div class="text-primary"> An error occurred while adding questions. <i class="fas fa-times"></i> </div>';
				}

				   
			}else{
				$result_array['error'] = true;
	 			$result_array['message'] = '<div class="text-primary"> An error occurred while creating the survey. <i class="fas fa-times"></i> </div>';
			}

 
			echo json_encode($result_array);
 

		}
 		
		 

 	}
 
 


	//  my surveys
	public function my_surveys()
	{
 
		$data['list'] = $this->Survey_model->getAll([
			'user_id' => $this->session->userdata('user_id')
		]);
 		
 		$data['title'] = 'My Surveys';

		$this->load->view('onchainsurveys/common/header');
		$this->load->view('onchainsurveys/survey/surveys_list',$data); // my_survey
		$this->load->view('onchainsurveys/common/footer');
	}



	public function detail($survey_id = false)
	{
		# id decode - tools_helper
  		$survey_id = id_decode($survey_id);

		$data['item'] = $this->Survey_model->get([
			'survey_id' => $survey_id
		]);
 
		# control
		if(!$data['item']){
			// error page
 			redirect(base_url('survey/error_page'),'refresh');
 			exit;
   		}

   		# approved control 
   		// onaylanmayan anketin başka kullanıcı tarafından link ile erişimini engelle
   		if($data['item']->is_approved == 0 AND $this->session->userdata('user_id') != $data['item']->user_id){
   			redirect(base_url('survey/error_page'),'refresh');
   			exit;
   		}
 

		$participated_where = [
			'survey_id' => $survey_id,
			'user_id' => $this->session->userdata('user_id'),
		]; 
		$participated =  $this->db->where($participated_where)->get('participated')->row();
 
 	  	$data['all_answers'] = $this->Survey_model->getAllAnswers([
		  	 'survey_id' => $survey_id,
    	]);

 	  	#kullanıcı ankete oy vermiş mi
 		if($participated){
 			$data['$participated'] = true;
  			$data['list'] = $this->db
				->join('answers a','a.question_id=q.question_id')
				->where('a.survey_id',$survey_id)
				->where('a.user_id',$this->session->userdata('user_id'))
 				->get('questions q')
				->result();
 		}else{
 			$data['$participated'] = false;
  			$data['list'] = $this->Survey_model->getAllQuestions([
				'survey_id' => $survey_id
			]);
 		}
    
		$this->load->view('onchainsurveys/common/header');

		# current time
		$now = date('Y-m-d H:i:s');
		
 		if($data['item']->end_date > $now){
			#the survey continues

 			#Has the user voted in the poll?
 			 if($participated){
 			 	$this->load->view('onchainsurveys/survey/detail',$data);
 			 }else{
 			 	$this->load->view('onchainsurveys/survey/survey_vote',$data);
 			 }
 
		}else{
			#survey completed
			$this->load->view('onchainsurveys/survey/detail',$data);
		}
 
		$this->load->view('onchainsurveys/common/footer');


	}

	// vote 
	public function survey_vote($survey_id = false)
	{
  		sleep(1);

   		$survey_id = id_decode($survey_id);

   		# current time
		$now = date('Y-m-d H:i:s');
 

		if($this->input->method() == "post"){
			$formData = $this->input->post();
 
			if(!$survey_id){
				$result_array['error'] = true;
	 			$result_array['message'] = '<div class="text-primary"> Anket cevaplanırken hata oluştu. <i class="fas fa-times"></i> </div>';
	 			echo json_encode($result_array);
	 			exit;
			}

			if(count($formData) < 1){
				$result_array['error'] = true;
 	 			$result_array['message'] = '<div class="text-primary"> You have not made any selection, the form has not been registered. <i class="fas fa-times"></i> </div>';
 	 			echo json_encode($result_array);
 	 			exit;
			}


			$survey_info = $this->Survey_model->get([
				'survey_id' => $survey_id
			]);


			# date control 
			if($survey_info->end_date <= $now){
				$result_array['error'] = true;
				$result_array['message'] = '<div class="text-primary"> The survey has expired. <i class="fas fa-times"></i> </div>';
 				echo json_encode($result_array);
 	 			exit;
			}


			# approved control 
			if($survey_info->is_approved != 1){
				$result_array['error'] = true;
				$result_array['message'] = '<div class="text-primary"> The survey is not approved. <i class="fas fa-times"></i> </div>';
 				echo json_encode($result_array);
 	 			exit;
			}
  
			$data = [
				'survey_id' => $survey_id,
				'user_id' => $this->session->userdata('user_id'),
				'create_date' => date('Y-m-d H:i:s'),
			];

			if($this->db->insert('participated', $data)){

				# get last id
 				$insert_id = $this->db->insert_id();

 				foreach ($formData as $key => $value) {
 
					 $answersData[] = array(
					 	'survey_id' => $survey_id,
					 	'participated_id' => $insert_id,
					 	'question_id' => $key,
					 	'answer'	=> 	$value,
					 	'user_id' 	=> $this->session->userdata('user_id'), 
					 	'create_date' 	=> date('Y-m-d H:i:s'), 
					 );
				}


				if($this->db->insert_batch('answers', $answersData)){
 					$result_array['success'] = true;
	 				$result_array['message'] = '<div class="text-success"> The survey has been answered.<br> You are being redirected... <i class="fas fa-check"></i> </div>';
				}else  {
					$result_array['error'] = true;
	 				$result_array['message'] = '<div class="text-primary"> An error occurred while answering the survey questions. <i class="fas fa-times"></i> </div>';
				}


			}else{
				$result_array['error'] = true;
	 			$result_array['message'] = '<div class="text-primary"> An error occurred while answering the survey. <i class="fas fa-times"></i> </div>';
			}
			
  
			  echo json_encode($result_array);

		}
  
	}


	function error_page()
	{
		$this->load->view('onchainsurveys/common/header');
		$this->load->view('onchainsurveys/survey/error_page');
		$this->load->view('onchainsurveys/common/footer');
	}


	 
 
	// list of pending surveys.
	public function approve($survey_id = false)
	{
		superUser_control();

		$data['list'] = $this->Survey_model->getAll([
 			'is_approved' => 0
		],'survey_id DESC');

		$data['title'] = 'Surveys Pending Approval';
		 
 		$this->load->view('onchainsurveys/common/header');
		$this->load->view('onchainsurveys/survey/surveys_list',$data);
		$this->load->view('onchainsurveys/common/footer');

	}



	// survey confirmation form
	public function survey_edit($survey_id = false)
	{
		superUser_control();

		# id decode - tools_helper
  		$survey_id = id_decode($survey_id);

		$data['item'] = $this->Survey_model->get([
			'survey_id' => $survey_id
		]);

		if(!$data['item']){
  			redirect(base_url('survey/error_page'),'refresh');
 			exit;
   		}

   		$data['list'] = $this->Survey_model->getAllQuestions([
			'survey_id' => $survey_id
		]);

   		$this->load->view('onchainsurveys/common/header');
		$this->load->view('onchainsurveys/survey/survey_edit',$data);
		$this->load->view('onchainsurveys/common/footer');


	}


	// approve survey - publish
	function approve_update($survey_id = false)
	{
		superUser_control();

		if($this->input->method() == "post"){

			#form data
			$formData = $this->input->post();

			 if(!$survey_id){
				$result_array['error'] = true;
	 			$result_array['message'] = '<div class="text-primary"> An error occurred while answering the survey. <i class="fas fa-times"></i> </div>';
	 			echo json_encode($result_array);
	 			exit;
			}

 			if($formData['is_approved'] == ""){
 				$result_array['error'] = true;
 	 			$result_array['message'] = '<div class="text-primary"> Please choose. <i class="fas fa-times"></i> </div>';
 	 			$result_array['is_approve_error'] = '<div class="text-primary"> Please choose. </div>';
 	 			
 	 			echo json_encode($result_array);
 	 			exit;
 			}


 			$data = [
 				'is_approved' => $formData['is_approved'],
  				'update_date' => date('Y-m-d H:i:s'),
 				'approved_admin' => $this->session->userdata('user_id'),
 			];

 			$update = $this->Survey_model->update([
         		'survey_id' => $survey_id
         	], $data);

         	if($update){
         		$result_array['message'] = '<div class="text-success"> The survey has been updated. <i class="fas fa-check"></i> </div>';
 				$result_array['success'] = true;
         	}else{
         		$result_array['error'] = true;
         		$result_array['message'] = '<div class="text-primary"> An error occurred while updating. <i class="fas fa-times"></i> </div>';
         	}
 
 			echo json_encode($result_array);


		}



	}

 

	// list of rejected surveys 
	public function rejected($survey_id = false)
	{
		superUser_control();

		$data['list'] = $this->Survey_model->getAll([
 			'is_approved' => 2
		],'survey_id DESC');

		$data['title'] = 'Rejected Surveys';
		 
 		$this->load->view('onchainsurveys/common/header');
		$this->load->view('onchainsurveys/survey/surveys_list',$data);
		$this->load->view('onchainsurveys/common/footer');

	}



	public function delete($survey_id = false)
	{

	}

	
	// history - participated survey 
	public function history()
	{
		 
		$this->db->select('*,s.user_id as create_user_id',false);  
		$this->db->from('surveys as s');
		$this->db->join('participated as p', 's.survey_id = p.survey_id');
		$this->db->where('p.user_id', $this->session->userdata('user_id'));
 		$this->db->order_by('s.survey_id DESC');
		$data['list'] = $this->db->get()->result();
 		
 		$data['title'] = 'Surveys History';
 		 
 		$this->load->view('onchainsurveys/common/header');
		$this->load->view('onchainsurveys/survey/history',$data);
		$this->load->view('onchainsurveys/common/footer');
	}





}
