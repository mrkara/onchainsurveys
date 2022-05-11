<?php 

	

	/***
	 * 
	 * 
	 * 
	 * 
	 * */


	if(!function_exists('get_question_participate')){
		/**
		 * 
		 * 
		 */
		function get_question_participate($question_id = false)
		{
			 $ci =& get_instance();
			 $where = [
			 	'question_id' => $question_id
			 ];
			 return $ci->db->where($where)->get('answers')->result();
		}
	}


	if(!function_exists('get_questions_answer')){
		/**
		 * 
		 * 
		 */
		function get_questions_answer($question_id = false)
		{
			 $ci =& get_instance();
			 $where = [
			 	'question_id' => $question_id
			 ];
			 return $ci->db->where($where)->get('answers')->result();
		}
	}


	


 ?>