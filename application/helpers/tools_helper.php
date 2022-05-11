<?php 
	
	/**
	 *	pre() - <pre> tagları arasına vs  
	 * 
	 * 
	 * */

	
	if(!function_exists('pre')){
		/**
		 * 
		 * 
		 */
		function pre($par = false)
		{
			echo '<pre>';
			print_r($par);
			echo '<pre>';
		}
	}



	if(!function_exists('success_message')){
		/**
		 * 
		 * 
		 */
		function success_message($text = false)
		{
			 return '<div class="alert alert-success"> <i class="fa fa-check"></i>'.$text.'</div>';
		}
	}


	if(!function_exists('error_message')){
		/**
		 * 
		 * 
		 */
		function error_message($text = false)
		{
			 return '<div class="alert alert-danger"> <i class="fa fa-check"></i>'.$text.'</div>';
		}
	}

 
 


	if(!function_exists('sef_url')){
	/**
	 * 
	 * 
	 */

	function sef_url($string)
	{
		$find = array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı', '+', '#', '&');
		$replace = array('c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', 'plus', 'sharp', 've');
		$string = strtolower(str_replace($find, $replace, $string));
		$string = preg_replace("@[^A-Za-z0-9\-_\.\+]@i", ' ', $string);
		$string = trim(preg_replace('/\s+/', ' ', $string));
		$string = str_replace(' ', '-', $string);
		return $string;
	}

	}

	if(!function_exists('get_user_info')){
	/**
	 * 
	 * 
	 */

		function get_user($user_id)
		{
			 $ci =& get_instance();

			 return $ci->db->where('id',$user_id)->get('users')->row();
		}

	}


	if(!function_exists('is_login')){
	/**
	 *  login ise true döner
	 * 
	 */
		function is_login()
		{
			 $ci =& get_instance();
			 if($ci->session->userdata('login') == id_encode($ci->session->userdata('user_id'))){
			 	return true;
			 }
 		}
	}


	if(!function_exists('login_control')){
	/**
	 * login değilse login sayfasına yönlendirir
	 * 
	 */
		function login_control()
		{
 			 if(!is_login()){
			 	redirect('user/login','refresh');
			}
		}
	}
 

	if(!function_exists('is_superUser')){
	/**
	 *  süper admin ise true döner
	 * 
	 */
		function is_superUser()
		{
 			 $ci =& get_instance();
			 if( $ci->session->userdata('authority') == 2){
			 	return true;
			 }
		}

	}


	if(!function_exists('superUser_control')){
	/**
	 * 
	 *  süper admin değilse logine yönlendirir
	 */
		function superUser_control()
		{
			if(!is_superUser()){
				redirect('user/login','refresh');
			}
		}
	}





	
	if(!function_exists('is_participated')){
	/**
	 *  ankete katılmış ise true döner
	 * 
	 */
		function is_participated($survey_id = false)
		{
			 $ci =& get_instance();

			 $where = [
				'survey_id' => $survey_id,
				'user_id' => $ci->session->userdata('user_id'),
			]; 

			 return $ci->db->where($where)->get('participated')->row();
 
		}

	}


	if(!function_exists('encrypt'))
	{
		/**
		 * 	config/custom_config.php - $config['crypt_key'] 
		 * 
		 * */
		function encrypt($par, $key = false) {
			$ci =& get_instance(); 
			if(!$key){
				$key = $ci->config->app->crypt_key;
			}
 	    	// return openssl_encrypt($par, "AES-128-ECB", $key);
 	    	return @bin2hex(openssl_encrypt($par,'AES-128-CBC', $key));
		}

	}

	


	if(!function_exists('decrypt'))
	{
		/**
		 *  config/custom_config.php - $config['crypt_key']
		 * 
		 * */
 		function decrypt($par, $key = false) {
 			$ci =& get_instance();
			if(!$key){
				$key = $ci->config->app->crypt_key;
			}
	    	//return openssl_decrypt($par, "AES-128-ECB", $key);
	    	return @openssl_decrypt(hex2bin($par),'AES-128-CBC',$key);

		}

	}


	if(!function_exists('id_encode'))
	{
		/**
		 * 
		 * 
		 * */
		function id_encode($id = false){
			return encrypt($id);
		}

	}
	

	if(!function_exists('id_decode'))
	{
		/**
		 * 
		 * 
		 **/
		function id_decode($decrypt_id = false){
			return decrypt($decrypt_id);
		}
	}
	
	

	function helper_test()
	{
		return true;
	}


 ?>