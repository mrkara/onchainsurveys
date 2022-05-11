
<section class="mt-3 mt-xl-0 py-5 p-relative z-index-2">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h4 class="text-color-light custom-text-10 font-weight-bold text-center custom-title-with-icon-center custom-title-with-icon custom-title-with-icon-primary pt-5 mt-5 mb-5">Login</h4>

				<div id="load_image" class="spinner-border text-primary" style="display: none; position: absolute;left: 50%;" role="status"><span class="sr-only ">Loading...</span></div>

				<div class="row justify-content-center text-center" id="result"></div>

				<form id="login_form" class="" action="user/login_in/" method="POST"  onsubmit="return false;">  
					 

					<div class="row justify-content-center">
						<div class="form-group d-block col-6">
							<input type="text" value="" data-msg-required="Please enter your name." maxlength="100" class="form-control py-4 px-4 rounded-0 text-color-light bg-color-secondary border-0" name="user_name" id="user_name" placeholder="User Name">
							<span id="user_name_error" class="form_error"></span>
						</div>
					</div>

					<div class="row justify-content-center">
						<div class="form-group col-6">
							<input type="password" value="" data-msg-required="Please enter the password."  maxlength="100" class="form-control py-4 px-4 rounded-0 text-color-light bg-color-secondary border-0" name="password" id="password" placeholder="Password" >
							<span id="password_error" class="form_error"></span>
							<a href="user/forgotpassword" class="p-1 float-end">Forgot your password?</a>
						</div>
					</div>

					<div class="row justify-content-center">
						<div class="form-group col-6">
							<button type="submit" href="javascript::" class="btn btn-outline custom-btn-outline btn-primary rounded-0 text-color-light custom-text-4 bg-color-hover-transparent text-color-hover-light font-weight-semibold custom-button-with-arrow px-4 py-3 w-100" onclick="login_form(event);" id="login_btn">Login</button>
 						</div>
					</div>

					 

					<div class="row justify-content-center">
						<div class="form-group col-6 text-center">
							<span class="text-white"> Need an account ?</span> <a href="user/register" id="sign_up">Sign Up</a>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</section>


<script>
	

	function login_form(e)
	{
 

		let form = document.getElementById("login_form");
        let formAction = form.action;
        let formData = new FormData(form);

        // loading image
       	let load_image = document.querySelector("#load_image");
 			load_image.style.display="block";
 

        var xmlhttp = ajaxReq();
 		xmlhttp.open("POST", formAction, true);  
		//xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send(formData); 

		xmlhttp.onreadystatechange = function () {
		    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		       try {
 					
 					load_image.style.display = "none";

		           let result = JSON.parse(xmlhttp.responseText);

		           let form_errors = document.querySelectorAll('.form_error');

					for(let i = 0; i < form_errors.length; i++){
						form_errors[i].innerHTML="";
			 		}

			 		// result div i temizle 
			 		document.getElementById("result").innerHTML='';
			 		
		           	if(result.error){
		           		if(result.user_name_error){
		           			error_show(result.user_name_error,'user_name_error');
 		           		}if(result.password_error){
		           			error_show(result.password_error,"password_error");
 		           		}
		           		 
		           		document.getElementById("result").innerHTML = result.message;

		           	}else{
		           		document.getElementById("result").innerHTML = result.message;
 		           		window.location.href = "<?=base_url('');?>";
		           	}


		       } catch (error) {
		          // throw Error;
 		       }
		    }
		}


		e.preventDefault();

	}

</script>