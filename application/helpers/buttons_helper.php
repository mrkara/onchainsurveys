<?php 
	
	/**
	 * 
	 * Here are the functions used for the buttons that vary according to the survey status
	 * 
	 * */


	if(!function_exists('survey_continue_btn')){
		/**
		 * button in case of ongoing survey
		 * 
		 * */
		function survey_continue_btn()
		{
			//echo '<span class="badge badge-danger badge-sm"> <i class="fas fa-hourglass-half"></i> Open  </span>';
			echo '<span class="btn btn-outline-primary btn-sm"> <i class="fas fa-hourglass-half"></i> Open  </span>';
			
		}

	}


	if(!function_exists('survey_end_btn')){
		/**
		 *  button in case of completed survey
		 * 
		 * */
		function survey_end_btn()
		{
			//echo '<span class="badge badge-success badge-sm"><i class="fas fa-check-circle"></i> Completed</span>';
			echo '<span class="btn btn-outline-secondary btn-sm"><i class="fas fa-check-circle"></i> Completed</span>';
		}

	}

	if(!function_exists('is_active_icon')){
		/**
		 * 
		 * Show the fa-check-circle icon when the survey is active 
		 * Show the fa-times-circle icon when the survey is not active
		 * 
		 * @param boolean $is_active Activity status of the survey
		 * 
		 * */
		function is_active_icon($is_active = false)
		{
			if($is_active){
				echo '<i class="fas fa-check-circle"></i>';
			}else{
				echo '<i class="fas fa-times-circle"></i>';
			}
 		}
	}


	if(!function_exists('is_approval_icon')){
		/**
		 * Show the fa-check-circle icon when the survey is approval 
		 * Show the fa-info-circle icon when the survey is waiting for approval
		 * Show the fa-times-circle icon when the survey is not approval
		 * 
		 * @param boolean $is_approval Approval status of the survey
		 * 
		 * */
		function is_approval_icon($is_approval = false)
		{
			if($is_approval == 1){
				echo '<i class="fas fa-check-circle fa-lg" title="Onaylı"></i>';
			}else if($is_approval == 0 OR $is_approval == NULL){
				echo '<i class="fas fa-info-circle fa-lg" title="Onay Bekliyor"></i>';
			}else if($is_approval == 2 ){
				echo '<i class="fas fa-times-circle fa-lg" title="Red"></i>';
			}
 		}
	}

	


	if(!function_exists('loading_image_html')){
		/**
		 *  Shows loading effect after form post
		 * 
		 * */
		function loading_image_html()
		{
			 echo '<div  class="d-flex justify-content-center" >
					  <div id="load_image" class="spinner-border text-primary" role="status" style="display: none;">
					    <span class="visually-hidden">Loading...</span>
					  </div>
					</div>'; 
 		}

	}


	if(!function_exists('go_back')){
		/**
		 *   go_back
		 * 
		 * */
		function go_back($url = false)
		{
			if(!$url){
				$url  = 'javascript:window.history.back();';
			}
 
			 echo '<a href="'.$url.'">
				<button type="button" class="btn btn-outline-secondary btn-lg" id="" ><i class="fas fa-arrow-left"></i> Go Back</button></a>'; 
 		}

	}

	



 ?>