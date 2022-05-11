<?php 

	
	/**
	 * 
	 * 	- Function List
	 * 
	 * 	recoverEmailSend 
	 * 	
	 * 
	 * 
	 * 
	 * */



	if(!function_exists('recoverEmailSend')){
		/**
		 * 
		 * 
		 */
		function recoverEmailSend($email = false)
		{
			$ci =& get_instance();

			//pre($ci->app);
			/* 
 			$key = sha1(md5(rand(1,1000)));
 			$domain = $ci->app->email->smtp_host;
 			$recoverUrl = $domain.'user/rcuser/'.$key;

 			$date = date('Y-m-d H:i:s');

 			 

 			$content = 

 			'<p> Email kurtarma talebinde bulundunuz. Eğer şifrenizi kurtarmak istiyorsanız. Aşağıdaki bağlantıya tıklayınız. </p>'.

 			'<p> <a href="'.$recoverUrl.'"></a> </p>'.

 			'<table>
                <tr>
                    <td> Tarih </td>
                    <td> : </td>
                    <td>'.$date.'</td>
                </tr>
 
            </table>';

            echo $content;

            // $config = [
            //     'protocol'  => 'smtp',
            //     'smtp_host' => $ci->app->email->smtp_host,
            //     'smtp_user' => $ci->app->email->smtp_user,
            //     'smtp_pass' => $ci->app->email->smtp_pass,
            //     'smtp_port' => '465',
            //     'wordwrap'  => true,
            //     'mailtype'  => 'html',
            //     'charset'   => 'utf-8',
            //     'newline'   => '\r\n',
            //     'smtp_crypto' => 'ssl',
            // ];
			
			*/ 

			return false;
		}
	}



 ?>