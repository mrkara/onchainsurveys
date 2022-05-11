
<section class="mt-3 mt-xl-0 py-5 p-relative z-index-2">
	<div class="container">
		
		<div class="row">
			
			<div class="col-lg-12">
				<h4 class="text-color-light custom-text-10 font-weight-bold text-center custom-title-with-icon-center custom-title-with-icon custom-title-with-icon-primary pt-5 mt-5 mb-5">Registration</h4>
				
				<form id="register_form" class="" action="user/create" method="POST">
					 <div class="row justify-content-center">
						<div class="form-group d-block col-6">
							<input type="text" value="" maxlength="100" class="form-control py-4 px-4 rounded-0 text-color-light bg-color-secondary border-0" name="name" id="name" placeholder="Name" >
							<span id="name_error" class="form_error"></span>
						</div>
					</div>

					<div class="row justify-content-center">
						<div class="form-group d-block col-6">
							<input type="text" value="" maxlength="100" class="form-control py-4 px-4 rounded-0 text-color-light bg-color-secondary border-0" name="surname" id="surname" placeholder="Surname">
							<span id="surname_error" class="form_error"></span>
						</div>
					</div>

					<div class="row justify-content-center">
						<div class="form-group d-block col-6">
							<input type="text" value="" maxlength="100" class="form-control py-4 px-4 rounded-0 text-color-light bg-color-secondary border-0" name="casper_key" id="casper_key" placeholder="Casper Public Key" autocomplete="off">
							<span id="casper_key_error" class="form_error"></span>
						</div>
					</div>

					

					<div class="row justify-content-center">
						<div class="form-group d-block col-6">
							<input type="text" value="" maxlength="100" class="form-control py-4 px-4 rounded-0 text-color-light bg-color-secondary border-0" name="user_name" id="user_name" placeholder="User Name" autocomplete="off">
							<span id="user_name_error" class="form_error"></span>
						</div>
					</div>

					<div class="row justify-content-center">
						<div class="form-group d-block col-6">
							<input type="text" value="" maxlength="100" class="form-control py-4 px-4 rounded-0 text-color-light bg-color-secondary border-0" name="email" id="email" placeholder="Email" autocomplete="off">
							<span id="email_error" class="form_error"></span>
						</div>
					</div>

					<div class="row justify-content-center">
						<div class="form-group col-6">
							<input type="password" value="" maxlength="100" class="form-control py-4 px-4 rounded-0 text-color-light bg-color-secondary border-0" name="password" id="password" placeholder="Password" >
							<span id="password_error" class="form_error"></span>
						</div>
					</div>

					<div class="row justify-content-center">
						<div class="form-group col-6">
							<input type="password" value=""  maxlength="100" class="form-control py-4 px-4 rounded-0 text-color-light bg-color-secondary border-0" name="confirm_password" id="confirm_password" placeholder="Confirm Password" >
							<span id="confirm_password_error" class="form_error"></span>
						</div>
					</div>

					<div class="row justify-content-center">
						<div class="form-group d-block col-6">
							<select  class="form-control py-4 px-4 rounded-0 text-color-light bg-color-secondary border-0" name="gender" id="gender">
								<option value="">Select Gender</option>
								<option value="female" >Female</option>  
								<option value="male" >Male</option>  
								<option value="not" >I do not want to specify</option> 
							</select>
						</div>
					</div>
 
					<div class="row justify-content-center">
						<div class="form-group d-block col-6">
							<select  class="form-control py-4 px-4 rounded-0 text-color-light bg-color-secondary border-0" name="country" id="country">
								<option value="">Country</option>
								<?//=pre($countries);?>
								<?php foreach ($countries as $key => $value) {?>

									<option value="<?=$value->name;?>" required >
										<?=$value->name;?></option>  
								<?php } ?>
							</select>
							<span id="country_error" class="form_error"></span>

						</div>
					</div>

					<div class="row justify-content-center">
						<div class="form-group col-6">
							<select name="birth_year" id="birth_year" class="form-control py-4 px-4 rounded-0 text-color-light bg-color-secondary border-0" >
							    <option value="">Year Of Birth</option>
							    <?php 
				        			$year = (date('Y')-16);
					        			$end_year = $year-90;
				        			for ($year; $year > $end_year; $year--) {?>
				        			 <option value="<?=$year;?>"
				        			 	><?=$year;?></option>
				        		<?php } ?>
							    
							</select>
							<span id="birth_year_error" class="form_error"></span>
						</div>
					</div>

					<!-- <div class="row justify-content-center">
						<div class="form-group col-6">
							<input type="file" name="avatar" id="avatar" accept="image/*" placeholder="Avatar" />
							<span id="avatar_error" class="form_error"></span>			
						</div>
					</div> -->

					<div class="row justify-content-center">
						<div class="form-group col-6">
							<button type="submit" id="register_btn" class="btn btn-outline custom-btn-outline btn-primary rounded-0 text-color-light custom-text-4 bg-color-hover-transparent text-color-hover-light font-weight-semibold custom-button-with-arrow px-4 py-3 w-100" onclick="register_form(event);">Register</button>
						</div>
					</div>

				</form>
				<div id="load_image" class="spinner-border text-primary" style="display: none; position: absolute;left: 50%;" role="status"><span class="sr-only ">Loading...</span></div>

				<!-- formdan gelen sonuçlar -->
				<div id="result" class="text-center"></div>
				
			</div>
		</div>
	</div>
</section>


<script>
	function register_form(e){
		//console.log(e);

		let form = document.getElementById("register_form");
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
		       //	document.getElementById("result").innerHTML = this.responseText;

		       	 	load_image.style.display = "none";

		       	 	// gelen datayı json çevir 
		        	let result = JSON.parse(xmlhttp.responseText);

		        	// .form_error clasına sahip tüm elementleri seç
		        	let form_errors = document.querySelectorAll('.form_error');

		        	// seçilen elementlerin içeriklerini temizle (hata mesajlerını temizle)
					for(let i = 0; i < form_errors.length; i++){
						form_errors[i].innerHTML="";
			 		}

			 		// result div i temizle 
			 		document.getElementById("result").innerHTML='';
			 		 

		           	if(result.error){
		           		error_show(result.user_name_error,'user_name_error');
		           		error_show(result.email_error,"email_error");
		           		error_show(result.password_error,"password_error");
		           		error_show(result.confirm_password_error,"confirm_password_error");
 		           		error_show(result.casper_key_error,"casper_key_error");
 
		           		document.getElementById("result").innerHTML = result.message;

		           	}else{
		           		document.getElementById("result").innerHTML = result.message;
 		           		window.location.href = "<?=base_url('user/login');?>";
		           	}


		       } catch (error) {
		          // throw Error;
 		       }
		    }
		}
 

		e.preventDefault();
	}
</script>