<section class="mt-3 mt-xl-0 py-5 p-relative z-index-2">
	<div class="container">
		
		<div class="row">
			
			<div class="col-lg-12">
				<h4 class="text-color-light custom-text-10 font-weight-bold text-center custom-title-with-icon-center custom-title-with-icon custom-title-with-icon-primary pt-5 mt-5 mb-3"> Reset Password</h4>
				<h6 class="text-color-light font-weight-bold text-center custom-title-with-icon-center">Enter your email and we'll send you a link to reset your password.</h6>
				<form id="forgotPassword_form" class="contact-form" action="user/recoverPassword" method="POST" novalidate="novalidate" onsubmit="return false;">
				
					<div class="row justify-content-center">
						<div class="form-group d-block col-6">
							<input type="text" value="" data-msg-required="Please enter your name." maxlength="100" class="form-control py-4 px-4 rounded-0 text-color-light bg-color-secondary border-0" name="email" id="email" placeholder="Email">
							<span id="email_error" class="form_error"></span>
						</div>
					</div>

					<div class="row justify-content-center">
						<div class="form-group col-6">
							<button type="submit" href="demo-digital-agency-2-dark-our-blog.html" class="btn btn-outline custom-btn-outline btn-primary rounded-0 text-color-light custom-text-4 bg-color-hover-transparent text-color-hover-light font-weight-semibold custom-button-with-arrow px-4 py-3 w-100" onclick="forgotPassword_form(event);">Submit</button>
						</div>
					</div>

					<div class="row justify-content-center" id="result"></div>

				</form>
			</div>
		</div>
	</div>
</section>




<script>
	
	function forgotPassword_form(e)
	{
 

		let form = document.getElementById("forgotPassword_form");
        let formAction = form.action;
        let formData = new FormData(form);

  
        var xmlhttp = ajaxReq();
 		xmlhttp.open("POST", formAction, true);  
 		xmlhttp.send(formData); 

		xmlhttp.onreadystatechange = function () {
		    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		       try {
 
		           let result = JSON.parse(xmlhttp.responseText);
		           //let form_errors = document.querySelectorAll('.form_error');
		           let form_errors = document.querySelector('.form_error').innerHTML="";;

					// for(let i = 0; i < form_errors.length; i++){
					// 	form_errors[i].innerHTML="";
			 	// 	}

			 		// result div i temizle 
			 		document.getElementById("result").innerHTML='';
			 		 
		           	if(result.error){
		           		if(result.email_error){
		           			error_show(result.email_error,'email_error');
		           		}
		           		document.getElementById("result").innerHTML = result.message;

		           	}else{

		           		document.getElementById("result").innerHTML = result.message;
		           		// if(result.email_success){
 		           	// 		window.location.href = "<?=base_url('user/login');?>";
		           		// }
		           		
 		           		
		           	}


		       } catch (error) {
		          // throw Error;
 		       }
		    }
		}


		e.preventDefault();

	}


</script>