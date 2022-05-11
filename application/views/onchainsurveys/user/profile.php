<?php //pre($item); ?>
<?php //pre($this->session->userdata()); ?>

<section class="mt-3 mt-xl-0 py-5 p-relative z-index-2">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 pt-5 mt-5 mb-5">
				<!-- content start -->
					<div class="container pt-3 pb-2">

					<div class="row pt-2">
						<div class="col-lg-3 mt-4 mt-lg-0">

							<aside class="sidebar mb-4 " id="sidebar" style="margin-left: 15px !important;">
								<h4 class="text-primary text-uppercase text-left" style="margin-left: 6px;">Welcome <?=$item->user_name;?> !!</h4>
								<ul class="nav nav-list flex-column mb-5 ms-2" id="profile_sidebar_top" >
									<li class="nav-item">User Type: ??</li>
									<li class="nav-item">User Id:  #<?=$item->id;?></li>
									
								</ul>
							</aside>
							

							<aside class="sidebar mt-2" id="sidebar">
								<ul class="nav nav-list flex-column mb-5" id="profile_sidebar">
									<li class="nav-item"><a class="nav-link text-3 active" onclick="open_profile();">My Profile</a></li>
									<!-- <li class="nav-item"><a class="nav-link text-3" href="#">Profil</a></li> -->
									<li class="nav-item"><a class="nav-link text-3" id="password_update" onclick="open_password_update();">Update Password</a></li>
									<li class="nav-item"><a class="nav-link text-3" href="survey/my_surveys">My Survey</a></li>
									<li class="nav-item"><a class="nav-link text-3" href="survey/history">Survey History  </a></li>
									<?php if(is_superUser()){?>
										<li class="nav-item"><a class="nav-link text-3" href="user/userlist"> User List </a></li>
									<?php } ?>
									
								</ul>
							</aside>

						</div>
						<div class="col-lg-9" id="profile_form_container">

							<form role="form" id="profile_form" class="" action="user/update" >  
								<div class="form-group row">
							        <label class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2  ">Name</label>
							        <div class="col-lg-9 has-success">
							            <input class="form-control text-3 h-auto py-2 bg-color-secondary" type="text" name="name" value="<?=$item->name;?>">
							            <span id="name_error" class="form_error"></span>
							        </div>
							    </div>
							    <div class="form-group row">
							        <label class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2  ">Surname</label>
							        <div class="col-lg-9 has-success">
							            <input class="form-control text-3 h-auto py-2 bg-color-secondary" type="text" name="surname" value="<?=$item->surname;?>" >
							            <span id="surname_error" class="form_error"></span>
							        </div>
							    </div>
								<div class="form-group row">
							        <label class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2 required">Username</label>
							        <div class="col-lg-9">
							            <input class="form-control text-3 h-auto py-2 bg-color-secondary" type="text" name="user_name" value="<?=$item->user_name;?>" required="">
							            <span id="user_name_error" class="form_error"></span>
							        </div>
							    </div>

							    <div class="form-group row">
							        <label class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2  ">Casper Public Key</label>
							        <div class="col-lg-9">
							            <input class="form-control text-3 h-auto py-2 bg-color-secondary" type="text" name="casper_key" value="<?=$item->casper_key;?>" required="" autocomplete="off">
							            <span id="casper_key_error" class="form_error"></span>
							        </div>
							    </div>


							    
							    <div class="form-group row">
							        <label class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2 required">Email</label>
							        <div class="col-lg-9">
							            <input class="form-control text-3 h-auto py-2 bg-color-secondary" type="email" name="email" value="<?=$item->email;?>" required="">
							            <span id="surname_error" class="form_error"></span>
							        </div>
							    </div>

							    <div class="form-group row">
							        <label class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2">Gender</label>
							        <div class="col-lg-9">
							        	<select class="form-control text-3 h-auto py-2 bg-color-secondary" name="gender" id="gender">
											<option value="">Select Gender</option>
											<option value="female" <?= $item->gender == 'female' ? ' selected' : null; ?>>Female</option>
											<option value="male" <?= $item->gender == 'male' ? ' selected' : null; ?>>Male</option>  
											<option value="not" <?= $item->gender == 'not' ? ' selected' : null; ?>>I do not want to specify</option> 
										</select>
										<span id="gender_error" class="form_error"></span>
							        </div>
							    </div>
 

 							    <div class="form-group row">
							        <label class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2">Country</label>
							        <div class="col-lg-9">
							        	<select class="form-control text-3 h-auto py-2 bg-color-secondary" name="country" id="country">
											<option value="">Country</option>
											<?php foreach ($countries as $key => $value) {?>
												<option value="<?=$value->name;?>" required
													<?php echo  $item->country == $value->name  ? ' selected' : null; ?> >
													<?=$value->name;?></option>  
											<?php } ?>
										</select>
										<span id="country_error" class="form_error"></span>
							        </div>
							    </div>

							    <?//=$item->birth_year;?>
							    <div class="form-group row">
							        <label class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2">Year Of Birth</label>
							        <div class="col-lg-9">
							        	<select class="form-control text-3 h-auto py-2 bg-color-secondary" name="birth_year" id="birth_year">
							        		<option value="">Year Of Birth</option>
							        		<?php 
							        			$year = (date('Y')-16);
 							        			$end_year = $year-90;
							        			for ($year; $year > $end_year; $year--) {?>
							        			 <option value="<?=$year;?>" 
							        			 	<?php echo $item->birth_year == $year ? ' selected' : null;?>
							        			 	><?=$year;?></option>
							        		<?php } ?>
 										</select>
										<span id="birth_year_error" class="form_error"></span>
							        </div>
							    </div>
							    
							   <!--  <div class="form-group row">
							        <label class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2 required">Password</label>
							        <div class="col-lg-9">
							            <input class="form-control text-3 h-auto py-2 bg-color-secondary" type="password" name="password" value="" required="">
							        </div>
							    </div>
							    <div class="form-group row">
							        <label class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2 required">Confirm password</label>
							        <div class="col-lg-9">
							            <input class="form-control text-3 h-auto py-2 bg-color-secondary" type="password" name="confirmPassword" value="" required="">
							        </div>
							    </div> -->
							    <div class="form-group row">
									<div class="form-group col-lg-9">

									</div>
									<div class="form-group col-lg-3">
										<input type="submit" value="Save" class="btn btn-outline custom-btn-outline btn-primary rounded-0 text-color-light bg-color-hover-transparent text-color-hover-light font-weight-semibold custom-button-with-arrowbtn float-end" data-loading-text="Loading..." onclick="profile_form(event);">
									</div>

									<div id="load_image" class="spinner-border text-primary" style="display: none; position: absolute;left: 50%;" role="status"><span class="sr-only ">Loading...</span></div>
									<div id="result" class="text-center"></div>
							    </div>
							</form>

						</div>

						<div class="col-lg-9 d-none" id="password_update_form_container" >

							<form role="form" id="password_form" class="needs-validation" action="user/resetpassword" novalidate="novalidate">
							    
							    <div class="form-group row">
							        <label class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2 required">Password</label>
							        <div class="col-lg-9">
							            <input class="form-control text-3 h-auto py-2 bg-color-secondary" type="password" name="password"  required="">
							            <span id="password_error" class="form_error"></span>
							        </div>
							    </div>
							    <div class="form-group row">
							        <label class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2">Confirm Password</label>
							        <div class="col-lg-9">
							            <input class="form-control text-3 h-auto py-2 bg-color-secondary" type="password" name="confirm_password">
							        	<span id="confirm_password_error" class="form_error"></span>
							        </div>
							    </div>
							    
							    <div class="form-group row">
									<div class="form-group col-lg-9">

									</div>
									<div class="form-group col-lg-3">
										<input type="submit" value="Update" class="btn btn-outline custom-btn-outline btn-primary rounded-0 text-color-light bg-color-hover-transparent text-color-hover-light font-weight-semibold custom-button-with-arrowbtn float-end" data-loading-text="Loading..." onclick="password_form(event);">
									</div>

									<div id="result_password" class="text-center"></div>

							    </div>
							</form>

						</div>
					</div>

				</div>
				<!-- content end -->
			</div>
		</div>
	</div>
</section>

<script>
	function open_password_update () {
		document.getElementById('profile_form_container').classList.add('d-none');
		document.getElementById('password_update_form_container').classList.remove('d-none');
	}

	function open_profile () {
		document.getElementById('password_update_form_container').classList.add('d-none');
		document.getElementById('profile_form_container').classList.remove('d-none');
	}


	function profile_form(e)
	{	

		let form = document.getElementById("profile_form");
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
 
		           let form_errors = document.querySelectorAll('.form_error');
					for(let i = 0; i < form_errors.length; i++){
						form_errors[i].innerHTML="";
			 		}

			 		// result div i temizle 
			 		document.getElementById("result").innerHTML='';
			 		
			 		load_image.style.display = "none";

			 		let result = JSON.parse(xmlhttp.responseText);
 
		           	if(result.error){
 		           		error_show(result.user_name_error,'user_name_error');
 		           		error_show(result.gender_error,'gender_error');
		           		//error_show(result.password_error,"password_error");
 		           		//error_show(result.confirm_password_error,"confirm_password_error");
		           		//error_show(result.education_error,"education_error");
		           		//error_show(result.country_error,"country_error");
		           		//error_show(result.birth_year_error,"birth_year_error");

		           		document.getElementById("result").innerHTML = result.message;

		           	}else{
 		           		document.getElementById("result").innerHTML = result.message;
 		           	}


		       } catch (error) {
		          // throw Error;
		           console.log(error);
 		       }
		    }
		}

 		
		e.preventDefault();
	}



	function password_form(e)
	{
		let form = document.getElementById("password_form");
        let formAction = form.action;
        let formData = new FormData(form);

 		var xmlhttp = ajaxReq();
 		xmlhttp.open("POST", formAction, true);  
		//xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send(formData); 

		xmlhttp.onreadystatechange = function () {
		    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		       try {
 
		           let form_errors = document.querySelectorAll('.form_error');
					for(let i = 0; i < form_errors.length; i++){
						form_errors[i].innerHTML="";
			 		}

			 		// result div i temizle 
			 		document.getElementById("result_password").innerHTML='';
			 		
			 		let result = JSON.parse(xmlhttp.responseText);

		           	if(result.error){
 		           		error_show(result.password_error,"password_error");
 		           		error_show(result.confirm_password_error,"confirm_password_error");
		           		 
		           		document.getElementById("result_password").innerHTML = result.message;

		           	}else{
		           		document.getElementById("result_password").innerHTML = result.message;
 		           	}


		       } catch (error) {
		          // throw Error;
 		       }
		    }
		}

		e.preventDefault();
	}




</script>